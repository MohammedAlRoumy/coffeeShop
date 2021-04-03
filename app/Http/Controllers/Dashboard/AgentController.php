<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Admin::whenSearch(request()->search)->orderBy('id','desc')->where('type','agent')->paginate();

        return view('dashboard.agents.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function create()
    {
        $cities = City::all();
        $countries = Country::all();

        return view('dashboard.agents.create',compact('countries','cities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:8',
            'status' => 'required',
        ]);

        $request->merge(['type' =>'agent','password' => bcrypt($request->password)]);


        $agent = Admin::create($request->all());
        $agent->assignRole(['الوكلاء']);
        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('agents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Admin::findOrFail($id);

        return view('dashboard.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Admin::findOrFail($id);

        $cities = City::all();
        $countries = Country::all();

        // $adminRole = $admin->roles->all();
        return view('dashboard.agents.edit', compact('agent','cities','countries'));

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
        $agent = Admin::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,'.$agent->id,
            'password' => 'nullable|confirmed|min:8',
            'status' => 'required',
           // 'roles_name' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $input['type'] = 'agent';

        $agent->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $agent->assignRole(['الوكلاء']);

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('agents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = Admin::findOrFail($id);

        $agent->delete();

        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect()->route('agents.index');
    }
}
