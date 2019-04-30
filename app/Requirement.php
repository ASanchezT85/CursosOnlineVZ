<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requirement extends Model
{
    protected $fillable = ['course_id', 'requirement'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
