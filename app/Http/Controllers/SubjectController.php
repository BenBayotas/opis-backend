<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('department')->get();
        return view('subject.subject-index', compact('subjects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $subjectGroups =DB::table('subject_groups')->get();
        $subjectCategories = DB::table('subject_categories')->get();

        return view('subject.subject-create', compact('departments','subjectGroups','subjectCategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_group_id' => 'required|exists:subject_groups,id',
            'code'     => 'nullable|string',
            'title'    => 'required|string',
            'is_major'         => 'required|boolean',
            'department_id'    => 'required|exists:departments,id',
            'credited_units'   => 'required|integer',
            'lec_hours'        => 'required|integer',
            'lab_hours'        => 'required|integer',
            'special'          => 'required|boolean',
            'elective'         => 'required|boolean',
            'no_text_booklet'  => 'required|boolean',
            'is_not_wga'       => 'required|boolean',
            'category_id'      => 'required|exists:subject_categories,id',
            'tuition_units'    => 'required|integer',
        ]);

        // Create the subject using mass assignment.
        Subject::create($validated);

        return redirect()->route('subject.index')->with('success', 'Subject Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subject.subject-show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $departments = Department::all();
        $subjectGroups = DB::table('subject_groups')->get();
        $subjectCategories = DB::table('subject_categories')->get();

        return view('subject.subject-edit', compact('subject', 'departments', 'subjectGroups', 'subjectCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'subject_group_id' => 'required|exists:subject_groups,id',
            'code'     => 'nullable|string',
            'title'    => 'required|string',
            'is_major'         => 'required|boolean',
            'department_id'    => 'required|exists:departments,id',
            'credited_units'   => 'required|integer',
            'lec_hours'        => 'required|integer',
            'lab_hours'        => 'required|integer',
            'special'          => 'required|boolean',
            'elective'         => 'required|boolean',
            'no_text_booklet'  => 'required|boolean',
            'is_not_wga'       => 'required|boolean',
            'category_id'      => 'required|exists:subject_categories,id',
            'tuition_units'    => 'required|integer',
        ]);

        // Update the subject record.
        $subject->update($validated);

        return redirect()->route('subject.index')->with('success', 'Subject Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }

    public function manageRequisites(Request $request, $subjectId)
    {
        // Retrieve the curriculum id from the query string
        $curriculumId = $request->query('curriculum');
        $subject = Subject::findOrFail($subjectId);
        $curriculum = \App\Models\Curriculum::findOrFail($curriculumId);
        $allSubjects = Subject::all(); // All subjects available for selection
        
        return view('subject.manage-requisites', compact('subject', 'curriculum', 'allSubjects'));
    }
}
