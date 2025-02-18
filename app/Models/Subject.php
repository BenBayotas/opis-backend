<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function semesters(): BelongsToMany
    {
        return $this->belongsToMany(CurriculumSemester::class)
            ->using(CurriculumSemesterSubject::class)
            ->withPivot('curriculum_semester_area_id', 'quota')
            ->withTimestamps();
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_prerequisite', 'subject_id', 'prerequisite_id')
            ->using(SubjectPrerequisite::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }

    public function prereqFor(): BelongsToMany
    {
        // filter for curriculum
        return $this->belongsToMany(Subject::class, 'subject_prerequisite', 'prerequisite_id', 'subject_id')
            ->using(SubjectPrerequisite::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }

}
