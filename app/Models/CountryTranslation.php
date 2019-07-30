<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;

/**
 * App\Models\CountryTranslation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CountryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CountryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CountryTranslation query()
 * @mixin \Eloquent
 */
class CountryTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['name'];
}
