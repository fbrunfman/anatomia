<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
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

    public function chapters()
    {
        return $this->hasMany('App\Chapter');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
