<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $courses = Course::all();

        $data = [
            "departments" => $departments,
            "courses" => $courses,
        ];
        return view('course.course-index',  $data);
    }

    /**
     * Store a newly created resource in storage.
     * 
     *request
     */
    public function store(Request $request)
{
    $course = new Course;

    $request->validate([
        'department_id'     => ['required', 'exists:departments,id'],
        'code'              => ['required'],
        'acronym'           => ['required'],
        'description'       => ['required'],
        'major'             => ['nullable'],
        'authority_no'      => ['nullable'],
        'accreditation_id'  => ['nullable'],
        'year_granted'      => ['nullable'],
        'years'             => ['required', 'integer'],
        'slots'             => ['required', 'integer'],
    ]);

    $course->department_id    = $request->input('department_id');
    $course->code             = $request->input('code');
    $course->acronym          = $request->input('acronym');
    $course->description      = $request->input('description');
    $course->major            = $request->input('major');
    $course->authority_no     = $request->input('authority_no');
    $course->accreditation_id = $request->input('accreditation_id'); // Fixed typo
    $course->year_granted     = $request->input('year_granted');
    $course->years            = $request->input('years');
    $course->slots            = $request->input('slots');

    $course->save();

    return redirect('course')->with('success', 'Course Added');
}

    public function create()
    {
        return view('create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    public function edit(string $id)
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
