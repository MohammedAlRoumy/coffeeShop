<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::orderBy('id','desc')->paginate();
        return  view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permission = Permission::get();
        return view('dashboard.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name'=>'admin'
        ]);

        $role->syncPermissions($request->input('permission'));
        session()->flash('success', 'تمت عملية الاضافة بنجاح');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role  = Role::findOrfail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.show',compact('permission','role','rolePermissions'));
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
        $role  = Role::findOrfail($id);
        if ($role->name =='المالك'){
            session()->flash('error', 'لايمكن إجراء عملية التعديل هذا العنصر');
            return redirect()->back();
        }
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit',compact('permission','role','rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        //
        $role  = Role::findOrfail($id);
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
            'permission' => 'required',
        ]);
        if ($role->name =='المالك'){
            session()->flash('error', 'لايمكن إجراء عملية التعديل هذا العنصر');
            return redirect()->back();
        }
        $role->update([
            'name' => $request->input('name'),
            'guard_name'=>'admin'
        ]);

        $role->syncPermissions($request->input('permission'));

        session()->flash('success', 'تمت عملية الاضافة بنجاح');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role  = Role::findOrfail($id);
        if ($role->name =='المالك'){
            session()->flash('error', 'لايمكن إجراء عملية الحذف هذا العنصر');
            return redirect()->back();
        }
        $role->delete();
        session()->flash('success', 'تمت عملية الحذف بنجاح');
        return redirect()->route('roles.index');
    }
}
