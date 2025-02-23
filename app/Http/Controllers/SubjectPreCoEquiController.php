<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Models\Subject;

// TODO: update to work with the new table
class SubjectPreCoEquiController extends Controller
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
    // takes a subject, that's in a curriculum, and adds one or many requisites of specified type
    public function store(Request $request, $id)
    {
        // NOTE: doesn't validate for duplicates
        $validated = $request->validate([
            'curriculum_id'   => 'required|exists:curricula,id',

            'requisites' => 'required|array',
            'requisites.*.dependent_subject_id'  => 'required|exists:subjects,id',
            'requisites.*.type' => 'required|integer',

        ]);

        $subject = Subject::findOrFail($id);

        foreach ($validated['requisites'] as $requisite) {
            $pivotData = [
                'curriculum_id' => $validated['curriculum_id'],
                'dependent_subject_id' => $requisite['dependent_subject_id'],
                'type' => $requisite['type'],
            ];
            switch ($requisite['type']) {
                case 1:
                    $subject->prerequisites()->attach($requisite['dependent_subject_id'], $pivotData);
                case 2:
                    $subject->corequisites()->attach($requisite['dependent_subject_id'], $pivotData);
                case 3:
                    $subject->equivalents()->attach($requisite['dependent_subject_id'], $pivotData);
            }
        }

        return redirect()->back()->with('success', 'requisite added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,)
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
    public function destroy(Request $request, $currId, $subjectId, $reqId)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject->requisites()->detach($reqId, ['curriculum_id' => $currId]);

        return redirect()->back()->with('success', 'requisite removed successfully.');
    }
}
