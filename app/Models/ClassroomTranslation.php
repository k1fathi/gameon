<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassroomTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['label','category'];
}
