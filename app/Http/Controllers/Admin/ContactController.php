<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $records = Contact::where(function ($query) use ($request){
            if($request->search){
                $query->where('name', 'LIKE', "%$request->search%")->orWhere('email','LIKE',"%$request->search%");
            }
        })->paginate(5);
        return view('contacts.index', compact('records'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $record = Contact::find($id);
        $record->delete();

        return redirect('admin/contacts');
    }
}
