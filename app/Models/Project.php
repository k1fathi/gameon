<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Project extends Model
{
    use HasRoles;

    protected $table = 'projects';

    protected $fillable = [
        'name', 'description', 'quota', 'start_date', 'finish_date', 'gold', 'exp', 'is_completed'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'project_user');
    }

    public function rosettes()
    {
        return $this->belongsToMany(Rosette::class);
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}

