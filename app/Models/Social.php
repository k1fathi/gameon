<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Social
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social query()
 * @mixin \Eloquent
 */
class Social extends Model
{
    use LogsActivity;
    protected $fillable = [
        'provider',
        'provider_id',
        'access_token',
        'access_token_secret',
    ];

    protected $hidden = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function columns(): Collection
    {
        $datas = [
            ['name' => 'id', 'data' => 'id', 'translate' => trans('models.common.id')],
            ['name' => 'provider', 'data' => 'provider', 'translate' => trans('models.social.provider')],
            ['name' => 'provider_id', 'data' => 'provider_id', 'translate' => trans('models.social.provider_id')],
        ];
        return collect($datas);
    }
}
