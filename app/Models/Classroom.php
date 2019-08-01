<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Classroom extends Model
{
    use LogsActivity;
    use Translatable;

    public $translatedAttributes = ['label','category'];
    protected $fillable = ['number'];
}
