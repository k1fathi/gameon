<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClassroomTranslation
 *
 * @property-read \App\Models\Classroom $classroom
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassroomTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassroomTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassroomTranslation query()
 * @mixin \Eloquent
 */
class ClassroomTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'label',
        'category',
    ];

    function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}