<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['name','description'];
}
