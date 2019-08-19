<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Guard;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\Project
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar[] $avatars
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feed[] $feeds
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
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
    use Translatable;

    protected $table = 'projects';

    public $translatedAttributes = [
        'name',
        'description'
    ];

    protected $fillable = [
        'id',
        'quota',
        'start_date',
        'end_date',
        'point',
        'experience',
        'is_completed',
    ];

    protected $hidden = [
        'updated_at',
        'translations',
    ];

    /* protected $appends = [
         'project_image',
         'author',
         'likes',
         'views'
     ];*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user')->where('is_claim', false);
    }

    public function claims()
    {
        return $this->belongsToMany(User::class, 'project_user')->where('is_claim', true);
    }

    public function rosettes()
    {
        return $this->belongsToMany(Rosette::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }

    public function translation()
    {
        return $this->hasOne(ProjectTranslation::class);
    }

    public function getFlagColorAttribute($value)
    {
        return $value;
    }

    public function getFlagTextAttribute($value)
    {
        return $value;
    }

    //FIXME: change it to real mode
    public function getProjectImageAttribute($value)
    {
        return $value;
    }

    public function getAuthorAttribute($value)
    {
        return $value;
    }

    public function getLikesAttribute($value)
    {
        return $value;
    }

    public function getProjectViewsAttribute($value)
    {
        return $value;
    }

    /**
     * Change activity log event description
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }

//    public function getFlagColorAttribute()
//    {
//        return 5;
//    }

    public static function boot()
    {
        parent::boot();

        parent::creating(function (self $model) {
            if (is_null($model->id)) {
                $model->id = abs(crc32(uniqid()));
            }
        });

        static::created(function (self $model) {

            Role::create([
                'name' => Setting::ROLE_PROJECT_OWNER . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            Role::create([
                'name' => Setting::ROLE_PROJECT_ADVISER . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            Role::create([
                'name' => Setting::ROLE_PROJECT_LEADER . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            Role::create([
                'name' => Setting::ROLE_PROJECT_MEMBER . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);

        });

        static::deleting(function ($model) {
//            Role::where('name',Setting::PROJECT_STUDENT . '-' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_TEACHER . '-' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_LEADER  . '-' . $model->id)->first()->delete();
//
//            Permission::where('name',Setting::PROJECT_CREATE  . '-' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_READ  . '-' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_UPDATE  . '-' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_DELETE  . '-' . $model->id)->first()->delete();
        });
    }
}

