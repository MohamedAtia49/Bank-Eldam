<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index(Request $request)
    {
        $record = Setting::find(1);
        return view('settings.edit', compact('record'));
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
        $validated = $request->validate([
            "email" => "required",
            "phone" => "required",
            "fb_link" => "required",
            "tw_link" => "required",
            "insta_link" => "required",
            'notification_settings_id' =>'required',
            "about_app" => "required",
        ]);

        $record = Setting::find(1);
        $record->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'fb_link' => $request->fb_link,
            'tw_link' => $request->tw_link,
            'insta_link' => $request->insta_link,
            'notification_settings_id' => $request->notification_settings_id,
            'about_app' => $request->about_app,
        ]);
        $record->save();

        return redirect('admin/settings')->with('message','Settings Updated');
    }

    public function destroy($id)
    {
        //
    }
}
