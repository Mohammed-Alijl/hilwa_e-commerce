<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleMapService
{
    public function geocode($latitude, $longitude){
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
                    return $locationDetails;
                } else {
                    // Country is not Saudi Arabia, return an error response
                    return ['error' => 'The provided location is not within Saudi Arabia.'];
                }
            }
        }
        return ['error' => 'Location not found'];
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
