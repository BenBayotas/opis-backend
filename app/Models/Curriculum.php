<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curriculum extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_implemented',
        'course_id',
        'department_id',
        'start_year',
        'end_year'
    ];


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
