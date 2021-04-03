<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::whenSearch(request()->search)->orderBy('id','desc')->paginate();
        return view('dashboard.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.brands.create');

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
            'logo' => 'required|image|mimes:jpg,jpeg,png',
            'slug' => 'required|unique:brands|max:255',
            'name' => 'required',
            'status' => 'required',
        ]);

        $request_data = $request->except(['logo']);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'brands_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/brands/', $file_name);

            $request_data['logo'] = $file_name;
        }

        Brand::create($request_data);
        /* Category::create($request->all());*/

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('brands.index');
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
        //
        $brand = Brand::findOrFail($id);
        return view('dashboard.brands.edit',compact('brand'));
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
        //
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'slug' => 'required|max:255|unique:brands,slug,'.$brand->id,
            'name' => 'required',
            'status' => 'required',
        ]);

        $request_data = $request->except(['logo']);

        if ($request->hasFile('logo')) {
            File::delete(public_path('uploads/brands/' . $brand->logo));
            $image = $request->file('logo');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'brands_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/brands/', $file_name);

            $request_data['logo'] = $file_name;
        }

        $brand->update($request_data);
        /* Category::create($request->all());*/

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        //  File::delete(public_path('uploads/projects/' . $project->image));
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'تمت عملية الحذف بنجاح');

    }
}
