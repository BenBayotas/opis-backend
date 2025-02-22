<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
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

    public function testCourseCanBeDeleted(): void
    {
        $course = Course::factory()->create();
        $this->assertDatabaseHas('courses', ['id' => $course->id]);
        $response = $this->delete(route('course.destroy', $course->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
        $response->assertSessionHas('success', 'course deleted');
    }
}
