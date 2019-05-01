<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//Relations
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    protected $fillable = ['teacher_id', 'name', 'description', 'picture', 'level_id', 'category_id', 'status_id'];

    protected $withCount = ['reviews', 'students'];

    public static function boot () {
        parent::boot();

        static::saving(function(Course $course) {
            if( ! \App::runningInConsole() ) {
                $course->slug = str_slug($course->name, "-");
            }
        });

        static::saved(function (Course $course) {
            if ( ! \App::runningInConsole()) {
                if ( request('requirements')) {
                    foreach (request('requirements') as $key => $requirement_input) {
                        if ($requirement_input) {
                            Requirement::updateOrCreate(['id' => request('requirement_id'. $key)], [
                                'course_id' => $course->id,
                                'requirement' => $requirement_input
                            ]);
                        }
                    }
                }

                if(request('goals')) {
                    foreach(request('goals') as $key => $goal_input) {
                        if( $goal_input) {
                            Goal::updateOrCreate(['id' => request('goal_id'.$key)], [
                                'course_id' => $course->id,
                                'goal' => $goal_input
                            ]);
                        }
                    }
                }
            }
        });
    }

    public function pathAttachment () {
        return "/images/courses/" . $this->picture;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->select('id', 'name');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class)->select('id', 'name');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)->select('id', 'name');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->select('id', 'user_id', 'course_id', 'rating', 'comment', 'created_at');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getCustomRatingAttribute () {
        return $this->reviews->avg('rating');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function relatedCourses () {
        return Course::with('reviews')->whereCategoryId($this->category->id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit(6)
            ->get();
    }
}
