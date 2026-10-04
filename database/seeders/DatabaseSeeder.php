<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make(Str::random(32)),
            ],
        );

        $this->call([
            StudentSeeder::class,
            BeritaSeeder::class,
            JobVacancySeeder::class,
            AlumniSeeder::class,
            PrestasiSeeder::class,
            PenerapanK3Seeder::class,
            TrialClassSeeder::class,
            IndustrySeeder::class,
        ]);
    }
}
