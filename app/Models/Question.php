<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'category','question','teacher_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
