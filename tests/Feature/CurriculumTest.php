<?php

namespace Tests\Feature;

use App\Models\Curriculum;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurriculumTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function testCurriculumCanBeCreated(): void
    {
        $data = [
            'year_implemented' => 5556,
            'course_id' => 1,
            'department_id' => 1,
            'start_year' => '2000',
            'end_year' => '2010',
        ];
        $response = $this->post(route('curriculum.store'), $data);

        $response->assertRedirect(route('curriculum.index'));
        $response->assertSessionHas('success', 'curriculum created');
    }

    public function testCurriculumCanBeDeleted(): void
    {
        $curriculum = Curriculum::factory()->create();

        $this->assertDatabaseHas('curricula', ['id' => $curriculum->id]);
        $response = $this->delete(route('curriculum.destroy', $curriculum->id));

        $response->assertRedirect(route('curriculum.index'));
        $this->assertDatabaseMissing('curricula', ['id' => $curriculum->id]);
        $response->assertSessionHas('success', 'curriculum deleted');
    }

    public function testCurriculumCanBeEdited(): void
    {
        $curriculum = Curriculum::factory()->create();

        $updatedData = [
            'year_implemented' => 2829,
            'course_id' => 2,
            'department_id' => 1,
            'start_year' => '2020',
            'end_year' => '2077',
        ];

        $response = $this->put(route('curriculum.update', $curriculum->id), $updatedData);
        $response->assertRedirect(route('curriculum.index'));

        $this->assertDatabaseHas('curricula', [
            'year_implemented' => 2829,
            'course_id' => 2,
            'department_id' => 1,
            'start_year' => '2020',
            'end_year' => '2077',
        ]);

        $response->assertSessionHas('success', 'curriculum updated');
    }

    public function testCurriculumCanAddSubjects(): void
    {
        $curriculum = Curriculum::factory()->create();
        $subject = Subject::factory()->create();
        $subject2 = Subject::factory()->create();

        $data = [
            "year_level" => 1,
            "semester" => 1,
            "subjects" => [$subject->id, $subject2->id]
        ];
        $response = $this->post(route('curriculum.addSubjects', $curriculum->id), $data);

        $response->assertRedirect(route('curriculum.index'));
        $response->assertSessionHas('success', 'subject added to curriculum');
    }
}
