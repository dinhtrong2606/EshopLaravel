<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function error_page()
    {
        return view('errors.404');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('post_id', 'DESC')
            ->where('post_status', 0)
            ->get();
        $number_views_post = 0;
        foreach($posts as $post){
            $number_views_post += $post->post_views;
        }

        $products = Product::orderBy('product_id', 'DESC')
            ->where('product_status', 0)
            ->get();
        $number_views_product = 0;
        foreach($products as $product){
            $number_views_product += $product->product_views;
        }
        $orders = Order::orderBy('order_id', 'DESC')
            ->get();
        return view('admin.dashboard')->with(compact('number_views_post', 'number_views_product', 
                                                    'products', 'orders'));
    }
}