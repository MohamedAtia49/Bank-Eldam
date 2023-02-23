<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $records = DonationRequest::with('client','city','bloodType')->where(function ($query) use($request){
            if($request->search){
                $query->where('patient_name', 'LIKE', "%$request->search%");
            }
            if($request->blood_type){
                $query->where('blood_type_id', $request->blood_type);
            }
            if($request->city){
                $query->where('city_id', $request->city);
            }
        })->paginate(4);
        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view('donations.index',compact('records','bloodTypes','cities'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $record = DonationRequest::find($id);
        return view('donations.details', compact('record'));
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
        $record = DonationRequest::find($id);
        $record->delete();

        return back();
    }
}
