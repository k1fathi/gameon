<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Step extends Model
{
    use LogsActivity;
    protected $table = 'steps';

    protected $fillable = [
        'ordinal',
        'name',
        'description',
        'is_completed'
    ];
}
