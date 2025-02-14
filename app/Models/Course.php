<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;
    // TODO: figure out the whole belongs-to-has thing
    //
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
