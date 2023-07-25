<?php

namespace App\Http\Requests\Driver;

use App\Models\Driver;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
{
    use AttachmentTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id)
    {
        $driver = Driver::find($id);
        if ($this->filled('name'))
            $driver->name = $this->name;
        if ($this->filled('password'))
            $driver->password = Hash::make($this->password);
        if ($this->filled('email'))
            $driver->email = $this->email;
        if ($this->filled('address'))
            $driver->address = $this->address;
        if ($this->filled('zone_id'))
            $driver->zone_id = $this->zone_id;
        if ($this->filled('status'))
            $driver->status = $this->status;
        if ($files = $this->file('pic')) {
            if ($driver->image != 'default.png')
                $this->delete_attachment('img/drivers/' . $driver->image);
            $imageName = $this->save_attachment($files, "img/drivers");
            $driver->image = $imageName;
        }
        $driver->save();
        return redirect()->route('drivers.index')->with('edit-success',__('success_messages.driver.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'max:255|string',
            'email' => 'email|unique:drivers,email,' . $this->route('driver'),
            'password' => 'same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'size:8|unique:drivers,mobile_number,' . $this->route('driver'),
            'zone_id'=>'numeric|exists:zones,id',
            'address'=>'string|max:255',
            'status'=>'boolean',
        ];
    }
}
