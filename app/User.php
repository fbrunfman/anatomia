<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_id'
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
    
    public function courses() {
        return $this->hasMany('App\Course');
    }
    public function lessons() {
        return $this->hasMany('App\Lesson');
    }
    public function chapters() {
        return $this->hasMany('App\Chapter');
    }
    public function screens() {
        return $this->hasMany('App\Screen');
    }
    public function questions() {
        return $this->hasMany('App\Question');
    }
    public function answers() {
        return $this->hasMany('App\Answer');
    }
}
