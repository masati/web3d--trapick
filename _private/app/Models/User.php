<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'job_title', 'institution', 'country_id',
        'city', 'phone', 'email', 'password', 'to_approve', 'date_course'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country() {
        return $this->belongsTo('\App\Models\Country');
    }

    public function sources()
    {
        return $this->hasMany('\App\Models\Source', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany('\App\Models\Lesson', 'user_id');
    }

    public function pages()
    {
        return $this->hasOne(\App\Models\Page::class);
    }

    public function favorite_sources()
    {
        return $this->belongsToMany('\App\Models\Source', 'favorite_sources');
    }

    public function favorite_lessons()
    {
        return $this->belongsToMany('\App\Models\Lesson', 'favorite_lessons');
    }



    public function setPasswordAttribute($value)
    {
        if( $value )
            $this->attributes['password'] = bcrypt($value);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isAdmin()
    {
        return $this->is_sa === 1;
    }
}
