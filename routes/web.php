<?php

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

Route::get('/', 'Beranda_controller@index');

Route::get('/cart',function(){
//   dd(\Cart::content()); 
    $berat = 0;
    foreach(\Cart::content() as $cr){
        $qty = $cr->qty;
        $brt = $cr->options->berat;
        $berat += $qty * $brt;
    }
    dd(\Cart::content());
});

// Route::get('transaksi',function(){
// 	\DB::beginTransaction();

// 	try{
// 		\DB::table('base64')->where('id',1)->delete();
// 		\App\Models\Product::where('id',1)->delete();

// 		dd(\DB::commit());
// 	}catch (\Exception $e) {
// 	    $aaa = \DB::rollback();
// 	    dd($aaa);
// 	}
// });

// Route::get('/ip',function(){
// 	$alamat_ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
// 	dd($alamat_ip);
// });

// Route::get('sync',function(){
// 	$data = \DB::connection('toko')->select("SELECT TOP 1 * from Item");
// 	dd($data);
// });

// Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', function(){
// 	return redirect('/');
// })->middleware('verified');

// Route::get('banner',function(){
// 	$product_id = \App\Models\Product::first();
// 	$uuid = \Uuid::generate(4);
// 	\DB::table('banner')->insert([
// 		'banner_id'=>$uuid,
// 		'product_id'=>$product_id->product_id,
// 	]);
// });




// Route::get('s/{store}/p/{product}/{title}','Beranda_controller@detail');

Route::get('s/{store}/p/{product}/{title}', ['as' => 'detail', 'uses' => 'Beranda_controller@detail']);

// Route::get('kategori/{id}','Beranda_controller@kategori');

Route::get('cat/{cat}', ['as' => 'product', 'uses' => 'Beranda_controller@kategori']);

Route::get('cari','Beranda_controller@cari');

Route::get('add-to-cart/{id}','Cart_controller@add');

Route::get('cart','Cart_controller@index');

Route::get('cart/remove','Cart_controller@remove');

Route::get('wishlist','Beranda_controller@wishlist')->middleware('auth');

/*Ajax POST untuk update wishlist */
Route::post('/update_wishlist',[
    'uses'  =>  'Beranda_controller@update_wishlist',
    'as'    =>  'update_wishlist'
]);

/*Ajax POST untuk update cart rowid */
Route::post('/update_cart',[
    'uses'  =>  'Cart_controller@update_cart',
    'as'    =>  'update_cart'
]);

/*Ajax POST untuk delete cart per rowid */
Route::post('/delete_cart',[
    'uses'  =>  'Cart_controller@delete_cart',
    'as'    =>  'delete_cart'
]);

/*Ajax POST untuk calculate harga dan attributes*/
Route::post('/calculate',[
    'uses'  =>  'Cart_controller@calculate',
    'as'    =>  'calculate'
]);



Route::get('checkout/index','Cart_controller@ongkir')->middleware('auth');

Route::get('checkout/kota/{id}','Cart_controller@kota')->middleware('auth');

Route::get('checkout/get_city/{id}','Cart_controller@get_city')->middleware('auth');

Route::get('checkout/get_kecamatan/{id}','Cart_controller@get_kecamatan')->middleware('auth');

Route::get('checkout/get_kelurahan/{id}','Cart_controller@get_kelurahan')->middleware('auth');

Route::get('checkout/get_pos/{id}','Cart_controller@get_pos')->middleware('auth');

Route::get('checkout/add_address','Cart_controller@add_address')->middleware('auth');

Route::get('checkout/set_address/{id}','Cart_controller@set_address')->middleware('auth');

Route::get('checkout/cek','Cart_controller@cek')->middleware('auth');

/* untuk new product */
Route::get('/new_product',[
    'uses'  =>  'product\ProductController@new',
    'as'    =>  'new_product'
]);

// /* untuk hot product */
// Route::get('/hot_product',[
//     'uses'  =>  'product\ProductController@hot',
//     'as'    =>  'hot_product'
// ]);

