<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', 0)->get();
        return view('admin.slider.index')->with(compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
                'slider_name' => 'required|max:100|unique:tbl_slider',
                'slider_desc' => 'required',
                'slider_status' => 'required',
                'slider_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
        );

        $slider = new Slider();
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];

        //them hinh anh san pham
        $get_image = $data['slider_image'];
        $path = 'uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $slider->slider_image = $new_image;
        $slider->save();

        return Redirect()->back()->with('status', 'Bạn đã thêm slider thành công');
    }

    public function slider(Request $request)
    {
        $data = $request->all();
        $slider = Slider::find($data['slider_id']);
        $slider->slider_status = $data['status'];
        $slider->save();
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
    public function edit($slider_id)
    {
        $slider = Slider::find($slider_id);
        return view('admin.slider.edit')->with(compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slider_id)
    {
        $data = $request->validate(
            [
                'slider_name' => 'required|max:100r',
                'slider_desc' => 'required',
                'slider_status' => 'required',
            ],
        );

        $slider = Slider::find($slider_id);
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];

        //them hinh anh san pham
        $get_image = $request->slider_image;
        if ($get_image) {
            $path = 'uploads/slider/' . $slider->slider_image;
            if (file_exists($path)) {
                unlink($path);
            }

            $path = 'uploads/slider/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $slider->slider_image = $new_image;
        }

        $slider->save();

        return Redirect()->back()->with('status', 'Bạn đã cập nhật slider thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_slider($slider_id)
    {
        $slider = Slider::find($slider_id);
        $path = 'uploads/slider/' . $slider->slider_image;
        if (file_exists($path)) {
            unlink($path);
        }
        Slider::find($slider_id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa slider thành công');
    }
}
