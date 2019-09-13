<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use App\models\Product;

class Banner_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Banner::first();

    	return view('admin.banner.banner_index',compact('title','data'));
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Banner::where('banner_id',$id)->first();
    	$produk = Product::where('status',1)->where('stock','>',0)->orderBy('nama','asc')->get();

    	return view('admin.banner.banner_edit',compact('title','data','produk'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'product_id'=>'required',
    	]);

    	Banner::where('banner_id',$id)->update([
    		'product_id'=>$request->product_id,
    	]);

    	\Session::flash('pesan','Data berhasil di Update');
    	return redirect('admin/banner');
    }
}
