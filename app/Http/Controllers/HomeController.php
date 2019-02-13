<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if (count($user->getRoleNames()) == 0) {
            $user->syncRoles('user');
        }
        return view('admin.page.index');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->back();
    }

}
