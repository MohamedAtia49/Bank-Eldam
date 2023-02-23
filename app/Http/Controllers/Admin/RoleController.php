<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $records = Role::with('permissions')->paginate(4);
        return view('roles.index', compact('records'));
    }


    public function create()
    {
        $records = Permission::all();
        return view('roles.create',compact('records'));
    }


    public function store(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required|unique:roles,name',
             'permissions'=>'required|array',
             'permissions.*'=>'exists:permissions,id'],
            ['name.required' => 'اسم الدور مطلوب',
            'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = Role::create($request->all());
        $permissions = Permission::all();
        $record->givePermissionTo($request->permissions,[]);

        return redirect('admin/roles')->with('message','Role Created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $record = Role::find($id);
        $permissions = Permission::all();
        return view('roles.edit',compact('record','permissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            ['name' => 'required|unique:roles,name,'.$id],
            ['name.required' => 'اسم الدور مطلوب',
             'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = tap(Role::find($id))->update($request->all());
        $permissions = Permission::all();
        $record->syncPermissions($request->permissions,[]);

        return redirect('admin/roles')->with('message','Role Updated');
    }

    public function destroy($id)
    {
        $record = Role::find($id);
        $record->delete();

        return redirect('admin/roles');
    }
}
