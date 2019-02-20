<?php

namespace App\Http\Controllers;

use App\Libs\Helpers;
use App\Models\Admin;
use App\Models\Affiliate;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class CustomerController extends Controller
{
    public function index($campaign_id)
    {
        $campaign = Campaign::where('id', $campaign_id)->first();
        if (isset($campaign)) {
            $title = 'Danh sách khách hàng';
            if (\Auth::user()->getRoleNames()[0] == 'admin') {
                $data = Customer::select('*')->where('campaign_id',$campaign_id)->paginate(20);
                return view('admin.page.customer.index-admin', compact('data', 'title'));
            } else {
                $data = Customer::select('customers.*')
                    ->join('user_campaign','user_campaign.campaign_id','=','customers.campaign_id')
                    ->where('customers.campaign_id',$campaign_id)
                    ->where('user_campaign.user_id',\Auth::user()->id)
                    ->get();
                return view('admin.page.customer.index', compact('data', 'title'));
            }
        } else {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }

    }

    public function store(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        $check = Customer::where('aff_id', $request->aff_id)->where('phone', $request->phone_customer)->first();
        $aff = Affiliate::where('aff_id', $request->aff_id)->first();
        if (!isset($check)) {
            $customer = new Customer();
            $customer->aff_id = $request->aff_id;
            $customer->phone = $request->phone_customer;
            $customer->campaign_id = $aff->campaign_id;
            $customer->name = $request->name_customer;
            $customer->email = $request->email_customer;
            $customer->status = Customer::$WAIT;
            $customer->created_at = date('Y-m-d H:i:s');
            $customer->save();
            return $customer;
        } else {
            return 'Đã tồn tại';
        }
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::where('id', $id)->first();
        if (isset($customer) && $customer->pay != Customer::$PAID) {
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->note = $request->note;
            $customer->status = $request->status;
            if (\Auth::user()->getRoleNames()[0] == 'admin') {
                $customer->total = str_replace(',', '', $request->total);
                $customer->percent = $request->percent;
            }
            $customer->save();
            return 'Cập nhập thành công';
        } else {
            return 'Đã xảy ra lỗi';
        }
    }

    public function pay(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = Helpers::getValidationError($validator);
            return back()->with(['error' => $error])->withInput(Input::all());
        }
        $customer = Customer::where('id', $request->customer_id)->first();
        if (isset($customer)) {
            if ($customer->pay != Customer::$PAID) {
                $customer->pay = Customer::$PAID;
                $customer->status = Customer::$SUCCESS;
                $aff = Affiliate::where('aff_id', $request->aff_id)->first();
                if (isset($aff)) {
                    $user = Admin::where('id', $aff->user_id)->first();
                    if ($request->amount != 0) {
                        if (!empty($user)) {
                            if ($request->type == Transaction::$TYPE_PLUS) {
                                $user->amount = (int)$user->amount + $request->amount;
                            } else {
                                $user->amount = (int)$user->amount - $request->amount;
                            }
                            $customer->save();
                            $user->save();
                            $model = new Transaction();
                            $transactionId = 'RENEW' . time() . rand(111, 9999);
                            $model->user_id = \Auth::user()->id;
                            $model->customer_id = $request->customer_id;
                            $model->transaction_id = $transactionId;
                            $model->note = $request->note;
                            $model->amount = $request->amount;
                            $model->type = $request->type;
                            $model->status = Transaction::$STATUS_SUCCESS;
                            $model->save();
                            return back()->with('success', 'Tạo giao dịch thành công');
                        } else {
                            return back()->with('error', 'Đã xảy ra lỗi');
                        }
                    }
                } else {
                    return back()->with('success', 'Đã xảy ra lỗi');
                }
            } else {
                return back()->with('error', 'Khách hàng đã được thanh toán');
            }
        } else {
            return back()->with('error', 'Đã xảy ra lỗi');
        }
    }
}
