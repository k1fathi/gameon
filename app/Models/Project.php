<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Project extends Model
{
    use HasRoles;

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
            'students' => User::role(Setting::PROJECT_STUDENT . $this->id)->get(),
            'teachers' => User::role(Setting::PROJECT_TEACHER . $this->id)->get(),
            'leader' => User::role(Setting::PROJECT_LEADER . $this->id)->get()
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
        static::created(function($model)
        {
            Role::create(['name'=>Setting::PROJECT_STUDENT . ' ' . $model->id]);
            Role::create(['name'=>Setting::PROJECT_TEACHER . ' ' . $model->id]);
            Role::create(['name'=>Setting::PROJECT_LEADER  . ' ' . $model->id]);

            Permission::create(['name'=>Setting::PROJECT_CREATE  . ' ' . $model->id]);
            Permission::create(['name'=>Setting::PROJECT_READ  . ' ' . $model->id]);
            Permission::create(['name'=>Setting::PROJECT_UPDATE  . ' ' . $model->id]);
            Permission::create(['name'=>Setting::PROJECT_DELETE  . ' ' . $model->id]);
        });

        static::deleting(function ($model)
        {
//            Role::where('name',Setting::PROJECT_STUDENT . ' ' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_TEACHER . ' ' . $model->id)->first()->delete();
//            Role::where('name',Setting::PROJECT_LEADER  . ' ' . $model->id)->first()->delete();
//
//            Permission::where('name',Setting::PROJECT_CREATE  . ' ' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_READ  . ' ' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_UPDATE  . ' ' . $model->id)->first()->delete();
//            Permission::where('name',Setting::PROJECT_DELETE  . ' ' . $model->id)->first()->delete();
        });
    }
}

