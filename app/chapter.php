<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }
}
