<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Products;
use App\Models\TMenu;
use App\Models\viewStoreProducts;
use App\Models\viewProductAttributes;
use App\Models\ProductCategories;
use App\Models\InfoProductLastView;
use App\Models\InfoProductFlashSell;

use Cart;
use Session;
use Wishlist;
use MyHelper;

class Beranda_controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public $tikiToken;

    public function index(){
        // print_r(\Auth::getRecallerName());exit;
        // print_r(Session::getId());exit;
        // print_r(\Auth::user());exit;
        
        // print_r($this->tikiToken);exit;

    	$title = 'Tokocetak.id | Homepage';
    	$banner = \App\Models\Banner::first();
        $flashSale = \App\Models\InfoProductFlashSell::orderBy('Sorting','asc')->get();
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
    	
        $kategori = \App\Models\ProductCategories::get();
    	$unggulan = \App\Models\InfoProductHotes::orderBy('Sorting','asc')->get();
    	$slider = \App\Models\BannerSlider::orderBy('Sorting','asc')->get();
    	$best_seller = \App\Models\InfoProductBestSeller::get();
        $produk = \App\Models\viewStoreProducts::where('StoreProductStatus',1)->orderBy('created_at','desc')->paginate(15);
        $hitung = count(\App\Models\viewStoreProducts::where('StoreProductStatus',1)->get());
        // print_r(Auth::check());exit;
    	return view('beranda.layouts1.master',compact('title','banner','flashSale','kategori','unggulan','slider','best_seller','produk','hitung','prodCategories','dataMenu'));
    }

    public function detail($s, $p, $t){
        $title = viewStoreProducts::where('ProductName',str_replace('-',' ',$p))->value('ProductName');
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        $data = viewStoreProducts::where('StoreName', str_replace('-',' ', $s))
                ->where('ProductName', str_replace('-',' ', $p))
                ->where('Title', str_replace('-',' ', $t))
                ->where('StoreProductID',$_GET['id'])
                ->where('StoreProductStatus', 1)
                ->first();
        $headerColumn = viewProductAttributes::select('ParentAttributes')->where('StoreProductID', $_GET['id'])->groupBy('ParentAttributes')->get();
        // print_r($headerColumn);exit;   
        $hitung = count(\App\Models\viewStoreProducts::where('StoreProductStatus',1)->where('ProductName',str_replace('-',' ', $p))->get());

        // Recent_view::insert([
        //     'recent_view_id'=>\Uuid::generate(4),
        //     'product_id'=>$id,
        //     'created_at'=>date("Y-m-d H:i:s"),
        // ]);

        return view('beranda.detail',compact('title','data','hitung','prodCategories','dataMenu','headerColumn'));
    }

    public function kategori($id){
        $title = ProductCategories::where('Name',str_replace('-',' ',$id))->value('Name');
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        $produk = viewStoreProducts::where('CategoryName',str_replace('-',' ',$id))->where('StoreProductStatus',1)->paginate(15);
        $hitung = count(\App\Models\viewStoreProducts::where('StoreProductStatus',1)->where('CategoryName',str_replace('-',' ',$id))->get());
        // print_r($produk[0]);exit;
        return view('beranda.home',compact('title','produk','hitung','prodCategories','dataMenu'));
    }

    public function cari(Request $request){
        $title = $request->keywod;
        $key = $request->keywod;
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        $produk = viewStoreProducts::where('ProductName','like','%'.$key.'%')
        ->orWhere('Tag','like','%'.$key.'%')
        ->orWhere('CategoryName','like','%'.$key.'%')
        ->orWhere('CategoryImage','like','%'.$key.'%')
        ->where('StoreProductStatus',1)->paginate(15);
        $hitung = count(\App\Models\viewStoreProducts::where('ProductName','like','%'.$key.'%')
        ->orWhere('Tag','like','%'.$key.'%')
        ->orWhere('CategoryName','like','%'.$key.'%')
        ->orWhere('CategoryImage','like','%'.$key.'%')
        ->where('StoreProductStatus',1)->get());
        // if($request->kategori_id == 0){
        //     $kategori_id = $request->kategori_id;
        //     $data = Product::where('kategori_id',$kategori_id)->where('nama','like','%'.$keyword.'%')->where('status',1)->get();
        // }else{
        //     $data = Product::where('nama','like','%'.$keyword.'%')->where('status',1)->get();
        // }
        return view('beranda.home',compact('title','produk','hitung','prodCategories','dataMenu'));
    }

    public function update_wishlist()
    {
        if(\Auth::user()){
            $StoreProductID = $_POST['StoreProductID'];

            // get item from user_id
            $dataWishlist = Wishlist::getWishListItem($StoreProductID, \Auth::user()->id);

            if($dataWishlist){
                try {
                    // remove item from user_id
                    Wishlist::removeByItem($StoreProductID, \Auth::user()->id);
                    return response()->json([
                        'success'=>11,
                        'result'=>'Item dihapus dari favorit'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success'=>0,
                        'result'=>$e->getMessage()
                    ]);
                }
                
            }
            else{
                try {
                    // add item to user_id
                    Wishlist::add($StoreProductID, \Auth::user()->id);

                    return response()->json([
                        'success'=>1,
                        'result'=>'Item berhasil ditambahkan ke favorit'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success'=>0,
                        'result'=>$e->getMessage()
                    ]);
                }
            }
        }
        else{
            return response()->json([
                'success'=>999,
                'result'=>'Silahkan login telebih dahulu'
            ]);
        }  
    }

    public function wishlist()
    {
        $title = 'TokoCetak | Wishlist';
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        $userID = \Auth::user()->id;
        $userWishlist = \Wishlist::getUserWishList($userID);

        $arrData = [];
        foreach ($userWishlist as $key => $wishlist) {
            $arrData[$key] = $wishlist->item_id;
        }
        $produk = viewStoreProducts::whereIn('StoreProductID', $arrData)
                ->orderBy('created_at','desc')
                ->paginate(10);
        return view('user.wishlist',compact('title','produk','prodCategories','dataMenu'));
    }
    
    public function logout(){
        // \Cart::restore(\Auth::user()->email); 

        \Auth::logout();

    	return redirect('/');
    }
}
