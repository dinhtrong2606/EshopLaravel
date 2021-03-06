<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ProductExport;
use App\Models\Gallevy;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
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
        $category = Product::with('category', 'brand')->orderBy('product_id', 'DESC')->get();
        return view('admin.product.index')->with(compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('category_id', 'DESC')->get();
        $brand = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.product.create')->with(compact('category', 'brand'));
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
                'product_name' => 'required|max:100|unique:tbl_product',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_content' => 'required',
                'product_price' => 'required',
                'product_desc' => 'required',
                'product_status' => 'required',
                'slugproduct' => 'required',
                'product_exist' => 'required',
                'product_tags' => 'required',
                'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
            [
                'product_name.required' => 'Vui l??ng nh???p t??n s???n ph???m',
                'product_name.max' => 'Vui l??ng nh???p t??n s???n ph???m kh??ng qu?? 100 k?? t???',
                'category_name.unique' => 'T??n s???n ph???m n??y ???? t???n t???i. Vui l??ng nh???p t??n s???n ph???m kh??c',
                'product_desc.required' => 'Vui l??ng nh???p m?? t??? s???n ph???m',
                'slugproduct.required' => 'Vui l??ng nh???p slug s???n ph???m',
                'product_image.required' => 'Vui l??ng ch???n h??nh ???nh s???n ph???m',
                'product_content.' => 'Vui l??ng nh???p n???i dung s???n ph???m',
                'product_desc.required' => 'Vui l??ng nh???p m?? t??? s???n ph???m',
            ]
        );

        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->slugproduct = $data['slugproduct'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_status = $data['product_status'];
        $product->product_price = $data['product_price'];
        $product->product_exist = $data['product_exist'];
        $product->product_tags = $data['product_tags'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];
        //them hinh anh san pham
        $get_image = $data['product_image'];
        $path = 'uploads/gallevy/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $product->product_image = $new_image;
        $product->save();

        $product_id = Product::orderBy('product_id', 'DESC')->where('slugproduct', $product->slugproduct)->first();
        $gallevy = new Gallevy();
        $gallevy->gallevy_name = $new_image;
        $gallevy->gallevy_image = $new_image;
        $gallevy->product_id = $product_id->product_id;
        $gallevy->save();

        $category = Product::with('category', 'brand')->orderBy('product_id', 'DESC')->get();

        // return Redirect()->back()->with('status', 'B???n ???? th??m s???n ph???m th??nh c??ng');

        return view('admin.product.index')->with(compact('category'), 'status', 'B???n ???? th??m s???n ph???m th??nh c??ng');
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
        $editproduct = Product::find($id);
        $brand = Brand::orderBy('brand_id', 'DESC')->get();
        $category = Category::orderBy('category_id', 'DESC')->get();
        return view('admin.product.edit')->with(compact('editproduct', 'brand', 'category'));
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
                'product_name' => 'required|max:100',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_content' => 'required',
                'product_price' => 'required',
                'product_desc' => 'required',
                'product_status' => 'required',
                'slugproduct' => 'required',
                'product_tags' => 'required',
                'product_exist' => 'required'
            ],
            [
                'product_name.required' => 'Vui l??ng nh???p t??n s???n ph???m',
                'product_name.max' => 'Vui l??ng nh???p t??n s???n ph???m kh??ng qu?? 100 k?? t???',
                'category_name.unique' => 'T??n s???n ph???m n??y ???? t???n t???i. Vui l??ng nh???p t??n s???n ph???m kh??c',
                'product_desc.required' => 'Vui l??ng nh???p m?? t??? s???n ph???m',
                'slugproduct.required' => 'Vui l??ng nh???p slug s???n ph???m',
                'product_image.required' => 'Vui l??ng ch???n h??nh ???nh s???n ph???m',
                'product_content.' => 'Vui l??ng nh???p n???i dung s???n ph???m',
                'product_desc.required' => 'Vui l??ng nh???p m?? t??? s???n ph???m',
            ]
        );

        $product = Product::find($id);
        $product->product_name = $data['product_name'];
        $product->slugproduct = $data['slugproduct'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_status = $data['product_status'];
        $product->product_price = $data['product_price'];
        $product->product_exist = $data['product_exist'];
        $product->product_tags = $data['product_tags'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];
        //them hinh anh san pham
        $get_image = $request->product_image;
        if ($get_image) {
            $path = 'uploads/gallevy/' . $product->product_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'uploads/gallevy/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $product->product_image = $new_image;

            $gallevy_id = Gallevy::orderBy('gallevy_id', 'DESC')->where('product_id', $id)->first();
            $gal_id = $gallevy_id->gallevy_id;
            $gallevy = Gallevy::find($gal_id);
            $gallevy->gallevy_name = $new_image;
            $gallevy->gallevy_image = $new_image;
            $gallevy->product_id = $id;
            $gallevy->save();
        }
        $product->save();

        return Redirect()->back()->with('status', 'B???n ???? c???p nh???t s???n ph???m th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $path = 'uploads/gallevy/' . $product->product_image;
        if (file_exists($path)) {
            unlink($path);
        }
        $gallevy_id = Gallevy::orderBy('gallevy_id', 'DESC')->where('product_id', $id)->get();
        foreach ($gallevy_id as $val) {
            $path2 = 'uploads/gallevy/' . $val->gallevy_image;
            if (file_exists($path2)) {
                unlink($path2);
            }

            Gallevy::find($val->gallevy_id)->delete();
        }
        Product::find($id)->delete();
        return Redirect()->back()->with('status', 'B???n ???? x??a s???n ph???m th??nh c??ng');
    }

    public function sanpham(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product->product_status = $data['status'];
        $product->save();
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }
}