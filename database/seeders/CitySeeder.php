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
                'zone_id' => 1,
            ],
            [
                'name' => 'أم غور',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابرقية',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابن سرحان',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابن شرار',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابن طوالة',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابن لغيصم',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابو حدرية',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابو طوطاحه البرازي',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابو قعر',
                'zone_id' => 1,
            ],
            [
                'name' => 'ابو معن',
                'zone_id' => 1,
            ],
            [
                'name' => 'الاحساء',
                'zone_id' => 1,
            ],
            [
                'name' => 'البطالية',
                'zone_id' => 1,
            ],
            [
                'name' => 'البويبيات',
                'zone_id' => 1,
            ],
            [
                'name' => 'التهيمية',
                'zone_id' => 1,
            ],
            [
                'name' => 'التوبي',
                'zone_id' => 1,
            ],
            [
                'name' => 'التويثير',
                'zone_id' => 1,
            ],
            [
                'name' => 'الثقبة',
                'zone_id' => 1,
            ],
            [
                'name' => 'الثمامة',
                'zone_id' => 1,
            ],
            [
                'name' => 'الجابرية',
                'zone_id' => 1,
            ],
            [
                'name' => 'آل حبيبة',
                'zone_id' => 2,
            ],
            [
                'name' => 'آل حميد',
                'zone_id' => 2,
            ],
            [
                'name' => 'آل سعيد',
                'zone_id' => 2,
            ],
            [
                'name' => 'آل صقاعة',
                'zone_id' => 2,
            ],
            [
                'name' => 'آل مرزوق',
                'zone_id' => 2,
            ],
            [
                'name' => 'أبو غبار',
                'zone_id' => 2,
            ],
            [
                'name' => 'إبن غوف',
                'zone_id' => 2,
            ],
            [
                'name' => 'ال سلمان',
                'zone_id' => 2,
            ],
            [
                'name' => 'ال نعمة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الأبناء',
                'zone_id' => 2,
            ],
            [
                'name' => 'الأزاهرة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الإشتاء',
                'zone_id' => 2,
            ],
            [
                'name' => 'الاشيرة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الاطاولة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الامرة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الباحة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الثراوين',
                'zone_id' => 2,
            ],
            [
                'name' => 'الثودة',
                'zone_id' => 2,
            ],
            [
                'name' => 'الجرين',
                'zone_id' => 2,
            ],
            [
                'name' => 'الجوة',
                'zone_id' => 2,
            ],

            [
                'name' => 'أطناب',
                'zone_id' => 3,
            ],
            [
                'name' => 'إثرة',
                'zone_id' => 3,
            ],
            [
                'name' => 'ابو عجرم',
                'zone_id' => 3,
            ],
            [
                'name' => 'ابورواث',
                'zone_id' => 3,
            ],
            [
                'name' => 'الأضارع',
                'zone_id' => 3,
            ],
            [
                'name' => 'الثنية',
                'zone_id' => 3,
            ],
            [
                'name' => 'الحديثة',
                'zone_id' => 3,
            ],
            [
                'name' => 'الحرة',
                'zone_id' => 3,
            ],
            [
                'name' => 'الحماد',
                'zone_id' => 3,
            ],
            [
                'name' => 'الحوي',
                'zone_id' => 3,
            ],
            [
                'name' => 'أبا الرواث',
                'zone_id' => 4,
            ],
            [
                'name' => 'أم خنصر',
                'zone_id' => 4,
            ],
            [
                'name' => 'إبن سوقي',
                'zone_id' => 4,
            ],
            [
                'name' => 'إبن شريم',
                'zone_id' => 4,
            ],
            [
                'name' => 'ابن عائش',
                'zone_id' => 4,
            ],
            [
                'name' => 'التمياط',
                'zone_id' => 4,
            ],
            [
                'name' => 'الجراني',
                'zone_id' => 4,
            ],
            [
                'name' => 'الدويد',
                'zone_id' => 4,
            ],
            [
                'name' => 'السليمانية',
                'zone_id' => 4,
            ],
            [
                'name' => 'الشاظي مناحي بن بكر',
                'zone_id' => 4,
            ],
            [
                'name' => 'أبا الكباش',
                'zone_id' => 5,
            ],
            [
                'name' => 'أبو جلال',
                'zone_id' => 5,
            ],
            [
                'name' => 'أبو حميض',
                'zone_id' => 5,
            ],
            [
                'name' => 'أبو رجوم',
                'zone_id' => 5,
            ],
            [
                'name' => 'أثيثية',
                'zone_id' => 5,
            ],
            [
                'name' => 'أم أثلة',
                'zone_id' => 5,
            ],
            [
                'name' => 'أم أرطى',
                'zone_id' => 5,
            ],
            [
                'name' => 'أم الجثجاث',
                'zone_id' => 5,
            ],
            [
                'name' => 'أم الدباء',
                'zone_id' => 5,
            ],
            [
                'name' => 'أم السباع',
                'zone_id' => 5,
            ],
            [
                'name' => 'أبانات',
                'zone_id' => 6,
            ],
            [
                'name' => 'أبلق',
                'zone_id' => 6,
            ],
            [
                'name' => 'أبو عرداء',
                'zone_id' => 6,
            ],
            [
                'name' => 'أبو نخلة',
                'zone_id' => 6,
            ],
            [
                'name' => 'أشقر النومانيات',
                'zone_id' => 6,
            ],
            [
                'name' => 'أم الخراسع',
                'zone_id' => 6,
            ],
            [
                'name' => 'أم المحاش',
                'zone_id' => 6,
            ],
            [
                'name' => 'أم حزم',
                'zone_id' => 6,
            ],
            [
                'name' => 'أم خطوط',
                'zone_id' => 6,
            ],
            [
                'name' => 'أم غويفة',
                'zone_id' => 6,
            ],
            [
                'name' => 'آبار الطويرفة',
                'zone_id' => 7,
            ],
            [
                'name' => 'آبار دحمولة',
                'zone_id' => 7,
            ],
            [
                'name' => 'أبو طاقة',
                'zone_id' => 7,
            ],
            [
                'name' => 'أبو قرن',
                'zone_id' => 7,
            ],
            [
                'name' => 'أبو كبير',
                'zone_id' => 7,
            ],
            [
                'name' => 'أبو مغير',
                'zone_id' => 7,
            ],
            [
                'name' => 'أبو نمصات',
                'zone_id' => 7,
            ],
            [
                'name' => 'أرباق',
                'zone_id' => 7,
            ],
            [
                'name' => 'أم البرك',
                'zone_id' => 7,
            ],
            [
                'name' => 'أويدك',
                'zone_id' => 7,
            ],
            [
                'name' => 'آمدان',
                'zone_id' => 8,
            ],
            [
                'name' => 'أكباد',
                'zone_id' => 8,
            ],
            [
                'name' => 'أم الريح',
                'zone_id' => 8,
            ],
            [
                'name' => 'ابا القزاز',
                'zone_id' => 8,
            ],
            [
                'name' => 'ابار قنا',
                'zone_id' => 8,
            ],
            [
                'name' => 'ابو اراكة',
                'zone_id' => 8,
            ],
            [
                'name' => 'ابو الحنشان',
                'zone_id' => 8,
            ],
            [
                'name' => 'الاخضر',
                'zone_id' => 8,
            ],
            [
                'name' => 'البدع',
                'zone_id' => 8,
            ],
            [
                'name' => 'البديع',
                'zone_id' => 8,
            ],
            [
                'name' => 'آل علي',
                'zone_id' => 9,
            ],
            [
                'name' => 'أبو الرديف',
                'zone_id' => 9,
            ],
            [
                'name' => 'أبو العشرة',
                'zone_id' => 9,
            ],
            [
                'name' => 'أبو طوق',
                'zone_id' => 9,
            ],
            [
                'name' => 'أم الحجل',
                'zone_id' => 9,
            ],
            [
                'name' => 'ابو السلع',
                'zone_id' => 9,
            ],
            [
                'name' => 'ابو الطيور',
                'zone_id' => 9,
            ],
            [
                'name' => 'ابو القعايد',
                'zone_id' => 9,
            ],
            [
                'name' => 'ابو الكرش',
                'zone_id' => 9,
            ],
            [
                'name' => 'ابو لهب',
                'zone_id' => 9,
            ],
            [
                'name' => 'أبلة',
                'zone_id' => 10,
            ],
            [
                'name' => 'أبو سويسيات',
                'zone_id' => 10,
            ],
            [
                'name' => 'أرينبة',
                'zone_id' => 10,
            ],
            [
                'name' => 'أفيعية',
                'zone_id' => 10,
            ],
            [
                'name' => 'أم العماير',
                'zone_id' => 10,
            ],
            [
                'name' => 'أم هشيم',
                'zone_id' => 10,
            ],
            [
                'name' => 'أوبيرة',
                'zone_id' => 10,
            ],
            [
                'name' => 'إبضة',
                'zone_id' => 10,
            ],
            [
                'name' => 'ابا الحيران',
                'zone_id' => 10,
            ],
            [
                'name' => 'ابو دويحات',
                'zone_id' => 10,
            ],
            [
                'name' => 'آل أم سعيد',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل إثيبة',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الأشعث',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل التوم',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الجلدة',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الخلف',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الداحس',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الذيب',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الذيب',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل الزارية',
                'zone_id' => 11,
            ],
            [
                'name' => 'آل عطى',
                'zone_id' => 12,
            ],
            [
                'name' => 'أبو جميدة',
                'zone_id' => 12,
            ],
            [
                'name' => 'أبو علي',
                'zone_id' => 12,
            ],
            [
                'name' => 'أبو ملوح',
                'zone_id' => 12,
            ],
            [
                'name' => 'أم الدوم',
                'zone_id' => 12,
            ],
            [
                'name' => 'أم الشوك',
                'zone_id' => 12,
            ],
            [
                'name' => 'أم راكة',
                'zone_id' => 12,
            ],
            [
                'name' => 'إبن غنام',
                'zone_id' => 12,
            ],
            [
                'name' => 'ا لحفائر',
                'zone_id' => 12,
            ],
            [
                'name' => 'آل سوار',
                'zone_id' => 13,
            ],
            [
                'name' => 'ابا الرخم',
                'zone_id' => 13,
            ],
            [
                'name' => 'ال شهي',
                'zone_id' => 13,
            ],
            [
                'name' => 'البرك',
                'zone_id' => 13,
            ],
            [
                'name' => 'التماني',
                'zone_id' => 13,
            ],
            [
                'name' => 'الجفة',
                'zone_id' => 13,
            ],
            [
                'name' => 'الحجف',
                'zone_id' => 13,
            ],
            [
                'name' => 'الحرشف',
                'zone_id' => 13,
            ],
            [
                'name' => 'الحصينية',
                'zone_id' => 13,
            ],
            [
                'name' => 'الحمضة',
                'zone_id' => 13,
            ],

        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city['name'],
                'zone_id' => $city['zone_id'],
            ]);
        }
    }
}
