<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
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

    public function run()
    {
        try {
            $user = User::find($this->id);
            if (!$user)
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            if ($user->image != 'default.png')
                $this->delete_attachment('img/users/' . $user->image);
            if ($user->delete()) {
                return redirect()->back()->with('success-message',__('success_messages.user.destroy'));
            }
            else
                return redirect()->back()->withErrors(__('failed_messages.failed'));
        } catch (\Exception $ex) {
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