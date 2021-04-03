<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons = Coupon::whenSearch(request()->search)->orderBy('id','desc')->paginate();
        return view('dashboard.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request; 'name','code','expiry-date','discount','discount-type','status'
        $date = Carbon::now()->format('Y-m-d');
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:coupons,code',
            'expiry_date' => 'required|date|after_or_equal:'.$date,
            'discount' => 'required|numeric|between:0,99.99',
            'discount_type' => 'required',
            'status' => 'required',
        ]);

        Coupon::create($request->all());

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('coupons.index');
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
        $coupon = Coupon::findOrFail($id);

        return view('dashboard.coupons.edit',compact('coupon'));
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
        $coupon = Coupon::findOrFail($id);

        $date = Carbon::now()->format('Y-m-d');
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:coupons,code,'.$coupon->id,
            'expiry_date' => 'required|date|after_or_equal:'.$date,
            'discount' => 'required|numeric|between:0,99.99',
            'discount_type' => 'required',
            'status' => 'required',
        ]);

        $coupon->update($request->all());

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect()->route('coupons.index');

    }
}