// /* untuk best seller */
// Route::get('/best_seller',[
//     'uses'  =>  'product\ProductController@best_seller',
//     'as'    =>  'best_seller'
// ]);

// /* untuk flash sale */
// Route::get('/flash_sale',[
//     'uses'  =>  'product\ProductController@flash_sale',
//     'as'    =>  'flash_sale'
// ]);

// /* untuk contact */
// Route::get('/contact',[
//     'uses'  =>  'homepage\HomepageController@contact',
//     'as'    =>  'contact'
// ]);

Route::group(['middleware'=>'auth'],function(){
	Route::post('/shipping_method',[
		'uses'  =>  'Cart_controller@shipping_method',
		'as'    =>  'shipping'
	])->middleware('auth');
	Route::post('/payment_method',[
		'uses'  =>  'Cart_controller@payment_method',
		'as'    =>  'payment'
	])->middleware('auth');

	/*Ajax POST untuk GET TOKEN TIKI */
	Route::post('/get_tiki_token',[
		'uses'  =>  'Cart_controller@get_tiki_token',
		'as'    =>  'get_tiki_token'
	])->middleware('auth');

	/*Ajax POST untuk mendapatkan layanan tiki */
	Route::post('/get_layanan_tiki',[
		'uses'  =>  'Cart_controller@get_layanan_tiki',
		'as'    =>  'get_layanan_tiki'
	])->middleware('auth');
	
	Route::post('/submit_payment',[
		'uses'  =>  'Cart_controller@submit_payment',
		'as'    =>  'submit'
	])->middleware('auth');
	
	Route::post('/finish_payment',[
		'uses'  =>  'Cart_controller@finish_payment',
		'as'    =>  'finish_payment'
	])->middleware('auth');
	
	Route::post('/unfinish_payment',[
		'uses'  =>  'Cart_controller@unfinish_payment',
		'as'    =>  'unfinish_payment'
	])->middleware('auth');
	
	Route::post('/error_payment',[
		'uses'  =>  'Cart_controller@error_payment',
		'as'    =>  'error_payment'
	])->middleware('auth');
	
	Route::get('/vtweb', 'PagesController@vtweb')->middleware('auth');

	Route::get('/vtdirect', 'PagesController@vtdirect')->middleware('auth');
	Route::post('/vtdirect', 'PagesController@checkout_process')->middleware('auth');

	Route::get('/vt_transaction', 'PagesController@transaction')->middleware('auth');
	Route::post('/vt_transaction', 'PagesController@transaction_process')->middleware('auth');

	Route::post('/vt_notif', 'PagesController@notification')->middleware('auth');

	Route::get('/snap', 'SnapController@snap')->middleware('auth');
	Route::get('/snaptoken', 'SnapController@token')->middleware('auth');
	Route::post('/snapfinish', 'SnapController@finish')->middleware('auth');

	Route::get('bayar','Cart_controller@bayar')->middleware('auth')->middleware('auth');
	Route::get('bayar/guide','Cart_controller@bayar_guide')->middleware('auth');
});

/* logout customer atau designer */
Route::get('logout','Beranda_controller@logout');

/* logout admin atau back end staff */
Route::get('keluar','Admin\Beranda_controller@keluar');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');

