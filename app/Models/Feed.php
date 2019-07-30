<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    const TYPE_PROJECT     = 'feed.project';
    const TYPE_CLUB     = 'feed.club';
    const TYPE_PROFILE      = 'feed.profile';

}
