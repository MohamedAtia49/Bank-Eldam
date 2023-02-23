<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $records = Client::with('bloodType','city')->where(function($query) use($request){
            if($request->search){
                $query->where('name','like',"%$request->search%")->orWhere('email','like',"%$request->search%");
            }
            if($request->blood_type){
                $query->where('blood_type_id',$request->blood_type);
            }
            if($request->city){
                $query->where('city_id', $request->city);
            }
        })->paginate(5);
        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view('clients.index',compact('records','bloodTypes','cities'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $records = Client::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('clients.index', compact('records'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        //
    }

    public function destroy($id)
    {
        $record = Client::where('id', $id)->first();
        $record->delete();
        return redirect('admin/clients');
    }

    public function deActive($id){
        $record = Client::find($id);
        if($record->status == 1){
            $record->status = "0" ;
            $record->save();

            return redirect('admin/clients');
        }
        return back();
    }

    public function active($id){
        $record = Client::find($id);
        if($record->status == 0){
            $record->status = "1" ;
            $record->save();

            return redirect('admin/clients');
        }
        return back();
    }

}
