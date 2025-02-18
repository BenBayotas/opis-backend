<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectCorequisite extends Pivot
{
    protected $table = 'subject_corequisite';
}
