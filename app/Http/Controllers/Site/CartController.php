<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(){

        return view('frontend.cart');
    }

    public function removeItem($id)
    {
        $data = Cart::get($id);
        $product =  $data->associatedModel;

         $product->update([
            'quantity' => $product->quantity + $data->quantity,
        ]);

        Cart::remove($id);


        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }

    public function clearCart()
    {
        $cartCollection = Cart::getContent();;
        foreach ($cartCollection as $cart){
            $data = Cart::get($cart->id);
            $product =  $data->associatedModel;
            $product->update([
                'quantity' => $product->quantity + $data->quantity,
            ]);
        }
        Cart::clear();

        return redirect()->back()->with('success', 'تم تفريغ السلة بنجاح');
    }
}
