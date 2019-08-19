<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Models\Rosette;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Http\Requests\Api\RosetteRequest;
use Illuminate\Support\Facades\Input;

class RosetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $rosettes = Rosette::query();

        if (!$rosettes) {
            return response()->error('error.not-found');
        }
        return response()->paginate($rosettes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(RosetteRequest $request)
    {
        $rosette_name=$request->only('name');
        $rosette = Rosette::query()->whereTranslationLike('name',$rosette_name)->exists();

        if($rosette){
            return response()->error('rosette.name-valid');
        }

        try {
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

        } catch (\Exception $exception) {
            return response()->error($exception->getMessage());
        }

        return response()->success('common.success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\Api\RosetteRequest
     * @param  int      $id
     *
     * @return array
     */
    public function update(RosetteRequest $request, $id)
    {
        $rosette = Rosette::find($id);

        if (!$rosette) {
            return response()->error('error.not-found');
        }

        $rosette->update($request->input());

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
        $rosette = Rosette::find($id);
        if (!$rosette) {
            return response()->error('error.not-found');
        }

        $rosette->delete();

        return response()->success('common.success');
    }
}
