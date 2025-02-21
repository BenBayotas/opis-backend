<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CurriculumSubject extends Pivot
{
    protected $table = 'curriculum_subject';
}
