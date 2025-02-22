<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function testCourseCanBeCreated(): void
    {
        $data = [
            'department_id' => 1,
            'head_id' => 1,
            'code' => 'bscs',
            'description' => 'bachelor of science',
            'major' => '',
            'authority_no' => '',
            'accreditation_id' => '',
            'year_granted' => '2003',
            'years' => 5,
            'slots' => 45,
        ];
        $response = $this->post('/course', $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'course added');
    }

    public function testCourseReturnsValidationErrors(): void
    {
        $data = [
            'department_id' => 5,
            'head_id' => 1,
            'code' => 'bscs',
            'description' => 'bachelor of science',
            'major' => '',
            'authority_no' => '',
            'accreditation_id' => '',
            'year_granted' => '2003',
            'years' => 5,
            'slots' => 45,
        ];
        $response = $this->post('/course', $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['department_id']);
    }

    public function testCourseCanBeDeleted(): void
    {
        $course = Course::factory()->create();
        $this->assertDatabaseHas('courses', ['id' => $course->id]);
        $response = $this->delete(route('course.destroy', $course->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
        $response->assertSessionHas('success', 'course deleted');
    }

    public function testCourseCanBeEdited(): void
    {
        $course = Course::factory()->create();

        $updatedData = [
            'department_id' => 1,
            'head_id' => 2,
            'code' => 'bsit',
            'description' => 'Bachelor of Science in Information Technology',
            'major' => 'Data Analytics',
            'authority_no' => 'ge 54321',
            'accreditation_id' => '98765',
            'year_granted' => '2024',
            'years' => 2,
            'slots' => 20,
        ];

        $response = $this->put(route('course.update', $course->id), $updatedData);
        $response->assertRedirect(route('course.index'));
        $this->assertDatabaseHas('courses', [
            'department_id' => 1,
            'head_id' => 2,
            'code' => 'bsit',
            'description' => 'Bachelor of Science in Information Technology',
            'major' => 'Data Analytics',
            'authority_no' => 'ge 54321',
            'accreditation_id' => '98765',
            'year_granted' => '2024',
            'years' => 2,
            'slots' => 20,
        ]);

        $response->assertSessionHas('success', 'course updated');
    }
}
