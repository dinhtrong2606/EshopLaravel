<?php

namespace App\Http\Controllers;

use App\Models\Catepost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatepostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->paginate(5);
        return view('admin.catepost.index')->with(compact('catepost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catepost.create');
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
                'cate_post_name' => 'required|max:100',
                'cate_post_desc' => 'required|max:255',
                'cate_post_status' => 'required',
                'cate_post_slug' => 'required',
            ],
            [
                'cate_post_name.required' => 'Vui lòng nhập tên danh mục bài viết',
                'cate_post_name.unique' => 'Tên danh mục bài viết này đã tồn tại. Vui lòng nhập tên danh mục khác',
                'cate_post_desc.required' => 'Vui lòng nhập mô tả danh mục bài viết',
                'cate_post_slug.required' => 'Vui lòng nhập slug danh mục bài viết',
            ]
        );

        $catepost = new Catepost();
        $catepost->cate_post_name = $data['cate_post_name'];
        $catepost->cate_post_slug = $data['cate_post_slug'];
        $catepost->cate_post_desc = $data['cate_post_desc'];
        $catepost->cate_post_status = $data['cate_post_status'];
        $catepost->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm danh mục bài viết thành công');
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
        $catepost = Catepost::find($id);
        return view('admin.catepost.edit')->with(compact('catepost'));
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
                'cate_post_name' => 'required|max:100',
                'cate_post_desc' => 'required|max:255',
                'cate_post_status' => 'required',
                'cate_post_slug' => 'required',
            ],
            [
                'cate_post_name.required' => 'Vui lòng nhập tên danh mục bài viết',
                'cate_post_name.unique' => 'Tên danh mục bài viết này đã tồn tại. Vui lòng nhập tên danh mục khác',
                'cate_post_desc.required' => 'Vui lòng nhập mô tả danh mục bài viết',
                'cate_post_slug.required' => 'Vui lòng nhập slug danh mục bài viết',
            ]
        );

        $catepost = Catepost::find($id);
        $catepost->cate_post_name = $data['cate_post_name'];
        $catepost->cate_post_slug = $data['cate_post_slug'];
        $catepost->cate_post_desc = $data['cate_post_desc'];
        $catepost->cate_post_status = $data['cate_post_status'];
        $catepost->save();

        return Redirect()->back()->with('status', 'Bạn đã cập nhật danh mục bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Catepost::find($id);
        $post->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa danh mục bài viết thành công!');
    }

    public function catepost(Request $request)
    {
        $data = $request->all();
        $cate_post = Catepost::find($data['cate_post_id']);
        $cate_post->cate_post_status = $data['status'];
        $cate_post->save();
    }
}