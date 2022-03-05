<?php

use Illuminate\Support\Facades\Route;

//==================Admin=============
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use App\Http\Controllers\Admin\ReportController;


//=========seller===============
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerLoginController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\GalleryController;
use App\Http\Controllers\Seller\StockController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\WithdrawController;
use App\Http\Controllers\Seller\SellerReportController;
use App\Http\Controllers\Seller\SellerProfileController;


//=========customer===============
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CompareListController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\ShopController;

// Admin routes
Route::group(['prefix'=>'admin'],function(){
	Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
	Route::get('profile',[AdminProfileController::class,'profile_form'])->name('admin.profile');
	Route::post('profile',[AdminProfileController::class,'profile_update'])->name('admin.profile_update');
	Route::get('password',[AdminProfileController::class,'password_form'])->name('admin.change_password');
	Route::post('password',[AdminProfileController::class,'change_password'])->name('admin.update_password');

	// Report routes
	
	Route::get('generate_report',[ReportController::class,'custom_report'])->name('admin.custom_report');
	Route::post('generate_report',[ReportController::class,'generate_report'])->name('admin.generate_report');
	Route::get('daily_report',[ReportController::class,'daily_report'])->name('admin.daily_report');
	Route::get('weekly_report',[ReportController::class,'weekly_report'])->name('admin.weekly_report');
	Route::get('monthly_report',[ReportController::class,'monthly_report'])->name('admin.monthly_report');

	// Orders Routes
	Route::get('load_order',[OrderController::class,'datatable'])->name('admin.load_order');
	Route::get('order_list',[OrderController::class,'index'])->name('admin.order_list');
	Route::post('update.order_status',[OrderController::class,'update_status'])->name('admin.update.order_status');
	Route::get('order_detail/{id}',[OrderController::class,'order_detail'])->name('admin.order_detail');
	Route::get('order_invoice/{id}',[OrderController::class,'order_invoice'])->name('admin.order_invoice');


	// Commission Routes
	Route::get('load_order_commission',[CommissionController::class,'order_commission_datatable'])
	->name('admin.load_order_commission');
	Route::get('order_commission',[CommissionController::class,'order_commission'])->name('admin.order_commission');
	Route::get('load_order_history',[CommissionController::class,'order_history_datatable'])->name('admin.load_order_history');
	Route::get('order_history',[CommissionController::class,'order_commission_history'])->name('admin.order_history');

	

	// Category Routes
	Route::get('load_category',[CategoryController::class,'datatable'])->name('admin.load_category');
	Route::get('category_list',[CategoryController::class,'index'])->name('admin.category_list');
	
	Route::get('category_create',[CategoryController::class,'create'])->name('admin.category_create');
	Route::post('category_store',[CategoryController::class,'store'])->name('admin.category_store');
	Route::get('category_edit/{id}',[CategoryController::class,'edit'])->name('admin.category_edit');
	Route::post('category_update',[CategoryController::class,'update'])->name('admin.category_update');
	Route::post('category_delete',[CategoryController::class,'delete'])->name('admin.category_delete');

	Route::post('subcategory_update',[CategoryController::class,'sub_update'])->name('admin.subcategory_update');
	Route::get('subcategory_list',[CategoryController::class,'sub_category'])->name('admin.subcategory_list');
	Route::get('subcategory_edit/{id}',[CategoryController::class,'edit_sub'])->name('admin.subcategory_edit');


	// sub Category Routes
	Route::get('load_subcategory',[CategoryController::class,'sub_cat_datatable'])->name('admin.load_subcategory');
	Route::get('subcategory_list',[CategoryController::class,'sub_cat_index'])->name('admin.subcategory_list');




	// Seller Routes
	Route::get('load_seller',[UserController::class,'seller_datatable'])->name('admin.load_seller');
	Route::get('seller_list',[UserController::class,'seller_index'])->name('admin.seller_list');
	Route::get('load_customer',[UserController::class,'customer_datatable'])->name('admin.load_customer');
	Route::get('customer_list',[UserController::class,'customer_index'])->name('admin.customer_list');
	

	// Brands Routes
	Route::get('load_brand',[BrandController::class,'datatable'])->name('admin.load_brand');
	Route::get('brand_list',[BrandController::class,'index'])->name('admin.brand_list');
	Route::get('brand_create',[BrandController::class,'create'])->name('admin.brand_create');
	Route::post('brand_store',[BrandController::class,'store'])->name('admin.brand_store');
	Route::get('brand_edit/{id}',[BrandController::class,'edit'])->name('admin.brand_edit');
	Route::post('brand_update',[BrandController::class,'update'])->name('admin.brand_update');
	Route::post('brand_delete',[BrandController::class,'delete'])->name('admin.brand_delete');


	// Color Routes
	Route::get('load_color',[ColorController::class,'datatable'])->name('admin.load_color');
	Route::get('color_list',[ColorController::class,'index'])->name('admin.color_list');
	Route::get('color_create',[ColorController::class,'create'])->name('admin.color_create');
	Route::post('color_store',[ColorController::class,'store'])->name('admin.color_store');
	Route::get('color_edit/{id}',[ColorController::class,'edit'])->name('admin.color_edit');
	Route::post('color_update',[ColorController::class,'update'])->name('admin.color_update');
	Route::post('color_delete',[ColorController::class,'delete'])->name('admin.color_delete');


	// Size Routes
	Route::get('load_size',[SizeController::class,'datatable'])->name('admin.load_size');
	Route::get('size_list',[SizeController::class,'index'])->name('admin.size_list');
	Route::get('size_create',[SizeController::class,'create'])->name('admin.size_create');
	Route::post('size_store',[SizeController::class,'store'])->name('admin.size_store');
	Route::get('size_edit/{id}',[SizeController::class,'edit'])->name('admin.size_edit');
	Route::post('size_update',[SizeController::class,'update'])->name('admin.size_update');
	Route::post('size_delete',[SizeController::class,'delete'])->name('admin.size_delete');


	// slider Routes
	Route::get('load_slider',[SliderController::class,'datatable'])->name('admin.load_slider');
	Route::get('slider_list',[SliderController::class,'index'])->name('admin.slider_list');
	Route::get('slider_create',[SliderController::class,'create'])->name('admin.slider_create');
	Route::post('slider_store',[SliderController::class,'store'])->name('admin.slider_store');
	Route::get('slider_edit/{id}',[SliderController::class,'edit'])->name('admin.slider_edit');
	Route::post('slider_update',[SliderController::class,'update'])->name('admin.slider_update');
	Route::post('slider_delete',[SliderController::class,'delete'])->name('admin.slider_delete');

	// Manage Product
	Route::get('load_product',[ManageProductController::class,'datatable'])->name('admin.load_product');
	Route::get('product_list',[ManageProductController::class,'index'])->name('admin.product_list');


	// Withdraw request
	Route::get('load_withdraw_request',[WithdrawRequestController::class,'datatable'])
	->name('admin.load_withdraw_request');
	Route::get('withdraw_request',[WithdrawRequestController::class,'index'])->name('admin.withdraw_request_list');
	Route::post('update_withdraw_request',[WithdrawRequestController::class,'update_withdraw_status'])
	->name('admin.update_withdraw_status');

	// General Settings Routes
	Route::get('general_setting',[GeneralSettingController::class,'index'])->name('admin.general_setting');
	Route::post('general_setting',[GeneralSettingController::class,'update_general_setting'])->name('admin.update.general_setting');
	
});


