<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('auth.profile.profile',compact('user'));
    }

    public function changePassword(Request $request){
        return view('auth.profile.reset_password');
    }

    public function passwordSave(Request $request)
    {
        $this->validate($request, [
            'password-old' => 'required',
            'password' => 'required|confirmed|max:16',
        ]);
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->input('password-old'), $user->password)) {
            return back()->with('error', 'The old password not correct');
        } else
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->back()->with('message','Password Changed');
    }
}

