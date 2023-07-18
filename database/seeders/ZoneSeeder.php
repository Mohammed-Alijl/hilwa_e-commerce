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
                'store_id'=> 1,
                'status'=>true,
                'postal_codes'=>['12345', '67890', '11111'],
            ],
                        [
                'name' => 'zone2',
                'city_id' => 2,
                'store_id'=> 1,
                'status'=>true,
                'postal_codes'=>['12345', '5461', '22222'],
            ],
                        [
                'name' => 'zone3',
                'city_id' => 3,
                'store_id'=> 2,
                'status'=>true,
                'postal_codes'=>['12345', '67890', '33333'],
            ],
                        [
                'name' => 'zone4',
                'city_id' => 4,
                'store_id'=> 2,
                'status'=>true,
                'postal_codes'=>['987654', '67890', '444444'],
            ],
                        [
                'name' => 'zone5',
                'city_id' => 5,
                'store_id'=> 3,
                'status'=>true,
                'postal_codes'=>['12345', '67890', '5555'],
            ],

        ];
        foreach ($zones as $zone){
            Zone::create([
                'name'=>$zone['name'],
                'city_id'=>$zone['city_id'],
                'store_id'=>$zone['store_id'],
                'status'=>$zone['status'],
                'postal_codes'=>$zone['postal_codes'],
            ]);
        }
    }
}
