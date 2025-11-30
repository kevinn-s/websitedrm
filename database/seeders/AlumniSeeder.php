<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Alumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
     use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Alumni::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'nim' => '2602145680',
            'password' => 'Test12345678',
            'status' => Status::PENDING
        ]);
    }
}
