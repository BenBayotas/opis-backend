<?php

namespace Tests\Feature;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    public function testSubjectCanBeCreated(): void
    {
        $data = [
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
        $response = $this->post(route('subject.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'subject created');
    }

    public function testSubjectCanBeDeleted(): void
    {
        $subject = Subject::factory()->create();

        $this->assertDatabaseHas('subjects', ['id' => $subject->id]);
        $response = $this->delete(route('subject.destroy', $subject->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
        $response->assertSessionHas('success', 'subject deleted');
    }

    public function testSubjectCanBeEdited(): void
    {
        $subject = Subject::factory()->create();

        $updatedData = [
            'subject_group_id' => 1,
            'code'     => 'it 171',
            'title'    => '*Programming Fundamentals I',
            'department_id'    => 1,
            'credited_units'   => 3,
            'lec_hours'        => 0,
            'lab_hours'        => 5,
            'special'          => true,
            'elective'         => false,
            'no_text_booklet'  => true,
            'is_not_wga'       => false,
            'category_id'      => 1,
            'tuition_units'    => 5,
        ];

        $response = $this->put(route('subject.update', $subject->id), $updatedData);
        $response->assertRedirect(route('subject.index'));

        $this->assertDatabaseHas('subjects', [
            'subject_group_id' => 1,
            'code'     => 'it 171',
            'title'    => '*Programming Fundamentals I',
            'department_id'    => 1,
            'credited_units'   => 3,
            'lec_hours'        => 0,
            'lab_hours'        => 5,
            'special'          => true,
            'elective'         => false,
            'no_text_booklet'  => true,
            'is_not_wga'       => false,
            'category_id'      => 1,
            'tuition_units'    => 5,
        ]);

        $response->assertSessionHas('success', 'subject updated');
    }
}
