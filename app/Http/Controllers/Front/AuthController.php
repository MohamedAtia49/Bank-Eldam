<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{
    public function showRegisterForm(){
        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view('front.register',compact('cities','bloodTypes'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed ',
            'phone' => 'required',
            'd_o_b' => 'required',
            'blood_type_id' => 'required|exists:blood_types,id',
            'last_donation_date' => 'required',
            'city_id' => 'required|exists:cities,id',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'd_o_b' => $request->d_o_b,
            'blood_type_id' => $request->blood_type_id,
            'last_donation_date' => $request->last_donation_date,
            'city_id' => $request->city_id,
            'api_token' => Str::random(60),
        ]);

        return redirect()->route('home');
    }

    public function showLoginForm(Request $request){
        return view('front.login');
    }

    public function login(Request $request){

        $this->validate($request,
         [
            'email'   => 'required|email|exists:clients,email',
            'password' => 'required',
        ],
        [
            'email.required' => 'الايميل مطلوب',
            'email.email' => 'الايميل غير صحيح',
            'email.exists' => 'الايميل او الرقم السرى غير صحيح',
            'password.required' => 'الرقم السرى مطلوب',
        ]
    );

        if (auth()->guard('client')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/home');
        }else{
            return redirect()->back()->with('error','الايميل او الرقم السرى غير صحيح');
        }
    }

    public function logout( Request $request )
    {
        if(auth()->guard('client')->check()) // this means that the admin was logged in.
        {
            auth()->guard('client')->logout();
            return redirect()->route('home');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function clientProfile(){
        $client = auth()->guard('client')->user();
        return view('front.client_profile',compact('client'));
    }

    public function getNotificationSettings(){
        $bloodTypes = BloodType::all();
        $governorates = Governorate::all();
        $client_blood_type = auth('client')->user()->bloodType;
        $client_governorates = auth('client')->user()->governorates;
        return view('front.client_notification_settings',compact('bloodTypes','governorates','client_blood_type','client_governorates'));
    }

    public function saveNotificationSettings(Request $request){
        $this->validate($request, [
            'blood_types' => 'array',
            'governorates' => 'array',
            'blood_types.*' => 'exists:blood_types,id',
            'governorates.*' => 'exists:governorates,id',
        ]);

        $client = $request->user();
        $bloodTypesToggle = $client->bloodTypes()->sync($request->blood_types);
        $governoratesToggle = $client->governorates()->sync($request->governorates);

        return redirect()->back();
    }

}
