<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'picture',
    ];

    public static function boot () {
        parent::boot();

        static::saving(function(Category $category) {
            if( ! \App::runningInConsole() ) {
                $category->slug = str_slug($category->name, "-");
            }
        });
    }

    public function pathAttachment () {
        return "/images/categories/" . $this->picture;
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
