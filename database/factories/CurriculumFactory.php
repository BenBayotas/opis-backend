<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = rand(10, 98);
        $curYear = strval($year) . strval($year + 1);

        return [
            'course_id' => Course::factory()->create(),
            'curriculum_year' => $curYear,
        ];
    }
}