Route::group(['middleware'=>'auth'],function(){

	Route::group(['middleware'=>'userMiddleware'],function(){

		Route::get('user/beranda','User\Beranda_controller@index')->middleware(['auth','verified']);

		// Profile Customer
		Route::get('user_profile', 'User\Beranda_controller@index')->middleware('auth');
		Route::get('settings', 'User\Beranda_controller@settings')->middleware('auth');

		// User List Address Profile
		// Route::resource('address_list', 'User\Beranda_controller@address_list')->middleware('auth');
		/*Ajax DATATABLES ADDRESS */
		Route::get('address_list',[
			'uses'  =>  'User\Beranda_controller@address_list',
			'as'    =>  'address_list'
		])->middleware('auth');

		//	EDIT ADDRESS CUSTOMER
		Route::get('edit_address','User\Beranda_controller@edit_address')->middleware('auth');	

		Route::post('save_address',[
			'uses'  =>  'User\Beranda_controller@save_address',
			'as'    =>  'save_address'
		])->middleware('auth');

		// ADD CUSTOMER ADDITONAL INFORMATION
		Route::post('save_birthdate',[
			'uses'  =>  'User\Beranda_controller@save_birthdate',
			'as'    =>  'save_birthdate'
		])->middleware('auth');

		Route::post('save_gender',[
			'uses'  =>  'User\Beranda_controller@save_gender',
			'as'    =>  'save_gender'
		])->middleware('auth');

		Route::post('change_password',[
			'uses'  =>  'User\Beranda_controller@change_password',
			'as'    =>  'change_password'
		])->middleware('auth');

		// Pesanan
		Route::get('user/order','User\Pesanan_controller@index')->middleware('auth');
		Route::get('user/order/detail/{id}','User\Pesanan_controller@detail')->middleware('auth');
		Route::get('user/order/konfirmasi','User\Pesanan_controller@konfirmasi')->middleware('auth');
		Route::get('user/order/konfirmasi/{id}','User\Pesanan_controller@konfirmasi_detail')->middleware('auth');
		Route::post('user/order/konfirmasi/{id}','User\Pesanan_controller@konfirmasi_proses')->middleware('auth');

		// Produk
		Route::get('user/produk/habis','User\Produk_controller@habis')->middleware('auth');
		Route::get('user/produk','User\Produk_controller@index')->middleware('auth');
		Route::get('user/produk/aktif','User\Produk_controller@aktif')->middleware('auth');
		Route::get('user/produk/nonaktif','User\Produk_controller@nonaktif')->middleware('auth');
		Route::get('user/produk/tambah','User\Produk_controller@add')->middleware('auth');
		Route::post('user/produk/tambah','User\Produk_controller@store')->middleware('auth');
		Route::get('user/produk/{id}','User\Produk_controller@edit')->middleware('auth');
		Route::put('user/produk/{id}','User\Produk_controller@update')->middleware('auth');
		Route::get('user/produk/delete/{id}','User\Produk_controller@delete')->middleware('auth');

	});


	Route::group(['middleware'=>'adminMiddleware'],function(){
		Route::get('admin/beranda','Admin\Beranda_controller@index')->middleware(['auth','verified']);

		// Alamat
		Route::get('admin/alamat','Admin\Alamat_controller@edit')->middleware('auth');
		Route::put('admin/alamat','Admin\Alamat_controller@update')->middleware('auth');

		// Produk
		Route::get('admin/produk/habis','Admin\Produk_controller@habis')->middleware('auth');
		Route::get('admin/produk','Admin\Produk_controller@index')->middleware('auth');
		Route::get('admin/produk/aktif','Admin\Produk_controller@aktif')->middleware('auth');
		Route::get('admin/produk/nonaktif','Admin\Produk_controller@nonaktif')->middleware('auth');
		Route::get('admin/produk/tambah','Admin\Produk_controller@add')->middleware('auth');
		Route::post('admin/produk/tambah','Admin\Produk_controller@store')->middleware('auth');
		Route::get('admin/produk/{id}','Admin\Produk_controller@edit')->middleware('auth');
		Route::put('admin/produk/{id}','Admin\Produk_controller@update')->middleware('auth');
		Route::get('admin/produk/delete/{id}','Admin\Produk_controller@delete')->middleware('auth');


		// Kategori
		Route::get('admin/kategori','Admin\Kategori_controller@index')->middleware('auth');
		Route::get('admin/kategori/tambah','Admin\Kategori_controller@add')->middleware('auth');
		Route::post('admin/kategori/tambah','Admin\Kategori_controller@store')->middleware('auth');
		Route::get('admin/kategori/{id}','Admin\Kategori_controller@edit')->middleware('auth');
		Route::put('admin/kategori/{id}','Admin\Kategori_controller@update')->middleware('auth');
		Route::get('admin/kategori/delete/{id}','Admin\Kategori_controller@delete')->middleware('auth');

		// Warna
		Route::get('admin/warna','Admin\Warna_controller@index')->middleware('auth');
		Route::get('admin/warna/tambah','Admin\Warna_controller@add')->middleware('auth');
		Route::post('admin/warna/tambah','Admin\Warna_controller@store')->middleware('auth');
		Route::get('admin/warna/{id}','Admin\Warna_controller@edit')->middleware('auth');
		Route::put('admin/warna/{id}','Admin\Warna_controller@update')->middleware('auth');
		Route::get('admin/warna/delete/{id}','Admin\Warna_controller@delete')->middleware('auth');

		// Populer Minggu ini
		Route::get('admin/populer-minggu','Admin\Populer_minggu_controller@index')->middleware('auth');
		Route::get('admin/populer-minggu/tambah','Admin\Populer_minggu_controller@add')->middleware('auth');
		Route::post('admin/populer-minggu/tambah','Admin\Populer_minggu_controller@store')->middleware('auth');
		Route::get('admin/populer-minggu/{id}','Admin\Populer_minggu_controller@edit')->middleware('auth');
		Route::put('admin/populer-minggu/{id}','Admin\Populer_minggu_controller@update')->middleware('auth');
		Route::get('admin/populer-minggu/delete/{id}','Admin\Populer_minggu_controller@delete')->middleware('auth');

		// Featured
		Route::get('admin/featured','Admin\Featured_controller@index')->middleware('auth');
		Route::get('admin/featured/tambah','Admin\Featured_controller@add')->middleware('auth');
		Route::post('admin/featured/tambah','Admin\Featured_controller@store')->middleware('auth');
		Route::get('admin/featured/{id}','Admin\Featured_controller@edit')->middleware('auth');
		Route::put('admin/featured/{id}','Admin\Featured_controller@update')->middleware('auth');
		Route::get('admin/featured/delete/{id}','Admin\Featured_controller@delete')->middleware('auth');

		// Banner
		Route::get('admin/banner','Admin\Banner_controller@index')->middleware('auth');
		Route::get('admin/banner/{id}','Admin\Banner_controller@edit')->middleware('auth');
		Route::put('admin/banner/{id}','Admin\Banner_controller@update')->middleware('auth');

		// Best Seller
		Route::get('admin/best-seller','Admin\Best_seller_controller@index')->middleware('auth');
		Route::get('admin/best-seller/tambah','Admin\Best_seller_controller@add')->middleware('auth');
		Route::post('admin/best-seller/tambah','Admin\Best_seller_controller@store')->middleware('auth');
		// Route::get('admin/best-seller/{id}','Admin\Best_seller_controller@edit');
		// Route::put('admin/best-seller/{id}','Admin\Best_seller_controller@update');
		Route::get('admin/best-seller/delete/{id}','Admin\Best_seller_controller@delete')->middleware('auth');

		// Manage Ukuran
		Route::get('admin/ukuran','Admin\Ukuran_controller@index')->middleware('auth');
		Route::get('admin/ukuran/tambah','Admin\Ukuran_controller@add')->middleware('auth');
		Route::post('admin/ukuran/tambah','Admin\Ukuran_controller@store')->middleware('auth');
		Route::get('admin/ukuran/{id}','Admin\Ukuran_controller@edit')->middleware('auth');
		Route::put('admin/ukuran/{id}','Admin\Ukuran_controller@update')->middleware('auth');
		Route::get('admin/ukuran/delete/{id}','Admin\Ukuran_controller@delete')->middleware('auth');

		// Banner Slider
		Route::get('admin/banner-slider','Admin\Banner_slider_controller@index')->middleware('auth');
		Route::get('admin/banner-slider/tambah','Admin\Banner_slider_controller@add')->middleware('auth');
		Route::post('admin/banner-slider/tambah','Admin\Banner_slider_controller@store')->middleware('auth');
		Route::get('admin/banner-slider/{id}','Admin\Banner_slider_controller@edit')->middleware('auth');
		Route::put('admin/banner-slider/{id}','Admin\Banner_slider_controller@update')->middleware('auth');
		Route::get('admin/banner-slider/delete/{id}','Admin\Banner_slider_controller@delete')->middleware('auth');
	});
	

});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
