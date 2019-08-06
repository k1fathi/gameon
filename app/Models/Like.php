<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Like
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $likeable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Like query()
 * @mixin \Eloquent
 */
class Like extends Model
{
    protected $fillable = [
        'likeable_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
