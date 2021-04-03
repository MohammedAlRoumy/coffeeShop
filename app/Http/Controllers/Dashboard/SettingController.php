<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function index()
    {

        return view('dashboard.settings.index');
    }


    public function update(Request $request)
    {
        //   return $request;
        if ($request->has('site_logo') && ($request->file('site_logo'))) {

            if (config('settings.site_logo') != null) {
                File::delete(public_path('uploads/settings/' . config('settings.site_logo')));
            }

            $logo = $request->file('site_logo');
            // return $logo;
            $extention = $logo->getClientOriginalExtension();
            $file_name = 'settings_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $logo->move('uploads/settings/', $file_name);

            Setting::set('site_logo', $file_name);

        }
        if ($request->has('site_favicon') && ($request->file('site_favicon'))) {

            if (config('settings.site_favicon') != null) {
                // $this->deleteOne(config('settings.site_favicon'));
                File::delete(public_path('uploads/settings/' . config('settings.site_favicon')));
            }

            $favicon = $request->file('site_favicon');
            $extention = $favicon->getClientOriginalExtension();
            $file_name = 'settings_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $favicon->move('uploads/settings/', $file_name);

            Setting::set('site_favicon', $file_name);


        }


        $keys = $request->except(['_token','site_favicon','site_logo']);

       // return $request;

        foreach ($keys as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.index')->with('success', 'تمت عملية التحديث بنجاح');

    }

}
