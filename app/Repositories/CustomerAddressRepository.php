<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\CustomerAddress;

class CustomerAddressRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return CustomerAddress::get();
    }

    public function find($id)
    {
        return CustomerAddress::findOrFail($id);
    }

    public function create($data)
    {
        $address = new CustomerAddress();
        $address->latitude = $data['latitude'];
        $address->longitude = $data['longitude'];
        $address->district = $data['district'];
        $address->street = $data['street'];
        $address->address_one = $data['address_one'];

        if (isset($data['address_two'])) {
            $address->address_two = $data['address_two'];
        }

        $address->isDefault = $data['isDefault'];
        $address->address_type_id = $data['address_type_id'];
        $address->use_for = $data['use_for'];
        $address->postal_code = $data['postal_code'];
        $address->status = $data['status'];
        $address->customer_id = $data['customer_id'];
        $address->city_id = $data['city_id'];
        $address->save();
    }

    public function update($data, $id)
    {
        $address = CustomerAddress::findOrFail($id);
        $address->latitude = $data['latitude'];
        $address->longitude = $data['longitude'];
        $address->district = $data['district'];
        $address->street = $data['street'];
        $address->address_one = $data['address_one'];

        if (isset($data['address_two'])) {
            $address->address_two = $data['address_two'];
        }

        $address->isDefault = $data['isDefault'];
        $address->address_type_id = $data['address_type_id'];
        $address->use_for = $data['use_for'];
        $address->postal_code = $data['postal_code'];
        $address->status = $data['status'];
        $address->customer_id = $data['customer_id'];
        $address->city_id = $data['city_id'];
        $address->save();
    }

    public function delete($id)
    {
        $address = CustomerAddress::findOrFail($id);
        $address->delete();
    }

}
