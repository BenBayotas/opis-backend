<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumYear extends Model
{
    /** @use HasFactory<\Database\Factories\CurriculumYearFactory> */
    use HasFactory;

    protected $fillable = ['year', 'curriculum_id'];


    public function semesters(): HasMany
    {
        return $this->hasMany(CurriculumSemester::class);
    }


    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class);
    }
}
