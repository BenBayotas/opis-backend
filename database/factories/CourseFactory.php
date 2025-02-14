<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => 1, // TODO: fix
            'code' => 'bscs',
            'acronym' => 'cs',
            'description' => 'bachelor of science in computer science',
            'major' => 'major in data science',
            'year_granted' => '2004',
            'years' => 4,
            'slots' => 40,
        ];
    }
}
