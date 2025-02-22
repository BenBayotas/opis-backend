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
            'subject_group_id' => 1,
            'code'     => 'cs 171',
            'title'    => 'Programming Fundamentals I',
            'department_id'    => 1,
            'credited_units'   => 3,
            'lec_hours'        => 2,
            'lab_hours'        => 5,
            'special'          => false,
            'elective'         => false,
            'no_text_booklet'  => false,
            'is_not_wga'       => false,
            'category_id'      => 1,
            'tuition_units'    => 5,
        ];
    }
}
