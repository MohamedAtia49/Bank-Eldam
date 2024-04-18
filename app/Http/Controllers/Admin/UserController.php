<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $records = User::with('roles')->paginate(5);
        return view('users.index',compact('records'));
    }


    public function create()
    {
        $records = Role::all();
        return view('users.create',compact('records'));
    }


    public function store(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required|unique:users,name',
             'email'=>'required|unique:users,email',
             'password'=>'required',
             'roles'=>'required|array',
             'roles.*'=>'exists:roles,id',
            ],
            ['name.required' => 'اسم المستخدم مطلوب',
            'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $record->assignRole($request->roles,[]);

        return redirect('admin/users')->with('message','User Created');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $record = User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('record','roles'));
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            ['name' => 'required|unique:users,name,'.$id,
             'email'=>'required|unique:users,email,'.$id,
             'password'=>'required',
             'roles'=>'array',
             'roles.*'=>'exists:roles,id',
            ],
            ['name.required' => 'اسم المستخدم مطلوب',
            'name.unique' => 'هذا الاسم موجود مسبقا'],
        );

        $record = tap(User::find($id))->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $record->syncRoles($request->roles,[]);

        return redirect('admin/users')->with('message','User Updated');
    }

    public function destroy($id)
    {
        $record = User::find($id);
        if($record->id == 1){

            return redirect('admin/users')->with('not_deleted', 'Big Bors Account Cant Be Deleted ^_^');

        }else{

            $record->delete();
            return redirect('admin/users');
        }

    }
}
