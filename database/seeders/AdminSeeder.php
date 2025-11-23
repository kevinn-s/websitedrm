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
            'name' => 'Admin',
            'email' => 'admin@asosiasidrm.com',
            'password' => Hash::make('G7!vN@zP3#tQm2$wL'),
            'role' => UserRole::Admin->value,
            'status' => Status::Verified->value
        ]);

 
    }
}
