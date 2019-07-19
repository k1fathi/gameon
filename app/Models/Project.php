<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name', 'description', 'quota', 'start_date', 'finish_date', 'gold', 'exp', 'is_completed'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
        //->select(array('id','name', 'type','avatar'));
    }

    public function rosettes()
    {
        return $this->belongsToMany(Rosette::class);
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class);
    }

}

