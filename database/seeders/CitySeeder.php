<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name' => 'أم العراد',
                'state_id' => 1,
            ],
            [
                'name' => 'أم غور',
                'state_id' => 1,
            ],
            [
                'name' => 'ابرقية',
                'state_id' => 1,
            ],
            [
                'name' => 'ابن سرحان',
                'state_id' => 1,
            ],
            [
                'name' => 'ابن شرار',
                'state_id' => 1,
            ],
            [
                'name' => 'ابن طوالة',
                'state_id' => 1,
            ],
            [
                'name' => 'ابن لغيصم',
                'state_id' => 1,
            ],
            [
                'name' => 'ابو حدرية',
                'state_id' => 1,
            ],
            [
                'name' => 'ابو طوطاحه البرازي',
                'state_id' => 1,
            ],
            [
                'name' => 'ابو قعر',
                'state_id' => 1,
            ],
            [
                'name' => 'ابو معن',
                'state_id' => 1,
            ],
            [
                'name' => 'الاحساء',
                'state_id' => 1,
            ],
            [
                'name' => 'البطالية',
                'state_id' => 1,
            ],
            [
                'name' => 'البويبيات',
                'state_id' => 1,
            ],
            [
                'name' => 'التهيمية',
                'state_id' => 1,
            ],
            [
                'name' => 'التوبي',
                'state_id' => 1,
            ],
            [
                'name' => 'التويثير',
                'state_id' => 1,
            ],
            [
                'name' => 'الثقبة',
                'state_id' => 1,
            ],
            [
                'name' => 'الثمامة',
                'state_id' => 1,
            ],
            [
                'name' => 'الجابرية',
                'state_id' => 1,
            ],
            [
                'name' => 'آل حبيبة',
                'state_id' => 2,
            ],
            [
                'name' => 'آل حميد',
                'state_id' => 2,
            ],
            [
                'name' => 'آل سعيد',
                'state_id' => 2,
            ],
            [
                'name' => 'آل صقاعة',
                'state_id' => 2,
            ],
            [
                'name' => 'آل مرزوق',
                'state_id' => 2,
            ],
            [
                'name' => 'أبو غبار',
                'state_id' => 2,
            ],
            [
                'name' => 'إبن غوف',
                'state_id' => 2,
            ],
            [
                'name' => 'ال سلمان',
                'state_id' => 2,
            ],
            [
                'name' => 'ال نعمة',
                'state_id' => 2,
            ],
            [
                'name' => 'الأبناء',
                'state_id' => 2,
            ],
            [
                'name' => 'الأزاهرة',
                'state_id' => 2,
            ],
            [
                'name' => 'الإشتاء',
                'state_id' => 2,
            ],
            [
                'name' => 'الاشيرة',
                'state_id' => 2,
            ],
            [
                'name' => 'الاطاولة',
                'state_id' => 2,
            ],
            [
                'name' => 'الامرة',
                'state_id' => 2,
            ],
            [
                'name' => 'الباحة',
                'state_id' => 2,
            ],
            [
                'name' => 'الثراوين',
                'state_id' => 2,
            ],
            [
                'name' => 'الثودة',
                'state_id' => 2,
            ],
            [
                'name' => 'الجرين',
                'state_id' => 2,
            ],
            [
                'name' => 'الجوة',
                'state_id' => 2,
            ],

            [
                'name' => 'أطناب',
                'state_id' => 3,
            ],
            [
                'name' => 'إثرة',
                'state_id' => 3,
            ],
            [
                'name' => 'ابو عجرم',
                'state_id' => 3,
            ],
            [
                'name' => 'ابورواث',
                'state_id' => 3,
            ],
            [
                'name' => 'الأضارع',
                'state_id' => 3,
            ],
            [
                'name' => 'الثنية',
                'state_id' => 3,
            ],
            [
                'name' => 'الحديثة',
                'state_id' => 3,
            ],
            [
                'name' => 'الحرة',
                'state_id' => 3,
            ],
            [
                'name' => 'الحماد',
                'state_id' => 3,
            ],
            [
                'name' => 'الحوي',
                'state_id' => 3,
            ],
            [
                'name' => 'أبا الرواث',
                'state_id' => 4,
            ],
            [
                'name' => 'أم خنصر',
                'state_id' => 4,
            ],
            [
                'name' => 'إبن سوقي',
                'state_id' => 4,
            ],
            [
                'name' => 'إبن شريم',
                'state_id' => 4,
            ],
            [
                'name' => 'ابن عائش',
                'state_id' => 4,
            ],
            [
                'name' => 'التمياط',
                'state_id' => 4,
            ],
            [
                'name' => 'الجراني',
                'state_id' => 4,
            ],
            [
                'name' => 'الدويد',
                'state_id' => 4,
            ],
            [
                'name' => 'السليمانية',
                'state_id' => 4,
            ],
            [
                'name' => 'الشاظي مناحي بن بكر',
                'state_id' => 4,
            ],
            [
                'name' => 'أبا الكباش',
                'state_id' => 5,
            ],
            [
                'name' => 'أبو جلال',
                'state_id' => 5,
            ],
            [
                'name' => 'أبو حميض',
                'state_id' => 5,
            ],
            [
                'name' => 'أبو رجوم',
                'state_id' => 5,
            ],
            [
                'name' => 'أثيثية',
                'state_id' => 5,
            ],
            [
                'name' => 'أم أثلة',
                'state_id' => 5,
            ],
            [
                'name' => 'أم أرطى',
                'state_id' => 5,
            ],
            [
                'name' => 'أم الجثجاث',
                'state_id' => 5,
            ],
            [
                'name' => 'أم الدباء',
                'state_id' => 5,
            ],
            [
                'name' => 'أم السباع',
                'state_id' => 5,
            ],
            [
                'name' => 'أبانات',
                'state_id' => 6,
            ],
            [
                'name' => 'أبلق',
                'state_id' => 6,
            ],
            [
                'name' => 'أبو عرداء',
                'state_id' => 6,
            ],
            [
                'name' => 'أبو نخلة',
                'state_id' => 6,
            ],
            [
                'name' => 'أشقر النومانيات',
                'state_id' => 6,
            ],
            [
                'name' => 'أم الخراسع',
                'state_id' => 6,
            ],
            [
                'name' => 'أم المحاش',
                'state_id' => 6,
            ],
            [
                'name' => 'أم حزم',
                'state_id' => 6,
            ],
            [
                'name' => 'أم خطوط',
                'state_id' => 6,
            ],
            [
                'name' => 'أم غويفة',
                'state_id' => 6,
            ],
            [
                'name' => 'آبار الطويرفة',
                'state_id' => 7,
            ],
            [
                'name' => 'آبار دحمولة',
                'state_id' => 7,
            ],
            [
                'name' => 'أبو طاقة',
                'state_id' => 7,
            ],
            [
                'name' => 'أبو قرن',
                'state_id' => 7,
            ],
            [
                'name' => 'أبو كبير',
                'state_id' => 7,
            ],
            [
                'name' => 'أبو مغير',
                'state_id' => 7,
            ],
            [
                'name' => 'أبو نمصات',
                'state_id' => 7,
            ],
            [
                'name' => 'أرباق',
                'state_id' => 7,
            ],
            [
                'name' => 'أم البرك',
                'state_id' => 7,
            ],
            [
                'name' => 'أويدك',
                'state_id' => 7,
            ],
            [
                'name' => 'آمدان',
                'state_id' => 8,
            ],
            [
                'name' => 'أكباد',
                'state_id' => 8,
            ],
            [
                'name' => 'أم الريح',
                'state_id' => 8,
            ],
            [
                'name' => 'ابا القزاز',
                'state_id' => 8,
            ],
            [
                'name' => 'ابار قنا',
                'state_id' => 8,
            ],
            [
                'name' => 'ابو اراكة',
                'state_id' => 8,
            ],
            [
                'name' => 'ابو الحنشان',
                'state_id' => 8,
            ],
            [
                'name' => 'الاخضر',
                'state_id' => 8,
            ],
            [
                'name' => 'البدع',
                'state_id' => 8,
            ],
            [
                'name' => 'البديع',
                'state_id' => 8,
            ],
            [
                'name' => 'آل علي',
                'state_id' => 9,
            ],
            [
                'name' => 'أبو الرديف',
                'state_id' => 9,
            ],
            [
                'name' => 'أبو العشرة',
                'state_id' => 9,
            ],
            [
                'name' => 'أبو طوق',
                'state_id' => 9,
            ],
            [
                'name' => 'أم الحجل',
                'state_id' => 9,
            ],
            [
                'name' => 'ابو السلع',
                'state_id' => 9,
            ],
            [
                'name' => 'ابو الطيور',
                'state_id' => 9,
            ],
            [
                'name' => 'ابو القعايد',
                'state_id' => 9,
            ],
            [
                'name' => 'ابو الكرش',
                'state_id' => 9,
            ],
            [
                'name' => 'ابو لهب',
                'state_id' => 9,
            ],
            [
                'name' => 'أبلة',
                'state_id' => 10,
            ],
            [
                'name' => 'أبو سويسيات',
                'state_id' => 10,
            ],
            [
                'name' => 'أرينبة',
                'state_id' => 10,
            ],
            [
                'name' => 'أفيعية',
                'state_id' => 10,
            ],
            [
                'name' => 'أم العماير',
                'state_id' => 10,
            ],
            [
                'name' => 'أم هشيم',
                'state_id' => 10,
            ],
            [
                'name' => 'أوبيرة',
                'state_id' => 10,
            ],
            [
                'name' => 'إبضة',
                'state_id' => 10,
            ],
            [
                'name' => 'ابا الحيران',
                'state_id' => 10,
            ],
            [
                'name' => 'ابو دويحات',
                'state_id' => 10,
            ],
            [
                'name' => 'آل أم سعيد',
                'state_id' => 11,
            ],
            [
                'name' => 'آل إثيبة',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الأشعث',
                'state_id' => 11,
            ],
            [
                'name' => 'آل التوم',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الجلدة',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الخلف',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الداحس',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الذيب',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الذيب',
                'state_id' => 11,
            ],
            [
                'name' => 'آل الزارية',
                'state_id' => 11,
            ],
            [
                'name' => 'آل عطى',
                'state_id' => 12,
            ],
            [
                'name' => 'أبو جميدة',
                'state_id' => 12,
            ],
            [
                'name' => 'أبو علي',
                'state_id' => 12,
            ],
            [
                'name' => 'أبو ملوح',
                'state_id' => 12,
            ],
            [
                'name' => 'أم الدوم',
                'state_id' => 12,
            ],
            [
                'name' => 'أم الشوك',
                'state_id' => 12,
            ],
            [
                'name' => 'أم راكة',
                'state_id' => 12,
            ],
            [
                'name' => 'إبن غنام',
                'state_id' => 12,
            ],
            [
                'name' => 'ا لحفائر',
                'state_id' => 12,
            ],
            [
                'name' => 'آل سوار',
                'state_id' => 13,
            ],
            [
                'name' => 'ابا الرخم',
                'state_id' => 13,
            ],
            [
                'name' => 'ال شهي',
                'state_id' => 13,
            ],
            [
                'name' => 'البرك',
                'state_id' => 13,
            ],
            [
                'name' => 'التماني',
                'state_id' => 13,
            ],
            [
                'name' => 'الجفة',
                'state_id' => 13,
            ],
            [
                'name' => 'الحجف',
                'state_id' => 13,
            ],
            [
                'name' => 'الحرشف',
                'state_id' => 13,
            ],
            [
                'name' => 'الحصينية',
                'state_id' => 13,
            ],
            [
                'name' => 'الحمضة',
                'state_id' => 13,
            ],

        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city['name'],
                'state_id' => $city['state_id'],
            ]);
        }
    }
}
