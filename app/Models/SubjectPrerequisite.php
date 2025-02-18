<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectPrerequisite extends Pivot
{
    protected $table = 'subject_prerequisite';
}
