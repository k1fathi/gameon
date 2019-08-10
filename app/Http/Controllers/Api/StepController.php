<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Step;

class StepController extends Controller
{
    public function store(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $step_no=$request->only('name');
        $step = Step::query()->whereTranslationLike('name',$step_no)->exists();

        if($step){
            return response()->error('project.name-valid');
        }

        $project = Project::find($request->project_id);

        $step = new Step($request->input());
        $project->steps()->save($step);

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        Step::destroy($id);

        return response()->success('common.success');
    }
}
