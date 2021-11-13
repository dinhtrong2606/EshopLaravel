<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Catepost;
use App\Models\Gallevy;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('product_id', 'DESC')
            ->where('product_status', 0)
            ->take(6)
            ->get();

        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        return view('pages.home')->with(compact('product', 'category', 'brand', 'catepost'));
    }

    public function product_category($slug)
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $category_id = Category::where('slugdanhmuc', $slug)
            ->first();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $category_name = Category::orderBy('category_id', 'DESC')
            ->where('category_id', $category_id->category_id)
            ->where('category_status', 0)
            ->first();

        $product_category = Product::with('category')
            ->where('category_id', $category_id->category_id)
            ->where('product_status', 0)
            ->get();

        return view('pages.category.product_category')->with(compact('product_category', 'catepost', 'category', 'brand', 'category_name', 'category_id'));
    }

    //danh muc con
    public function product_category_child($slug)
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $category_id = Category::where('slugdanhmuc', $slug)
            ->first();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();
        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $product_category = Product::with('category')->where('category_id', $category_id->category_id)->get();

        return view('pages.category.category_child_product')->with(compact('category', 'catepost', 'brand', 'category_id', 'product_category'));
    }

    //brand product
    public function product_brand($slug)
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $brand_id = Brand::where('slugbrand', $slug)
            ->first();


        $product_brand = Product::with('brand')
            ->where('brand_id', $brand_id->brand_id)
            ->where('product_status', 0)
            ->get();

        return view('pages.brand.product_brand')->with(compact('category', 'catepost', 'brand', 'brand_id', 'product_brand'));
    }

    // detail product
    public function product_detail($slug)
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();
        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $product = Product::with('category', 'brand')
            ->where('slugproduct', $slug)
            ->where('product_status', 0)
            ->first();

        $recommend_product = Product::with('category')
            ->where('category_id', $product->category->category_id)
            ->where('product_status', 0)
            ->whereNotIn('product_id', [$product->product_id])
            ->get();

        $gallevy_product = Gallevy::where('product_id', $product->product_id)->get();

        return view('pages.product.product_detail')->with(compact('category', 'catepost', 'brand', 'product', 'recommend_product', 'gallevy_product'));
    }


    //search product
    public function search_product(Request $request)
    {
        $keyword = $request->_text;

        $search = Product::orderBy('product_id', 'DESC')
            ->where('product_name', 'LIKE', '%' . $keyword . '%')
            ->get();

        // $product = Product::orderBy('product_id', 'DESC')
        // ->where('product_name', 'LIKE', '%'.$keyword.'%')
        // ->first();

        $output = '
        <h2 class="title text-center">Sản phẩm tìm kiếm</h2>
        ';

        $search_count = $search->count();
        if ($search_count > 0) {
            foreach ($search as $row_product) {
                $output .= '
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    <input type="hidden" class="cart_product_id_' . $row_product->product_id . '"
                                        value="' . $row_product->product_id . '">
                                    <input type="hidden" class="cart_product_name_' . $row_product->product_id . '"
                                        value="' . $row_product->product_name . '">
                                    <input type="hidden" class="cart_product_price_' . $row_product->product_id . '"
                                        value="' . $row_product->product_price . '">
                                    <input type="hidden" class="cart_product_exist_' . $row_product->product_id . '"
                                        value="' . $row_product->product_exist . '">
                                    <input type="hidden" class="cart_product_image_' . $row_product->product_id . '"
                                        value="' . $row_product->product_image . '">
                                    <input type="hidden" class="cart_product_qty_' . $row_product->product_id . '" value="1">
                                    <a href="' . route('product-detail', $row_product->slugproduct) . '"><img
                                            style="width: 230px;height:170px"
                                            src="' . asset('uploads/gallevy/' . $row_product->product_image) . '" alt="" /></a>
                                    <h2>' . number_format($row_product->product_price) . ' vnđ' . '</h2>
                                    <p>' . $row_product->product_name . '</p>
                                    <button type="button" name="add-to-cart" data-id="' . $row_product->product_id . '"
                                        class="btn btn-default add-to-cart">Add to cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                ';
            }
        }

        echo $output;
    }


    //post list 
    public function post_list($slug)
    {
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $catepost_id = Catepost::orderBy('cate_post_id', 'DESC')->where('cate_post_slug', $slug)->first();

        $post_list = Post::orderBy('post_id', 'DESC')->where('cate_post_id', $catepost_id->cate_post_id)->paginate(3);

        return view('pages.post.post_list')->with(compact('category', 'brand', 'catepost', 'catepost_id', 'post_list'));
    }

    public function post_detail($slug)
    {
        $post_id = Post::orderBy('post_id', 'DESC')->where('post_slug', $slug)->where('post_status', 0)->first();

        $post_detail = Post::with('catepost')->where('post_id', $post_id->post_id)->first();

        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $post = Post::orderBy('post_id', 'DESC')
            ->where('cate_post_id', $post_id->cate_post_id)
            ->get();


        $relate_post = Post::with('catepost')
            ->where('cate_post_id', $post_id->cate_post_id)
            ->whereNotIn('post_slug', [$slug])
            ->take(3)
            ->get();

        return view('pages.post.post_detail')->with(compact('post_id', 'post_detail', 'category', 'brand', 'catepost', 'relate_post'));
    }
}