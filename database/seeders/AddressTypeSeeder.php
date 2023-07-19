<?php

namespace Database\Seeders;

use App\Models\AddressType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['home','office','other'];
        foreach ($names as $name){
            $addressType = new AddressType();
            $addressType->name = $name;
            $addressType->save();
        }
    }
}
