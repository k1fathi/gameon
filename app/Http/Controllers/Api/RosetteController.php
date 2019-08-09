<?php

namespace App\Http\Controllers\Api;

use App\Models\Rosette;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Imaged;

class RosetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request)
    {
        $rosettes = Rosette::all();
        $rosettes = $rosettes->map(function ($rosette) {
            return [
                'name' => $rosette->name,
                'description' => $rosette->description
            ];
        });

        return response()->success('common.success', $rosettes);
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
        $rosette_name=$request->only('name');
        $rosette = Rosette::query()->whereTranslationLike('name',$rosette_name)->exists();

        if($rosette){
            return response()->error('project.name-valid');
        }

        $rosette = new Rosette();
        $rosette->fill([
            'name:'. App::getLocale()    => $request->name,
            'description:'. App::getLocale() => $request->description,
        ]);
        $rosette->save();

        if ($request->hasFile('image')) {
            $rosette->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }

        if ($request->input('image_url')) {
            $rosette->image()->save(new Image([
                'image' => Imaged::make($request->input('image_url')),
            ]));
        }


        return response()->success('common.success');
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
        $data = $request->all();

        $project = Rosette::findOrFail($id);
        $project->update($data);

        return response()->success('common.success');
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
        Rosette::destroy($id);

        return response()->success('common.success');
    }
}
