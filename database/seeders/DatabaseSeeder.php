<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Department;
use App\Models\ProgramType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProgramTypeSeeder::class,
            SubjectGroupSeeder::class,
            SubjectCategorySeeder::class,
            CurriculumSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Course::factory()->count(1)->create();
        Department::factory()->count(10)->create();
        Subject::factory()->count(2)->create();
    }
}
