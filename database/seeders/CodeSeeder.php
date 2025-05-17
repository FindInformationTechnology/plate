<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Emirate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all emirates
        $emirates = Emirate::all();
        
        // Define common codes for all emirates
        $commonCodes = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
                        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        
        // Special codes for specific emirates
        $specialCodes = [
            'Abu Dhabi' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '50'],
            'Dubai' => ['AA', 'BB', 'CC', 'DD', 'EE', 'FF', 'GG', 'HH', 'II', 'JJ', 'KK', 'LL', 'MM'],
            'Sharjah' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            'Ajman' => ['1', '2', '3', '4', '5', '6'],
            'Umm Al Quwain' => ['1', '2', '3', '4'],
            'Ras Al Khaimah' => ['A', 'B', 'C', 'D', 'E', 'F'],
            'Fujairah' => ['1', '2', '3', '4', '5']
        ];
        
        foreach ($emirates as $emirate) {
            // Add common codes for all emirates
            foreach ($commonCodes as $code) {
                Code::create([
                    'emirate_id' => $emirate->id,
                    'name' => $code,
                ]);
            }
            
            // Add special codes for specific emirates if they exist
            if (isset($specialCodes[$emirate->name])) {
                foreach ($specialCodes[$emirate->name] as $code) {
                    // Check if code already exists for this emirate
                    $exists = Code::where('emirate_id', $emirate->id)
                                  ->where('name', $code)
                                  ->exists();
                    
                    if (!$exists) {
                        Code::create([
                            'emirate_id' => $emirate->id,
                            'name' => $code,
                        ]);
                    }
                }
            }
        }
        
        $this->command->info('Codes seeded successfully!');
    }
}