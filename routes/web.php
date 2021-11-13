<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatepostController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GallevyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideosController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//public
Route::get('/', [PublicController::class, 'index'])->name('trang-chu');

//login
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/404', [HomeController::class, 'error_page']);

Route::group(['middleware' => ['auth']], function () {
    //Category Product
    Route::post('/trang-thai', [CategoryController::class, 'trangthai']);
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'destroy'])->name('category_delete');
    Route::resource('category', CategoryController::class);

    //Brand
    Route::post('/thuong-hieu', [BrandController::class, 'thuonghieu']);
    Route::resource('brand', BrandController::class);
    Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit'])->name('brand_edit');
    Route::get('/delete-brand/{brand_id}', [BrandController::class, 'destroy'])->name('brand_delete');

    //Category post
    Route::post('/cate-post', [CatepostController::class, 'catepost']);
    Route::resource('catepost', CatepostController::class);
    Route::get('/edit-catepost/{id}', [CatepostController::class, 'edit'])->name('cate_post_edit');
    Route::get('/delete-catepost/{id}', [CatepostController::class, 'destroy'])->name('catepost_delete');

    //Post blog
    Route::post('/post-status', [PostController::class, 'post_status']);
    Route::resource('post', PostController::class);
    Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('post_edit');
    Route::get('/delete-post/{id}', [PostController::class, 'destroy'])->name('post_delete');

    //Manage Video
    Route::post('/select-video', [VideosController::class, 'select_video']);
    Route::get('/video-list', [VideosController::class, 'list_video'])->name('list_video');
    Route::post('/store-video', [VideosController::class, 'store_video']);
    Route::post('/delete-video', [VideosController::class, 'delete_video']);
    Route::post('/edit-video', [VideosController::class, 'edit_video']);
    Route::post('/edit-image', [VideosController::class, 'edit_image']);


    //export excel
    Route::get('/export/brand', [BrandController::class, 'export'])->name('export-brand');
    Route::get('/export/product', [ProductController::class, 'export'])->name('export-product');


    //Product
    Route::post('/san-pham', [ProductController::class, 'sanpham']);
    Route::resource('product', ProductController::class);
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit'])->name('product_edit');
    Route::get('/delete-product/{product_id}', [ProductController::class, 'destroy'])->name('product_delete');

    //gallevy image product
    Route::get('/add-gallevy/{id}', [GallevyController::class, 'add_gallevy'])->name('add_gallevy');
    Route::post('/select-gallevy', [GallevyController::class, 'gallevy']);
    Route::post('/insert-gallevy/{pro_id}', [GallevyController::class, 'insert_gallevy'])->name('insert_gallevy');
    Route::delete('/delete-gallevy', [GallevyController::class, 'delete_gallevy']);
    Route::post('/update-name-gallevy', [GallevyController::class, 'update_name_gallevy']);
    Route::post('/update-image-gallevy', [GallevyController::class, 'update_image_gallevy']);

    //Delete User and Roles
    Route::get('/delete-roles/{user_id}', [UserController::class, 'delete_roles'])->name('delete-roles');


    //coupon
    Route::resource('coupon', CouponController::class);
    Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'destroy'])->name('coupon_delete');
    Route::get('/xoa-ma', [CartController::class, 'delete_coupon'])->name('xoa-ma');

    //slider
    Route::resource('slider', SliderController::class);
    Route::post('/slider', [SliderController::class, 'slider']);
    Route::get('/delete-slider/{slider_id}', [SliderController::class, 'delete_slider'])->name('delete-slider');
    Route::get('/edit-slider/{slider_id}', [SliderController::class, 'edit'])->name('slider_edit');

    //manage order
    Route::get('/manage-order', [CheckoutController::class, 'manage_order'])->name('manage-order');
    Route::get('/manage-order-detail/{order_id}', [CheckoutController::class, 'manage_detail'])->name('manage-detail');
    Route::get('/print-order/{id}', [CheckoutController::class, 'print_order'])->name('print-pdf');

    //user admin
    Route::post('/store-user', [UserController::class, 'store'])->name('user_store');
    Route::get('/create-user', [UserController::class, 'create'])->name('create_user');

    //phan quyen
    Route::get('/divide-user/{id}', [UserController::class, 'permission_user'])->name('permission_user');
    Route::get('/delete-permission-roles/{id}', [UserController::class, 'delete_permission'])->name('delete_permission');
    Route::get('/roles-user/{id}', [UserController::class, 'roles_user'])->name('roles_user');
    Route::post('/assign-roles-user', [UserController::class, 'assign_roles'])->name('assign_roles');
    Route::post('/assign-permission-user', [UserController::class, 'assign_permission'])->name('assign_permission');
    Route::get('/all-user', [UserController::class, 'index'])->name('all_user');
    Route::get('/delete-user/{id}', [UserController::class, 'delete'])->name('delete-user');
});

// //chuyen quyen nhanh voi laravel using once id
// Route::get('/impersonate/all-user/{id}', [UserController::class, 'impersonate'])->name('convert-user');

Route::group(['middleware' => ['auth', 'role:Manage order']], function () {
    //manage order
    Route::get('/manage-order', [CheckoutController::class, 'manage_order'])->name('manage-order');
    Route::get('/manage-order-detail/{order_id}', [CheckoutController::class, 'manage_detail'])->name('manage-detail');
    Route::get('/print-order/{id}', [CheckoutController::class, 'print_order'])->name('print-pdf');
});



//show product category
Route::get('/category-product/{slug}', [PublicController::class, 'product_category'])->name('product-category');

//show product child category
Route::get('/category-product-child/{slug}', [PublicController::class, 'product_category_child'])->name('product-category_child');

//show product brand
Route::get('/brand-product/{slug}', [PublicController::class, 'product_brand'])->name('product-brand');

//detail product
Route::get('/detail-product/{slug}', [PublicController::class, 'product_detail'])->name('product-detail');

//cart
Route::post('/update-quantity-product', [CartController::class, 'update_qty_product'])->name('update_quantity');
Route::post('/cart-product', [CartController::class, 'show_cart'])->name('cart-product');
Route::get('/cart-show', [CartController::class, 'showproduct'])->name('show-cart');
Route::get('/delete-to-product/{rowId}', [CartController::class, 'delete_to_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang-ajax', [CartController::class, 'giohang'])->name('gio-hang');
Route::post('/del-to-product', [CartController::class, 'delete_product']);
Route::post('/update-qty-product', [CartController::class, 'update_cart'])->name('update-cart');
Route::post('/coupon-ajax', [CartController::class, 'coupon_save']);
Route::post('/update-qty-ajax', [CartController::class, 'update_qty'])->name('update-qty');

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('login-checkout');
Route::post('/login-customer', [CheckoutController::class, 'save_login'])->name('save_login');
Route::post('/save-shipping', [CheckoutController::class, 'save_shipping'])->name('save_shipping');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('check-out');
Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::post('/login-account', [CheckoutController::class, 'login_account'])->name('login-account');
Route::get('/logout-account', [CheckoutController::class, 'logout_account'])->name('logout-account');
Route::get('/delete-order/{orderId}', [CheckoutController::class, 'delete_order'])->name('delete-order');
Route::post('/done-order', [CheckoutController::class, 'done_order']);



//payment
Route::post('/order-place', [CheckoutController::class, 'order_place'])->name('order-place');

//Search product
Route::post('/search-product', [PublicController::class, 'search_product']);

//login google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//login facebook
Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

//post list
Route::get('/post-list/{slug}', [PublicController::class, 'post_list'])->name('post-list');
Route::get('/{slug}.html', [PublicController::class, 'post_detail'])->name('post_detail');