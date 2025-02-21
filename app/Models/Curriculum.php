<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curriculum extends Model
{
    protected $fillable = ['course_id', 'curriculum_year'];


    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'curriculum_subject')
            ->using(CurriculumSubject::class)
            ->withPivot('year_level', 'semester', 'quota', 'subject_area_id')
            ->withTimestamps();
    }
}
