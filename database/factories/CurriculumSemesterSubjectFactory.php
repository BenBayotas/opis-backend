<?php

namespace Database\Factories;

use App\Models\CurriculumSemester;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurriculumSemesterSubject>
 */
class CurriculumSemesterSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'curriculum_semester_id' => CurriculumSemester::factory()->create(),
            'subject_id' => Subject::factory()->create(),
            'curriculum_semester_area_id' => 0,
            'quota' => 2.4,
        ];
    }
}
