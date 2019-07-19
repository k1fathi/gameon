<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProject;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\Avatar;
use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $projects = Project::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $projects = Project::orderBy('id', 'ASC')->paginate($perPage);
        }

        return view('admin.projects.index', compact('projects'));
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

        //$user = User::find($request->user_id);

        $data = $request->all();

        $project = Project::create($data);

//        if($user->hasRole('teacher'))
//        {
//            $rosettes = Rosette::find($request->rosette_ids);
//            $project->rosettes()->saveMany($rosettes);
//
//            $avatars = Avatar::find($request->avatar_ids);
//            $project->avatars()->saveMany($avatars);
//
//            $users = User::find($request->user_ids);
//            $project->users()->saveMany($users);
//
//            foreach ($users as $user)
//            {
//                $project_user = ProjectUser::where(['user_id'=>$user->id,'project_id'=>$project->id])->first();
//                $project_user->assignRole('member');
//            }
//
//            $advisor = User::find($request->advisor_id);
//            $project->users()->saveMany($advisor);
//
//            $project_user = ProjectUser::where(['user_id'=>$request->advisor_id,'project_id'=>$project->id])->first();
//            $project_user->assignRole('advisor');
//        }

        return response()->json(['name' => 'başarılı', 'state' => 'CA']);
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
        $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project'));
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


        $project = Project::select('id', 'name', 'description','start_date', 'finish_date', 'gold', 'exp', 'is_completed')->findOrFail($id);

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
    public function update(CreateProject $request, $id)
    {

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

        return redirect('admin/projects')->with('flash_message', 'Project deleted!');
    }
}
