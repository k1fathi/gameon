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
    const PERMISSION_PROJECT_ACCEPT = 'project-accept'; // project creator
    const PERMISSION_PROJECT_DONE = 'project-done';
    const PERMISSION_PROJECT_UPDATE = 'project-update';
    const PERMISSION_PROJECT_DELETE = 'project-delete';

    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';

    const SARENTE='sarente';


}
