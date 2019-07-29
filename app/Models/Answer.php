<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Answer extends Model
{
    use LogsActivity;
    protected $table = 'answers';

    protected $fillable = [
        'answer_text',
        'correctness'
    ];
}
