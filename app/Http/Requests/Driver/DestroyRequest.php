<?php

namespace App\Http\Requests\Driver;

use App\Models\Driver;
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
        $driver = Driver::find($id);
        if(!$driver)
            abort(404);
        $driver->delete();
        return redirect()->route('drivers.index')->with('delete-success',__('success_messages.driver.delete.success'));
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
