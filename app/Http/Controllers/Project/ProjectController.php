<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
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
        $user = User::find($request->user_id);

        $data = $request->all();

        $project = Project::create($data);

        if($user->hasRole('teacher'))
        {
            $rosettes = Rosette::find($request->rosette_ids);
            $project->rosettes()->saveMany($rosettes);

            $avatars = Avatar::find($request->avatar_ids);
            $project->avatars()->saveMany($avatars);

            $users = User::find($request->user_ids);
            $project->users()->attach($users);

            Role::create(['name'=>'student_project' . $project->id]);
            Role::create(['name'=>'teacher_project' . $project->id]);
            Role::create(['name'=>'leader_project' . $project->id]);

            Permission::create(['name'=>'create_project' . $project->id]);
            Permission::create(['name'=>'read_project' . $project->id]);
            Permission::create(['name'=>'update_project' . $project->id]);
            Permission::create(['name'=>'delete_project' . $project->id]);

            $students = User::find($request->student_ids);

            foreach ($students as $student)
            {
                $student->assignRole('student_project' . $project->id);
            }

            $teachers = User::find($request->teacher_ids);

            foreach ($teachers as $teacher)
            {
                $teacher->assignRole('teacher_project' . $project->id);
            }

        }

        return response()->json(['name' => 'success', 'status' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        return Project::where('id',$id)->with('advisors','members','rosettes','avatars')->get();
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

        return response()->json(['name' => 'success', 'status' => '200']);
    }
}
