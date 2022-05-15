<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Catepost;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Gallevy;
use App\Models\Post;
use App\Models\Product;
use App\Models\Videos;
use App\Models\Slider;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Svg\Tag\Rect;
use Mail;

class PublicController extends Controller
{
    public function test_mail()
    {
        return view('emails.test');
    }

    public function index()
    {
        $product_new_arrivals = Product::orderBy('created_at', 'DESC')
            ->where('product_status', 0)
            ->take(8)
            ->get();

        $product_best_sellers = Product::orderBy('product_sold', 'DESC')
            ->where('product_status', 0)
            ->take(6)
            ->get();

        $product_hot_sales = Product::orderBy('product_price', 'DESC')
            ->where('product_status', 0)
            ->take(4)
            ->get();

        $posts = Post::orderBy('created_at', 'DESC')
            ->where('post_status', 0)
            ->take(6)
            ->get();

        $sliders = Slider::orderBy('slider_id', 'DESC')
            ->where('slider_status', 0)
            ->get();

        return view('pages.home_page.index')->with(compact('product_new_arrivals', 'product_best_sellers', 'product_hot_sales', 'posts', 'sliders'));
    }

    public function shop_detail(){
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

        return view('pages.shop_index.index')->with(compact('product', 'category', 'brand'));
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
        $product = Product::with('category', 'brand')
            ->where('slugproduct', $slug)
            ->where('product_status', 0)
            ->first();

        $recommend_product = Product::with('category')
            ->where('category_id', $product->category->category_id)
            ->where('product_status', 0)
            ->whereNotIn('product_id', [$product->product_id])
            ->get();

        $comments = Comment::where('product_id', $product->product_id)
            ->where('comment_status', 1)
            ->get();

        $gallevy_product = Gallevy::where('product_id', $product->product_id)
            ->take(3)
            ->get();

        return view('pages.product.product_details')->with(compact('product', 'recommend_product', 'gallevy_product', 'comments'));
    }


