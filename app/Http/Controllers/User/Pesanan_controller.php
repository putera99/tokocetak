<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\Pesanan;
use App\Models\Pesanan_alamat;
use App\Models\Pesanan_barang;
use App\Models\Pesanan_status;
use App\Models\ProductCategories;
use App\Models\TMenu;

class Pesanan_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Riwayat Pesanan';
		$data = Pesanan::where('user_id',\Auth::user()->id)->orderBy('tanggal','desc')->get();
		$prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
		// print_r($data);exit;
    	return view('user.pesanan.pesanan_index',compact('title','data','prodCategories','dataMenu'));
    }

    public function detail($id){
    	$title = 'TokoCetak | Detail Pesanan';
    	$alamat = Pesanan_alamat::where('pesanan_id',$id)->first();
		$barangs = Pesanan_barang::where('pesanan_id',$id)->get();
		$prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
		// print_r($barangs[0]);exit;
    	return view('user.pesanan.pesanan_detail',compact('title','alamat','barangs','prodCategories','dataMenu'));
    }

    public function konfirmasi(){
    	$title = 'Sangcahaya.com | Konfirmasi Pesanan';
    	$data = Pesanan::where('user_id',\Auth::user()->id)->where('status',2)->orderBy('tanggal','desc')->get();

    	return view('user.pesanan.pesanan_konfirmasi',compact('title','data'));
    }

    public function konfirmasi_detail($id){
    	$title = 'Sangcahaya.com | Konfirmasi Pesanan';
    	$data = Pesanan::orderBy('tanggal','desc')->get();
    	$pesanan_id = $id;

    	return view('user.pesanan.pesanan_konfirmasi_detail',compact('title','data','pesanan_id'));
    }

    public function konfirmasi_proses(Request $request, $id){
    	$file = $request->file('image');

    	if($file){
    		$nama_gambar = $file->getClientOriginalName();
    		\Image::make(Input::file('image'))->resize(263, 280)->save('uploads/'.$nama_gambar);

    		\DB::transaction(function() use($id,$nama_gambar){
                \DB::table('pesanan_konfirmasi')->insert([
                    'pesanan_konfirmasi_id'=>\Uuid::generate(4),
                    'pesanan_id'=>$id,
                    'gambar'=>$nama_gambar
                ]);

                \DB::table('pesanan')->where('pesanan_id',$id)->update([
                    'status'=>1,
                ]);
            });

    		\Session::flash('pesan','Bukti Pembayaran berhasil dikirim');
    		return redirect('user/pesanan/konfirmasi');
    	}else{
    		\Session::flash('pesan','Gambar wajib dimasukkan');
    		return redirect()->back();
    	}
    }
}
