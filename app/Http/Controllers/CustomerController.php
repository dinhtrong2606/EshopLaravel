<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('customer_id', 'DESC')->get();
        return view('admin.customer.index')->with(compact('customers'));
    }

    public function destroy($customer_id){
        Customer::find($customer_id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa khách hàng thành công');
    }
}
