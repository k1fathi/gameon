<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Setting
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @mixin \Eloquent
 */
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

    //Default Permissions of project
    const PERMISSION_PROJECT_CREATE = 'project-create'; // project creator
    const PERMISSION_PROJECT_DONE = 'project-done';
    const PERMISSION_PROJECT_UPDATE = 'project-update';
    const PERMISSION_PROJECT_DELETE = 'project-delete';

    //Default Roles of project
    const ROLE_PROJECT_OWNER = 'project-owner';
    const ROLE_PROJECT_ADVISER = 'project-adviser';
    const ROLE_PROJECT_LEADER = 'project-leader';
    const ROLE_PROJECT_MEMBER = 'project-member';

    //Default Roles of system
    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPER_ADMIN = 'super-admin';

    const SARENTE='sarente';


}
