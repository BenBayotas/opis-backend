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


    protected $fillable = [
        'subject_group_id',
        'code',
        'title',
        'is_major',
        'department_id',
        'credited_units',
        'lec_hours',
        'lab_hours',
        'special',
        'elective',
        'no_text_booklet',
        'is_not_wga',
        'category_id',
        'tuition_units',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function semesters(): BelongsToMany
    {
        return $this->belongsToMany(CurriculumSemester::class, 'curriculum_semester_subject')
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

    public function corequisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_corequisite', 'subject_id', 'corequisite_id')
            ->using(SubjectCorequisite::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }

    public function coreqFor(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_corequisite', 'corequisite_id', 'subject_id')
            ->using(SubjectCorequisite::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }

    public function equivalents(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_equivalent', 'subject_id', 'equivalent_id')
            ->using(SubjectEquivalent::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }

    public function equivFor(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_equivalent', 'equivalent_id', 'subject_id')
            ->using(SubjectEquivalent::class)
            ->withPivot('curriculum_id')
            ->withTimestamps();
    }
}
