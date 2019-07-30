<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rosetteable()
    {
        return $this->belongsTo();
    }
}
