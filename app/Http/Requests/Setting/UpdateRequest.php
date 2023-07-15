<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
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

    public function run($id)
    {
        try {
            $setting = Setting::find($id);
            if (!$setting)
                abort(404);
            if ($this->filled('display_name'))
                $setting->display_name = $this->display_name;
            if ($this->filled('namespace'))
                $setting->namespace = $this->namespace;
            if ($this->filled('key'))
                $setting->key = $this->key;
            if ($this->filled('value'))
                $setting->value = $this->value;
            if ($this->filled('type'))
                $setting->type = $this->type;
            if ($setting->save())
                return redirect()->route('settings.index');
            else
                return redirect()->back()->withErrors('failed', 'Failed to edit the setting');
        } catch (\Exception $ex) {
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
            'display_name' => 'nullable|string',
            'namespace' => 'nullable|string',
            'key' => 'nullable|string|unique:settings',
            'type' => 'nullable|in:string,integer,float,boolean,color',
            'value' => 'nullable|required_with:type',
        ];
    }
}
