<?php

namespace Database\Seeders;

use App\Models\Plate;
use Database\Factories\PlateFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plate::factory()->count(10)->create();
    }
}
