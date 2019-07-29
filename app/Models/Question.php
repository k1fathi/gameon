<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use LogsActivity;
    protected $table = 'questions';

    protected $fillable = [
        'question_text',
        'user_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function photo()
    {
        return $this->morphMany('App\Models\Image', 'model');
    }
}
