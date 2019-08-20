<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before(Authenticatable $user, $ability)
    {
        return false;
    }

    /**
     * Determine whether the user can view the test.
     *
     * @param  Authenticatable $user
     * @return mixed
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the test.
     *
     * @param  Authenticatable $user
     * @param  Project $model
     * @return mixed
     */
    public function show(User $user, Project $model)
    {
        return false;
    }

    /**
     * Determine whether the user can create tests.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $var=$user->can(Setting::PERMISSION_PROJECT_CREATE);

        if ($user->can(Setting::PERMISSION_PROJECT_CREATE)) {
            return true;
        };
    }

    /**
     * Determine whether the user can update the test.
     *
     * @param  Authenticatable $user
     * @param  Project $model
     * @return mixed
     */
    public function edit(User $user, Project $model)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the test.
     *
     * @param  Authenticatable $user
     * @param  Project $model
     * @return mixed
     */
    public function delete(User $user, Project $model)
    {
        return false;
    }

    public function import(User $user)
    {
        return true;
    }

}
