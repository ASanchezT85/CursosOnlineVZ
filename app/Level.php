<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    public static function boot () {
        parent::boot();

        static::saving(function(Level $levels) {
            if( ! \App::runningInConsole() ) {
                $levels->slug = str_slug($levels->name, "-");
            }
        });
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
