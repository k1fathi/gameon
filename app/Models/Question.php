<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Question
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $photo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @mixin \Eloquent
 */
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