    //search product
    public function search_product(Request $request)
    {
        $keyword = $request->keyword;

        $search = Product::orderBy('product_id', 'DESC')
            ->where('product_name', 'LIKE', '%' . $keyword . '%')
            ->get();

        // $product = Product::orderBy('product_id', 'DESC')
        // ->where('product_name', 'LIKE', '%'.$keyword.'%')
        // ->first();
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        return view('pages.product.search')->with(compact('category', 'brand', 'catepost', 'search'));
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

    //tags product
    public function tags_product($product_tags)
    {
        $tag = str_replace('-', ' ', $product_tags);
        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $product = Product::orderBy('product_id', 'DESC')
            ->where('product_status', 0)
            ->where('product_name', 'LIKE', '%' . $tag . '%')
            ->orWhere('slugproduct', 'LIKE', '%' . $tag . '%')
            ->orWhere('product_tags', 'LIKE', '%' . $tag . '%')
            ->get();


        return view('pages.product.product_tags')->with(compact('category', 'catepost', 'brand', 'product', 'tag'));
    }

    public function list_video_eshop()
    {

        $category = Category::orderBy('category_id', 'DESC')
            ->where('category_status', 0)
            ->get();

        $brand = Brand::orderBy('brand_id', 'DESC')
            ->where('brand_status', 0)
            ->get();

        $catepost = Catepost::orderBy('cate_post_id', 'DESC')->get();

        $video = Videos::orderBy('video_id', 'DESC')->paginate(4);

        return view('pages.videos_eshop.video_list')->with(compact('category', 'brand', 'catepost', 'video'));
    }

    public function watch_video(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = Videos::find($video_id);
        $output = '
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/' . $video->video_link . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        ';

        echo $output;
    }

    public function search_complete(Request $request)
    {
        $keyword = $request->text;
        $product = Product::orderBy('product_id', 'DESC')
            ->where('product_name', 'LIKE', '%' . $keyword . '%')
            ->get();
        
        return $product;
    }

    //filter category
    public function filter_category(Request $request){
        $category_id = $request->category_id;
        $product = Product::where('category_id', $category_id)
            ->where('product_status', 0)
            ->get();
        return $product;
    }

    //filter brand
    public function filter_brand(Request $request){
        $brand_id = $request->brand_id;
        $product = Product::where('brand_id', $brand_id)
            ->where('product_status', 0)
            ->get();
        return $product;
    }

    //filter price
    public function filter_price(Request $request){
        $filter_price = $request->filter_price;
        if($filter_price == 1){
            $product = Product::whereBetween('product_price', [0, 500000])
            ->where('product_status', 0)
            ->get();
        }else if($filter_price == 2){
            $product = Product::whereBetween('product_price', [500000, 2000000])
            ->where('product_status', 0)
            ->get();
        }else if($filter_price == 3){
            $product = Product::whereBetween('product_price', [2000000, 5000000])
            ->where('product_status', 0)
            ->get();
        }else if($filter_price == 4){
            $product = Product::whereBetween('product_price', [5000000, 10000000])
            ->where('product_status', 0)
            ->get();
        }else{
            $product = Product::where('product_price', '>', 10000000)
            ->where('product_status', 0)
            ->get();
        }
        
        return $product;
    }

    public function add_product_viewed(Request $request){
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product->product_views = $product->product_views + 1;
        $product->save();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $product_viewed = $request->session()->get('product_viewed');
        if ($product_viewed == true) {
            $is_available = 0;
            foreach ($product_viewed as $key => $value) {
                if ($value['product_id'] == $data['product_id']) {
                    $is_available++;
                    $product_viewed[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['product_name'],
                        'product_id' => $data['product_id'],
                        'product_exist' => $data['product_exist'],
                        'product_price' => $data['product_price'],
                        'product_qty' => $data['product_qty'] + $value['product_qty'],
                        'product_image' => $data['product_image'],
                        'product_size' => $data['product_size'],
                        'product_slug' => $data['product_slug'],
                    );
                }
            }
            if ($is_available == 0) {
                $product_viewed[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['product_name'],
                    'product_id' => $data['product_id'],
                    'product_exist' => $data['product_exist'],
                    'product_price' => $data['product_price'],
                    'product_qty' => $data['product_qty'],
                    'product_image' => $data['product_image'],
                    'product_size' => $data['product_size'],
                    'product_slug' => $data['product_slug'],
                );
                $request->session()->put('product_viewed', $product_viewed);
            }
        } else {
            $product_viewed[] = array(
                'session_id' => $session_id,
                'product_name' => $data['product_name'],
                'product_id' => $data['product_id'],
                'product_exist' => $data['product_exist'],
                'product_price' => $data['product_price'],
                'product_qty' => $data['product_qty'],
                'product_image' => $data['product_image'],
                'product_size' => $data['product_size'],
                'product_slug' => $data['product_slug'],
            );
        }

        $request->session()->put('product_viewed', $product_viewed);
    }

    public function add_product_wishlist(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $product_wishlist = $request->session()->get('product_wishlist');
        if ($product_wishlist == true) {
            $is_available = 0;
            foreach ($product_wishlist as $key => $value) {
                if ($value['product_id'] == $data['product_id']) {
                    $is_available++;
                    $product_viewed[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['product_name'],
                        'product_id' => $data['product_id'],
                        'product_exist' => $data['product_exist'],
                        'product_price' => $data['product_price'],
                        'product_qty' => $data['product_qty'] + $value['product_qty'],
                        'product_image' => $data['product_image'],
                        'product_size' => $data['product_size'],
                        'product_slug' => $data['product_slug'],
                        'product_sold' => $data['product_sold'],
                    );
                }
            }
            if ($is_available == 0) {
                $product_wishlist[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['product_name'],
                    'product_id' => $data['product_id'],
                    'product_exist' => $data['product_exist'],
                    'product_price' => $data['product_price'],
                    'product_qty' => $data['product_qty'],
                    'product_image' => $data['product_image'],
                    'product_size' => $data['product_size'],
                    'product_slug' => $data['product_slug'],
                    'product_sold' => $data['product_sold'],
                );
                $request->session()->put('product_wishlist', $product_wishlist);
            }
        } else {
            $product_wishlist[] = array(
                'session_id' => $session_id,
                'product_name' => $data['product_name'],
                'product_id' => $data['product_id'],
                'product_exist' => $data['product_exist'],
                'product_price' => $data['product_price'],
                'product_qty' => $data['product_qty'],
                'product_image' => $data['product_image'],
                'product_size' => $data['product_size'],
                'product_slug' => $data['product_slug'],
                'product_sold' => $data['product_sold'],
            );
        }

        $request->session()->put('product_wishlist', $product_wishlist);
    }

    public function wishlist_product(){
        return view('pages.product.product_wishlist');
    }

    //add comment
    public function add_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->user_id = session('customer_id');
        $comment->product_id = $data['product_id'];
        $comment->name = $data['name'];
        $comment->comment_content = $data['comment_content'];
        $comment->comment_status = 1;
        $comment->save();

        $comments = Comment::where('product_id', $data['product_id'])
        ->where('comment_status', 1)
        ->get();

        $num_comment = count($comments);

        $htmlComment = '';
        $htmlComment .= '
        <div class="be-comment">
            <div class="be-img-comment">	
                <a href="blog-detail-2.html">
                    <img src="http://127.0.0.1:8000/uploads/customer/avatar.jpg" alt="" class="be-ava-comment">
                </a>
            </div>
            <div class="be-comment-content mt-3">
                <span class="be-comment-name">
                    <a href="blog-detail-2.html" style="font-size: 16px;"><b>'.$comment->name.'</b></a>
                    <i class="fa-solid fa-paper-plane-top"></i>
                    <i data-comment_id="'.$comment->comment_id.'" class="fa fa-edit ml-2 edit-comment" style="font-size: 17px;"></i>
                    <i class="fa fa-trash ml-1 delete-comment" style="font-size: 17px;"></i>
                    </span>
                <span class="be-comment-time">
                    <i class="fa fa-clock-o"></i>
                    '.$comment->created_at.'
                </span>
                <div class="comment-content'.$comment->comment_id.'">
                    <input class="form-control form-control-lg comment_content" type="text" id="comment_content'.$comment->comment_id.'" 
                        name="comment_content" value="'.$comment->comment_content.'">
                </div>
            </div>
        </div>
        ';

        return response()->json([
            'htmlComment' => $htmlComment,
            'number_comment' => $num_comment,
        ]);
    }

