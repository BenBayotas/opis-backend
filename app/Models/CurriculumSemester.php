<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumSemester extends Model
{
    use HasFactory;

    public function curriculumYear(): BelongsTo
    {
        return $this->belongsTo(CurriculumYear::class);
    }
}
