<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Avatar
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar query()
 * @mixin \Eloquent
 */
class Avatar extends Model
{
    use LogsActivity;
    protected $table = 'avatars';

    protected $fillable = [
        'name',
        'description',
        'path'
    ];

    public function owner()
    {
        return $this->belongsToMany(User::class, 'avatar_user');
    }
}
