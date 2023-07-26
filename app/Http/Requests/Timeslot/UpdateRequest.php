<?php

namespace App\Http\Requests\Timeslot;

use App\Models\Timeslot;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id){
        $fields = ['start_time', 'end_time', 'total_order', 'display_order','timeslot_id'];
        if (!$this->hasEqualArrayCount($fields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }
        foreach ($this->start_time as $index=>$start_time){
            $timeslot = Timeslot::find($this->timeslot_id[$index]);
            $timeslot->start_time = $this->start_time[$index];
            $timeslot->end_time = $this->end_time[$index];
            $timeslot->total_order = $this->total_order[$index];
            $timeslot->display_order = $this->display_order[$index];
            $timeslot->save();
        }
        return redirect()->route('timeslots.index')->with('edit-success',__('success_messages.timeslot.edit.success'));
    }
    private function hasEqualArrayCount($fields)
    {
        if(!isset($this->fields))
            return false;
        $count = count($this->{$fields[0]});
        foreach ($fields as $field) {
            if (count($this->{$field}) !== $count) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'timeslot_id.*'=>'numeric|exists:timeslots,id',
            'start_time' => 'array',
            'start_time.*' => 'date_format:H:i',
            'end_time' => 'array',
            'end_time.*' => 'date_format:H:i',
            'total_order.*' => 'integer|min:1',
            'display_order.*' => 'integer|min:1',
        ];
    }
}
