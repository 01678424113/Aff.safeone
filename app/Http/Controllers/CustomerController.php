<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::getAllData();
        $title = 'Danh sách khách hàng';
        return view('admin.page.customer.index', compact('data', 'title'));
    }
}
