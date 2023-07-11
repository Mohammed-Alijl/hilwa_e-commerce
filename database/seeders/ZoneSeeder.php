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
        $names = [
            'Eastern Province',
            'Al Bahah Province',
            'Al Jawf Province',
            'Northern Borders Province',
            'Riyadh Province',
            'Qassim Province',
            'Al Madinah Province',
            'Tabuk Province',
            'Jazan Province',
            'Hail Province',
            'Asir Province',
            'Makkah Province',
            'Najran Province',
        ];
        foreach ($names as $name){
            $zone = new Zone();
            $zone->name = $name;
            $zone->country_id = 1;
            $zone->save();
        }
    }
}
