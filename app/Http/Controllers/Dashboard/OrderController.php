<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;



class OrderController extends Controller
{
    public function index()
    {
        //
        $orders = Order::orderBy('id','desc')->paginate();
        // $categories = Category::paginate(1);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('dashboard.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('dashboard.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // return $request;
        $order = Order::findOrFail($id);


        $validated = $request->validate([

            'status' => 'required',

        ]);

        $order->status = $request['status'];
        $order->save();

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('orders.index');
    }

    public function print($id)
    {
        $order = Order::findOrFail($id);

        $data['order_id'] = $order->id;
        $data['order_number'] = $order->order_number;
        $data['order_date'] = $order->created_at->format('Y-m-d');
        $data['firstname'] = $order->firstname;
        $data['lastname'] = $order->lastname;
        $data['country'] = $order->country;
        $data['city'] = $order->city;
        $data['address'] = $order->address;
        $data['post_code'] = $order->post_code;
        $data['email'] = $order->email;
        $data['phone'] = $order->phone;
        $data['agent_name'] = $order->admin->name;

        $orderItems = $order->items()->get();

        foreach ($orderItems as $item) {
            $items[] = [
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'unit_price' => $item->price,
                'row_sub_total' => $item->quantity * $item->price,
            ];
        }
        $data['items'] = $items;

        $sub_total = 0;
        foreach ($data['items'] as $item){
            $sub_total = $sub_total + $item['row_sub_total'];
        }


        $data['sub_total'] =$sub_total;
        $data['discount'] = $order->discount;
        $data['grand_total'] = $order->grand_total;


        return view('dashboard.orders.invoice',$data);

    }
}
