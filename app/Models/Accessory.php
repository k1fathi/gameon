<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Accessory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \App\Models\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory query()
 * @mixin \Eloquent
 */
class Accessory extends Model
{
    //
    use LogsActivity;

    protected $fillable = [
        'name',
        'description'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class,'projects_accessories');
    }

}
