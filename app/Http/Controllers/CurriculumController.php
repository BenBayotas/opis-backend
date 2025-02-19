<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculums = Curriculum::all();
        $courses = Course::all(); // NOTE: remove in transition

        $data = [
            "curriculums" => $curriculums,
            "courses" => $courses,
        ];

        return view('curriculum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "courses" => Course::all()
        ];
        return view('curriculum.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $curricula = Curriculum::all();

        $request->validate([
            'year' => ['required', 'digits:4', 'unique:curricula,curriculum_year'],
            'course' => ['required']
        ]);

        $curriculum = new Curriculum;
        $curriculum->course_id = $request->input('course');
        $curriculum->curriculum_year = $request->input('year');
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', 'new curriculum adedd');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $curriculum_id = $request->query('curriculum');
        $curriculum = Curriculum::find($curriculum_id);

        $data = [
            "curriculum" => $curriculum,
        ];
        return view('curriculum.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        //
    }
}
