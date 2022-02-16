<?php

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

use App\Http\Controllers\HomeController; 

//Phía trang chủ giao diện người dùng
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');
Route::get('/404','App\Http\Controllers\HomeController@error_page');
Route::post('/autocomplete-ajax','App\Http\Controllers\HomeController@autocomplete_ajax');


//Hiển thị sản phẩm theo danh mục index
Route::get('/danh-muc/{slug_category_product}','App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu/{brand_slug}','App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet/{product_slug}','App\Http\Controllers\ProductController@details_product');
Route::get('/tag/{product_tag}','App\Http\Controllers\ProductController@tag');

Route::get('/comment','App\Http\Controllers\ProductController@list_comment');
/* Route::post('/quickview','ProductController@quickview'); */
Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::post('/allow-comment','App\Http\Controllers\ProductController@allow_comment');
Route::post('/reply-comment','App\Http\Controllers\ProductController@reply_comment');
Route::post('/delete-comment','App\Http\Controllers\ProductController@delete_comment');

Route::post('/insert-rating','App\Http\Controllers\ProductController@insert_rating');

//Phía admin quản trị 
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard'); 

Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');

Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::get('/order-date','App\Http\Controllers\AdminController@order_date');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');


//Danh mục sản phẩm
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');

Route::post('/export-csv','App\Http\Controllers\CategoryProduct@export_csv');
Route::post('/import-csv','App\Http\Controllers\CategoryProduct@import_csv');

Route::post('/arrange-category','App\Http\Controllers\CategoryProduct@arrange_category');

Route::post('/product-tabs','App\Http\Controllers\CategoryProduct@product_tabs');



//Thương hiệu sản phẩm
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');



//Sản phẩm

Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');

Route::get('users','App\Http\Controllers\UserController@index')->middleware('auth.roles');
Route::get('add-users','App\Http\Controllers\UserController@add_users')->middleware('auth.roles');
Route::get('delete-user-roles/{admin_id}','App\Http\Controllers\UserController@delete_user_roles')->middleware('auth.roles');
Route::post('store-users','App\Http\Controllers\UserController@store_users');
Route::post('assign-roles','App\Http\Controllers\UserController@assign_roles')->middleware('auth.roles');

Route::get('impersonate/{admin_id}','App\Http\Controllers\UserController@impersonate');
Route::get('impersonate-destroy','App\Http\Controllers\UserController@impersonate_destroy');



Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');


Route::post('/uploads-ckeditor','App\Http\Controllers\ProductController@ckeditor_image');
Route::get('/file-browser','App\Http\Controllers\ProductController@file_browser');



//Giỏ hàng
Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@delete_product');
Route::get('/del-all-product','App\Http\Controllers\CartController@delete_all_product');

Route::get('/show-cart','App\Http\Controllers\CartController@show_cart_menu');
Route::get('/hover-cart','App\Http\Controllers\CartController@hover_cart');
Route::get('/cart-session','App\Http\Controllers\CartController@cart_session');

//Thanh toán
Route::get('/dang-nhap','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/del-fee','App\Http\Controllers\CheckoutController@del_fee');

Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/calculate-fee','App\Http\Controllers\CheckoutController@calculate_fee');
Route::post('/select-delivery-home','App\Http\Controllers\CheckoutController@select_delivery_home');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');

//Quản lí đặt hàng
/* Route::get('/manage-order','App\Http\Controllers\CheckoutController@manage_order');
Route::get('/view-order/{orderId}','App\Http\Controllers\CheckoutController@view_order');
Route::get('/delete-order/{orderId}','App\Http\Controllers\CheckoutController@delete_order'); */
Route::get('/delete-order/{order_code}','App\Http\Controllers\OrderController@order_code');
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');

Route::get('/view-history-order/{order_code}','App\Http\Controllers\OrderController@view_history_order');
Route::get('/history','App\Http\Controllers\OrderController@history');


//Gửi Mail
Route::get('/send-mail','App\Http\Controllers\HomeController@send_mail');


//Mã giảm giá
Route::post('/check-coupon','App\Http\Controllers\CartController@check_coupon');
Route::get('/unactive-coupon','App\Http\Controllers\CouponController@unactive_coupon');
Route::get('/active-coupon','App\Http\Controllers\CouponController@active_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');
Route::get('/unset-coupon','App\Http\Controllers\CouponController@unset_coupon');


//Phí vận chuyển
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery','App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery','App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship','App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-delivery','App\Http\Controllers\DeliveryController@update_delivery');

//Banner Slider
Route::get('/manage-slider','App\Http\Controllers\SliderController@manage_slider');
Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','App\Http\Controllers\SliderController@delete_slide');
Route::post('/insert-slider','App\Http\Controllers\SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','App\Http\Controllers\SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','App\Http\Controllers\SliderController@active_slide');


//Authentication roles
Route::get('/register-auth','App\Http\Controllers\AuthController@register_auth');
Route::get('/login-auth','App\Http\Controllers\AuthController@login_auth');
Route::get('/logout-auth','App\Http\Controllers\AuthController@logout_auth');

Route::post('/register','App\Http\Controllers\AuthController@register');
Route::post('/login','App\Http\Controllers\AuthController@login');

//Danh mục bài viết
Route::get('/add-category-post','App\Http\Controllers\CategoryPost@add_category_post');
Route::get('/all-category-post','App\Http\Controllers\CategoryPost@all_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPost@edit_category_post');

Route::post('/save-category-post','App\Http\Controllers\CategoryPost@save_category_post');
Route::post('/update-category-post/{cate_id}','App\Http\Controllers\CategoryPost@update_category_post');
Route::get('/delete-category-post/{cate_id}','App\Http\Controllers\CategoryPost@delete_category_post');


//Bài viết
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');

//Hiển thị bài viết index
Route::get('/danh-muc-bai-viet/{post_slug}','App\Http\Controllers\PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','App\Http\Controllers\PostController@bai_viet');

//Gallery
Route::get('add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('update-gallery','App\Http\Controllers\GalleryController@update_gallery');


//Trang liên hệ
Route::get('/lien-he','App\Http\Controllers\ContactController@lien_he' );
Route::get('/information','App\Http\Controllers\ContactController@information' );
Route::get('/list-nut','App\Http\Controllers\ContactController@list_nut' );
Route::get('/delete-icons','App\Http\Controllers\ContactController@delete_icons' );

Route::get('/list-doitac','App\Http\Controllers\ContactController@list_doitac' );

Route::post('/add-doitac','App\Http\Controllers\ContactController@add_doitac' );
Route::post('/add-nut','App\Http\Controllers\ContactController@add_nut' );
Route::post('/save-info','App\Http\Controllers\ContactController@save_info' );
Route::post('/update-info/{info_id}','App\Http\Controllers\ContactController@update_info' );