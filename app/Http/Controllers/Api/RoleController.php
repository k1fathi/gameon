<?php

namespace App\Http\Controllers\Api;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query();

        if (!$roles) {
            return response()->error('error.not-found');
        }

        return response()->paginate($roles);
    }

    public function store(Request $request)
    {
        $role = new Role($request->input());
        $role->save();

        return response()->success('common.success');
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->error('error.not-found');
        }

        $role->update($request->input());

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->error('error.not-found');
        }

        $role->delete();

        return response()->success('common.success');
    }
}
