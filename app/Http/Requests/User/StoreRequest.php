<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

    public function run(){
        try {
            $user = new User();
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->mobile_number = $this->mobile_number;
            $user->password = Hash::make($this->password);
            $user->roles_name = $this->roles_name;
            $user->city_id = $this->city_id;
            $user->code = $this->code;

            if ($files = $this->file('pic')) {
                $imageName = $this->save_attachment($files, "assets/img/users");
            }else
                $imageName = 'default.jpg';
            $user->image = $imageName;
            $user->save();

            $user->assignRole($this->roles_name);

            return redirect()->route('users.index')
                ->with('success',__('success_messages.user.add.success'));
        }catch (Exception $ex){
            return redirect()->back()->withErrors('failed',$ex->getMessage());
        }

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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'array|required|exists:roles,name',
            'pic'=>'mimes:jpeg,jpg,png,svg|max:5000',
            'code'=>'required|string|size:8',
            'mobile_number'=>'required|string|regex:/^\d{8}$/',
            'city_id'=>'required|numeric|exists:cities,id'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'=>__('failed_messages.user.first_name.required'),
            'first_name.max'=>__('failed_messages.user.first_name.max'),
            'last_name.required'=>__('failed_messages.user.last_name.required'),
            'last_name.max'=>__('failed_messages.user.last_name.max'),
            'email.required'=>__('failed_messages.user.email.required'),
            'email.email'=>__('failed_messages.user.email.email'),
            'email.unique'=>__('failed_messages.user.email.unique'),
            'password.required'=>__('failed_messages.user.password.required'),
            'password.same'=>__('failed_messages.user.password.same'),
            'roles_name.array'=>__('failed_messages.user.roles_name.array'),
            'roles_name.required'=>__('failed_messages.user.roles_name.required'),
            'roles_name.exists'=>__('failed_messages.user.roles_name.exists'),
            'pic.mimes'=>__('failed_messages.user.pic.mimes'),
            'pic.max'=>__('failed_messages.user.pic.max'),
            'code.required'=>__('failed_message.user.code.required'),
            'code.string'=>__('failed_messages.user.code.string'),
            'code.size'=>__('failed_messages.user.code.size'),
            'mobile_number.required'=>__('failed_messages.user.mobile_number.required'),
            'mobile_number.string'=>__('failed_messages.user.mobile_number.string'),
            'mobile_number.regex'=>__('failed_messages.user.mobile_number.regex'),
            'city_id.required'=>__('failed_messages.user.city_id.required'),
            'city_id.numeric'=>__('failed_messages.user.city_id.numeric'),
            'city_id.exists'=>__('failed_messages.user.city_id.exists'),
        ];
    }
}
