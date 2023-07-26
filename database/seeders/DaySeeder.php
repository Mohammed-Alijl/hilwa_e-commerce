<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            [
                'name'=>'Sunday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Monday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Tuesday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Wednesday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Thursday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Friday',
                'delivery_available'=>0
            ],
            [
                'name'=>'Saturday',
                'delivery_available'=>0
            ],

        ];
        foreach ($days as $day){
            Day::create([
               'name'=>$day['name'],
               'delivery_available'=>$day['delivery_available']
            ]);
        }
    }
}
