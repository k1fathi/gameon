<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';

    protected $fillable = [
        'name',
        'description',
        'path'
    ];

    public function owner()
    {
        return $this->belongsToMany(User::class, 'avatar_user');
    }
}
