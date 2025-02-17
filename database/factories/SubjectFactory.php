<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_group_id' => 0,
            'subject_code' => 'cs 171',
            'subject_title' => 'fundamentals of programming',

            'is_major' => false,
            /*'department_id' => 0,*/

            'credited_units' => 3,
            'lec_hours' => 2,
            'lab_hours' => 3,

            'special' => false,
            'elective' => false,
            'no_text_booklet' => false,
            'is_not_wga' => false,

            'category_id' => 0,
            'tuition_units' => 5,
        ];
    }
}
