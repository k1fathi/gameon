<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Rosette
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \App\Models\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RosetteTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rosette withTranslation()
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