<?php

namespace App\Http\Controllers;

use App\Libs\Helpers;
use App\Models\AdminModelHasRoles;
use App\Rules\Utf8StringRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $data = Role::cursor();
        $title = 'Danh sách vai trò';
        return view('admin.page.decentralized-management.role.index', compact('data','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $title = 'Tạo quyền';
        return view('admin.page.decentralized-management.role.create', compact('permissions','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:191', Rule::unique('admin_roles')],
        ]);
        if ($validator->fails()) {
            $error = Helpers::getValidationError($validator);
            return back()->with(['error' => $error])->withInput(Input::all());
        }
        try {
            $role = Role::create(['guard_name' => 'web', 'name' => $request->name]);
            $permissions = $request->permissions;
            $role->givePermissionTo($permissions);
        } catch (\Exception $e) {
           return redirect()->back()->with('error','Đã xảy ra lỗi');
        }
        return redirect()->back()->with('success','Tạo vai trò thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $title = 'Sửa quyền';
        return view('admin.page.decentralized-management.role.edit', compact('role','permissions','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:191', Rule::unique('admin_roles')->ignore($request->name, 'name')],
        ]);
        if ($validator->fails()) {
            $error = Helpers::getValidationError($validator);
            return back()->with(['error' => $error])->withInput(Input::all());
        }
        try {
            $role = Role::findOrFail($id);
            if($id != 1){
                $role->name = $request->name;
            }
            $role->save();
            $permissions = $request->permissions;
            $role->syncPermissions($permissions);
            return redirect()->back()->with('success','Cập nhập vai trò thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Đã xảy ra lỗi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($id != 1){
            /*$role->delete();
            AdminModelHasRoles::where('role_id',$id)->delete();*/
            return redirect()->back()->with('success','Chức năng này hiện tạm bị khóa');
        }else{
            return redirect()->back()->with('error','Không thể xóa quyền admin');
        }
    }
}
