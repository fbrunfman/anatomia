<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    public $updated_at = false;
    
    protected $fillable = [
        'name'
    ];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
