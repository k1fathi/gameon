<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @mixin \Eloquent
 */
class Role extends Model implements \Spatie\Permission\Contracts\Role
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name'
    ];
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = $this->attributesToArray();
        $attributes = array_merge($attributes, $this->relationsToArray());
        unset($attributes['pivot']['created_at']);
        return $attributes;
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

    /*public static function boot()
     {
         parent::boot();

         parent::saving(function (self $model) {
             $model->guard_name=ucwords(Setting::SARENTE);
         });
     }*/
    /**
     * Find a role by its name and guard name.
     * @param string $name
     * @param string|null $guardName
     * @return \Spatie\Permission\Contracts\Role
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findByName(string $name, $guardName): \Spatie\Permission\Contracts\Role
    {
        return app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()::findByName($name, $guardName);
    }

    /**
     * Find a role by its id and guard name.
     * @param int $id
     * @param string|null $guardName
     * @return \Spatie\Permission\Contracts\Role
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findById(int $id, $guardName): \Spatie\Permission\Contracts\Role
    {
        // TODO: Implement findById() method.
    }

    /**
     * Find or create a role by its name and guard name.
     * @param string $name
     * @param string|null $guardName
     * @return \Spatie\Permission\Contracts\Role
     */
    public static function findOrCreate(string $name, $guardName): \Spatie\Permission\Contracts\Role
    {
        // TODO: Implement findOrCreate() method.
    }

    /**
     * Determine if the user may perform the given permission.
     * @param string|\Spatie\Permission\Contracts\Permission $permission
     * @return bool
     */
    public function hasPermissionTo($permission): bool
    {
        // TODO: Implement hasPermissionTo() method.
    }

    /**
     * A role may be given various permissions.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
