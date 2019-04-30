<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id', 'goal'];

    /**
     * Courses can belong to many goals.
     *
     * @return Model
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
