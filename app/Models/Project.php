<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'quota',
        'start_date',
        'end_date',
        'point',
        'experience',
        'is_completed',
        'user_id'
    ];

    protected $appends = [
        'flag_color',
        'flag_text',
        'project_image',
        'author',
        'likes',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        //return $this->belongsToMany(User::class, 'project_claim');
        return null;
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }


    public function rosettes()
    {
        return $this->belongsToMany(Rosette::class, 'project_rosette');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class);
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

        static::created(function ($model) {

            Permission::create(['name' => Setting::PERMISSION_PROJECT_ACCEPT . '_' . $model->id]);
            Permission::create(['name' => Setting::PERMISSION_PROJECT_DONE . '_' . $model->id]);
            Permission::create(['name' => Setting::PERMISSION_PROJECT_UPDATE . '_' . $model->id]);
            Permission::create(['name' => Setting::PERMISSION_PROJECT_DELETE . '_' . $model->id]);
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

