<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = AboutUs::findOrFail(1);
        return view('dashboard.abouts.index',compact('about'));
    }


    public function update(Request $request,$id)
    {
        $about = AboutUs::findOrFail($id);


        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'title' => 'required',
            'description'=>'required',

        ]);

        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            File::delete(public_path('uploads/aboutus/' . $about->image));
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'aboutus_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/aboutus/', $file_name);

            $request_data['image'] = $file_name;
        }

        $about->update($request_data);

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('abouts.index');
    }

}
