<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Step;

class StepController extends Controller
{
    public function store(Request $request)
    {
        $project = Project::where('id',$request->project_id)->first();

        $step = new Step();
        $step->ordinal = $request->ordinal;
        $step->name = $request->name;
        $step->description = $request->description;

        $project->steps()->save($step);

        return response()->json(['name' => 'success', 'status' => '200']);
    }

    public function destroy($id, Request $request)
    {
        $step = Step::where('project_id',$id)->where('ordinal',$request->ordinal)->delete();

        return response()->json(['name' => 'success', 'status' => '200']);
    }
}
