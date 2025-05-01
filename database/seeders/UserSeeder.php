<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\PlateFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            // other fields
        ]);
        
        // Assign admin role
        $admin->assignRole('admin');

        User::factory(1)->create()
        ->each(function ($user) {
            $user->assignRole('user');
        });
        // Create regular users
        
    }
}
