<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\RosetteTranslation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \App\Models\Rosette $rosette
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RosetteTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RosetteTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RosetteTranslation query()
 * @mixin \Eloquent
 */
class RosetteTranslation extends Model
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