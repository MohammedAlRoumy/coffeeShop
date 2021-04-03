<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::whenSearch(request()->search)->orderBy('id','desc')->paginate();
        return view('dashboard.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'ftitle' => 'required',
            'stitle' => 'required',
            'status' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'sliders_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/sliders/', $file_name);

            $request_data['image'] = $file_name;
        }

        Slider::create($request_data);
        /* Category::create($request->all());*/

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('dashboard.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'ftitle' => 'required',
            'stitle' => 'required',
            'status' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            File::delete(public_path('uploads/sliders/' . $slider->image));
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'sliders_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/sliders/', $file_name);

            $request_data['image'] = $file_name;
        }

        $slider->update($request_data);


        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'تمت عملية الحذف بنجاح');
    }
}
