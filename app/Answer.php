<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    public $updated_at = false;
    
    protected $fillable = [
        'name', 'is_correct', 'question_id'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

}
