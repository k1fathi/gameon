<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Step
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step query()
 * @mixin \Eloquent
 */
class StepTranslation extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'description'
    ];

    function step()
    {
        return $this->belongsTo(Step::class);
    }
}
