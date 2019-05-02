<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    public static function boot () {
        parent::boot();

        static::saving(function(Status $status) {
            if( ! \App::runningInConsole() ) {
                $status->slug = str_slug($status->name, "-");
            }
        });
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
