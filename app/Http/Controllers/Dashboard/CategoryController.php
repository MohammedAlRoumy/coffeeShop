<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::whenSearch(request()->search)->orderBy('id','desc')->with('parent')->paginate();
       // $categories = Category::paginate(1);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'slug' => 'required|unique:categories|max:255',
            'name' => 'required',
            'parent_id'=>'nullable|exists:categories,id',
            'status' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'categories_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/categories/', $file_name);

            $request_data['image'] = $file_name;
        }

        Category::create($request_data);

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.categories.edit', compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::findOrFail($id);


        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'slug' => 'required|max:255|unique:categories,slug,'.$category->id,
            'name' => 'required',
            'parent_id'=>'nullable|exists:categories,id',
            'status' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            File::delete(public_path('uploads/categories/' . $category->image));
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = 'categories_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

            $image->move('uploads/categories/', $file_name);

            $request_data['image'] = $file_name;
        }

        $category->update($request_data);

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $category = Category::findOrFail($id);

        //  File::delete(public_path('uploads/projects/' . $project->image));
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تمت عملية الحذف بنجاح');
    }
}
