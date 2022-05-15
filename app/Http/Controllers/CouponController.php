<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::orderBy('coupon_id', 'DESC')->get();
        return view('admin.coupon.index')->with(compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'coupon_name' => 'required|unique:tbl_coupon',
                'coupon_time' => 'required',
                'coupon_condition' => 'required',
                'coupon_code' => 'required|unique:tbl_coupon',
                'coupon_number' => 'required',
            ],
            [
                'coupon_name.required' => 'Vui lòng nhập tên mã giảm giá',
                'coupon_name.unique' => 'Tên mã giảm giá này đã tồn tại. Vui lòng nhập tên mã giảm giá khác',
                'coupon_code.unique' => 'Mã giảm giá này đã tồn tại. Vui lòng nhập mã giảm giá khác',
                'coupon_code.required' => 'Vui lòng nhập mã giảm giá',
                'coupon_number.required' => 'Vui lòng nhập số lượng mã giảm giá',
            ]
        );

        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa mã giảm giá thành công');
    }
}