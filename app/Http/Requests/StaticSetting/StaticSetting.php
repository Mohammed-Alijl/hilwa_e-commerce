<?php

namespace App\Http\Requests\StaticSetting;

use Illuminate\Foundation\Http\FormRequest;

class StaticSetting extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run()
    {
        $staticSetting = \App\Models\StaticSetting::first();
        $staticSetting->update_open = $this->has('update_open');
        $staticSetting->confirm_place_order = $this->has('confirm_place_order');
        $staticSetting->create_new_order_back_office = $this->has('create_new_order_back_office');
        $staticSetting->show_unavailable_offers = $this->has('show_unavailable_offers');

        $staticSetting->save();
        return redirect()->back();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        ];
    }
}
