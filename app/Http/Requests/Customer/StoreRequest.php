<?php


namespace App\Http\Requests\Customer;

use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    use AttachmentTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function run()
    {
        $addressFields = ['latitude', 'longitude', 'isDefault', 'address_type', 'use_for'];
        if (!$this->hasEqualArrayCount($addressFields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }

        $customer = new Customer();
        $customer->name = $this->first_name . " " . $this->last_name;
        $customer->password = Hash::make($this->password);
        $customer->email = $this->email;
        $customer->mobile_number = $this->mobile_number;

        if ($files = $this->file('pic')) {
            $imageName = $this->save_attachment($files, "img/customers");
        } else {
            $imageName = 'default.png';
        }

        $customer->image = $imageName;
        $customer->save();

        $apiKey = env('GOOGLE_MAP_API_KEY');

        foreach ($this->latitude as $index => $latitude) {
            if ($index === 1) {
                continue;
            }

            $longitude = $this->longitude[$index];

            $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['status'] === 'OK' && count($data['results']) > 0) {
                    $addressComponents = $data['results'][0]['address_components'];
                    $country = $this->extractAddressComponent($addressComponents, 'country');

                    if (strcasecmp($country, 'Saudi Arabia') === 0) {
                        $city_name = $this->extractAddressComponent($addressComponents, 'administrative_area_level_2');
                        $city = City::where('name', $city_name)->first();

                        if (!$city) {
                            $state_name = $this->extractAddressComponent($addressComponents, 'administrative_area_level_1');
                            $state = State::where('name', $state_name)->first();

                            if (!$state) {
                                return redirect()->back()->withErrors('State Is Not Exists');
                            } else {
                                $city = new City();
                                $city->name = $city_name;
                                $city->state_id = $state->id;
                                $city->save();
                            }
                        }

                        $address = new CustomerAddress();
                        $address->latitude = $latitude;
                        $address->longitude = $longitude;
                        $address->district = $this->extractAddressComponent($addressComponents, 'sublocality_level_1');
                        $address->street = $this->extractAddressComponent($addressComponents, 'route');
                        $address->address_one = $data['results'][0]['formatted_address'];

                        if ($this->address_two[$index]) {
                            $address->address_two = $this->address_two[$index];
                        }

                        $address->isDefault = $this->isDefault[$index];
                        $address->address_type_id = $this->address_type[$index];
                        $address->use_for = $this->use_for[$index];
                        $address->postal_code = $this->extractAddressComponent($addressComponents, 'postal_code');
                        $address->status = $this->status[$index];
                        $address->customer_id = $customer->id;
                        $address->city_id = $city->id;
                        $address->save();
                    }
                } else {
                    return redirect()->back()->withErrors('Please Enter A Latitude & Longitude In Saudi Arabia');
                }
            } else {
                return redirect()->back()->withErrors('The Response To Google Map Was Failed');
            }
        }

        return redirect()->route('customers.index')->with('add-success', __('success_messages.customer.add.success'));
    }

    private function hasEqualArrayCount($fields)
    {
        $count = count($this->{$fields[0]});
        foreach ($fields as $field) {
            if (count($this->{$field}) !== $count) {
                return false;
            }
        }
        return true;
    }

    private function extractAddressComponent($addressComponents, $type)
    {
        foreach ($addressComponents as $component) {
            if (in_array($type, $component['types'])) {
                return $component['long_name'];
            }
        }
        return '';
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'required|size:8|unique:customers,mobile_number',
            'latitude' => 'array|required',
            'latitude.*' => 'required|numeric',
            'longitude' => 'array|required',
            'longitude.*' => 'required|numeric',
            'isDefault' => 'array|required',
            'isDefault.*' => 'required|boolean',
            'address_type' => 'required|array',
            'address_type.*' => 'required|exists:address_types,id',
            'use_for' => 'required|array',
            'use_for.*' => ['required', Rule::in(['delivery', 'billing']),],
            'status' => 'required|array',
            'status.*' => 'required|boolean',
        ];
    }
}




















