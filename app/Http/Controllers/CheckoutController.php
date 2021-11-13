<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Catepost;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PDF;

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        return view('pages.checkout.login_checkout')->with(compact('category', 'brand', 'catepost'));
    }



    public function save_login(Request $request)
    {
        $data = $request->validate(
            [
                'customer_name' => 'required',
                'customer_email' => 'required',
                'customer_password' => 'required|min:6|max:25',
                'customer_phone' => 'required',
            ],
            [
                'customer_name.required' => 'Vui lòng nhập tên khách hàng',
                'customer_email.required' => 'Vui lòng nhập địa chỉ email',
                'customer_password.required' => 'Vui lòng nhập mật khẩu',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            ]
        );

        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();

        return Redirect()->back()->with('status', 'Bạn đã đăng kí tài khoản thành công!');
    }

    public function checkout()
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        return view('pages.checkout.show_checkout')->with(compact('category', 'brand', 'catepost'));
    }

    public function save_shipping(Request $request)
    {


        return Redirect()->route('payment');
    }

    public function payment()
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        return view('pages.checkout.payment')->with(compact('category', 'brand', 'catepost'));
    }

    public function order_place(Request $request)
    {

        //insert shipping

        $data = $request->all();

        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;
        $request->session()->put('shipping_id', $shipping_id);

        // insert payment
        $payment = new Payment();
        $payment->payment_method = $data['payment'];
        $payment->payment_status = 'Dang cho xu li';
        $payment->save();
        $payment_id = $payment->payment_id;
        $request->session()->put('payment_id', $payment_id);

        //insert order
        $total_product = session('total');
        $coupon = session('coupon');
        if (session()->has('coupon')) {
            foreach ($coupon as $val_coupon) {
                $coupon_id = $val_coupon['coupon_id'];
                $coupon_code = $val_coupon['coupon_code'];
            }
        } else {
            $coupon_id = 0;
            $coupon_code = 'Không áp dụng';
        }
        foreach ($total_product as $val) {
            $order = new Order();
            $order->customer_id = session('customer_id');
            $order->coupon_id = $coupon_id;
            $order->shipping_id = session('shipping_id');
            $order->payment_id = session('payment_id');
            $order->order_total = $val['total'];
            $order->order_status = 0;
            $order->save();
        }
        // $order_id = $order->order_id;
        $request->session()->put('order_id', $order->order_id);

        //insert order_detail
        $content = session('cart');
        foreach ($content as $value) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = session('order_id');
            $order_detail->product_id = $value['product_id'];
            $order_detail->product_name = $value['product_name'];
            $order_detail->coupon_code = $coupon_code;
            $order_detail->product_price = $value['product_price'];
            $order_detail->product_sales_quantity = $value['product_qty'];
            $order_detail->save();
        }

        $request->session()->forget('coupon');
        $request->session()->forget('total');
        $request->session()->forget('cart');
    }

    //in don ra pdf
    public function print_order($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($id));
        return $pdf->stream();
    }

    public function done_order(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        if ($order->order_status == 1) {
            foreach ($data['product_id'] as $key => $val_product) {
                $product = Product::find($val_product);
                $product_quantity = $product->product_exist;
                foreach ($data['quantity'] as $key2 => $qty) {

                    if ($key == $key2) {
                        $product->product_exist = $product_quantity - $qty;
                        $product->product_sold = $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    public function print_order_convert($id)
    {
        $id = Order::where('order_id', $id)->first();
        $customer = Customer::orderBy('customer_id', 'DESC')
            ->where('customer_id', $id->customer_id)
            ->first();

        $shipping = Shipping::orderBy('shipping_id', 'DESC')
            ->where('shipping_id', $id->shipping_id)
            ->first();

        $order_detail = OrderDetail::orderBy('order_details_id', 'DESC')
            ->where('order_id', $id->order_id)
            ->get();

        $payment = Payment::orderBy('payment_id', 'DESC')
            ->where('payment_id', $id->payment_id)
            ->first();

        $coupon = Coupon::where('coupon_id', $id->coupon_id)->first();

        $output = '';

        $output .= '
            <style>
            body{
                font-family: Dejavu Sans;
            }
            table {
                border: 1px solid black;
              }
              td {
                  border: 1px solid black;
              }
              th {
                  border: 1px solid black;
              }
              .style{
                display: flex;
                width: 1000px;
              }
              .nhan{
                 margin-left: 30%;
              }
              .container{
                margin-left: 10%;
              }
            </style>
        ';

        $output .= '
        <div style="text-align: center">
        <h2>Phiếu in đơn hàng - Eshop Store</h2>
      </div>
      <div class="container">
        <h3>Thông tin người nhận hàng</h3>
        <table>
         <tr>
           <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Ghi chú</th>
         </tr>
        
        <tr>
          <td>' . $shipping->shipping_name . '</td>
          <td>' . $shipping->shipping_address . '</td>
          <td>' . $shipping->shipping_phone . '</td>
          <td>' . $shipping->shipping_email . '</td>
          <td>' . $shipping->shipping_note . '</td>
        </tr>
      </table>
      
      <h3>Đơn đặt hàng</h3>
      <table>
        <tr>
          <th>Tên sản phẩm</th>
            <th>Phí ship</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>
        </tr>';
        $totals = 0;
        $total  = 0;
        $total_coupon = '';
        $total_after = '';
        foreach ($order_detail as $value_pdf) {

            $total = $value_pdf->product_price * $value_pdf->product_sales_quantity;
            $totals += $total;

            if ($coupon) {
                if ($coupon->coupon_condition == 1) {
                    $total_coupon = ($totals * 15) / 100;
                    $total_after = $totals - $total_coupon;
                } else {
                    $total_after = $totals - 100000;
                }
            } else {
                $total_after = $totals;
            }

            $output .= '
        <tr>
            <td>' . $value_pdf->product_name . '</td>
            <td>20,000 vnd</td>
            <td>' . $value_pdf->product_sales_quantity . '</td>
            <td>' . number_format($value_pdf->product_price) . '</td>
            <td>' . number_format($total) . '</td>
        </tr>
            ';
        }
        $output .= '

        <h3>Tổng phí thu: ' . number_format($total_after) . ' vnđ</h3>
        <h4>Mã giảm giá được áp dụng: ' . $value_pdf->coupon_code . '</h4>
            <hr>
           
           
        
    ';

        $output .= '  
      </table>
      
      <p>Ký tên</p> 
     <div class="style">
        <div class="lap">
        <p>Người gửi hàng</p>
      </div>
        <div class="nhan">
        <p>Người nhận</p>
      </div>
     </div>
      </div>
    
        ';
        return $output;
    }

    //manage order
    public function manage_order()
    {
        $manage_order = Order::with('customers')->orderBy('order_id', 'DESC')->get();
        return view('admin.order.manage_order')->with(compact('manage_order'));
    }

    //manage order detail
    public function manage_detail($order_id)
    {
        $id = Order::where('order_id', $order_id)->first();
        $customer = Customer::orderBy('customer_id', 'DESC')
            ->where('customer_id', $id->customer_id)
            ->first();

        $shipping = Shipping::orderBy('shipping_id', 'DESC')
            ->where('shipping_id', $id->shipping_id)
            ->first();

        $order_detail = OrderDetail::with('products')->orderBy('order_details_id', 'DESC')
            ->where('order_id', $id->order_id)
            ->get();

        $payment = Payment::orderBy('payment_id', 'DESC')
            ->where('payment_id', $id->payment_id)
            ->first();

        return view('admin.order.manage_detail')->with(compact('customer', 'shipping', 'order_detail', 'payment', 'id'));
    }


    //delete order
    public function delete_order($orderId)
    {
        Order::find($orderId)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa đơn hàng thành công!');
    }

    //login account
    public function login_account(Request $request)
    {
        $email_account = $request->email_account;
        $password_account = md5($request->password_account);

        $customer = Customer::where('customer_email', $email_account)->where('customer_password', $password_account)->first();

        if ($customer) {
            $request->session()->put('customer_id', $customer->customer_id);
            return Redirect()->route('check-out');
        } else {
            return Redirect()->route('login-checkout');
        }
    }


    public function logout_account(Request $request)
    {
        $request->session()->flush();
        return Redirect()->route('login-checkout');
    }
}