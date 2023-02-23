<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $records = Permission::paginate(5);
        return view('permissions.index', compact('records'));
    }


    public function create()
    {
        return view('permissions.create');
    }


    public function store(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required|unique:permissions,name,'],
            ['name.required' => 'اسم الصلاحية مطلوب',
            'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = Permission::create($request->all());
        return redirect('admin/permissions');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $record = Permission::find($id);
        return view('permissions.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            ['name' => 'required|unique:permissions,name'],
            ['name.required' => 'اسم الدور مطلوب',
            'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = Permission::find($id)->update($request->all());

        return redirect('admin/permissions');
    }

    public function destroy($id)
    {
        $record = Permission::find($id);
        $record->delete();

        return redirect('admin/permissions');
    }
}
