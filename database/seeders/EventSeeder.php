<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventAccess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
        //
        $event_1 = Event::create([
                'title' => 'Fun Run & Charity Gala',
                'image' => 'events/fun-run-charity.png',
                'category' => 'Community',
                'type' => 'SCHEDULED',
                'published_at' => now(),
                'date' => now()->addDays(10)->format('Y-m-d'),
                'time' => '07:00 AM - 10:00 AM',
                'annual_date' => null,
                'speaker_name' => null,
                'description' => 'Join us for a morning of fun, fitness, and fundraising! All proceeds go to local education initiatives.',
                'created_at' => now(),
                'updated_at' => now(),
        ]);

        EventAccess::create(
            [
                'event_id' => $event_1->id,
                'type' => 'PHYSICAL',
                'name' => 'Main Campus Auditorium',
                'address' => 'Jl. Pendidikan No. 10, Jakarta Selatan',
                'map_url' => 'https://maps.google.com/?q=-6.234567,106.823456',
                'meeting_url' => null,
                'meeting_passcode' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            );

            $event_2 = Event::create([
                'title' => 'Alumni Homecoming',
                'image' => 'events/homecoming.jpg',
                'category' => 'Alumni',
                'type' => 'ANNUAL',
                'published_at' => now(),
                'date' => null,
                'time' => null,
                'annual_date' => 'October',
                'speaker_name' => 'Prof. Michael Tan',
                'description' => 'Our biggest annual gathering! Reconnect with old friends, celebrate achievements, and enjoy campus tours.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        EventAccess::create(
            [
                    'event_id' => $event_2->id,
                    'type' => 'HYBRID',
                    'name' => 'Alumni Hall + Live Stream',
                    'address' => 'Jl. Kenangan No. 5, Bandung',
                    'map_url' => 'https://maps.google.com/?q=-6.917464,107.619129',
                    'meeting_url' => 'https://teams.microsoft.com/l/meetup-join/abc123',
                    'meeting_passcode' => 'alumni2025',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

    }
}
