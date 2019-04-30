<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Relations
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//Shinobi paquete de roles y permisos
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Caffeinated\Shinobi\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, ShinobiTrait;

    protected static function boot () {
        parent::boot();
        static::creating(function (User $user) {
            if( ! \App::runningInConsole()) {
                $user->slug = str_slug($user->name, "-");
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pathAttachment () {
        return "/images/users/" . $this->picture;
    }

    /**
     * Roles can belong to many Role.
     *
     * @return Model
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Student Account can has One User.
     *
     * @return Model
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Teacher Account can has One User.
     *
     * @return Model
     */
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    /**
     * User Social Account can has One User.
     *
     * @return Model
     */
    public function socialAccount(): HasOne
    {
        return $this->hasOne(UserSocialAccount::class);
    }


}
