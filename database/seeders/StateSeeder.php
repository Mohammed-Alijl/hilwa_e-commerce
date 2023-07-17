<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
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
            $state = new State();
            $state->name = $name;
            $state->country_id = 1;
            $state->save();
        }
    }
}
