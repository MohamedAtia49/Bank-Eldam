<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){

        $validation = Validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:clients',
            'd_o_b' => 'required',
            'blood_type_id' => 'required',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'last_donation_date' => 'required',
            'city_id' => 'required',
        ]);

        if($validation->fails())
        {
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return responseJson(1,'تم الاضافة بنجاح',[
            'api_token' =>$client->api_token,
            'client' => $client,
        ]);
    }

    public function login(Request $request){
        $validation = Validator()->make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

    if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
    }

       auth()->guard('client')->attempt($request->all());
       $client = auth()->guard('client')->user();
       if($client){
            if($client->status == 1){
                return responseJson(0,'تم تسجيل الدخول',[
                    'api_token' => $client->api_token,
                    'client' => $client,
                ]);
            }else{
                return responseJson(0,'Your Email had been Banned');
            }
       }else{
            return responseJson(0,'Email or Password not correct');
       }

    }

    public function sendPinCode(Request $request){
        $validation =Validator()->make($request->all(),[
            'email' => 'required',
        ]);

        if($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $user = Client::where('email',$request->email)->first();
        if($user){
            $code = rand(11111,99999);
            $update= $user->update(['pin_code'=>$code]);
            if($update){
                Mail::to($user->email)->send(new ResetPassword($user));
                return responseJson(1,'تم ارسال الكود الى الايميل الخاص بك يرجى فحص الايميل',[
                    'pin_code' => $code,
                ]);
            }else{
                return responseJson(0,'حدث خطأ ، يرجى المحاولة مرة اخرى');
            }
        }else{
            return responseJson(0,'لا يوجد حساب بهذا الايميل ');
        }
    }

    public function resetPassword(Request $request){
        $validation = Validator()->make($request->all(),[
            'pin_code' => 'required',
            'password' => 'required|confirmed',
        ]);

        if($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $user = Client::where('pin_code',$request->pin_code)->first();
        if($user){
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if($user->save()){
                return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            }else{
                return responseJson(0,'حدث خطأ ، يرجى المحاولة مرة اخرى');
            }
        }else{
            return responseJson(0,'الكود المكتوب غير صحيح');
        }
    }

    public function profile(Request $request){
        $validation = Validator()->make($request->all(),[
            'email' =>Rule::unique('clients')->ignore($request->user()->id),
            'phone' =>Rule::unique('clients')->ignore($request->user()->id),
            'password' => 'required|confirmed',
        ]);

        if($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $loginUser = $request->user();
        $loginUser->update($request->all());
        if($request->has('password')){
            $loginUser->password = bcrypt($request->password);
        }

        if($request->has('city_id')){
            $loginUser->city()->associate($request->city_id);
        }

        if($request->has('blood_type_id')){
            $loginUser->bloodType()->associate($request->blood_type_id);
        }

        if($loginUser->save()){
            return responseJson(1, 'تم التحديث', $loginUser->load('city.governorate'));
        }else{
            return responseJson(0,'حدث خطأ ، حاول مره اخرى');
        }
    }

    public function notificationSettings(Request $request){
        $validation = Validator()->make($request->all(), [
            'blood_types' => 'array',
            'governorates' => 'array',
            'blood_types.*' => 'exists:blood_types,id',
            'governorates.*' => 'exists:governorates,id',
        ]);

        if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $user = $request->user();
        $bloodTypesToggle = $user->bloodTypes()->sync($request->blood_types);
        $governoratesToggle = $user->governorates()->sync($request->governorates);

        if($bloodTypesToggle){
            return responseJson(1, 'Notification settings updated', $bloodTypesToggle);
        }elseif($governoratesToggle){
            return responseJson(1, 'Notification settings updated', $governoratesToggle);
        }else{
            return responseJson(1, 'Nothing changed');
        }
    }

    public function contact(Request $request){
        $validation = Validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required|exists:clients,email|unique:contacts',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        if ($contact = Contact::create($request->all())) {
            return responseJson(1, 'message sended');
        }else{
            return responseJson(0, 'حدث خطأ اثناء الارسال');
        }
    }

    public function registerToken(Request $request){
        $validation = Validator()->make($request->all(),[
            'token' => 'required',
            'platform' => 'required|in:android,ios',
        ]);

        if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $token =Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());

        return responseJson(1,'تم التسجيل بنجاح');
    }


    public function removeToken(Request $request){
        $validation = Validator()->make($request->all(),[
            'token' => 'required',
        ]);

        Token::where('token',$request->token)->delete();
        return responseJson(1,'تم الحذف بنجاح');
    }

}
