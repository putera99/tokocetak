<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pesanan_controller extends Controller
{
    public function index(){
    	$title = $title = 'TokoCetak | Dashboard';
    	$data = Pesanan::where('user_id',\Auth::user()->id)->orderBy('tanggal','desc')->get();

    	return view('admin.pesanan.pesanan_index',compact('title','data'));
    }

    public function detail($id){
    	$title = $title = 'TokoCetak | Dashboard';
    	$alamat = Pesanan_alamat::where('pesanan_id',$id)->first();
    	$barangs = Pesanan_barang::where('pesanan_id',$id)->get();

    	return view('admin.pesanan.pesanan_detail',compact('title','alamat','barangs'));
    }
}
