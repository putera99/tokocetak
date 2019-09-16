<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pesanan;
use App\Models\Pesanan_barang;
use App\Models\Pesanan_alamat;

use App\Models\Products;
use App\Models\TMenu;
use App\Models\viewStoreProducts;
use App\Models\viewProductAttributes;
use App\Models\ProductCategories;
use App\Models\InfoProductLastView;
use App\Models\UserAddress;
use App\Models\Provinsi;
use App\Models\PostalCode;
use App\Models\TikiTarif;
use App\Models\JnePos;
use App\Models\JneTarif;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;

use Config;
use Cart;
use Auth;
use DB;
use MyHelper;

class Cart_controller extends Controller
{

	protected $request;
	protected $tikiToken;

	public function __construct(Request $request)
    {
        $this->request = $request;
        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index(){
        $title = 'TokoCetak | Keranjang';
		$prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
		// print_r(\Cart::content());exit;
        return view('beranda.cart',compact('title','prodCategories','dataMenu'));
    }
    
    public function remove(){
        Cart::destroy();
        
        \Session::flash('pesan','Keranjang di kosongkan');
        return redirect()->back();
    }
    
    public function add(Request $request, $id){
		$total = 0;
		$cnt = 0;
		$arrOption = array();
		$pr = viewStoreProducts::where('StoreProductID',$id)->first();
		// print_r($pr->WeightFrom);exit;
		// print_r($request->all());exit;
		// print_r(count($request->all()));exit;
		// print_r(array_keys($request->all()));exit;
		foreach ($request->all() as $key => $req) {
			if(($key != 'qty') OR ($key != 'StoreProductID')){
				// $arrOption[str_replace('cb','',strtolower($key))] = $req;
				$attVal = viewProductAttributes::select('AttributesName',DB::raw('sum(Price) Price'))
				->where('AttributesName',$req)
				->groupBy('AttributesName')->first();
				(float)$total += (float)$attVal['Price'];
			}
			$cnt ++;
		}

		// print_r($request->qty);exit;

		$StoreProductID = $id;
		$nama = $pr->ProductName;
		$weight = $pr->WeightFrom * $request->qty;
    	$qty = $request->qty;
		$harga = ($total + $pr->PriceFrom);
		
		// print_r($harga);exit;

		Cart::add([
    	    'id'=>$StoreProductID,
    	    'name'=>$nama,
    	    'qty'=>$qty,
			'price'=>$harga,
			'weight'=>$weight,
    	    'options'=>$arrOption
		]);
    	
		\Session::flash('pesan','Berhasil di masukkan ke Keranjang');
		return redirect('cart');
    	// return redirect()->back();
    }
    
    public function ongkir(){
		// print_r(\Uuid::generate(1)->string);exit;
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();
		$userAddr = UserAddress::where('UserID', Auth::user()->id)->get();
		$userAddrDefault = UserAddress::where('UserID', Auth::user()->id)->where('IsDefault', 1)->first();
        $title = 'TokoCetak | Checkout';
        // print_r($userAddrDefault);exit;
        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: a35bcf69df327236675d8180b9449930"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if($err){
			dd($err);
		}else{
			$provinsi = json_decode($response);
		}
		

		$berat = 0;
		$qty = 0;
		$brt = 0;
		// print_r(Cart::content());exit;

        foreach(\Cart::content() as $cr){
            $qty = $cr->qty;
            $brt = $cr->weight;
            $berat += $brt;
        }

		return view('beranda.ongkir',compact('title','provinsi','berat','dataMenu','prodCategories','userAddr','userAddrDefault'));
    }
    
