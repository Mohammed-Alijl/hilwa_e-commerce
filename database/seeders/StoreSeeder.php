<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['store1','store2','store3'];
        foreach ($names as $name){
            $store = new Store();
            $store->name = $name;
            $store->save();
        }
    }
}
