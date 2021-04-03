<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $countries = Country::whenSearch(request()->search)->paginate();
        $cities = City::whenSearch(request()->search)->orderBy('id','desc')->paginate();
        return view('dashboard.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::all();

        return view('dashboard.cities.create',compact('countries'));

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
            'name' => 'required',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required',
        ]);


        City::create($request->all());

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('cities.index');
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
        $city = City::findOrFail($id);

        $countries = Country::all();

        return view('dashboard.cities.edit',compact('countries','city'));
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
        $city = City::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required',
        ]);

        $city->update($request->all());

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $city = City::findOrFail($id);

        $city->delete();

        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect()->route('cities.index');
    }
}
