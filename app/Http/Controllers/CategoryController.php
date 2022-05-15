<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Catepost;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
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
        $danhmuc = Category::orderBy('category_id', 'DESC')->get();
        $category = Category::orderBy('category_id', 'DESC')->where('category_parent', 0)->get();
        return view('admin.category.index')->with(compact('danhmuc', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('category_id', 'DESC')->where('category_parent', 0)->get();
        return view('admin.category.create')->with(compact('category'));
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
                'category_name' => 'required|unique:tbl_category_product',
                'category_desc' => 'required|max:255',
                'category_status' => 'required',
                'category_parent' => 'required',
                'slugdanhmuc' => 'required',
            ],
            [
                'category_name.required' => 'Vui lòng nhập tên danh mục',
                'category_name.unique' => 'Tên danh mục này đã tồn tại. Vui lòng nhập tên danh mục khác',
                'category_desc.required' => 'Vui lòng nhập mô tả danh mục',
                'slugdanhmuc.required' => 'Vui lòng nhập slug danh mục',
            ]
        );

        $danhmuc = new Category();
        $danhmuc->category_name = $data['category_name'];
        $danhmuc->slugdanhmuc = $data['slugdanhmuc'];
        $danhmuc->category_desc = $data['category_desc'];
        $danhmuc->category_parent = $data['category_parent'];
        $danhmuc->category_status = $data['category_status'];
        $danhmuc->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm danh mục thành công');
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
        $danhmuc = Category::find($id);
        $category = Category::orderBy('category_id', 'DESC')->get();
        return view('admin.category.edit')->with(compact('danhmuc', 'category'));
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
                'category_name' => 'required|max:255',
                'category_desc' => 'required|max:255',
                'category_status' => 'required',
                'category_parent' => 'required',
                'slugdanhmuc' => 'required',
            ],
            [
                'category_name.required' => 'Vui lòng nhập tên danh mục',
                'category_desc.required' => 'Vui lòng nhập mô tả danh mục',
                'slugdanhmuc.required' => 'Vui lòng nhập slug danh mục',
            ]
        );

        $danhmuc = Category::find($id);
        $danhmuc->category_name = $data['category_name'];
        $danhmuc->slugdanhmuc = $data['slugdanhmuc'];
        $danhmuc->category_desc = $data['category_desc'];
        $danhmuc->category_parent = $data['category_parent'];
        $danhmuc->category_status = $data['category_status'];
        $danhmuc->save();

        return Redirect()->back()->with('status', 'Bạn đã cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa danh mục thành công');
    }

    public function trangthai(Request $request)
    {
        $data = $request->all();
        $trangthai = Category::find($data['category_id']);
        $trangthai->category_status = $data['status'];
        $trangthai->save();
    }
}