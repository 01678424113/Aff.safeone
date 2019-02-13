<?php

namespace App\Http\Controllers;

use App\Libs\Helpers;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Rules\Utf8StringRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Permission::select('*')->orderBy('name','ASC')->cursor();
        $title = 'Danh sách quyền';
        return view('admin.page.decentralized-management.permission.index', compact('data','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo quyền';
        return view('admin.page.decentralized-management.permission.create',compact('title'));
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
            'name' => ['required', new Utf8StringRule(), 'min:2', 'max:191', Rule::unique('admin_permissions')],
        ]);
        if ($validator->fails()) {
            $error = Helpers::getValidationError($validator);
            return back()->with(['error' => $error])->withInput(Input::all());
        }
        try {
            $permission = Permission::create(['guard_name' => 'web', 'name' => $request->name, 'note' => $request->note]);
            return redirect()->back()->with('success', 'Thêm quyền mới thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
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
        $model = Permission::findOrFail($id);
        $title = 'Sửa quyền';
        return view('admin.page.decentralized-management.permission.edit', compact('model','title'));
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
        try {
            $permission = Permission::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => ['required', new Utf8StringRule(), 'min:2', 'max:191', Rule::unique('admin_permissions')->ignore($request->name, 'name')],
                'note' => 'required'
            ]);
            if ($validator->fails()) {
                $error = Helpers::getValidationError($validator);
                return back()->with(['error' => $error])->withInput(Input::all());
            }
            $permission->name = $request->name;
            $permission->note = $request->note;
            $permission->save();
            return redirect()->back()->with('success', 'Cập nhập quyền thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
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
        $model = Permission::findOrFail($id);

        $flag = $model->delete();

        if ($flag) {
            return back()->with('success', 'Xoá quyền thành công');
        }
        return back()->with('warning', 'Xoá quyền không thành công');
    }


    /**
     * Function list all permission.
     * Always update new permission from route file
     * @param $subDomain
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tool()
    {
        $listController = $this->__getRoute();
        foreach ($listController as $controller => $value) {
            foreach ($value as $action) {
                if (empty($listPermission[$controller][$action])) {
                    $name = $controller . '_' . $action;
                    try {
                        $permission = Permission::create(['guard_name' => 'web', 'name' => $name]);
                    } catch (Exception $e) {
                        continue;
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Cập nhân quyền thành công');
    }

    /**
     * Function edit permission
     * @param Request $request
     * @param $subDomain
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    private function __getRoute()
    {
        $controllers = array();
        $routes = Route::getRoutes()->getRoutes();
        foreach ($routes as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $controllerAction = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controllerAction);
                $controller = str_replace('Controller', '', $controller);
                $controllers[$controller][] = $action;
            }
        }
        return $controllers;
    }
}
