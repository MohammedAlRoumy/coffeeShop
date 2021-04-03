<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use Moyasar\Providers\PaymentService;
use Illuminate\Support\Str;
use function Composer\Autoload\includeFile;

class CheckoutController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getCheckout(Request $request)
    {

        $cities = City::all();
        $countries = Country::all();

        if ($request['coupon']) {
            // return $request['coupon'];
            $coupon = Coupon::where('code', $request['coupon'])->first();
            // return $coupon;
            if (!$coupon) {

                $request->session()->flash('error', 'كود الخصم غير صحيح');
                return redirect()->route('checkout.index');
            }
            if ($coupon->discount_type == 'percentage') {
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => $coupon->name,
                    'type' => 'sale',
                    'target' => 'subtotal', // this condition will be applied to cart's total when getTotal() is called.
                    'value' => '-' . $coupon->discount . '%',
                    //'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
                ));
            }
            if ($coupon->discount_type == 'fixed') {
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => $coupon->name,
                    'type' => 'sale',
                    'target' => 'subtotal', // this condition will be applied to cart's total when getTotal() is called.
                    'value' => '-' . $coupon->discount,
                    //'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
                ));
            }

            $condition = Cart::condition($condition);

            // return $condition;
            // dd( Str::before(Cart::getCondition($coupon->name)->getValue(),'%'));
            //Cart::getSubTotal()

            $request->session()->flash('success', 'كود الخصم صحيح، تم إجراء عملية الخصم بنجاح');
            return view('frontend.checkout', compact('condition', 'coupon', 'countries', 'cities'));
        }

        return view('frontend.checkout', compact('countries', 'cities'));
    }

    /*
    public function couponCheck(Request $request){

       // return $request;

        $cities = City::all();
        $countries = Country::all();

        if($request['coupon']){
            $coupon = Coupon::where('code',$request['coupon'])->first();
            if(!$coupon){
                redirect()->back()->with('error','coupon not valid');
            }
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Express Shipping $15',
                'type' => 'shipping',
                'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
                'value' => '+15',
                //'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
            ));
            Cart::condition($condition);

            //Cart::getSubTotal()
            return view('frontend.checkout',compact('coupon','countries','cities'));
        }

        return view('frontend.checkout',compact('countries','cities'));
    }
    */

    public function placeOrder(Request $request)
    {
        //  return $request ;

        // Before storing the order we should implement the
        // request validation which I leave it to you

        $order = $this->storeOrderDetails($request->all());
        // return $order;

        if ($order) {
            if ($order->payment_method == 'الدفع عند الاستلام') {

                Cart::clear();

                return view('frontend.order-success', compact('order'));

            }

            if ($order->payment_method == 'ميسر') {

                return view('frontend.moyasar-payment', compact('order'));
            }


            // return  $this->payPal;
            //  return  $this->payPal->processPayment($order);
        }

        session()->flash('error', 'لا يمكن اتمام العملية ، لاتوجد منتجات في السلة لإتمام عملية الشراء');
        return redirect()->back();
    }

    public function storeOrderDetails($reqest)
    {

        if (Cart::getTotalQuantity() > 0 && Cart::getSubTotal()){


        $admin = Admin::where('type', 'agent')->where('city', $reqest['city'])->first();
        $coupon = Coupon::where('code', $reqest['coupon'])->first();

        if ($coupon) {
            $discount = Cart::getCondition($coupon->name)->getValue();
        } else {
            $discount = null;
        }

        if ($reqest['payment_method'] == 'الدفع عند الاستلام') {
            $payment_status = 1;
        } elseif ($reqest['payment_method'] == 'ميسر') {
            $payment_status = 0;
        }


        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->user()->id,
            'admin_id' => $admin->id,
            'coupon_id' => $coupon->id ?? null,
            'discount' => $discount,
            'status' => 'pending',
            'grand_total' => Cart::getSubTotal(),
            'item_count' => Cart::getTotalQuantity(),
            'payment_status' => $payment_status,
            'payment_method' => $reqest['payment_method'],
            'firstname' => $reqest['firstname'],
            'lastname' => $reqest['lastname'],
            'address' => $reqest['address'],
            'city' => $reqest['city'],
            'country' => $reqest['country'],
            'post_code' => $reqest['post_code'],
            'phone' => $reqest['phone'],
            'email' => $reqest['email'],
            'notes' => $reqest['notes']
        ]);

        if ($order) {
            $items = Cart::getContent();
            foreach ($items as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('name', $item->name)->first();
                $orderItem = new OrderItem([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->getPriceSum()
                ]);
                $order->items()->save($orderItem);
            }
        }
        return $order;

        }else{

            return view('frontend.checkout');

        }
    }


    public function moyasarResponce(Request $request,$id){

        // return $request;

         $order = Order::findOrFail($id);

        $payment =   $this->paymentService->fetch($request->id);

        if($payment->status == 'paid'  ){
          //  dd( $payment->capture());

            $order->payment_status = 1;
            $order->save();

            Cart::clear();

            return view('frontend.order-success', compact('order'));
        }

        return view('frontend.payments_redirect');

    }


    /*  public function complete(Request $request)
      {
          $paymentId = $request->input('paymentId');
          $payerId = $request->input('PayerID');

          $status = $this->payPal->completePayment($paymentId, $payerId);

          $order = Order::where('order_number', $status['invoiceId'])->first();
          $order->status = 'processing';
          $order->payment_status = 1;
          $order->payment_method = 'PayPal -'.$status['salesId'];
          $order->save();

          Cart::clear();
          return view('site.pages.success', compact('order'));
      }*/
}
