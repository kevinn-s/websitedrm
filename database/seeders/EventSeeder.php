<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventAccess;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Fun Run & Charity Gala',
                'image' => 'events/fun-run-charity.png',
                'tags' => ['Workout', 'Fun'],
                'description' => 'A morning full of running, fun challenges, and charity fundraising for local education programs.',
            ],
            [
                'title' => 'Digital Marketing Bootcamp',
                'image' => 'events/digital-marketing.png',
                'tags' => ['Marketing', 'Workshop'],
                'description' => 'Learn SEO, paid ads, and social media strategies from top industry professionals.',
            ],
            [
                'title' => 'Community Health Forum',
                'image' => 'events/health-forum.png',
                'tags' => ['Health', 'Community'],
                'description' => 'Open discussion with medical experts about wellness, prevention, and healthy habits.',
            ],
            [
                'title' => 'Tech Innovation Summit',
                'image' => 'events/tech-summit.png',
                'tags' => ['Technology', 'Innovation'],
                'description' => 'Explore the latest breakthroughs in AI, robotics, and software engineering.',
            ],
            [
                'title' => 'Youth Leadership Workshop',
                'image' => 'events/leadership-workshop.png',
                'tags' => ['Leadership', 'Training'],
                'description' => 'A transformative leadership and communication workshop for youth and young adults.',
            ],
            [
                'title' => 'Art & Creativity Expo',
                'image' => 'events/art-expo.png',
                'tags' => ['Art', 'Creative'],
                'description' => 'Discover the creativity of local artists, designers, and creators.',
            ],
            [
                'title' => 'Career Development Seminar',
                'image' => 'events/career-seminar.png',
                'tags' => ['Career', 'Education'],
                'description' => 'Boost your career with insights from HR experts and industry professionals.',
            ],
            [
                'title' => 'Cultural Night Festival',
                'image' => 'events/cultural-night.png',
                'tags' => ['Culture', 'Festival'],
                'description' => 'A celebration of traditional music, food, and performances.',
            ],
            [
                'title' => 'Entrepreneur Meetup & Networking',
                'image' => 'events/entrepreneur-meetup.png',
                'tags' => ['Business', 'Networking'],
                'description' => 'Meet founders, innovators, and investors in an exclusive networking event.',
            ],
            [
                'title' => 'Online Coding Bootcamp',
                'image' => 'events/coding-bootcamp.png',
                'tags' => ['Coding', 'Online'],
                'description' => 'Hands-on coding sessions covering modern web development technologies.',
            ],
        ];

        foreach ($events as $index => $ev) {
            $event = Event::create([
                'title' => $ev['title'],
                'image' => $ev['image'],
                'tags' => $ev['tags'],
                'type' => 'SCHEDULED',
                'published_at' => now(),
                'date' => now()->addDays($index + 5)->format('Y-m-d'),
                'start_time' => now()->addHours($index)->format('H:i:s'),
                'end_time' => now()->addHours($index + 2)->format('H:i:s'),
                'registration_link' => 'https://example.com/register',
                'description' => $ev['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            EventAccess::create([
                'event_id' => $event->id,
                'type' => ($index % 2 == 0) ? 'PHYSICAL' : 'VIRTUAL',
                'name' => ($index % 2 == 0)
                    ? 'Main Campus Auditorium'
                    : 'Zoom Meeting Room',
                'address' => ($index % 2 == 0)
                    ? 'Jl. Pendidikan No. 10, Jakarta Selatan'
                    : null,
                'map_url' => ($index % 2 == 0)
                    ? 'https://maps.google.com/?q=-6.234567,106.823456'
                    : null,
                'meeting_url' => ($index % 2 != 0)
                    ? 'https://zoom.us/example'
                    : null,
                'meeting_passcode' => ($index % 2 != 0)
                    ? '123456'
                    : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $annualEvents = [
            [
                'title' => 'Rapat Tahunan Alumni Nasional',
                'image' => 'events/rapat-tahunan.png',
                'tags' => ['Rapat', 'Tahunan'],
                'description' => 'Pertemuan resmi untuk mengevaluasi program kerja dan menentukan agenda strategis asosiasi.',
                'access' => [
                    'type' => 'PHYSICAL',
                    'name' => 'Auditorium Utama Kampus',
                    'address' => 'Jl. Pendidikan No. 10, Jakarta Selatan',
                    'map_url' => 'https://maps.google.com/?q=-6.234567,106.823456',
                ],
            ],
            [
                'title' => 'Malam Anugerah Alumni DRM',
                'image' => 'events/malam-anugerah.png',
                'tags' => ['Penghargaan', 'Gala'],
                'description' => 'Malam penganugerahan bagi alumni berprestasi dengan rangkaian gala dinner dan networking.',
                'access' => [
                    'type' => 'PHYSICAL',
                    'name' => 'Grand Ballroom Nusantara',
                    'address' => 'Jl. Jend. Sudirman Kav. 18, Jakarta',
                    'map_url' => 'https://maps.google.com/?q=-6.219999,106.816666',
                ],
            ],
            [
                'title' => 'Konferensi Pendidikan Nasional',
                'image' => 'events/konferensi-pendidikan.png',
                'tags' => ['Konferensi', 'Pendidikan'],
                'description' => 'Sesi panel dan diskusi tematik seputar inovasi pendidikan tinggi di era digital.',
                'access' => [
                    'type' => 'HYBRID',
                    'name' => 'Convention Center & Zoom',
                    'address' => 'Jl. Gatot Subroto No. 1, Jakarta',
                    'map_url' => 'https://maps.google.com/?q=-6.225432,106.807654',
                    'meeting_url' => 'https://zoom.us/j/annual-edu',
                    'meeting_passcode' => 'EDU2025',
                ],
            ],
            [
                'title' => 'Festival Kebudayaan Alumni',
                'image' => 'events/festival-kebudayaan.png',
                'tags' => ['Budaya', 'Festival'],
                'description' => 'Pagelaran seni, kuliner, dan lokakarya budaya yang menghadirkan alumni lintas angkatan.',
                'access' => [
                    'type' => 'PHYSICAL',
                    'name' => 'Lapangan Seni Nusantara',
                    'address' => 'Jl. Melati No. 2, Bandung',
                    'map_url' => 'https://maps.google.com/?q=-6.914744,107.609810',
                ],
            ],
        ];

        foreach ($annualEvents as $index => $ev) {
            $event = Event::create([
                'title' => $ev['title'],
                'image' => $ev['image'],
                'tags' => $ev['tags'],
                'type' => 'ANNUAL',
                'published_at' => now(),
                'date' => now()->addMonths($index + 1)->format('Y-m-d'),
                'start_time' => '18:00:00',
                'end_time' => '21:00:00',
                'registration_link' => 'https://example.com/register-annual',
                'description' => $ev['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            EventAccess::create([
                'event_id' => $event->id,
                'type' => $ev['access']['type'],
                'name' => $ev['access']['name'],
                'address' => $ev['access']['address'] ?? null,
                'map_url' => $ev['access']['map_url'] ?? null,
                'meeting_url' => $ev['access']['meeting_url'] ?? null,
                'meeting_passcode' => $ev['access']['meeting_passcode'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
