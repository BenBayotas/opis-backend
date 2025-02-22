<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        dd($departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required",
            "program_type_id" => "required|exists:program_types,id",
            "dean_id" => "required", // TODO: require id to be valid
            "chairperson_id" => "required",
        ]);

        Department::create($validated);
    }

    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Department $department)
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
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            "title" => "required",
            "program_type_id" => "required|exists:program_types,id",
            "dean_id" => "required", // TODO: require id to be valid
            "chairperson_id" => "required",
        ]);

        $department->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }
}
