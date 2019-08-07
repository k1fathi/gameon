<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
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
    use Translatable;

    protected $fillable = [

    ];
    public $translatedAttributes = [
        'name',
        'description'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'translations',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_rosettes');
    }


}