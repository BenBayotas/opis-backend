<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function program_type(): BelongsTo
    {
        return $this->belongsTo(ProgramType::class);
    }


    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
