<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "model_has_photos";

    public function model()
    {
        return $this->morphTo();
    }
}
