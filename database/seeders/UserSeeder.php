<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $this->seedAdmin();
            $this->seedAlumniProfiles();
        });
    }

    protected function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@drm.or.id'],
            [
                'name' => 'DRM Administrator',
                'password' => Hash::make('admin123'),
                'role' => UserRole::Admin,
                'status' => Status::Verified,
            ]
        );
    }

    protected function seedAlumniProfiles(): void
    {
        $alumniProfiles = [
            [
                'user' => [
                    'name' => 'Sarah Hartono',
                    'email' => 'sarah.hartono@alumni.binus.ac.id',
                    'password' => 'sarahPassword!',
                    'status' => Status::Verified,
                ],
                'alumni' => [
                    'student_id' => '2201681234',
                    'phone_number' => '0812-8888-1122',
                    'competency' => ['Product Management', 'Fintech'],
                    'linkedin' => 'https://linkedin.com/in/sarah-hartono',
                ],
                'education' => [
                    'graduation_batch' => 2016,
                    'legitimation_date' => '2016-08-20',
                    'gpa' => 3.78,
                ],
                'profession' => [
                    'profession' => 'Head of Product',
                    'company' => 'Nusantara Pay',
                    'city' => 'Jakarta',
                    'province' => 'DKI Jakarta',
                ],
                'research' => [
                    [
                        'title' => 'Driving Financial Inclusion with AI',
                        'type' => 'Journal',
                        'publication_year' => 2022,
                        'publisher' => 'Journal of Digital Finance',
                        'publication_link' => 'https://example.org/research/ai-finance',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => 'Michael Siregar',
                    'email' => 'michael.siregar@alumni.binus.ac.id',
                    'password' => 'michaelPassword!',
                    'status' => Status::Pending,
                ],
                'alumni' => [
                    'student_id' => '2201677788',
                    'phone_number' => '0821-4455-9988',
                    'competency' => ['Network Engineering', 'Cybersecurity'],
                    'instagram' => 'https://instagram.com/michael.siregar',
                ],
                'education' => [
                    'graduation_batch' => 2018,
                    'legitimation_date' => '2018-07-14',
                    'gpa' => 3.62,
                ],
                'profession' => [
                    'profession' => 'Network Architect',
                    'company' => 'GarudaConnect',
                    'city' => 'Medan',
                    'province' => 'Sumatera Utara',
                ],
                'research' => [],
            ],
            [
                'user' => [
                    'name' => 'Nadia Pramesti',
                    'email' => 'nadia.pramesti@alumni.binus.ac.id',
                    'password' => 'nadiaPassword!',
                    'status' => Status::Verified,
                ],
                'alumni' => [
                    'student_id' => '2101543321',
                    'phone_number' => '0813-7000-4411',
                    'competency' => ['Data Science', 'Humanitarian Logistics'],
                    'x' => 'https://x.com/nadia.pramesti',
                ],
                'education' => [
                    'graduation_batch' => 2014,
                    'legitimation_date' => '2014-09-01',
                    'gpa' => 3.9,
                ],
                'profession' => [
                    'profession' => 'Senior Data Scientist',
                    'company' => 'Relief Analytics Lab',
                    'city' => 'Bandung',
                    'province' => 'Jawa Barat',
                ],
                'research' => [
                    [
                        'title' => 'Predictive Logistics for Disaster Relief',
                        'type' => 'Conference',
                        'publication_year' => 2023,
                        'publisher' => 'ASEAN Resilience Forum',
                        'publication_link' => 'https://example.org/research/logistics',
                    ],
                    [
                        'title' => 'Data Pipelines for Rapid Response',
                        'type' => 'Whitepaper',
                        'publication_year' => 2021,
                        'publisher' => 'Relief Analytics Lab',
                        'publication_link' => 'https://example.org/research/pipelines',
                    ],
                ],
            ],
        ];

        foreach ($alumniProfiles as $profile) {
            $user = User::updateOrCreate(
                ['email' => $profile['user']['email']],
                [
                    'name' => $profile['user']['name'],
                    'password' => Hash::make($profile['user']['password']),
                    'role' => UserRole::Alumni,
                    'status' => $profile['user']['status'],
                ]
            );

            $alumni = Alumni::updateOrCreate(
                ['user_id' => $user->id],
                array_merge(
                    $profile['alumni'],
                    [
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                )
            );

            if (! empty($profile['education'])) {
                $alumni->education()->updateOrCreate([], $profile['education']);
            }

            if (! empty($profile['profession'])) {
                $alumni->profession()->updateOrCreate([], $profile['profession']);
            }

            if (! empty($profile['research'])) {
                foreach ($profile['research'] as $researchData) {
                    $alumni->research()->updateOrCreate(
                        ['title' => $researchData['title']],
                        $researchData
                    );
                }
            }
        }
    }
}
