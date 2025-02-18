<?php

namespace Database\Factories;

use App\Models\CurriculumYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurriculumSemester>
 */
class CurriculumSemesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posName = [
            'first',
            'second',
            'summer',
        ];

        return [
            'title' => $posName[rand(0, 2)],
            'curriculum_year_id' => CurriculumYear::factory()->create(),
        ];
    }
}
