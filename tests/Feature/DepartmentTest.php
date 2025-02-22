<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Department;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    public function testDepartmentCanBeCreated(): void
    {
        $data = [
            "title" => "Engineering Department",
            "program_type_id" => 1,
            "dean_id" => 1,
            "chairperson_id" => "1",
        ];
        $response = $this->post('/department', $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'department created');
    }

    public function testDepartmentCanBeDeleted(): void
    {
        $department = Department::factory()->create();

        $this->assertDatabaseHas('departments', ['id' => $department->id]);
        $response = $this->delete(route('department.destroy', $department->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
        $response->assertSessionHas('success', 'department deleted');
    }

    public function testDepartmentCanBeEdited(): void
    {
        $department = Department::factory()->create();

        $updatedData = [
            "title" => "Computer Studies Program",
            "program_type_id" => 2,
            "dean_id" => 1,
            "chairperson_id" => "1",
        ];

        $response = $this->put(route('department.update', $department->id), $updatedData);
        $response->assertRedirect(route('course.index'));

        $this->assertDatabaseHas('departments', [
            "title" => "Computer Studies Program",
            "program_type_id" => 2,
            "dean_id" => 1,
            "chairperson_id" => "1",
        ]);

        $response->assertSessionHas('success', 'department updated');
    }
}
