<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\Project
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar[] $avatars
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rosette[] $rosettes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Step[] $steps
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project role($roles, $guard = null)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasRoles;
    use LogsActivity;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'quota',
        'start_date',
        'finish_date',
        'gold',
        'experience',
        'is_completed'
    ];

    public function getMembers()
    {
        return [
            'students' => User::role(Setting::PROJECT_STUDENT . '_' . $this->id)->get(),
            'teachers' => User::role(Setting::PROJECT_TEACHER . '_' . $this->id)->get(),
            'leader' => User::role(Setting::PROJECT_LEADER . '_' . $this->id)->get()
        ];
    }

    public function rosettes()
    {
        return $this->belongsToMany(Rosette::class);
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            Role::create(['name' => Setting::PROJECT_STUDENT . '_' . $model->id]);
            Role::create(['name' => Setting::PROJECT_TEACHER . '_' . $model->id]);
            Role::create(['name' => Setting::PROJECT_LEADER . '_' . $model->id]);

            Permission::create(['name' => Setting::PROJECT_CREATE . '_' . $model->id]);
            Permission::create(['name' => Setting::PROJECT_READ . '_' . $model->id]);
            Permission::create(['name' => Setting::PROJECT_UPDATE . '_' . $model->id]);
            Permission::create(['name' => Setting::PROJECT_DELETE . '_' . $model->id]);
        });

        static::deleting(function ($model) {
//            Role::where('name',Setting::PROJECT_STUDENT . '_' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_TEACHER . '_' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_LEADER  . '_' . $model->id)->first()->delete();
//
//            Permission::where('name',Setting::PROJECT_CREATE  . '_' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_READ  . '_' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_UPDATE  . '_' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_DELETE  . '_' . $model->id)->first()->delete();
        });
    }
}

