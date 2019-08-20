<?php

namespace App\Http\Controllers\Api;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::query();

        if (!$permissions) {
            return response()->error('error.not-found');
        }

        return response()->paginate($permissions);
    }

    public function store(Request $request)
    {
        $permission = new Permission($request->input());
        $permission->save();

        return response()->success('common.success');
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->error('error.not-found');
        }

        $permission->update($request->input());

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->error('error.not-found');
        }

        $permission->delete();

        return response()->success('common.success');
    }
}