    public function edit_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_content = $data['comment_content'];
        $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->save();

        $time = $comment->updated_at->toDateTimeString(); 
        $comment_content = $comment->comment_content;
        return response()->json([
            'comment_content' => $comment_content,
            'updated_at' => $time,
        ]);
    }

    public function delete_comment(Request $request){
        Comment::find($request->comment_id)->delete();
        $comments = Comment::where('product_id', $request->product_id)
            ->where('comment_status', 1)
            ->get();
        $num_comment = count($comments);
        return response()->json([
            'status' => 200,
            'number_comment' => $num_comment,
        ]);
    }

    public function blog_list(){
        $posts = Post::orderBy('post_id', 'DESC')
            ->where('post_status', 0)
            ->get();
        return view('pages.blog.blog_list')->with(compact('posts'));
    }

    public function blog_detail($slug){
        $post = Post::where('post_slug', $slug)
            ->where('post_status', 0)
            ->first();

        $post_id = $post->post_id;

        $posts = Post::find($post_id);
        $posts->post_views = $posts->post_views + 1;
        $posts->save();

        $next_post = Post::where('post_id' ,'>' , $post_id)
            ->where('post_status', 0)
            ->first();

        $prev_post = Post::where('post_id' ,'<' , $post_id)
            ->where('post_status', 0)
            ->first();

        return view('pages.blog.blog_details')->with(compact('post', 'next_post', 'prev_post'));
    }

    //contact
    public function contact(){
        return view('pages.contact.contact');
    }

    public function store_contact(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->customer_id = session('customer_id');
        $contact->name = $data['contact_name'];
        $contact->email = $data['contact_email'];
        $contact->contact_content = $data['contact_content'];
        $contact->save();

        return response()->json([
            'status' => 200,
            'message' => "",
        ]);
    }

    public function see_more(){
        $products = Product::orderBy('product_id', 'DESC')
            ->where('product_status', 0)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $products,
            'message' => "",
        ]);
    }

    public function see_less(){
        $products = Product::orderBy('product_id', 'DESC')
            ->where('product_status', 0)
            ->take(6)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $products,
            'message' => "",
        ]);
    }
}

