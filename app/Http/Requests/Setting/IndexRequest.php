<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
use App\Models\ZipCode;
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
        $settings = Setting::get();
        $setting = new Setting();
        $zipCodes  = ZipCode::get();
        return view('Front-end.settings.index',compact('settings','setting','zipCodes'));
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