    // public function kota($provinsi){
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$provinsi",
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "GET",
	// 		CURLOPT_HTTPHEADER => array(
	// 			"key: a35bcf69df327236675d8180b9449930"
	// 		),
	// 	));

	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);

	// 	if ($err) {
	// 		echo "cURL Error #:" . $err;
	// 	} else {
	// 		$kota = json_decode($response);
	// 		// dd($kota);
	// 	}

	// 	return response()->json([
	// 		'data'=>$kota
	// 	]);
	// }

	public function cek(Request $request){
		// print_r($request->input());exit;
		$kota_asal = "10620";
		$kota_tujuan = $request->kota_tujuan;
		$kurir = $request->kurir;
		$berat = $request->berat;
		$group_id = $request->group_id;

		// print_r($kota_tujuan);exit;
		// \DB::table('ongkir')->where('group_id',$group_id)->update([
		// 	'harga'=>
		// ])

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: a35bcf69df327236675d8180b9449930"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {	  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response);
		}

		return response()->json([
			'hasil'=>$data
		]);
	}

	public function shipping_method(Request $request)
	{
		// print_r($request->input());exit;
		$userAddr = UserAddress::where('UserID','=',\Auth::user()->id)->where('IsDefault',1)->first();
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();

		// print_r(\Cart::content());exit;

		$qty = 0;
		$brt = 0;
		$berat = 0;
		foreach(\Cart::content() as $cr){
            $qty = $cr->qty;
            $brt = $cr->weight;
            $berat += $brt;
		}

		// print_r($userAddr);exit;
		
		$arrData = [];
		$arrData = array(
			'nama1'=>$request->nama1,
			'provinsi1'=>$request->provinsi1,
			'kota1'=>$request->kota1,
			'kode_pos'=>$request->kode_pos,
			'nope'=>$request->nope,
			'alamat'=>$request->alamat
		);

		// print_r($arrData);exit;
		$title = 'TokoCetak | Shipping Method';
		return view('beranda.shipping',compact('title','arrData','dataMenu','prodCategories','qty','brt','berat','userAddr'));
	}

	public function payment_method(Request $request)
	{
		// print_r($request->all());exit;

		if($request->kurir=='tiki'){
			$this->validate($request,[
				'_token'=>'required',
				'tokenCourier'=>'required',
				'nama1'=>'required',
				'provinsi1'=>'required',
				'kota1'=>'required',
				'kecamatan1'=>'required',
				'kelurahan1'=>'required',
				'kurir'=>'required',
				'kode_pos'=>'required',
				'nope'=>'required',
				'alamat'=>'required'
			]);
		}

		else{
			$this->validate($request,[
				'_token'=>'required',
				'nama1'=>'required',
				'provinsi1'=>'required',
				'kota1'=>'required',
				'kecamatan1'=>'required',
				'kelurahan1'=>'required',
				'kurir'=>'required',
				'kode_pos'=>'required',
				'nope'=>'required',
				'alamat'=>'required'
			]);
		}
		// print_r($request->input());exit;
		$tokenCourier = $request->tokenCourier;
		$userAddr = UserAddress::where('UserID','=',\Auth::user()->id)->where('IsDefault',1)->first();
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();

		$id = \Uuid::generate(1);
		$layananNya = explode('-', $request->layanan);
		$newID = 'TKC'.substr($id->time, 0, 10);
		
		// print_r($layananNya);exit;
		
		$courier = '';
		if($request->kurir=='tiki'){$courier='TIKI';}
		elseif($request->kurir=='jne'){$courier='JNE';}
		elseif($request->kurir=='wahana'){$courier='WHN';}
		else{$courier=='UNDEF';}

		// print_r($courier);exit;

		$StoreProductID = null;
		$price = 0;
		$totalPrice = 0;
		$qty = 0;
		$brt = 0;
		$berat = 0;
		$OrderID = $courier . $newID;
		
		// print_r((float)str_replace(",","",\Cart::subtotal()));exit;

		foreach(\Cart::content() as $cr){
            $qty = $cr->qty;
            $brt = $cr->weight;
			$berat += $brt;
			$StoreProductID = $cr->id;
			$price = (float)str_replace(",","",\Cart::subtotal());
			$totalPrice = (float)str_replace(",","",\Cart::subtotal());
			// print_r($cr);exit;
		}

		if($request->kurir=='tiki'){
			$biayaKirim = (float)$layananNya[2];
			$service = $layananNya[1];
			$estimasi = $layananNya[3];
			$totalPrice = (float)$totalPrice + (float)$layananNya[2];
		}
		if($request->kurir=='jne'){
			// print_r($layananNya);exit;
			$biayaKirim = (float)$layananNya[4];
			$service = $layananNya[3];
			$estimasi = $layananNya[1];
			$totalPrice = (float)$totalPrice + (float)$layananNya[4];
			if($layananNya[1]=='null'){
				$estimasi = "0";
			}
		}

		$value=\Config::get('services.midtrans.clientKey');
		
		// print_r($biayaKirim);exit;
		
		$arrData = [];
		$arrData = array(
			'tikiToken'=>$tokenCourier,
			'StoreProductID'=>$StoreProductID,
			'nama1'=>$request->nama1,
			'provinsi1'=>$request->provinsi1,
			'kota1'=>$request->kota1,
			'kecamatan1'=>$request->kecamatan1,
			'kelurahan1'=>$request->kelurahan1,
			'kode_pos'=>$request->kode_pos,
			'nope'=>$request->nope,
			'alamat'=>$request->alamat,
			'kurir'=>$request->kurir,
			'layanan'=>$service,
			'estimasi'=>$estimasi,
			'biayaKirim'=>$biayaKirim
		);

		// print_r($arrData);exit;
		$title = 'TokoCetak | Payment Method';
		return view('beranda.payment',compact(
			'title',
			'arrData',
			'dataMenu',
			'prodCategories',
			'qty',
			'brt',
			'berat',
			'price',
			'totalPrice',
			'OrderID',
			'userAddr'
		));
	}
		
	public function submit_payment(Request $request)
	{
		$arrItem = array();
		$cnt = 0;
		
		foreach (\Cart::content() as $key => $cart) {
			
			$productDetail = viewStoreProducts::where('StoreProductID', $cart->id)->first();
			$productName = $productDetail['ProductName'] . ' - ' . $productDetail['Title'];
			
			$arrItem[$cnt]['id'] = $cart->id;
			$arrItem[$cnt]['price'] = $cart->price;
			$arrItem[$cnt]['quantity'] = $cart->qty;
			$arrItem[$cnt]['name'] = ucwords(str_replace('_', ' ', $productName));

			$cnt++;
		}

		$shippingAddress = array(
			'Name'=>$request->name1,
			'Alamat'=>$request->alamat,
			'Provinsi'=>$request->provinsi1,
			'Kota'=>$request->kota1,
			'Kecamatan'=>$request->kecamatan1,
			'Keluarahan'=>$request->kelurahan1,
			'Kode Pos'=>$request->kode_pos,
			'Country Code'=>'IDN'
		);
		
		// print_r($arrItem);
		// print_r($request->input());exit;
		$payload = [
			'transaction_details' => [
				'order_id'      => $request->OrderID,
				'gross_amount'  => $request->totalPrice,
			],
			'customer_details' => [
				'first_name'    => $request->nama1,
				'email'         => \Auth::user()->email,
				'phone'         => $request->nope,
				'address'       => $request->alamat,
				'shipping_address'=>$shippingAddress
			],
			// 'item_details' => $arrItem
			// 'item_details' => [
			// 	[
			// 		'id'       => $request->StoreProductID,
			// 		'price'    => $request->totalPrice,
			// 		'quantity' => 1, //$request->qty,
			// 		'name'     => ucwords(str_replace('_', ' ', $productName))
			// 	]
			// ]
		];

		// print_r($payload);

		$snapToken = Veritrans_Snap::getSnapToken($payload);

		// print_r($snapToken);exit;x

		$this->response['snap_token'] = $snapToken;

		// Cart::destroy();

		return response()->json($this->response);
	}

	public function finish_payment(Request $request)
	{
		// print_r($request->all());exit;
		$title = 'TokoCetak | Pending Payment';
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();

		DB::transaction(function() use($request){

			// $id = \Uuid::generate(1);
			$totalharga = 0;
			$layanan = '';
			$ongkir = 0;
			$price = 0;

			foreach (\Cart::content() as $cr) {
				$totalharga += $cr->price * $cr->qty;
			}

			Pesanan::insert([
				'pesanan_id'=>(string)$request->OrderID,
				'tanggal'=>date('Y-m-d H:i:s'),
				'user_id'=>\Auth::user()->id,
				'total_harga'=>$request->totalPrice,
				'PaymentID'=>1,
				'Status'=>3	
			]);

			Pesanan_alamat::insert([
				'pesanan_detail_id'=>\Uuid::generate(4),
				'pesanan_id'=>(string)$request->OrderID,
				'nama1'=>$request->nama1,
				'nama2'=>null,
				'provinsi1'=>$request->provinsi1,
				'provinsi2'=>null,
				'kota1'=>$request->kota1,
				'kota2'=>null,
				'kurir'=>strtoupper($request->kurir),
				'kode_pos'=>$request->kode_pos,
				'nope'=>$request->nope,
				'alamat'=>$request->alamat,
				'layanan'=>strtoupper($request->kurir) . '-' .(string)$request->biayaKirim,
				'ongkir'=>$request->biayaKirim,
			]);

			$qty = 0;
			$subharga = 0;
			$warna_id = '';
			$ukuran_id = '';
			$berat = 0;

			foreach (\Cart::content() as $cr) {
				$qty = $cr->qty;
				$price = $cr->price;
				$berat = $cr->weight;

				Pesanan_barang::insert([
					'pesanan_barang_id'=>\Uuid::generate(4),
					'pesanan_id'=>(string)$request->OrderID,
					'product_id'=>$cr->id,
					'qty'=>$qty,
					'harga'=>$price,
					'subharga'=>$qty*$price,
					'berat'=>$berat
				]);
			}

		});

		\Cart::destroy();

		return view('beranda.finish',compact('title','prodCategories','dataMenu'));
	}

	public function unfinish_payment(Request $request)
	{
		// print_r($request->all());exit;
		
		$title = 'TokoCetak | Pending Payment';
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();

		DB::transaction(function() use($request){

			// $id = \Uuid::generate(1);
			$totalharga = 0;
			$layanan = '';
			$ongkir = 0;
			$price = 0;

			foreach (\Cart::content() as $cr) {
				$totalharga += $cr->price * $cr->qty;
			}

			Pesanan::insert([
				'pesanan_id'=>(string)$request->OrderID,
				'tanggal'=>date('Y-m-d H:i:s'),
				'user_id'=>\Auth::user()->id,
				'total_harga'=>$request->totalPrice,
				'PaymentID'=>1,
				'Status'=>2	
			]);

			Pesanan_alamat::insert([
				'pesanan_detail_id'=>\Uuid::generate(4),
				'pesanan_id'=>(string)$request->OrderID,
				'nama1'=>$request->nama1,
				'nama2'=>null,
				'provinsi1'=>$request->provinsi1,
				'provinsi2'=>null,
				'kota1'=>$request->kota1,
				'kota2'=>null,
				'kurir'=>strtoupper($request->kurir),
				'kode_pos'=>$request->kode_pos,
				'nope'=>$request->nope,
				'alamat'=>$request->alamat,
				'layanan'=>strtoupper($request->layanan) . '-' .(string)$request->biayaKirim,
				'ongkir'=>$request->biayaKirim,
			]);

			$qty = 0;
			$subharga = 0;
			$warna_id = '';
			$ukuran_id = '';
			$berat = 0;

			foreach (\Cart::content() as $cr) {
				$qty = $cr->qty;
				$price = $cr->price;
				$berat = $cr->weight;

				Pesanan_barang::insert([
					'pesanan_barang_id'=>\Uuid::generate(4),
					'pesanan_id'=>(string)$request->OrderID,
					'product_id'=>$cr->id,
					'qty'=>$qty,
					'harga'=>$price,
					'subharga'=>$qty*$price,
					'berat'=>$berat
				]);
			}

		});

		\Cart::destroy();

		return view('beranda.unfinish',compact('title','prodCategories','dataMenu'));
	}

	public function error_payment(Request $request)
	{

		$title = 'TokoCetak | Error Payment';
		$prodCategories = ProductCategories::where('Status',1)->get();
		$dataMenu = TMenu::where('Status',1)->get();

		return view('beranda.error',compact('title','prodCategories','dataMenu'));
	}

	public function bayar(Request $request){

		$this->validate($request,[
			'nama1'=>'required',
			'provinsi1'=>'required',
			'kota1'=>'required',
			'kode_pos'=>'required',
			'nope'=>'required',
			'alamat'=>'required'
		]);

		// print_r($request->input());exit;

		DB::transaction(function() use($request){

			$id = \Uuid::generate(1);
			$totalharga = 0;
			$layanan = '';
			$ongkir = 0;

			foreach (\Cart::content() as $cr) {
				$totalharga += $cr->price * $cr->qty;
			}

			$layananNya = explode('-', $request->layanan);
			$newID = substr($id->time, 0, 10);
	
			$layanan = $layananNya[0];
			$ongkir = $layananNya[1];

			// $OrderID = 'TIKITKC' . $newID;
			
			// print_r($OrderID);exit;

			Pesanan::insert([
				'pesanan_id'=>(string)$OrderID,
				'tanggal'=>date('Y-m-d H:i:s'),
				'user_id'=>\Auth::user()->id,
				'total_harga'=>$totalharga,
				'PaymentID'=>1,
				'Status'=>2	
			]);

			Pesanan_alamat::insert([
				'pesanan_detail_id'=>\Uuid::generate(4),
				'pesanan_id'=>$OrderID,
				'nama1'=>$request->nama1,
				'nama2'=>$request->nama2,
				'provinsi1'=>$request->provinsi1,
				'provinsi2'=>$request->provinsi2,
				'kota1'=>$request->kota1,
				'kota2'=>$request->kota2,
				'kurir'=>$request->kurir,
				'kode_pos'=>$request->kode_pos,
				'nope'=>$request->nope,
				'alamat'=>$request->alamat,
				'layanan'=>$layanan,
				'ongkir'=>$ongkir,
			]);

			$qty = 0;
			$subharga = 0;
			$warna_id = '';
			$ukuran_id = '';
			$berat = 0;

			foreach (\Cart::content() as $cr) {
				$qty = $cr->qty;
				$price = $cr->price;
				$berat = $cr->weight;

				Pesanan_barang::insert([
					'pesanan_barang_id'=>\Uuid::generate(4),
					'pesanan_id'=>$OrderID,
					'product_id'=>$cr->id,
					'qty'=>$qty,
					'harga'=>$price,
					'subharga'=>$qty*$price,
					'berat'=>$berat
				]);
			}

		});

		Cart::destroy();
		\Session::flash('pesan','Keranjang Anda Telah dikosongkan ...');

		return redirect('/');
	}

	public function calculate()
    {
        $quantity = 0;
		$total = 0;

		// print_r($_POST['arrData']);exit;
		// print_r(count($_POST['arrData']));exit;
		// print_r($_POST['arrData'][1]['value']);exit;
		$StoreProductID = $_POST['arrData'][1]['value'];

		/**untuk produk yang punya attributes**/
        if( count($_POST['arrData']) > 2)
        {
            foreach ((object)$_POST['arrData'] as $key => $data) {
				if($key > 2)
				{
					$attVal = viewProductAttributes::select('AttributesName','StoreProductID',DB::raw('sum(TotalPrice) TotalPrice'))
					->where('AttributesName',$data['value'])
					->where('StoreProductID', $StoreProductID)
					->groupBy('AttributesName','StoreProductID')->first();
					(float)$total += (float)$attVal['TotalPrice'];
				}
				
            }
			$total = (float)$total * (float)$_POST['arrData'][0]['value'];
            return response()->json(['total'=>'Rp. ' . (string)number_format($total,2,".",",")]);
        }
		/**Untuk yang tidak punya attributes**/
        if( count($_POST['arrData']) == 2)
        {
			// print_r(count($_POST['arrData']));exit;
			$priceFrom = viewStoreProducts::select('PriceFrom')->where('StoreProductID', $_POST['arrData'][1]['value'])->first();
			// print_r($priceFrom['PriceFrom']);exit;
			$total = (float)$_POST['arrData'][0]['value'] * (float)$priceFrom['PriceFrom'];
            return response()->json(['total'=>'Rp. ' . (string)number_format($total,2,".",",")]);
        }
	}

	public function update_cart()
	{
		// print_r($_POST['arrData']);exit;

		$arrChunk = array_chunk($_POST['arrData'],2);

		// print_r($arrChunk);exit;

		foreach ($arrChunk as $key => $data) {
			$rowId = $data[0]['value'];
			$qty = $data[1]['value'];

			$cartContent = \Cart::get($rowId);
			$StoreProductID = $cartContent->id;

			$dataProduct = viewStoreProducts::where('StoreProductID', $StoreProductID)
						->where('StoreProductStatus', 1)
						->first();
			
			$arrData = [];
			$arrData['qty'] = $qty;
			$arrData['weight'] = $qty * $dataProduct->WeightFrom;		

			\Cart::update($rowId, $arrData);
		}
		
		return response()->json(['result'=>\Cart::content()]);
	}
	
	public function delete_cart()
	{
		$rowId = $_POST['rowId'];

		\Cart::remove($rowId);

		return response()->json(['result'=>\Cart::content()]);
	}

	public function get_city($province)
	{
		// print_r($province);exit;
		$city = PostalCode::where('ProvinceCode', $province)->distinct()->get(['ProvinceCode','City']);
		// print_r($city);exit;
		return response()->json([
			'hasil'=>$city
		]);
	}

	public function get_kecamatan($city)
	{
		// print_r($city);exit;
		$district = PostalCode::where('City', $city)->distinct()->get(['City','District']);
		// print_r($district);exit;
		return response()->json([
			'hasil'=>$district
		]);
	}

	public function get_kelurahan($district)
	{
		// print_r($district);exit;
		$SubDistrict = PostalCode::where('District', $district)->distinct()->get(['District','SubDistrict']);
		// print_r($SubDistrict);exit;
		return response()->json([
			'hasil'=>$SubDistrict
		]);
	}

	public function get_pos($subdistrict)
	{
		// print_r($subdistrict);exit;
		$postalCode = PostalCode::where('SubDistrict', $subdistrict)->distinct()->get(['ID','PostalCode']);
		// print_r($postalCode);exit;
		return response()->json([
			'hasil'=>$postalCode
		]);
	}

	public function add_address(Request $request)
	{
		// print_r(Auth::user()->id);exit;
		// print_r($request->input());exit;

		$isDefault = 0;
		$countAddress = UserAddress::where('UserID', \Auth::user()->id)->where('IsDefault', 1)->get();
		
		if(count($countAddress)==0){$isDefault = 1;}
		
		// print_r($isDefault);exit;

		$id = \Uuid::generate(1);
		UserAddress::insert([
			'UserAddressID'=>$id,
			'UserID'=>\Auth::user()->id,
			'ProvinceCode'=>$request->input('addProvince'),
			'PostalCodeID'=>$request->addPos,
			'Receiver'=>$request->addName,
			'Address'=>$request->addAlamat,
			'ContactNumber'=>$request->addPhone,
			'IsDefault'=>$isDefault	
		]);

		\Session::flash('pesan','Alamat Berhasil Ditambahkan ...');
		return redirect('checkout/index');
	}

	public function set_address($id)
	{
		// print_r($id);exit;

		/* set IsDefault become 0 per UserID */
		$updateAll = DB::table('UserAddress')->where('UserID','=',\Auth::user()->id)->update(array('IsDefault'=>false));
		$updateAll = DB::table('UserAddress')->where('UserAddressID','=',$id)->where('UserID','=',\Auth::user()->id)->update(array('IsDefault'=>true));

		\Session::flash('pesan','Alamat Pengiriman Berhasil Diubah ...');

		return redirect('checkout/index');
	}
	
	public function get_tiki_token(Request $request)
    {
        // print_r(env('TIKI_URL_TOKEN'));exit;
        $MyHelper = new MyHelper();
        $getToken = $MyHelper->get_tiki_token();
        $this->tikiToken = $getToken->response->token;
        // print_r($this->tikiToken);exit;
        return response()->json([
			'result'=>$this->tikiToken
		]);
    }

	public function get_layanan_tiki(Request $request)
	{
		// print_r($request->all());exit;
		$data = array(
			'token' => $request->tikiToken,
			'kode_pos'=>$request->kode_pos 
		);
		// print_r($data);exit;
		$MyHelper = new MyHelper();
		$tikiServices = $MyHelper->get_tiki_service($data);

		// print_r($tikiServices);exit;
		return response()->json([
			'result'=>$tikiServices
		]);
	}

	public function get_layanan_jne(Request $request)
	{
		/*SEMENTARA DEFAULT KEPU SELATAN*/
		$from = 'CGK10000';
		$postalCode = JnePos::where('KodePos','=',$request->kodePos)->select('Dest')->first()['Dest'];
		$thru = JneTarif::where('Area','=',$postalCode)->first();
		
		$weigth = 0;

		foreach (\Cart::content() as $key => $value) {
            $weigth += $value->weigth;
        }

		$data = array(
			'from'=>$from,
			'thru'=>$thru['Area'],
			'weigth'=>$weigth	
		);

		$MyHelper = new MyHelper();
		$jneServices = $MyHelper->get_jne_services($data);

		// print_r($jneServices);exit;
		return response()->json([
			'result'=>$jneServices
		]);
	}
	// public function bayar_guide(){
	// 	$title = 'Petunjuk Pembayaran';
	// 	$prodCategories = ProductCategories::where('Status',1)->get();
    //     $dataMenu = TMenu::where('Status',1)->get();
	// 	// return view('beranda.pembayaran',compact('title','dataMenu','prodCategories'));
	// 	return redirect('/');
	// }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