// Seller Routes
Route::group(['prefix'=>'seller'],function(){
	Route::get('dashboard',[SellerController::class,'index'])->name('seller.dashboard');

	// Report routes
	
	Route::get('generate_report',[SellerReportController::class,'custom_report'])->name('seller.custom_report');
	Route::post('generate_report',[SellerReportController::class,'generate_report'])->name('seller.generate_report');
	Route::get('daily_report',[SellerReportController::class,'daily_report'])->name('seller.daily_report');
	Route::get('weekly_report',[SellerReportController::class,'weekly_report'])->name('seller.weekly_report');
	Route::get('monthly_report',[SellerReportController::class,'monthly_report'])->name('seller.monthly_report');

	// Product Routes
	Route::get('load_product',[ProductController::class,'datatable'])->name('seller.load_product');
	Route::get('product_list',[ProductController::class,'index'])->name('seller.product_list');
	Route::get('product_create',[ProductController::class,'create'])->name('seller.product_create');
	Route::post('product_store',[ProductController::class,'store'])->name('seller.product_store');
	Route::get('product_edit/{id}',[ProductController::class,'edit'])->name('seller.product_edit');
	Route::post('product_update',[ProductController::class,'update'])->name('seller.product_update');
	Route::post('product_delete',[ProductController::class,'delete'])->name('seller.product_delete');
	Route::POST('find_sub_cat',[ProductController::class,'find_sub_cat'])->name('find_sub_category');

	// Seller Orders Routes
	Route::get('load_order',[SellerOrderController::class,'datatable'])->name('seller.load_order');
	Route::get('order_list',[SellerOrderController::class,'index'])->name('seller.order_list');
	Route::get('order_detail/{id}',[SellerOrderController::class,'order_detail'])->name('seller.order_detail');
	
	
	Route::post('show_product_status',[ProductController::class,'show_product_status'])
	->name('seller.show_product_status');
	Route::post('update_product_status',[ProductController::class,'update_product_status'])
	->name('seller.update_product_status');

	 //Product Gallery
	Route::get('gallery_list/{id}',[GalleryController::class,'index'])->name('seller.gallery_list');
	Route::post('gallery_store',[GalleryController::class,'store'])->name('seller.gallery_store');
	Route::get('gallery_edit/{id}',[GalleryController::class,'edit'])->name('seller.gallery_edit');
	Route::post('gallery_update',[GalleryController::class,'update'])->name('seller.gallery_update');
	Route::post('gallery_delete',[GalleryController::class,'delete'])->name('seller.gallery_delete');

	//Product Stock
	Route::get('stock_list/{id}',[StockController::class,'index'])->name('seller.stock_list');
	Route::post('stock_store',[StockController::class,'store'])->name('seller.stock_store');
	Route::get('stock_edit/{id}',[StockController::class,'edit'])->name('seller.stock_edit');
	Route::post('stock_update',[StockController::class,'update'])->name('seller.stock_update');
	Route::post('stock_delete',[StockController::class,'delete'])->name('seller.stock_delete');

	//Product Stock
	Route::get('balance',[WithdrawController::class,'balance'])->name('seller.balance');
	Route::post('withdra_submit',[WithdrawController::class,'withdraw'])->name('seller.withdraw.submit');
	Route::get('load_withdraw_history',[WithdrawController::class,'datatable'])->name('seller.load_withdraw.history');
	Route::get('withdra_history',[WithdrawController::class,'withdraw_history'])->name('seller.withdraw.history');

	//Product Stock
	Route::get('profile',[SellerProfileController::class,'profile_form'])->name('seller.profile');
	Route::post('profile',[SellerProfileController::class,'profile_update'])->name('seller.profile_update');
	Route::get('password',[SellerProfileController::class,'password_form'])->name('seller.change_password');
	Route::post('password',[SellerProfileController::class,'change_password'])->name('seller.update_password');
	Route::get('wallet',[SellerProfileController::class,'wallet'])->name('seller.wallet');
	Route::get('shop_logo',[SellerProfileController::class,'shop_logo_form'])->name('seller.shop_logo');
	Route::post('shop_logo',[SellerProfileController::class,'add_shop_logo'])->name('seller.add_shop_logo');
	
	


   // Authenticate Routes
	Route::get('register',[SellerLoginController::class,'showRegisterForm'])->name('seller.register');
	Route::get('login',[SellerLoginController::class,'showLoginForm'])->name('seller.login');
	Route::post('register',[SellerLoginController::class,'register']);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------
|
*/


Auth::routes();

Route::get('/', [EcommerceController::class, 'index'])->name('home.page');
Route::get('/setlocal/{locale}', [LocalizationController::class, 'set_locale'])->name('set.locale');

Route::group(['prefix'=>'product'],function(){
	
	Route::get('/detail/{slug}', [EcommerceController::class, 'product_detail'])->name('product.detail');
	Route::post('/load_more_data', [EcommerceController::class, 'load_more_data'])->name('load.more.data');
	Route::get('/category_wise/{id}',[EcommerceController::class, 'category_wise'])->name('product.category_wise');
	Route::post('/load_category',[EcommerceController::class, 'load_cat_product'])->name('load.category_product');
	Route::get('/subcategory_wise/{id}',[EcommerceController::class, 'subcategory_wise'])->name('product.subcategory_wise');
	Route::post('/load_subcategory',[EcommerceController::class, 'load_subcat_product'])->name('load.subcategory_product');
	Route::get('/brand_wise/{id}',[EcommerceController::class, 'brand_wise_product'])->name('product.brand_wise');
	Route::post('/load_brand_wise',[EcommerceController::class, 'load_brand_product'])->name('load.brand_wise');
	Route::post('/load_related_product',[EcommerceController::class, 'load_related_product'])->name('load.related_product');
	Route::post('/find_size',[EcommerceController::class, 'find_size'])->name('find_size');
	Route::post('/available_quantity',[EcommerceController::class, 'available_quantity'])->name('available_quantity');
	Route::post('/search',[EcommerceController::class, 'product_search'])->name('product_search');
	Route::post('/load_search_product',[EcommerceController::class, 'load_search_product'])->name('load.load_search_product');

	// review routes
	Route::post('/review',[ReviewController::class, 'review'])->name('product.review');
	Route::post('/load_more_review',[ReviewController::class, 'load_review'])->name('product.load_review');

	// shop routes

	Route::get('/shop',[ShopController::class, 'product_shop'])->name('product.shop');


});

// cart routes
Route::group(['prefix'=>'cart'],function(){
	Route::post('/add_to_cart',[CartController::class, 'add_to_cart'])->name('add_to_cart');
	Route::get('/view',[CartController::class, 'view_cart'])->name('view.cart');
	Route::post('/update',[CartController::class, 'update_cart'])->name('update.cart');
	Route::post('/delete',[CartController::class, 'delete_cart'])->name('delete.cart');
});

// wishlist route
Route::group(['prefix'=>'wishlist'],function(){
	Route::post('/add_to_wishlist',[WishlistController::class, 'add_to_wishlist'])->name('add_to_wishlist');
	Route::get('/view',[WishlistController::class, 'view_wishlist'])->name('view.wishlist');
	Route::post('/delete',[WishlistController::class, 'delete_wishlist'])->name('delete.wishlist');
});


// comparelist route
Route::group(['prefix'=>'comparelist'],function(){
	Route::post('/add_to_comparelist',[CompareListController::class, 'add_to_comparelist'])->name('add_to_comparelist');
	Route::get('/view',[CompareListController::class, 'view_comparelist'])->name('view.comparelist');
	Route::post('/delete',[CompareListController::class, 'delete_comparelist'])->name('delete.comparelist');
});

Route::group(['prefix'=>'checkout'],function(){
	Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('checkout');
	Route::post('/submit',[CheckoutController::class, 'submit_checkout'])->name('submit.checkout');
	//Route::get('/'.md5('success'),[CheckoutController::class, 'checkout_success'])->name('checkout.success');
	Route::get('/success',[CheckoutController::class, 'checkout_success'])->name('checkout.success');
});

Route::group(['prefix'=>'customer'],function(){
	Route::get('/dashboard',[CustomerProfileController::class, 'dashboard'])->name('customer.dashboard');
	Route::get('/password',[CustomerProfileController::class, 'password'])->name('customer.password');
	Route::post('/password',[CustomerProfileController::class, 'change_password'])->name('customer.change_password');
	Route::get('/order',[CustomerProfileController::class, 'order_list'])->name('customer.order');
	Route::get('/order_track',[CustomerProfileController::class, 'order_track'])->name('customer.order_track');
	Route::get('/profile',[CustomerProfileController::class, 'profile'])->name('customer.profile');
	Route::post('/profile',[CustomerProfileController::class, 'profile_update'])->name('customer.profile_update');
	Route::post('/track_order',[CustomerProfileController::class, 'track_order'])->name('customer.track_order');
});

Route::get('/customer/login', [HomeController::class, 'showLoginForm'])->name('customer.login');
 