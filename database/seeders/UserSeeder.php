<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\User;
use App\Models\Alumni;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Antony',
            'email' => 'antony@gmail.com',
            'password' => Hash::make('antony123'),
            'role' => UserRole::Alumni->value,
            'status' => Status::Verified->value
        ]);

        Alumni::create([
            'user_id' => $user->id,
            'student_id' => '2602145680',
            'name' => $user->name,
            'email' => $user->email
        ]);

        $user2 = User::create([
            'name' => 'Kodak black',
            'email' => 'kodakblack@gmail.com',
            'password' => Hash::make('kodak123'),
            'role' => UserRole::Alumni->value,
            'status' => Status::Pending->value
        ]);

        Alumni::create([
            'user_id' => $user2->id,
            'student_id' => '2602145681',
            'name' => $user2->name,
            'email' => $user2->email
        ]);

        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => UserRole::Admin->value,
            'status' => Status::Verified->value
        ]);
    }
}
