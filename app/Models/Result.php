<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Result
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $resultable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Result query()
 * @mixin \Eloquent
 */
class Result extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
    ];

    public function resultable()
    {
        return $this->morphTo();
    }
}