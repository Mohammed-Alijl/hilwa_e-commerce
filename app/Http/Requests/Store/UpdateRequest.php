<?php

namespace App\Http\Requests\Store;

use App\Models\Store;
use App\Models\StoreTranslation;
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

    public function run($storeId)
    {
        $store = Store::findOrFail($storeId);
        $storeTranslation = StoreTranslation::where('language_id', $this->language_id)->where('store_id', $storeId)->first();
        if (!$storeTranslation) {
            $storeTranslation = new StoreTranslation();
            $storeTranslation->language_id = $this->language_id;
            $storeTranslation->store_id = $storeId;
        }
        $storeTranslation->name = $this->name;
        $storeTranslation->save();
        $store->email = $this->email;
        $store->mobile_number = $this->mobile_number;
        if ($this->filled('open_time'))
            $store->open_time = $this->open_time;
        if ($this->filled('close_time'))
            $store->close_time = $this->close_time;
        $store->city_id = $this->city_id;
        $store->latitude = $this->latitude;
        $store->longitude = $this->longitude;
        $store->zip_code = $this->zip_code;
        $store->status = $this->status;
        $store->save();
        return redirect()->route('stores.index')->with('edit-success', __('success_messages.store.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'language_id' => 'required|numeric|exists:languages,id',
            'name' => 'required|string|max:255,unique:store_translations,name,' . $this->route('store'),
            'email' => 'required|email|unique:stores,email,' . $this->route('store'),
            'mobile_number' => 'required|size:8|unique:stores,mobile_number,' . $this->route('store'),
            'open_time' => 'date_format:H:i',
            'close_time' => 'date_format:H:i|after:open_time',
            'city_id' => 'required|numeric|exists:cities,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'zip_code' => 'required|string|regex:/^\d{3,10}(,\d{3,10})*$/',
            'status' => 'required|boolean',
        ];
    }
}
