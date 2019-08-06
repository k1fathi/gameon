<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Accessory extends Model
{
    //
    use LogsActivity;

    protected $fillable = [
        'name',
        'description'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
