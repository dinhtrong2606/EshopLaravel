<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\BrandExport;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.brand.index')->with(compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
                'brand_name' => 'required|max:100|unique:tbl_brand_product',
                'brand_desc' => 'required|max:255',
                'brand_status' => 'required',
                'slugbrand' => 'required',
            ],
            [
                'brand_name.required' => 'Vui lòng nhập tên thương hiệu',
                'brand_name.unique' => 'Tên thương hiệu này đã tồn tại. Vui lòng nhập tên thương hiệu khác',
                'brand_desc.required' => 'Vui lòng nhập mô tả thương hiệu',
                'slugbrand.required' => 'Vui lòng nhập slug thương hiệu',
            ]
        );

        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->slugbrand = $data['slugbrand'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm thương hiệu thành công');
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
        $brand = Brand::find($id);
        return view('admin.brand.edit')->with(compact('brand'));
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
        $data = $request->validate(
            [
                'brand_name' => 'required|max:100',
                'brand_desc' => 'required|max:255',
                'brand_status' => 'required',
                'slugbrand' => 'required',
            ],
            [
                'brand_name.required' => 'Vui lòng nhập tên thương hiệu',
                'brand_name.unique' => 'Tên thương hiệu này đã tồn tại. Vui lòng nhập tên thương hiệu khác',
                'brand_desc.required' => 'Vui lòng nhập mô tả thương hiệu',
                'slugbrand.required' => 'Vui lòng nhập slug thương hiệu',
            ]
        );

        $brand = Brand::find($id);
        $brand->brand_name = $data['brand_name'];
        $brand->slugbrand = $data['slugbrand'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();

        return Redirect()->back()->with('status', 'Bạn đã cập nhật thương hiệu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa thương hiệu thành công');
    }

    //ajax brand_status 
    public function thuonghieU(Request $request)
    {
        $data = $request->all();
        $brand = Brand::find($data['brand_id']);
        $brand->brand_status = $data['status'];
        $brand->save();
    }

    public function export()
    {
        return Excel::download(new BrandExport, 'brand.xlsx');
    }
}