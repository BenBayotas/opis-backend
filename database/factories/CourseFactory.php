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
            'department_id' => 1,
            'head_id' => 1,
            'code' => 'bscs',
            'description' => 'bachelor of science of computer science',
            'major' => '',
            'authority_no' => '',
            'accreditation_id' => '',
            'year_granted' => '2003',
            'years' => 5,
            'slots' => 45,
        ];
    }
}
