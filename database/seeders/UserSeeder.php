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
        // Create super admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('password'),
            'phone' => '+971501234567',
            'email_verified_at' => now(),
        ]);
        
        // Assign super admin role
        $superAdmin->assignRole('admin');
        
        // Create main admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'phone' => '+971501234568',
            'email_verified_at' => now(),
        ]);
        
        // Assign admin role
        $admin->assignRole('admin');
        
        // Create additional admin users
        $admin1 = User::create([
            'name' => 'Admin One',
            'email' => 'admin1@mail.com',
            'password' => Hash::make('password'),
            'phone' => '+971501234569',
            'email_verified_at' => now(),
        ]);
        $admin1->assignRole('admin');
        
        $admin2 = User::create([
            'name' => 'Admin Two',
            'email' => 'admin2@mail.com',
            'password' => Hash::make('password'),
            'phone' => '+971501234570',
            'email_verified_at' => now(),
        ]);
        $admin2->assignRole('admin');

        // Create regular users
        User::factory(3)->create()
        ->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
