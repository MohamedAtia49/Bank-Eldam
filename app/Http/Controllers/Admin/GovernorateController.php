<?php

namespace App\Http\Controllers\Admin;


use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernorateController extends Controller
{

    public function index()
    {
        $records = Governorate::all();
        return view('governorates.index',compact('records'));
    }


    public function create()
    {
        return view('governorates.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:governorates|max:16',
        ]);
        Governorate::create([
            'name' => $request->name,
        ]);
        return redirect('admin/governorates');
    }


    public function edit($id)
    {
        $record = Governorate::where('id', $id)->first();
        return view('governorates.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:governorates|max:16',
        ]);
        $record = Governorate::where('id', $id)->update([
            'name' => $request->name,
        ]);
        return redirect('admin/governorates');
    }

    public function destroy($id)
    {
        $record = Governorate::where('id', $id)->first();
        $record->delete();
        $record->cities()->delete();
        return redirect('admin/governorates');
    }
}
