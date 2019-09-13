<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Featured;
use App\Models\Product;

class Featured_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Featured::orderby('urutan','asc')->get();

    	return view('admin.featured.featured_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    	return view('admin.featured.featured_tambah',compact('title','data'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Featured::insert([
    		'featured_id'=>\Uuid::generate(4),
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan,
    	]);

    	\Session::flash('pesan','Data berhasil ditambah');
    	return redirect('admin/featured');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Featured::where('featured_id',$id)->first();
    	$produk = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    	return view('admin.featured.featured_edit',compact('title','data','produk'));
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Featured::where('featured_id',$id)->update([
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan,
    	]);

    	\Session::flash('pesan','Data berhasil di Update');
    	return redirect('admin/featured');
    }

    public function delete($id){
    	Featured::where('featured_id',$id)->delete();

    	\Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/featured');
    }
}
