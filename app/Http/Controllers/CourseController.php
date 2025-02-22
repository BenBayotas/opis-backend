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
        return view('course.index',  $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     *request
     */
    public function store(Request $request)
    {
        $course = new Course;

        // NOTE: head id needs validation
        $request->validate([
            'department_id'     => ['required', 'exists:departments,id'],
            'head_id' => ['required'],
            'code'              => ['required'],
            'description'       => ['required'],
            'major'             => ['nullable'],
            'authority_no'      => ['nullable'],
            'accreditation_id'  => ['nullable'],
            'year_granted'      => ['nullable'],
            'years'             => ['required', 'integer'],
            'slots'             => ['required', 'integer'],
        ]);

        $course->department_id       = $request->input('department_id');
        $course->head_id       = $request->input('head_id');
        $course->code             = $request->input('code');
        $course->description      = $request->input('description');
        $course->major            = $request->input('major');
        $course->authority_no     = $request->input('authority_no');
        $course->accreditation_id = $request->input('accreditation_id'); // Fixed typo
        $course->year_granted     = $request->input('year_granted');
        $course->years            = $request->input('years');
        $course->slots            = $request->input('slots');

        $course->save();

        return redirect()->route('course.index')->with('success', 'course added');
    }

    public function create()
    {
        $departments = Department::all();
        return view('course.create', compact('departments'));
    }


    public function search(Request $request)
    {
        $search = $request->query("search");


        // TODO: update for new model
        $courses = Course::where('code', 'like', '%' . $search . '%')
            ->orWhereHas('department', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('major', 'like', '%' . $search . '%')
            ->get();

        if ($search == "") {
            $courses = Course::all();
        }

        $data = [
            "courses" => $courses,
        ];

        // only ajax for now, fix later
        return view('course.partials.list', $data);
    }
    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $departments = Department::all();

        if ($request->header('HX-Request')) {
            return view('course.partials.edit-form', compact('course', 'departments'));
        }

        // Otherwise, load the full edit page (if needed)
        return view('course.course-edit', compact('course', 'departments'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'department_id'     => ['required', 'exists:departments,id'],
            'code'              => ['required'],
            'description'       => ['required'],
            'major'             => ['nullable'],
            'authority_no'      => ['nullable'],
            'accreditation_id'  => ['nullable'],
            'year_granted'      => ['nullable'],
            'years'             => ['required', 'integer'],
            'slots'             => ['required', 'integer'],
        ]);

        $course = Course::findOrFail($id);

        $course->department_id       = $request->input('department_id');
        $course->head_id = $request->input('head_id');
        $course->code             = $request->input('code');
        $course->description      = $request->input('description');
        $course->major            = $request->input('major');
        $course->authority_no     = $request->input('authority_no');
        $course->accreditation_id = $request->input('accreditation_id'); // Fixed typo
        $course->year_granted     = $request->input('year_granted');
        $course->years            = $request->input('years');
        $course->slots            = $request->input('slots');

        $course->save();

        return redirect()->route('course.index')->with('success', 'course updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Course::destroy($id);

        return redirect()->route('course.index')->with('success', 'course deleted');
    }
}
