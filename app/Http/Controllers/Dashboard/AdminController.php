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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::whenSearch(request()->search)->orderBy('id','desc')->where('type','admin')->paginate();

        return view('dashboard.admins.index',compact('admins'));
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
        $roles = Role::where('name','!=','المالك')->get();
        return view('dashboard.admins.create',compact('countries','cities','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:8',
            'status' => 'required',
            'roles_name' => 'required'
        ]);

        $request->merge(['type' =>'admin','password' => bcrypt($request->password)]);

        $admin = Admin::create($request->all());
        $admin->assignRole([$request->input('roles_name')]);

        session()->flash('success', 'تمت عملية الإضافة بنجاح');
        return redirect()->route('admins.index');
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
        $admin = Admin::findOrFail($id);
         $adminRole = $admin->roles->all();

       //  return $adminRole;
        return view('dashboard.admins.show', compact('admin','adminRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        if($admin->hasRole('المالك')){
            return redirect()->route('admins.index');
        }

        $cities = City::all();
        $countries = Country::all();

        $roles = Role::where('name','!=','المالك')->get();

        return view('dashboard.admins.edit', compact('admin','cities','countries','roles'));
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
       // return $request;
        $admin = Admin::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'password' => 'nullable|confirmed|min:8',
            'status' => 'required',
            'roles_name' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $input['type'] = 'admin';
        if($admin->hasRole('المالك')){
            return redirect()->route('admins.index');
        }
        /*if ($admin->id == 1){
            session()->flash('error', 'لا يمكن تعديل بيانات هذا المدير');
            return redirect()->route('admins.index');
        }else{*/
            $admin->update($input);
//        }

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $admin->assignRole([$request->input('roles_name')]);

        session()->flash('success', 'تمت عملية التعديل بنجاح');
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if($admin->hasRole('المالك')){
            return redirect()->route('admins.index');
        }
            $admin->delete();

        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect()->route('admins.index');
    }
}
