<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $records = City::with('governorate')->paginate(20);
        return view('cities.index',compact('records'));
    }


    public function create()
    {
        return view('cities.create')->with('governorates',Governorate::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:cities|max:16',
            'governorate_id' => 'required|exists:governorates,id',
        ]);
        City::create([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,
        ]);
        return redirect()->route('cities.index');
    }


    public function edit($id)
    {
        $record = City::with('governorate')->find($id);
        $governorates = Governorate::all();
        return view('cities.edit', compact('record','governorates'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:cities|max:16',
            'governorate_id' => 'required|exists:governorates,id',
        ]);
        $record = City::find($id)->update([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,
        ]);

        return redirect()->route('cities.index');
    }
    public function destroy($id)
    {
        $record = City::find($id);
        $record->delete();
        return redirect()->route('cities.index');
    }
}
