<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        // TODO: need to add start and end year
        $request->validate([
            'year' => ['required', 'digits:4', 'unique:curricula,year_implemented'],
            'course' => ['required']
        ]);

        $curriculum = new Curriculum;
        $curriculum->course_id = $request->input('course');
        $curriculum->year_implemented = $request->input('year');
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', 'New curriculum added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $curriculum_id = $request->query('curriculum');
        $curriculum = Curriculum::find($curriculum_id);
        $curriculum->load('course', 'curriculumYears.semesters.subjects');
        $subjects = Subject::all();
        return view('curriculum.show', compact('curriculum', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $courses = Course::all();;

        $data = [
            "curriculum" => $curriculum,
            "courses" => $courses,
        ];
        return view('curriculum.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $curricula = Curriculum::all();

        $request->validate([
            'year_implemented' => ['required', 'digits:4', Rule::unique('curricula', 'year_implemented')->ignore($id)],
            'course' => ['required']
        ]);

        $curriculum = Curriculum::findOrFail($id);
        $curriculum->course_id = $request->input('course');
        $curriculum->year_implemented = $request->input('year_implemented');
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', 'curriculum updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        $curriculum->delete();
    }


    // NOTE: expects this kind of input
    // {
    //   "year_level": 1,
    //   "semester": 1,
    //   "subjects": [1, 2, 3]
    // }
    public function addSubjects(Request $request, $id)
    {
        $validated = $request->validate([
            'year_level' => 'required|integer',
            'semester' => 'required|integer',

            'subjects' => 'required|array',
            'subjects.*' => 'required|exists:subjects,id',
        ]);

        $curriculum = Curriculum::findOrFail($id);

        $subjectsData = [];
        foreach ($validated['subjects'] as $subjectId) {
            $subjectData[$subjectId] = [
                'year_level' => $validated['year_level'],
                'semseter' => $validated['semseter'],
            ];
        }
        $curriculum->subjects()->attach($subjectsData);
    }

    public function removeSubjects(Request $request, $id)
    {
        $validated = $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'required|exists:subjects,id',
        ]);
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->subjects()->detach($validated['subjects']);
    }
}
