<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;

class LoginCustomerController extends Controller
{
    public function signup_customer(Request $request)
    {
        $data = $request->validate(
            [
                'customer_name' => 'required',
                'customer_email' => 'required',
                'customer_password' => 'required|min:6|max:25|same:customer_repassword',
                'customer_repassword' => 'required|min:6|max:25',
                'customer_phone' => 'required',
            ],
            [
                'customer_name.required' => 'Vui lòng nhập tên khách hàng',
                'customer_email.required' => 'Vui lòng nhập địa chỉ email',
                'customer_password.required' => 'Vui lòng nhập mật khẩu',
                'customer_repassword.required' => 'Vui lòng nhập xác nhận mật khẩu',
                'customer_password.same' => 'Xác nhận mật khẩu không đúng. Vui lòng nhập lại',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            ]
        );

        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();

        return Redirect()->back()->with('success', 'Bạn đã đăng kí tài khoản thành công!');
    }

    public function login_customer(){
        return view('pages.account.login');
    }

    //login account
    public function login_account(Request $request)
    {
        $email_account = $request->email_account;
        $password_account = md5($request->password_account);

        $customer = Customer::where('customer_email', $email_account)->where('customer_password', $password_account)->first();

        if ($customer) {
            $request->session()->put('customer_id', $customer->customer_id);
            return Redirect()->route('trang-chu');
        } else {
            return Redirect()->back()->with('status', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại!');
        }
    }

    //logout customer
    public function logout_account(Request $request)
    {
        $request->session()->flush();
        $request->session()->forget('coupon');
        $request->session()->forget('total');
        $request->session()->forget('cart');
        $request->session()->forget('product_viewed');
        $request->session()->forget('product_wishlist');
        return Redirect()->route('login-customer');
    }

    public function forgot_password(){
        return view('pages.account.forgot_password');
    }

    public function confirm_password(Request $request){
        $email_account = $request->user_email;
        $confirm_password = Customer::where('customer_email', $email_account)->first();
        if ($confirm_password) {
            $customer_id = $confirm_password->customer_id;
            return view('pages.account.reset_password')->with(compact('customer_id'));
        } else {
            return Redirect()->back()->with('status', 'Địa chỉ email không tồn tại. Vui lòng nhập lại!');
        }
    }

    public function reset_password(){
        return view('pages.account.reset_password');
    }

    public function store_new_password(Request $request){
        $customer = Customer::find($request->customer_id);
        $customer->customer_password = md5($request->password);
        $customer->save();

        return Redirect()->route('login-customer')->with('success', 'Thay đổi mật khẩu thành công!');
    }
}
