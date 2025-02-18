<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CurriculumSemester extends Model
{
    use HasFactory;

    public function curriculumYear(): BelongsTo
    {
        return $this->belongsTo(CurriculumYear::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)
            ->using(CurriculumSemesterSubject::class)
            ->withPivot('curriculum_semester_area_id', 'quota')
            ->withTimestamps();
    }
}
