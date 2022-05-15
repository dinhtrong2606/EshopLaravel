<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Catepost;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = $request->session()->get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $data['cart_product_id']) {
                    $is_available++;
                    $cart[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_exist' => $data['cart_product_exist'],
                        'product_price' => $data['cart_product_price'],
                        'product_qty' => $data['cart_product_qty'] + $value['product_qty'],
                        'product_image' => $data['cart_product_image'],
                        'product_size' => $data['cart_product_size'],
                    );
                }
            }
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_exist' => $data['cart_product_exist'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_image' => $data['cart_product_image'],
                    'product_size' => $data['cart_product_size'],
                );
                $request->session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_exist' => $data['cart_product_exist'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
                'product_image' => $data['cart_product_image'],
                'product_size' => $data['cart_product_size'],
            );
        }

        $request->session()->put('cart', $cart);
    }

    //update qty ajax
    public function update_qty(Request $request)
    {
        $data = $request->all();
        $cart = session('cart');
        if ($cart) {
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['product_id']) {
                    $cart[$key]['product_qty'] = $data['qty'];
                }
            }
        }
        $total = $data['qty'] * $cart[$key]['product_price'];
        $totals = number_format($total);
        $request->session()->put('cart', $cart);
        return $totals;
    }

    public function giohang()
    {
        return view('pages.cart.shopping_cart');
    }

    // ma giam gia coupon
    public function coupon_save(Request $request)
    {
        $data = $request->coupon;
        $coupon_data = Coupon::where('coupon_code', $data)->first();
        if ($coupon_data) {
            $coupon_session = $request->session()->get('coupon');
            if ($coupon_session == true) {
                $coupon[] = array(
                    'coupon_id' => $coupon_data->coupon_id,
                    'coupon_code' => $coupon_data->coupon_code,
                    'coupon_number' => $coupon_data->coupon_number,
                    'coupon_condition' => $coupon_data->coupon_condition,
                );
                $request->session()->put('coupon', $coupon);
            } else {
                $coupon[] = array(
                    'coupon_id' => $coupon_data->coupon_id,
                    'coupon_code' => $coupon_data->coupon_code,
                    'coupon_number' => $coupon_data->coupon_number,
                    'coupon_condition' => $coupon_data->coupon_condition,
                );
                $request->session()->put('coupon', $coupon);
            }
        } else {
            $request->session()->forget('coupon');
            $status = 'Mã không hợp lệ. Vui lòng thử lại!';
            echo $status;
        }
    }


    //delete coupon 
    public function delete_coupon(Request $request)
    {
        $coupon = $request->session()->get('coupon');
        if ($coupon) {
            $request->session()->forget('coupon');
        }
        return Redirect()->back()->with('status', 'Xóa mã giảm giá thành công!');
    }


    //delete product cart ajax
    public function delete_product(Request $request)
    {
        $data = session('cart');
        $val = $request->all();
        $coupon = $request->session()->get('coupon');
        foreach ($data as $key => $value) {
            if ($value['product_id'] == $val['id']) {
                unset($data[$key]);
            }
        }
        if ($data == null) {
            if ($coupon) {
                $request->session()->forget('coupon');
            }
        }
        $request->session()->put('cart', $data);
    }

    public function show_cart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = $request->session()->get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $data['product_id']) {
                    $is_available++;
                    $cart[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['product_name'],
                        'product_id' => $data['product_id'],
                        'product_exist' => $data['product_exist'],
                        'product_price' => $data['product_price'],
                        'product_qty' => $data['product_quantity'] + $value['product_qty'],
                        'product_image' => $data['product_image'],
                    );
                }
            }
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['product_name'],
                    'product_id' => $data['product_id'],
                    'product_exist' => $data['product_exist'],
                    'product_price' => $data['product_price'],
                    'product_qty' => $data['product_quantity'],
                    'product_image' => $data['product_image'],

                );
                $request->session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['product_name'],
                'product_id' => $data['product_id'],
                'product_exist' => $data['product_exist'],
                'product_price' => $data['product_price'],
                'product_qty' => $data['product_quantity'],
                'product_image' => $data['product_image'],
            );
        }

        $request->session()->put('cart', $cart);



        // $product_id = $request->product_id;
        // $qty = $request->qty;
        // $product_info = Product::with('category')
        // ->where('product_id', $product_id)
        // ->first();

        // $data['id'] = $product_id;
        // $data['qty'] = $qty;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] =  $product_info->product_price;
        // $data['options']['image'] = $product_info->product_image;

        // Cart::add($data);


    }

    //update qty cart
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = session('cart');
        if ($cart == true) {
            foreach ($data['quantity'] as $key => $value) {
                foreach ($cart as $key2 => $val) {
                    if ($key == $val['session_id']) {
                        $cart[$key2]['product_qty'] = $value;
                    }
                }
            }
        }

        $request->session()->put('cart', $cart);
        return Redirect()->back()->with('status', 'Bạn đã cập nhật sản phẩm thành công!');
    }

    public function showproduct()
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        return view('pages.cart.show_cart')->with(compact('category', 'brand'));
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect()->route('show-cart');
    }

    public function update_qty_product(Request $request)
    {
        $rowId = $request->quantity_cart;
        $qty = $request->quantity;
        Cart::update($rowId, $qty);
        return Redirect()->route('show-cart');
    }
}