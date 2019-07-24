<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'settings';

    /**
     * The database primary key value.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ['key', 'value'];


    //Default Roles of project
    const PROJECT_STUDENT = 'project_student_';
    const PROJECT_TEACHER = 'project_teacher_';
    const PROJECT_LEADER = 'project_leader_';

    //Default Permissions of project
    const PROJECT_CREATE = 'project_create_';
    const PROJECT_READ = 'project_read_';
    const PROJECT_UPDATE = 'project_update_';
    const PROJECT_DELETE = 'project_delete_';


    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';
}
