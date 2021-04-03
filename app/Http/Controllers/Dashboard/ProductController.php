<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::whenSearch(request()->search)->orderBy('id','desc')->paginate();

        return view('dashboard.products.index', compact('products'));

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
        $brands = Brand::all();
        return view('dashboard.products.create', compact('categories', 'brands'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'slug' => 'required|unique:products|max:255',
            'name' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sale_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required',
            'description' => 'nullable',
        ]);

        Product::create($request->all());

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('products.index');
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
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);


        return view('dashboard.products.edit', compact('categories', 'brands', 'product'));

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
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'slug' => 'required|max:255|unique:products,slug,' . $product->id,
            'name' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sale_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required',
            'description' => 'nullable',
        ]);

        $product->update($request->all());

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);

        if ($product->images->count() > 0){
            foreach ($product->images as $img) {
                $imageId =  $img->id;

                $image = ProductImage::findOrFail($imageId);

                $image->delete();

            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'تمت عملية الحذف بنجاح');
    }


    /********************************************************/
            /********  Image process  *********/
    /*********************************************************/

    public function addImages($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('dashboard.products.product_images', compact('product'))->withId($product_id);
    }

    public function saveProductImages(Request $request)
    {

        $image = $request->file('dzfile');
        //  foreach($images as $image){
        $extention = $image->getClientOriginalExtension();
        $file_name = 'products_' . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;

        $image->move('uploads/products/', $file_name);
        //  }

        return response()->json([
            'name' => $file_name,
        ]);

    }

    public function saveProductImagesDB(Request $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {


                    ProductImage::create([
                        'product_id' => $request->product_id,
                        'image' => $image,
                    ]);
                }
            }

            return redirect()->route('products.index')->with(['success' => 'تم إضافة الصور  بنجاح']);

        } catch (\Exception $ex) {

        }


    }

    public function deleteImages($id)
    {
        $image = ProductImage::findOrFail($id);

        $image->delete();

        return redirect()->back();
    }
}
