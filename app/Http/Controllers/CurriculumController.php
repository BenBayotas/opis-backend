<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumSemester;
use App\Models\CurriculumYear;
use App\Models\Subject;
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

    public function addSubjects(Request $request, Curriculum $curriculum){
        $data = $request->validate([
            'year'     => 'required|integer',
            'semester' => 'required|integer',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $curriculumYear = $curriculum->curriculumYears()->where('year', $data['year'])->first();
        if (!$curriculumYear) {
            return response()->json(['message' => 'Curriculum year not found'], 404);
        }

        $semesterTitles = [
            1 => 'first',
            2 => 'second',
            3 => 'summer'
        ];
        $semTitle = $semesterTitles[$data['semester']] ?? null;
        if (!$semTitle) {
            return response()->json(['message' => 'Invalid semester value'], 400);
        }

        $curriculumSemester = $curriculumYear->semesters()->where('title', $semTitle)->first();
        if (!$curriculumSemester) {
            return response()->json(['message' => 'Curriculum semester not found'], 404);
        }

        $subjectsToAttach = [];
        foreach ($data['subjects'] as $subjectId) {
            $subjectsToAttach[$subjectId] = [
                'curriculum_semester_area_id' => 1, // default or adjust as needed
                'quota' => 0, // default or adjust as needed
            ];
        }

        $curriculumSemester->subjects()->syncWithoutDetaching($subjectsToAttach);

        return response()->json(['message' => 'Subjects added successfully']);
    }

    public function removeSubject(Request $request, Curriculum $curriculum, $semester, $subject)
    {
        // Optionally, add logic to verify that the semester belongs to this curriculum.
        $curriculumSemester = \App\Models\CurriculumSemester::findOrFail($semester);
        $curriculumSemester->subjects()->detach($subject);
        return response()->json(['message' => 'Subject removed successfully']);
    }
}
