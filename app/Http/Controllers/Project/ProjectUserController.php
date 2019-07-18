<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use App\User;
use App\Role;
use App\Project;

class ProjectUserController extends Controller
{
    public function add_user(Request $request)
    {
        $project = Project::find($request->project_id);
        $user = User::find($request->user_id);

        $project->users()->save($user);
    }

    public function assign_role(Request $request)
    {
        $role = Role::find($request->role_id);
        $project_user = ProjectUser::where(['user_id' => $request->user_id, 'project_id' => $request->project_id])->first();

        //echo $role->name;
        $project_user->assignRole($role->name);
    }
}
