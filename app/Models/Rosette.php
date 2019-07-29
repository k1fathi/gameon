<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rosette extends Model
{
    use LogsActivity;
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