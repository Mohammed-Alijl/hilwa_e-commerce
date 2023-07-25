<?php

namespace App\Http\Requests\Driver;

use App\Models\Driver;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreRequest extends FormRequest
{
    use AttachmentTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run(){
        $driver = new Driver();
        $driver->name = $this->first_name . " " . $this->last_name;
        $driver->email = $this->email;
        $driver->mobile_number = $this->mobile_number;
        $driver->password = Hash::make($this->password);
        $driver->zone_id = $this->zone_id;
        $driver->address = $this->address;
            if ($files = $this->file('pic')) {
                $imageName = $this->save_attachment($files, "img/drivers");
            }else
                $imageName = 'default.png';
        $driver->status = $this->status;
        $driver->image = $imageName;
        $driver->save();
            return redirect()->route('drivers.index')
                ->with('add-success',__('success_messages.driver.add.success'));
        }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'required|size:8|unique:drivers,mobile_number',
            'zone_id'=>'required|numeric|exists:zones,id',
            'address'=>'string|max:255',
            'status'=>'required|boolean',
        ];
    }
}
