<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;
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
    const PROJECT_STUDENT = 'project_student';
    const PROJECT_TEACHER = 'project_teacher';
    const PROJECT_LEADER = 'project_leader';

    //Default Permissions of project
    const PROJECT_CREATE = 'project_create';
    const PROJECT_READ = 'project_read';
    const PROJECT_UPDATE = 'project_update';
    const PROJECT_DELETE = 'project_delete';

    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';

    const SARENTE='sarente';



}
