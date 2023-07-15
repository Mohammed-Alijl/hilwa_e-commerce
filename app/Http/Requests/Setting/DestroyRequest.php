<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id){
        try {
            $setting = Setting::find($id);
            if(!$setting)
                abort(404);
            if($setting->delete())
                return redirect()->route('settings.index')->with('delete-success',__('success_messages.setting.delete'));
            else
                return redirect()->back()->withErrors('failed','failed to delete the setting');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
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
