<?php

namespace Database\Seeders;

use App\Models\CurriculumSemesterSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSemesterSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumSemesterSubject::factory()->count(5)->create();
    }
}
