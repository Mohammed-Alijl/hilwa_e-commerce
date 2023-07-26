<?php

namespace App\Http\Requests\Unit;

use App\Models\Language;
use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run(){
        $rowNumber = 1;
        $units = Unit::get();
        $languages = Language::get();
        return view('Front-end.units.index',compact('rowNumber','units','languages'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
