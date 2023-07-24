<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateRequest;
use App\Http\Requests\Customer\DestroyRequest;
use App\Http\Requests\Customer\IndexRequest;
use App\Http\Requests\Customer\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        return $request->run();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, string $id)
    {
        return $request->run($id);
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
