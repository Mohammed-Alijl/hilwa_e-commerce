<?php

namespace App\Http\Requests\User;

use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use AttachmentTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required|exists:roles,name',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'code' => 'required|string|size:8||unique:admins,code',
            'mobile_number' => 'required|size:8|unique:admins,mobile_number',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('failed_messages.user.first_name.required'),
            'first_name.max' => __('failed_messages.user.first_name.max'),
            'last_name.required' => __('failed_messages.user.last_name.required'),
            'last_name.max' => __('failed_messages.user.last_name.max'),
            'email.required' => __('failed_messages.user.email.required'),
            'email.email' => __('failed_messages.user.email.email'),
            'email.unique' => __('failed_messages.user.email.unique'),
            'password.required' => __('failed_messages.user.password.required'),
            'password.same' => __('failed_messages.user.password.same'),
            'roles_name.required' => __('failed_messages.user.roles_name.required'),
            'roles_name.exists' => __('failed_messages.user.roles_name.exists'),
            'pic.mimes' => __('failed_messages.user.pic.mimes'),
            'pic.max' => __('failed_messages.user.pic.max'),
            'code.required' => __('failed_message.user.code.required'),
            'code.string' => __('failed_messages.user.code.string'),
            'code.size' => __('failed_messages.user.code.size'),
            'mobile_number.required' => __('failed_messages.user.mobile_number.required'),
            'mobile_number.string' => __('failed_messages.user.mobile_number.string'),
            'mobile_number.regex' => __('failed_messages.user.mobile_number.regex'),
            'city_id.required' => __('failed_messages.user.city_id.required'),
            'city_id.numeric' => __('failed_messages.user.city_id.numeric'),
            'city_id.exists' => __('failed_messages.user.city_id.exists'),
        ];
    }
}
