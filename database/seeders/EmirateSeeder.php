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
            [
                'name' => ['en' => 'Abu Dhabi', 'ar' => 'أبو ظبي'],
                'slug' => 'abu-dhabi',
                'image' => 'assets/media/emirates/abudhabi.png'
            ],
            [
                'name' => ['en' => 'Dubai', 'ar' => 'دبي'],
                'slug' => 'dubai',
                'image' => 'assets/media/emirates/dubai.png'
            ],
            [
                'name' => ['en' => 'Sharjah', 'ar' => 'الشارقة'],
                'slug' => 'sharjah',
                'image' => 'assets/media/emirates/sharjah.png'
            ],
            [
                'name' => ['en' => 'Ajman', 'ar' => 'عجمان'],
                'slug' => 'ajman',
                'image' => 'assets/media/emirates/ajman.png'
            ],
            [
                'name' => ['en' => 'Fujairah', 'ar' => 'الفجيرة'],
                'slug' => 'fujairah',
                'image' => 'assets/media/emirates/fujairah.png'
            ],
            [
                'name' => ['en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'],
                'slug' => 'rak',
                'image' => 'assets/media/emirates/rak.png'
            ],
            [
                'name' => ['en' => 'Umm Al Quwain', 'ar' => 'أم القيوين'],
                'slug' => 'uaq',
                'image' => 'assets/media/emirates/uaq.png'
            ],
        ];

        foreach ($emirates as $emirate) {
            Emirate::create($emirate);
        }
    }
}
