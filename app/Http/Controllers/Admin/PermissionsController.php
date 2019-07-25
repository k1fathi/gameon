<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
protected $perPage = 15;
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(PermissionRequest $PermissionRequest)
    {
        $keyword = $PermissionRequest->get('search');
        

        if (!empty($keyword)) {
            $permissions = Permission::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
                ->latest()->paginate($this->perPage);
        } else {
            $permissions = Permission::latest()->paginate($this->perPage);
        }

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return void
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\PermissionRequest $PermissionRequest
     * @return void
     */
    public function store(PermissionRequest $PermissionRequest)
    {
        $permission = Permission::firstOrNew(['name' => $PermissionRequest->name]);

        $permission->save();
        
        $permissions = Permission::latest()->paginate($this->perPage);

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\PermissionRequest $PermissionRequest
     * @param  int $id
     * @return void
     */
    public function update(PermissionRequest $PermissionRequest, $id)
    {
        $this->validate($PermissionRequest, ['name' => 'required']);

        $permission = Permission::findOrFail($id);
        $permission->update($PermissionRequest->all());

        return redirect('admin/permissions')->with('flash_message', 'Permission updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect('admin/permissions')->with('flash_message', 'Permission deleted!');
    }
}
