<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use Notifiable;
    protected $table = "projects";

    protected $fillable = [
        'name', 'description', 'is_completed',
    ];
}
