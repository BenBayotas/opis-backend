<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # NOTE: departments shouldn't be here, should be in a separate api call
        # but for now we'll keep it since we're using controller
        $departments = Department::all();

        $courses = Course::all();

        $data = [
            "departments" => $departments,
            "courses" => $courses,
        ];
        return view('course', $data);
    }

    # NOTE: we don't have create and edit functions because I messed up and made resource
    # controllers
    # reminder that the create and edit functinos are just the functions that show the forms

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
