<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Step
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Step query()
 * @mixin \Eloquent
 */
class Step extends Model
{
    use LogsActivity;
    protected $table = 'steps';

    protected $fillable = [
        'ordinal',
        'name',
        'description',
        'is_completed'
    ];
}
