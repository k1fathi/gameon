<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Language
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @mixin \Eloquent
 */
class Language extends Model
{
    use LogsActivity;
    protected $fillable = [
        'locale',
        'native',
        'english',
        'is_required',
    ];

    public static function locales()
    {
        return Cache::rememberForever('locales', function () {
            return self::query()->pluck('locale')->toArray();
        });
    }

    public static function requiredLocales()
    {
        return Cache::rememberForever('locales_required', function () {
            return self::query()->where('is_required', true)->pluck('locale')->toArray();
        });
    }

    public static function getEnglishLabels(){
        return Language::query()->pluck('english','id')->toArray();
    }

}
