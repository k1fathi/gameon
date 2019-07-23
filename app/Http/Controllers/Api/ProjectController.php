<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\Avatar;
use App\Models\User;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        return $projects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());

        $user = User::find($request->user_id);

        if($user->hasRole('teacher'))
        {
            $rosettes = Rosette::find($request->rosette_ids);
            $project->rosettes()->saveMany($rosettes);

            $avatars = Avatar::find($request->avatar_ids);
            $project->avatars()->saveMany($avatars);

            $this->createRolesAndPermissions($project->id);

            $students = User::find($request->student_ids);
            $this->studentSave($students, $project->id);

            $teachers = User::find($request->teacher_ids);
            $this->teacherSave($teachers, $project->id);
        }

        return response()->success('common.success');
    }
    
    public function createRolesAndPermissions($project_id)
    {
        Role::create(['name'=>Setting::PROJECT_STUDENT . $project_id]);
        Role::create(['name'=>Setting::PROJECT_TEACHER . $project_id]);
        Role::create(['name'=>Setting::PROJECT_LEADER  . $project_id]);

        Permission::create(['name'=>Setting::PROJECT_CREATE  . $project_id]);
        Permission::create(['name'=>Setting::PROJECT_READ  . $project_id]);
        Permission::create(['name'=>Setting::PROJECT_UPDATE  . $project_id]);
        Permission::create(['name'=>Setting::PROJECT_DELETE  . $project_id]);
    }
    public function studentSave($students, $project_id)
    {
        foreach ($students as $student)
        {
            $student->assignRole(Setting::PROJECT_STUDENT . $project_id);
        }
    }

    public function teacherSave($teachers, $project_id)
    {
        foreach ($teachers as $teacher)
        {
            $teacher->assignRole(Setting::PROJECT_TEACHER  . $project_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return array
     */
    public function show($id)
    {
        $project = Project::find($id);

        return [
            "project" => $project,
            "members" => $project->getMembers(),
            "avatars" => $project->avatars()->get(),
            "rosettes"=> $project->rosettes()->get(),
            "steps" => $project->steps()->get()
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {


        $project = Project::select('id', 'name', 'description','starr_date', 'finish_date', 'gold', 'exp', 'is_completed')->findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
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
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return response()->success('common.success');
    }
}
