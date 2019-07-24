<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'steps';

    protected $fillable = [
        'ordinal',
        'name',
        'description',
        'is_completed'
    ];
}
