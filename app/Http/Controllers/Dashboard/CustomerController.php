<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\AddressType;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    use AttachmentTrait;

    function __construct()
    {
        $this->middleware('permission:view_customer', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_customer', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rowNumber = 1;
        $customers = User::where('type', 'customer')->get();
        return view('dashboard.customers.index', compact('rowNumber', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::get();
        $address_types = AddressType::get();
        return view('dashboard..customers.create', compact('states', 'address_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $addressFields = ['latitude', 'longitude', 'isDefault', 'address_type', 'use_for'];
        if (!$this->hasEqualArrayCount($request, $addressFields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }

        $customer = new User();
        $customer->name = $request->first_name . " " . $request->last_name;
        $customer->password = Hash::make($request->password);
        $customer->email = $request->email;
        $customer->mobile_number = $request->mobile_number;

        if ($files = $request->file('pic')) {
            $imageName = $this->save_attachment($files, "img/customers");
        } else {
            $imageName = 'default.png';
        }

        $customer->image = $imageName;
        $customer->type = 'customer';
        $customer->save();

        $apiKey = env('GOOGLE_MAP_API_KEY');

        foreach ($request->latitude as $index => $latitude) {
            if ($index === 1) {
                continue;
            }

            $longitude = $request->longitude[$index];

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

                        if ($request->address_two[$index]) {
                            $address->address_two = $request->address_two[$index];
                        }

                        $address->isDefault = $request->isDefault[$index];
                        $address->address_type_id = $request->address_type[$index];
                        $address->use_for = $request->use_for[$index];
                        $address->postal_code = $this->extractAddressComponent($addressComponents, 'postal_code');
                        $address->status = $request->status[$index];
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = User::find($id);
        return view('dashboard.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = User::findOrFail($id);
        $states = State::get();
        $address_types = AddressType::get();
        return view('dashboard.customers.edit', compact('customer', 'states', 'address_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $addressFields = ['latitude', 'longitude', 'isDefault', 'address_type', 'use_for'];
        if (!$this->hasEqualArrayCount($request, $addressFields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }

        $customer = User::findOrFail($id);
        if ($request->filled('name')) {
            $customer->name = $request->name;
        }
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }
        if ($request->filled('email')) {
            $customer->email = $request->email;
        }
        if ($request->filled('mobile_number')) {
            $customer->mobile_number = $request->mobile_number;
        }

        if ($files = $request->file('pic')) {
            if ($customer->image != 'default.png') {
                $this->delete_attachment('img/customers/' . $customer->image);
            }
            $imageName = $this->save_attachment($files, "img/customers");
            $customer->image = $imageName;
        }
        $customer->save();

        $apiKey = env('GOOGLE_MAP_API_KEY');

        foreach ($request->latitude as $index => $latitude) {
            if ($index == count($request->address_id)) {
                continue;
            }

            $longitude = $request->longitude[$index];

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

                        if (!isset($request->address_id[$index])) {
                            $address = new CustomerAddress();
                        } else {
                            $addressId = $request->address_id[$index];
                            $address = CustomerAddress::find($addressId);
                            if (!$address) {
                                return redirect()->back()->withErrors('Address not found');
                            }
                        }

                        $address->latitude = $latitude;
                        $address->longitude = $longitude;
                        $address->district = $this->extractAddressComponent($addressComponents, 'sublocality_level_1');
                        $address->street = $this->extractAddressComponent($addressComponents, 'route');
                        $address->address_one = $data['results'][0]['formatted_address'];

                        if (isset($request->address_two[$index])) {
                            $address->address_two = $request->address_two[$index];
                        }

                        $address->isDefault = $request->isDefault[$index];
                        $address->address_type_id = $request->address_type[$index];
                        $address->use_for = $request->use_for[$index];
                        $address->postal_code = $this->extractAddressComponent($addressComponents, 'postal_code');
                        $address->status = $request->status[$index];
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

        return redirect()->route('customers.index')->with('edit-success', __('success_messages.customer.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = User::findOrFail($id);
        if ($customer->image != 'default.png')
            $this->delete_attachment('img/customers/' . $customer->image);
        $customer->delete();
        return redirect()->back()->with('delete-success', __('success_messages.customer.delete.success'));
    }

    public function lookupLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $apiKey = env('GOOGLE_MAP_API_KEY');
        $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] === 'OK' && count($data['results']) > 0) {
                $addressComponents = $data['results'][0]['address_components'];
                $country = $this->extractAddressComponent($addressComponents, 'country');

                // Validate if the country is Saudi Arabia
                if (strcasecmp($country, 'Saudi Arabia') === 0) {
                    // Country is Saudi Arabia, continue processing
                    $locationDetails = [
                        'postal_code' => $this->extractAddressComponent($addressComponents, 'postal_code'),
                        'address' => $data['results'][0]['formatted_address'],
                        'district' => $this->extractAddressComponent($addressComponents, 'sublocality_level_1'),
                        'street' => $this->extractAddressComponent($addressComponents, 'route'),
                        'state' => $this->extractAddressComponent($addressComponents, 'administrative_area_level_1'),
                        'city' => $this->extractAddressComponent($addressComponents, 'administrative_area_level_2'),
                    ];
                    return response()->json($locationDetails);
                } else {
                    // Country is not Saudi Arabia, return an error response
                    return response()->json(['error' => 'The provided location is not within Saudi Arabia.'], 400);
                }
            }
        }

        return response()->json(['error' => 'Location not found'], 404);
    }

    private function hasEqualArrayCount($request, $fields)
    {
        $count = count($request->{$fields[0]});
        foreach ($fields as $field) {
            if (count($request->{$field}) !== $count) {
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
}
