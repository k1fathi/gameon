<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectTranslation;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\Avatar;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\App;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
    public function index(Request $request)
    {
        $projects = Project::all();

        $projects = $projects->map(function ($project) {

            $project->flag_color='pink.png';
            $project->flag_text = 'ilk 3';
            $project->project_image = $project->image()->value('original_url');
            $project->author = $project->user()->value('name');
            $project->likes = 0;
            $project->views = 0;

            return $project;
        });

        return response()->success('common.success', $projects);
    }


    /**
     * Show the form for creating a new resource.
     * @return void
     */
    public function create()
    {

        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $project_name=$request->only('name');
        $project = Project::query()->whereTranslationLike('name',$project_name)->exists();

        if($project){
            return response()->error('project.name-valid');
        }

        $project = new Project($request->input());
        $project->user()->associate($user);
        $project->save();

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
            $project->participants()->saveMany($students);

            $teachers = User::find($request->teacher_ids);
            $project->participants()->saveMany($teachers);
            foreach ($teachers as $teacher) {
                $teacher->givePermissionTo([
                    Setting::PERMISSION_PROJECT_ACCEPT . '_' . $project->id,
                    Setting::PERMISSION_PROJECT_DONE . '_' . $project->id,
                    Setting::PERMISSION_PROJECT_DELETE . '_' . $project->id,
                    Setting::PERMISSION_PROJECT_UPDATE . '_' . $project->id,
                ]);
            }
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


        return response()->success($project->load(['members', 'rosettes', 'participants', 'steps', 'feed']));

        /*return [
            "project" => $project,
            "members" => $project->getMembers(),
            "avatars" => $project->avatars()->get(),
            "rosettes"=> $project->rosettes()->get(),
            "steps" => $project->steps()->get()
        ];*/
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {


        $project = Project::select('id', 'name', 'description', 'starr_date', 'finish_date', 'gold', 'exp', 'is_completed')->findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'description' => 'required|string'
            ]
        );

        $data = $request->all();

        $project = Project::findOrFail($id);
        $project->update($data);


        return redirect('admin/projects')->with('flash_message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return response()->success('common.success');
    }
}
