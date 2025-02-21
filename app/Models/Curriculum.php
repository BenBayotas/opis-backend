<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    /** @use HasFactory<\Database\Factories\CurriculumFactory> */
    use HasFactory;

    protected $fillable = ['course_id', 'curriculum_year'];


    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
