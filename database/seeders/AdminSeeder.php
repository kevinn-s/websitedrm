<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\Status;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => UserRole::Admin->value,
            'status' => Status::Verified->value
        ]);

 
    }
}
