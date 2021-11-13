<?php

namespace App\Http\Controllers;

use App\Models\Catepost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('catepost')->orderBy('post_id', 'DESC')->paginate(5);
        return view('admin.post.index')->with(compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catepost = Catepost::orderBy('cate_post_id')->get();
        return view('admin.post.create')->with(compact('catepost'));
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
                'post_title' => 'required|max:100|unique:tbl_post',
                'cate_post_id' => 'required',
                'post_slug' => 'required',
                'post_desc' => 'required',
                'post_content' => 'required',
                'post_meta_desc' => 'required',
                'post_meta_keywords' => 'required',
                'post_status' => 'required',
                'post_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
            [
                'post_title.required' => 'Vui lòng nhập tên bài viết',
                'post_title.max' => 'Vui lòng nhập tên bài viết không quá 100 kí tự',
                'post_title.unique' => 'Tên bài viết này đã tồn tại. Vui lòng nhập tên bài viết khác',
                'post_slug.required' => 'Vui lòng nhập slug bài viết',
                'post_image.required' => 'Vui lòng chọn hình ảnh bài viết',
                'post_content.' => 'Vui lòng nhập nội dung bài viết',
                'post_desc.required' => 'Vui lòng nhập mô tả bài viết',
            ]
        );

        $post = new Post();
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_status = $data['post_status'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        //them hinh anh san pham
        $get_image = $data['post_image'];
        $path = 'uploads/post/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $post->post_image = $new_image;
        $post->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm bài viết thành công');
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
        $post = Post::find($id);
        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();
        return view('admin.post.edit')->with(compact('post', 'catepost'));
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
                'post_title' => 'required|max:100',
                'cate_post_id' => 'required',
                'post_slug' => 'required',
                'post_desc' => 'required',
                'post_content' => 'required',
                'post_meta_desc' => 'required',
                'post_meta_keywords' => 'required',
                'post_status' => 'required',
            ],
            [
                'post_title.required' => 'Vui lòng nhập tên bài viết',
                'post_title.max' => 'Vui lòng nhập tên bài viết không quá 100 kí tự',
                'post_title.unique' => 'Tên bài viết này đã tồn tại. Vui lòng nhập tên bài viết khác',
                'post_slug.required' => 'Vui lòng nhập slug bài viết',
                'post_image.required' => 'Vui lòng chọn hình ảnh bài viết',
                'post_content.' => 'Vui lòng nhập nội dung bài viết',
                'post_desc.required' => 'Vui lòng nhập mô tả bài viết',
            ]
        );

        $post = Post::find($id);
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_status = $data['post_status'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        //them hinh anh san pham
        $get_image = $request->post_image;
        if ($get_image) {
            $path = 'uploads/post/' . $post->post_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'uploads/post/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $post->post_image = $new_image;
        }
        $post->save();

        return Redirect()->back()->with('status', 'Bạn đã cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $path = 'uploads/post/' . $post->post_image;
        if (file_exists($path)) {
            unlink($path);
        }
        $post->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa thành công bài viết');
    }

    public function post_status(Request $request)
    {
        $data = $request->all();
        $post = Post::find($data['post_id']);
        $post->post_status = $data['status'];
        $post->save();
    }
}