<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            [
                'name' => 'zone1',
                'city_id' => 1,
            ],
            [
                'name' => 'zone2',
                'city_id' => 1,
            ],
            [
                'name' => 'zone3',
                'city_id' => 1,
            ],
            [
                'name' => 'zone4',
                'city_id' => 2,
            ],
            [
                'name' => 'zone5',
                'city_id' => 2,
            ],
            [
                'name' => 'zone6',
                'city_id' => 3,
            ],
            [
                'name' => 'zone7',
                'city_id' => 3,
            ],
        ];
        foreach ($zones as $zone){
            Zone::create([
                'name'=>$zone['name'],
                'city_id'=>$zone['city_id']
            ]);
        }
    }
}
