<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Banner_slider;

class Banner_slider_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';

    	$data = Banner_slider::orderby('urutan','asc')->get();

    	return view('admin.banner_slider.banner_slider_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';

    	$data = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    	return view('admin.banner_slider.banner_slider_tambah',compact('title','data'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Banner_slider::insert([
    		'banner_slider_id'=>\Uuid::generate(4),
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan,
    	]);

    	\Session::flash('pesan','Data berhasil ditambah');
    	return redirect('admin/banner-slider');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';

    	$data = Banner_slider::where('banner_slider_id',$id)->first();
    	$produk = Product::where('stock','>',0)->where('status',1)->orderBy('nama','asc')->get();

    	return view('admin.banner_slider.banner_slider_edit',compact('title','data','produk'));
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'product_id'=>'required',
    		'urutan'=>'required',
    	]);

    	Banner_slider::where('banner_slider_id',$id)->update([
    		'product_id'=>$request->product_id,
    		'urutan'=>$request->urutan,
    	]);

    	\Session::flash('pesan','Data berhasil di Update');
    	return redirect('admin/banner-slider');
    }

    public function delete($id){
    	Banner_slider::where('banner_slider_id',$id)->delete();

    	\Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/banner-slider');
    }
}
