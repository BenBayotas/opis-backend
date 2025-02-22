<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "program_type_id",
        "dean_id",
        "chairperson_id",
    ];


    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function curricula(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function program_type(): BelongsTo
    {
        return $this->belongsTo(ProgramType::class);
    }
}
