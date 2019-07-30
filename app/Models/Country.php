<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Dimsav\Translatable\Translatable;

/**
 * App\Models\Country
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CountryTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country withTranslation()
 * @mixin \Eloquent
 */
class Country extends Model
{
    use LogsActivity;

    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['code'];

    /**
     * The relations to eager load on every query.
     * @var array
     */
    // (optionaly)
    // protected $with = ['translations'];
}
