<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Best_seller;

class Best_seller_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Best_seller::get();

    	return view('admin.best_seller.best_seller_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    	return view('admin.best_seller.best_seller_tambah',compact('title','data'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'product_id'=>'required',
    	]);

    	Best_seller::insert([
    		'best_seller_id'=>\Uuid::generate(4),
    		'product_id'=>$request->product_id,
    	]);

    	\Session::flash('pesan','Data berhasil ditambah');
    	return redirect('admin/best-seller');
    }

    // public function edit($id){
    // 	$title = 'Edit Data';
    // 	$data = Best_seller::where('best_seller_id',$id)->first();
    // 	$produk = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    // 	return view('admin.featured.featured_edit',compact('title','data','produk'));
    // }

    // public function update(Request $request,$id){
    // 	$this->validate($request,[
    // 		'product_id'=>'required',
    // 	]);

    // 	Featured::where('featured_id',$id)->update([
    // 		'product_id'=>$request->product_id,
    // 		'urutan'=>$request->urutan,
    // 	]);

    // 	\Session::flash('pesan','Data berhasil di Update');
    // 	return redirect('admin/featured');
    // }

    public function delete($id){
    	Best_seller::where('best_seller_id',$id)->delete();

    	\Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/best-seller');
    }
}
