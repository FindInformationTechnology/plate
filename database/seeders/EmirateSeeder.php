<?php

namespace Database\Seeders;

use App\Models\Emirate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmirateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emirates = [
            ['en' => 'Abu Dhabi', 'ar' => 'أبو ظبي'],
            ['en' => 'Dubai', 'ar' => 'دبي'],
            ['en' => 'Sharjah', 'ar' => 'الشارقة'],
            ['en' => 'Ajman', 'ar' => 'عجمان'],
            ['en' => 'Fujairah', 'ar' => 'الفجيرة'],
            ['en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'],
            ['en' => 'Umm Al Quwain', 'ar' => 'أم القيوين'],
        ];

        foreach ($emirates as $name) {
            Emirate::create(['name' => $name]);
        }
    }
}
