<?php

namespace App\Http\Requests\User;

use App\Models\Admin;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UpdateRequest extends FormRequest
{
    public function __construct($id)
    {
        $this->id = $id;
    }
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

    public function run($id){
        try {
            $user = Admin::find($id);
            if(!$user)
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            if($this->filled('password')){
                $user->password = Hash::make($this->password);
                $user->save();
                return redirect()->route('users.index')->with('edit-success',__('success_messages.password.change'));
            }
            if($this->filled('first_name'))
                $user->first_name = $this->first_name;
            if($this->filled('last_name'))
                $user->last_name = $this->last_name;
            if($this->filled('email'))
                $user->email = $this->email;
            if($this->filled('mobile_number'))
                $user->mobile_number = $this->mobile_number;
            if($this->filled('city_id'))
                $user->city_id = $this->city_id;
            if($this->filled('roles_name'))
                $user->roles_name = $this->roles_name;
            if ($files = $this->file('pic')) {
                if($user->image != 'default.png')
                $this->delete_attachment('img/admins/' . $user->image);
                $imageName = $this->save_attachment($files, "img/admins");
                $user->image = $imageName;
            }
            if($user->save()){
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $user->assignRole($this->roles_name);
                return redirect()->route('admins.index')->with('edit-success',__('success_messages.data.edit'));
            }
            else
                return redirect()->withErrors(__('failed_messages.failed'));
        }catch (Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
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
            'first_name' => 'max:255|string',
            'last_name' => 'max:255|string',
            'email' => 'email|unique:admins,email,' . $this->id,
            'password' => 'same:confirm-password',
            'roles_name' => 'exists:roles,name',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'code'=>'string|size:8||unique:users,code',
            'mobile_number' => 'size:8|unique:admins,mobile_number,' . $this->id,
            'city_id'=>'numeric|exists:cities,id',
            'address'=>'string|max:255',
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
