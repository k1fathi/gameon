<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Rosette
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette query()
 * @mixin \Eloquent
 */
class Rosette extends Model
{
    use LogsActivity;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    function rosette()
    {
        return $this->belongsTo(Rosette::class);
    }

}