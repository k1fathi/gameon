<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\User;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
    public function index()
    {
        $projects = Project::
        with('steps', 'rosettes', 'image')
            ->with(['members.roles' => function ($role) {
                $role->where('name', 'teacher')->orWhere('name', 'student')->select('name');
            }]);

        if (!$projects) {
            return response()->error('error.not-found');
        }
        return response()->paginate($projects);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(ProjectRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $project_name = $request->only('name');
        $project = Project::whereTranslationLike('name', $project_name)->exists();

        if ($project) {
            return response()->error('project.name-valid');
        }

        $project = new Project($request->input());
        $project->user()->associate($user);
        $project->save();

        if ($request->hasFile('image')) {
            $project->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }

        if ($user->hasRole('student')) {
            $user->givePermissionTo([
                Setting::PERMISSION_PROJECT_ACCEPT . '_' . $project->id,
                Setting::PERMISSION_PROJECT_DONE . '_' . $project->id,
                Setting::PERMISSION_PROJECT_DELETE . '_' . $project->id,
                Setting::PERMISSION_PROJECT_UPDATE . '_' . $project->id,
            ]);
        }

        if ($user->hasRole('teacher')) {
            $rosettes = Rosette::find($request->rosette_ids);
            $project->rosettes()->saveMany($rosettes);
//
//            $avatars = Avatar::find($request->avatar_ids);
//            $project->avatars()->saveMany($avatars);

            $students = User::find($request->student_ids);
            $project->members()->saveMany($students);

            $teachers = User::find($request->teacher_ids);
            $project->members()->saveMany($teachers);

//            foreach ($teachers as $teacher) {
//                $teacher->givePermissionTo([
//                    Setting::PERMISSION_PROJECT_ACCEPT . '_' . $project->id,
//                    Setting::PERMISSION_PROJECT_DONE . '_' . $project->id,
//                    Setting::PERMISSION_PROJECT_DELETE . '_' . $project->id,
//                    Setting::PERMISSION_PROJECT_UPDATE . '_' . $project->id,
//                ]);
//            }
        }

        return response()->success('common.success');
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $project = Project::find($id);


        return response()->success($project->load(['members', 'rosettes', 'steps']));

        /*return [
            "project" => $project,
            "members" => $project->getMembers(),
            "avatars" => $project->avatars()->get(),
            "rosettes"=> $project->rosettes()->get(),
            "steps" => $project->steps()->get()
        ];*/
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->error('error.not-found');
        }

        $project->update($request->input());

        return response()->success('common.success');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->error('error.not-found');
        }
        $project->delete();

        return response()->success('common.success');
    }
}
