<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use Notifiable;
    protected $table = "projects";

    protected $fillable = [
        'name',
        'description',
        'starr_date',
        'finish_date',
        'gold', 'exp',
        'is_completed',
    ];
}
