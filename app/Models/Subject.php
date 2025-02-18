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
        'subject_code',
        'subject_title',
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
        return $this->belongsToMany(CurriculumSemester::class)
            ->using(CurriculumSemesterSubject::class)
            ->withPivot('curriculum_semester_area_id', 'quota')
            ->withTimestamps();
    }
}
