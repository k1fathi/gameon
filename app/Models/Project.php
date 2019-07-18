<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name', 'description', 'start_date', 'finish_date', 'is_completed'
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

