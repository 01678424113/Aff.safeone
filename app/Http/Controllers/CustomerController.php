<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::getAllData();
        $title = 'Danh sách khách hàng';
        return view('admin.page.customer.index', compact('data', 'title'));
    }

    public function store(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        $check = Customer::where('aff_id', $request->aff_id)->where('phone', $request->phone_customer)->first();
        if (!isset($check)) {
            $customer = new Customer();
            $customer->aff_id = $request->aff_id;
            $customer->phone = $request->phone_customer;
            $customer->name = $request->name_customer;
            $customer->email = $request->email_customer;
            $customer->status = Customer::$ACTIVE;
            $customer->created_at = date('Y-m-d H:i:s');
            $customer->save();
            return $customer;
        } else {
            return 'Đã tồn tại';
        }
    }
}
