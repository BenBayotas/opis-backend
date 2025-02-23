<?php

namespace App\Models;

use App\Http\Controllers\SubjectPrerequisiteController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
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

    public function curriculums(): BelongsToMany
    {
        return $this->belongsToMany(Curriculum::class, 'curriculum_subject')
            ->using(CurriculumSubject::class)
            ->withPivot('year_level', 'semester', 'quota', 'subject_area_id')
            ->withTimestamps();
    }


    public function requisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'subject_id', 'dependent_subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->withTimestamps();
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'subject_id', 'dependent_subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 1)
            ->withTimestamps();
    }

    public function prereqFor(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'dependent_subject_id', 'subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 1)
            ->withTimestamps();
    }

    public function corequisites(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'subject_id', 'dependent_subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 2)
            ->withTimestamps();
    }

    public function coreqFor(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'dependent_subject_id', 'subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 2)
            ->withTimestamps();
    }

    public function equivalents(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'dependent_subject_id', 'subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 3)
            ->withTimestamps();
    }

    public function equivFor(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_pre_co_equi', 'dependent_subject_id', 'subject_id')
            ->using(SubjectPreCoEqui::class)
            ->withPivot('type', 'curriculum_id')
            ->wherePivot('type', 3)
            ->withTimestamps();
    }
}
