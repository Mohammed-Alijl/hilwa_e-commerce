<?php

namespace App\Http\Requests\Timeslot;

use App\Models\Day;
use App\Models\Timeslot;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run(){
        $timeslot = new Timeslot();
        $timeslot->day_id = $this->day_id;
        $timeslot->start_time = $this->start_time;
        $timeslot->end_time = $this->end_time;
        $timeslot->total_order = $this->total_order;
        $timeslot->display_order = $this->display_order;
        $timeslot->save();
        $day = Day::find($this->day_id);
        $day->delivery_available = 1;
        $day->save();
        return redirect()->route('timeslots.index')->with('add-success',__('success_messages.timeslot.add.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'day_id'=>'required|numeric|exists:days,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'total_order' => 'required|integer|min:1',
            'display_order' => 'required|integer|min:1',
        ];
    }
}
