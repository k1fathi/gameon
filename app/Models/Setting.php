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


    public static function getUrl($roleName){

        $url='';
        $keys=self::where('key','like',"%$roleName%")->get()->pluck('value','key');

        if(count($keys)){

            switch($roleName){
                case self::ROLE_STUDENT:
                    $url=$keys[$roleName.'_url'];
                case self::ROLE_TEACHER:
                    $url=$keys[$roleName.'_url'];
                case self::ROLE_ADMIN:
                    $url=$keys[$roleName.'_url'];
            }
        }
        return $url;
    }
}
