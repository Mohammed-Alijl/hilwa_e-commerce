<?php

namespace App\Http\Requests\User;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
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
            $userRole = $user->roles->pluck('name','name')->all();
            if(!$user)
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            return view('Front-end.admins.show',compact('user','userRole'));
        }catch (\Exception $ex){
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
            //
        ];
    }
}
