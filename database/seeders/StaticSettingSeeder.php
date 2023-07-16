<?php

namespace Database\Seeders;

use App\Models\StaticSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staticSetting = new StaticSetting();
        $staticSetting->update_open = false;
        $staticSetting->confirm_place_order = false;
        $staticSetting->create_new_order_back_office = false;
        $staticSetting->show_unavailable_offers = false;
        $staticSetting->save();
    }
}
