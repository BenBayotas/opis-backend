<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectCorequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_id'      => 'required|exists:subjects,id',
            'corequisite_id'  => 'required|exists:subjects,id',
            'curriculum_id'   => 'required|exists:curricula,id',
        ]);

        $subject = Subject::findOrFail($data['subject_id']);
        $subject->corequisites()->syncWithoutDetaching([
            $data['corequisite_id'] => ['curriculum_id' => $data['curriculum_id']]
        ]);

        return redirect()->back()->with('success', 'Corequisite added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $subjectId, $corequisiteId)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject->corequisites()->detach($corequisiteId);
        return redirect()->back()->with('success', 'Corequisite removed successfully.');
    }
}
