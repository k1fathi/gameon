<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Http\Requests\Request;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\User;
use http\Env\Response;
use Spatie\Permission\PermissionRegistrar;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
    public function index()
    {
        $projects = Project::with('steps', 'rosettes', 'members', 'claims', 'image')
            ->with(['members.roles' => function ($role) {
                $role->where('name', 'teacher')->orWhere('name', 'student')->select('name');
            }])->latest('created_at');

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
        //$var=$this->authorize('create', Project::class);

        /** @var User $user */
        $user = $request->user();
        $project_name = $request->only('name');
        $project = Project::whereTranslationLike('name', $project_name)->exists();

        if ($project) {
            return response()->error('project.name-valid');
        }
        try {
            $project = new Project($request->input());
            $project->user()->associate($user);
            $project->save();

            if ($request->hasFile('image')) {
                $project->image()->save(new Image([
                    'image' => $request->file('image'),
                ]));
            }

            $rosettes = Rosette::whereIn('id', $request->input('rosette_ids'))->get();
            if ($rosettes) {
                $project->rosettes()->sync($rosettes);
            };

            if ($user->hasRole(Setting::ROLE_TEACHER)) {

                $students = User::find($request->student_ids);
                foreach ($students as $student){
                    $project->members()->save($student, ['is_claim'=> false]);
                }

                $teachers = User::find($request->teacher_ids);
                foreach ($teachers as $teacher){
                    $project->members()->save($teacher, ['is_claim'=> false]);
                }

//            foreach ($teachers as $teacher) {
//                $teacher->givePermissionTo([
//                    Setting::PERMISSION_PROJECT_ACCEPT . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_DONE . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_DELETE . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_UPDATE . '-' . $project->id,
//                ]);
//            }
            }
        } catch (\Exception $exception) {
            return response()->error($exception->getMessage());
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
        if (!$project) {
            return response()->error('error.not-found');
        }

        $project = $project->load(['claims', 'members', 'rosettes', 'steps', 'image'])
            ->load(['members.roles' => function ($role){
            $role->where('name', 'teacher')->orWhere('name', 'student')->select('name');
        }]);

        return response()->success($project);
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
