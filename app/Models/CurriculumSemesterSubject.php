<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CurriculumSemesterSubject extends Pivot
{
    /** @use HasFactory<\Database\Factories\CurriculumSemesterSubjectFactory> */
    use HasFactory;

    protected $table = 'curriculum_semester_subject';
}
