<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Alumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AlumniSeeder extends Seeder
{
     use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
           $alumni = Alumni::create([
            'name' => 'Kevin Sukohardjo',
            'nim' => '2440012345',
            'email' => 'kevin@example.com',
            'password' => Hash::make('password'),
            'status' => Status::VERIFIED,
            'bib' => 2023001,
            'slug' => 'kevin-sukohardjo',
            'phone' => '081234567890',
            'x' => '@kevin',
            'instagram' => 'kevin.ig',
            'facebook' => 'kevin.fb',
            'linkedin' => 'kevin-ln',
            'email_verified_at' => now(),
        ]);

        $alumni->profession()->create([
            'profession' => 'Software Engineer',
            'company' => 'PT Teknologi Maju',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
        ]);
    }
}
