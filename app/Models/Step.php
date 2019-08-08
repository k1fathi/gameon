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
class Step extends Model
{
    use LogsActivity;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'step_no',
        'is_completed',
    ];
}
