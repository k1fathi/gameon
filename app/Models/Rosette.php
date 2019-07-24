<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rosette extends Model
{
    protected $table = 'rosettes';

    protected $fillable = [
        'name',
        'description',
        'path'
    ];

    public function owner()
    {
        return $this->belongsToMany(User::class, 'rosette_user');
    }
}