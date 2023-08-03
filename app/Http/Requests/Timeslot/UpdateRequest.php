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
