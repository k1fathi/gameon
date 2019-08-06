<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feed
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $feedable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed query()
 * @mixin \Eloquent
 */
class Feed extends Model
{
    const TYPE_PROJECT     = 'feed.project';
    const TYPE_CLUB     = 'feed.club';
    const TYPE_PROFILE      = 'feed.profile';

    protected $hidden = [
        'updated_at',
        'deleted_at',

        'user_id',
        'feedable_id',

        'is_premium',
    ];

    protected $fillable = [
        'created_at',
        'is_like',
        'is_dislike',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedable()
    {
        return $this->morphTo('feedable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
