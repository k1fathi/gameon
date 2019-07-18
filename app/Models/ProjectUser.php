<?php

namespace App\Models;

use App\HasRoles;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasRoles;

    protected $table = "project_user";

}
