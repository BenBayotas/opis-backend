<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumSemester;
use App\Models\CurriculumYear;
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
        $curriculum->year_implemented = $request->input('year');
        $curriculum->save();

        $course = Course::findOrFail($request->input('course'));

        for ($i = 1; $i <= $course->years; $i++) {
            $year = new CurriculumYear();
            $year->year = $i;
            $year->curriculum_id = $curriculum->id;
            $year->save();

            for ($j = 0; $j < 3; $j++) {
                $sem = new CurriculumSemester();

                $title = match ($j) {
                    0 => 'first',
                    1 => 'second',
                    2 => 'summer'
                };
                $sem->title = $title;
                $sem->curriculum_year_id = $year->id;
                $sem->save();
            }
        }

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
        $data = [
            "curriculum" => $curriculum,
        ];
        return view('curriculum.edit', $data);
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
