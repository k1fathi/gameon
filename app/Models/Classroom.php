<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Classroom
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassroomTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classroom withTranslation()
 * @mixin \Eloquent
 */
class Classroom extends Model
{
    use LogsActivity;
    use Translatable;

    protected $fillable = [
        'number',
    ];

    public $translatedAttributes = [
        'label',
        'category'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'translations',
    ];
}
