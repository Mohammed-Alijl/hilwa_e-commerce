<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name'=>'English',
                'code'=>'en'
            ],
            [
                'name'=>'Arabic',
                'code'=>'ar'
            ]
        ];
        foreach ($languages as $language){
            Language::create([
                'name'=>$language['name'],
                'code'=>$language['code']
            ]);
        }
    }
}
