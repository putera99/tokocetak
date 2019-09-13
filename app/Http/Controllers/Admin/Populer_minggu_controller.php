<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Populer_minggu;
use App\Models\Product;

class Populer_minggu_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Populer_minggu::orderBy('urutan','asc')->get();

    	return view('admin.populer_minggu.populer_minggu_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Product::where('stock','>',0)->where('status',1)->get();

    	return view('admin.populer_minggu.populer_minggu_tambah',compact('title','data'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Populer_minggu::insert([
    		'populer_minggu_id'=>\Uuid::generate(4),
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan,
    		'created_at'=>date('Y-m-d H:i:s'),
    		'updated_at'=>date('Y-m-d H:i:s'),
    	]);

    	\Session::flash('pesan','Data berhasil ditambah');
    	return redirect('admin/populer-minggu');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$produk = Populer_minggu::where('populer_minggu_id',$id)->first();
    	$data = Product::where('stock','>',0)->where('status',1)->get();

    	return view('admin.populer_minggu.populer_minggu_edit',compact('title','data','produk'));
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Populer_minggu::where('populer_minggu_id',$id)->update([
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan
    	]);

    	\Session::flash('pesan','Data berhasil di Update');
    	return redirect('admin/populer-minggu');
    }

    public function delete($id){
    	Populer_minggu::where('populer_minggu_id',$id)->delete();

    	\Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/populer-minggu');
    }
}
