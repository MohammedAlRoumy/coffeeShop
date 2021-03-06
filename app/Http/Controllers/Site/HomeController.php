<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Cart;

class HomeController extends Controller
{

    public function index()
    {
        // return $request;
        $categories = Category::where('status',1)->with('products')->get();
        $products = Product::all();

        $products_low = Product::where('sale_price', '!=', null)->get();
        $products_new = Product::orderby('created_at', 'desc')->take(10)->get();
        $sliders = Slider::all();
        $brands = Brand::all();


        return view('frontend.home',
            compact(
                'products_low',
                'products_new',
                'products',
                'sliders',
                'categories',
                'brands')
        );
    }

    public function products()
    {

        $products = Product::whenCategory(request()->category_name)
            ->whenFavorite(request()->favorite)->paginate();


        return view('frontend.products', compact('products'));
    }

    public function categories()
    {

        $categories = Category::paginate();


        return view('frontend.categories', compact('categories'));
    }

    public function brands()
    {

        $brands = Brand::paginate();


        return view('frontend.brands', compact('brands'));
    }


    public function productShow($id)
    {

        $product = Product::findOrFail($id);

        $related_products = Product::where('category_id',$product->category_id)
            ->where('id','!=',$product->id)->latest()->take(6)->get();

        return view('frontend.product_details', compact('product','related_products'));
    }

    public function about()
    {
        $about = AboutUs::first();

        return view('frontend.about', compact('about'));
    }


    /****************************************/

    public function contactus()
    {

        return view("frontend.contact");
    }

    public function contactusValidator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required',
            'lname' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ],
            [
                'fname.required' => '?????????? ?????????? ??????????',
                'lname.required' => '?????????? ???????????? ??????????',
                'title.required' => '?????????? ?????????????? ??????????',
                'email.required' => '???????????? ???????????????????? ??????????',
                'email.email' => '???????? ???????????? ???????????????????? ?????? ??????????',
                'content.required' => '?????????????? ????????????'
            ]);
    }

    public function contactusAdd(Request $request)
    {
        $validator = $this->contactusValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $contactus = ContactUs::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'title' => $request['title'],
            'email' => $request['email'],
            'content' => $request['content'],
        ]);

        $request->session()->flash('success', "???? ?????????? ?????????????? ???????????? ?????????? ?????????????? ????????");
        //session()->flash('success', __('???? ?????????? ?????????????? ???????????? ?????????? ?????????????? ????????'));
        return redirect('/contactus');

        /*  //session()->flash('success', __('???? ?????????? ?????????????? ???????????? ?????????? ?????????????? ????????'));
          return redirect('/contactus')->with('success', "???? ?????????? ?????????????? ???????????? ?????????? ?????????????? ????????");*/

    }

    /****************************************/

    public function addToCart(Request $request)
    {
        // dd($request->all());

        $product = Product::findOrFail($request->productId);

        if ($product->quantity > 0) {
            Cart::add(array(
                // 'id' => uniqid(),
                'id' => $product->id,
                'name' => $product->name,
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'attributes' => array(),
                'associatedModel' => $product
            ));
        } else {
            if ($request->expectsJson()) {
                return ['error' => '???????????? ?????? ???????????? ??????????'];
            }
            return redirect()->back()->with('error', '???????????? ?????? ???????????? ??????????');
        }

        $product->update([
            'quantity' => $product->quantity - $request->input('quantity'),
        ]);

        if ($request->expectsJson()) {
            return ['added' => true,];
        }
        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function toggle_favorite(Product $product)
    {

        if ($product->is_favored) {
            $product->users()->detach(auth()->user()->id);
            return [
                'added' => false,
            ];
        }

        $product->users()->attach(auth()->user()->id);
        return [
            'added' => true,
        ];

    }

    public function search(Request $request)
    {

        $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate();
        return view('frontend.products', compact('products'));
    }

    public function profile($id)
    {

        $user = User::findOrFail($id);
        $countries = Country::all();
        $cities = City::all();

        return view('frontend.profile', compact('user','countries','cities'));
    }

    public function updateProfile(Request $request, $id)
    {
    //return $request;
        $user = User::findOrFail($id);
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required',
            'postcode' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        $user->update($request->all());
      // return $user;
       // $request->session()->flash();
        return redirect()->back()->with('success', "???? ?????????? ???????????????? ??????????");
    }

    public function myOrders($id){

       $user= User::findOrFail($id) ;

        $orders = Order::where('user_id',$user->id)->paginate();


        return view('frontend.orders', compact('orders'));

    }

}
