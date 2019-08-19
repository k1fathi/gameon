<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 * @mixin \Eloquent
 */
class Permission extends Model implements \Spatie\Permission\Contracts\Permission
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() :BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }

    /**
     * Find a permission by its name.
     * @param string $name
     * @param string|null $guardName
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     * @return \Spatie\Permission\Contracts\Permission
     */public static function findByName(string $name, $guardName): \Spatie\Permission\Contracts\Permission
{
    // TODO: Implement findByName() method.
}

    /**
     * Find a permission by its id.
     * @param int $id
     * @param string|null $guardName
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     * @return \Spatie\Permission\Contracts\Permission
     */
    public static function findById(int $id, $guardName): \Spatie\Permission\Contracts\Permission
    {
        // TODO: Implement findById() method.
    }

    /**
     * Find or Create a permission by its name and guard name.
     * @param string $name
     * @param string|null $guardName
     * @return \Spatie\Permission\Contracts\Permission
     */
    public static function findOrCreate(string $name, $guardName): \Spatie\Permission\Contracts\Permission
    {
        // TODO: Implement findOrCreate() method.
    }
}
