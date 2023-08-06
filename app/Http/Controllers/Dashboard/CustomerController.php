<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Repositories\AddressTypeRepository;
use App\Repositories\CityRepository;
use App\Repositories\CustomerAddressRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\StateRepository;
use App\Services\GoogleMapService;
use App\Traits\AttachmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    use AttachmentTrait;

    private $customerRepository;
    private $stateRepository;
    private $addressTypeRepository;
    private $googleMapService;
    private $cityRepository;
    private $addressRepository;

    function __construct(CustomerRepository        $customerRepository,
                         StateRepository           $stateRepository,
                         AddressTypeRepository     $addressTypeRepository,
                         GoogleMapService          $googleMapService,
                         CityRepository            $cityRepository,
                         CustomerAddressRepository $addressRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->stateRepository = $stateRepository;
        $this->addressTypeRepository = $addressTypeRepository;
        $this->cityRepository = $cityRepository;
        $this->addressRepository = $addressRepository;
        $this->googleMapService = $googleMapService;
        $this->middleware('permission:view_customer', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_customer', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public
    function index()
    {
        $rowNumber = 1;
        $customers = $this->customerRepository->getAll();
        return view('dashboard.customers.index', compact('rowNumber', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        $states = $this->stateRepository->getAll();
        $address_types = $this->addressTypeRepository->getAll();
        return view('dashboard..customers.create', compact('states', 'address_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(StoreRequest $request)
    {
        $addressFields = ['latitude', 'longitude', 'isDefault', 'address_type', 'use_for'];
        if (!$this->hasEqualArrayCount($request, $addressFields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }

        $requestData = $request->only(['first_name', 'last_name', 'password', 'email', 'mobile_number']);
        $requestData += ['image' => $request->file('pic') ? $this->save_attachment($request->file('pic'), "img/customers") : 'default.png'];
        $customer = $this->customerRepository->create($requestData);


        foreach ($request->latitude as $index => $latitude) {
            if ($index === 1)
                continue;

            $locationDetails = $this->googleMapService->geocode($latitude, $request->longitude[$index]);

            if (!isset($locationDetails['error'])) {
                $city = City::where('name', $locationDetails['city'])->first();

                if (!$city) {
                    $state = State::where('name', $locationDetails['state'])->first();

                    if (!$state)
                        return redirect()->back()->withErrors('State Is Not Exists');
                    else
                        $city = $this->cityRepository->create(['name' => $locationDetails['city'], 'state_id' => $state->id]);
                }

                $addressDetails = [
                    'latitude' => $latitude,
                    'longitude' => $request->longitude[$index],
                    'district' => $locationDetails['district'],
                    'street' => $locationDetails['street'],
                    'address_one' => $locationDetails['address'],
                    'postal_code' => $locationDetails['postal_code'],
                    'isDefault' => $request->isDefault[$index],
                    'address_type_id' => $request->address_type[$index],
                    'use_for' => $request->use_for[$index],
                    'status' => $request->status[$index],
                    'customer_id' => $customer->id,
                    'city_id' => $city->id,
                ];
                if (isset($request->address_two[$index]))
                    $addressDetails += ['address_two' => $request->address_two[$index]];
                $this->addressRepository->create($addressDetails);
            } else {
                return redirect()->back()->withErrors($locationDetails['error']);
            }
        }

        return redirect()->route('customers.index')->with('add-success', __('success_messages.customer.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public
    function show($id)
    {
        $customer = $this->customerRepository->find($id);
        return view('dashboard.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        $customer = $this->customerRepository->find($id);
        $states = $this->stateRepository->getAll();
        $address_types = $this->addressTypeRepository->getAll();
        return view('dashboard.customers.edit', compact('customer', 'states', 'address_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(UpdateRequest $request, string $id)
    {
        $addressFields = ['latitude', 'longitude', 'isDefault', 'address_type', 'use_for'];
        if (!$this->hasEqualArrayCount($request, $addressFields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }
        $customer = $this->customerRepository->find($id);
        $customerData = $request->only(['name', 'email', 'mobile_number']);
        if ($request->filled('password'))
            $customerData += $request->password;

        if ($files = $request->file('pic')) {
            if ($customer->image != 'default.png') {
                $this->delete_attachment('img/customers/' . $customer->image);
            }
            $imageName = $this->save_attachment($files, "img/customers");
            $customerData += ['image' => $imageName];
        }
        $this->customerRepository->update($customerData, $id);

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
    public
    function destroy(string $id)
    {
        $this->customerRepository->delete($id);
        return redirect()->back()->with('delete-success', __('success_messages.customer.delete.success'));
    }

    public
    function lookupLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        return response()->json($this->googleMapService->geocode($latitude, $longitude));
    }

    private
    function hasEqualArrayCount($request, $fields)
    {
        $count = count($request->{$fields[0]});
        foreach ($fields as $field) {
            if (count($request->{$field}) !== $count) {
                return false;
            }
        }
        return true;
    }

    private
    function extractAddressComponent($addressComponents, $type)
    {
        foreach ($addressComponents as $component) {
            if (in_array($type, $component['types'])) {
                return $component['long_name'];
            }
        }
        return '';
    }
}
