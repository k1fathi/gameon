<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StepRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Step;
use Illuminate\Support\Facades\App;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->error('error.not-found');
        }

        return response()->paginate($project->steps());
    }

    public function store(StepRequest $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->error('error.not-found');
        }

        try {
            $step = new Step(['step_no'=> $request->step_no]);
            $step->fill([
                'name:'. App::getLocale()    => $request->name,
                'description:'. App::getLocale() => $request->description,
            ]);
            $project->steps()->save($step);

        } catch (\Exception $exception) {
            return response()->error($exception->getMessage());
        }

        return response()->success('common.success');
    }

    public function update(StepRequest $request, $id)
    {
        $step = Step::find($id);
        if (!$step) {
            return response()->error('error.not-found');
        }

        $step->update($request->input());

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        $step = Step::find($id);
        if (!$step) {
            return response()->error('error.not-found');
        }

        $step->delete();

        return response()->success('common.success');
    }
}
