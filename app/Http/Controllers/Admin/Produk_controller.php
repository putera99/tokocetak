<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Models\Product;
use App\Models\Product_gambar;
use App\Models\Kategori;

class Produk_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Product::orderBy('created_at','desc')->get();

    	return view('admin.produk.produk_index',compact('title','data'));
    }

    public function aktif(){
        $title = 'TokoCetak | Dashboard';
        $data = Product::where('status',1)->orderBy('created_at','desc')->get();

        return view('admin.produk.produk_index',compact('title','data'));
    }

    public function nonaktif(){
        $title = 'TokoCetak | Dashboard';
        $data = Product::where('status',2)->orderBy('created_at','desc')->get();

        return view('admin.produk.produk_index',compact('title','data'));
    }

    public function habis(){
        $title = 'TokoCetak | Dashboard';
        $data = Product::where('stock','<',1)->orderBy('created_at','desc')->get();

        return view('admin.produk.produk_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';
        $kategori = Kategori::orderBy('nama','asc')->get();
        $warna = \App\Models\Warna::orderBy('nama','asc')->get();
        $ukuran = \App\Models\Ukuran::get();

    	return view('admin.produk.produk_tambah',compact('title','kategori','warna','ukuran'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required',
            'kategori_id'=>'required',
    		'harga_awal'=>'required',
    		'discount'=>'required',
    		'stock'=>'required',
    		'berat'=>'required',
    		'keterangan'=>'required',
    		'status'=>'required',
    	]);

    	$uuid = \Uuid::generate(4);
    	$harga_awal = $request->harga_awal;
    	$discount = $request->discount / 100 * $harga_awal;
    	$harga_akhir = $harga_awal - $discount;

    	Product::insert([
    		'product_id'=>$uuid,
            'kategori_id'=>$request->kategori_id,
    		'nama'=>$request->nama,
    		'harga_awal'=>$harga_awal,
    		'discount'=>$request->discount,
    		'harga_akhir'=>$harga_akhir,
    		'stock'=>$request->stock,
    		'berat'=>$request->berat,
    		'keterangan'=>$request->keterangan,
    		'status'=>$request->status,
    		'user_id'=>\Auth::user()->id,
    		'created_at'=>date('Y-m-d H:i:s'),
    		'updated_at'=>date('Y-m-d H:i:s'),
    	]);

    	$files = $request->file('gambar');
    	if($files){
    		foreach ($files as $key => $file) {
                $nama = $file->getClientOriginalName();
                $path = $file->getRealPath();
                // dd($file);
                \Image::make($file)->resize(363,280)->save('uploads/'.$nama);
                // $oh = \Image::make(public_path().'\uploads/'.$nama)->resize(320, 240)->insert('uploads/'.$nama);
                // \Image::make( $request->file("image[$key]") )->resize( 363,380 )->save( 'uploads/' . $nama );
                // dd($oh);

                \App\Models\Product_gambar::insert([
                    'product_gambar_id'=>\Uuid::generate(4),
                    'nama'=>$nama,
                    'product_id'=>$uuid,
		    		'created_at'=>date('Y-m-d H:i:s'),
		    		'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }
    	}

        $warna_id = $request->warna_id;
        if($warna_id){
            foreach ($warna_id as $key => $wd) {
                \DB::table('product_warna')->insert([
                    'product_warna_id'=>\Uuid::generate(4),
                    'product_id'=>$uuid,
                    'warna_id'=>$wd,
                ]);
            }
        }

        $ukuran_id = $request->ukuran_id;
        if($ukuran_id){
            foreach ($ukuran_id as $key => $ud) {
                \DB::table('product_ukuran')->insert([
                    'product_ukuran_id'=>\Uuid::generate(4),
                    'product_id'=>$uuid,
                    'ukuran_id'=>$ud,
                ]);
            }
        }

    	\Session::flash('pesan','Produk berhasil ditambah');
    	return redirect('admin/produk');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Product::where('product_id',$id)->first();
        $kategori = Kategori::orderBy('nama','asc')->get();
        $warna = \App\Models\Warna::orderBy('nama','asc')->get();
        $ukuran = \App\Models\Ukuran::get();

    	return view('admin.produk.produk_edit',compact('title','data','kategori','warna','ukuran'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
            'nama'=>'required',
            'harga_awal'=>'required',
            'discount'=>'required',
            'stock'=>'required',
            'berat'=>'required',
            'keterangan'=>'required',
            'status'=>'required',
            'kategori_id'=>'required',
        ]);

        $uuid = \Uuid::generate(4);
        $harga_awal = $request->harga_awal;
        $discount = $request->discount / 100 * $harga_awal;
        $harga_akhir = $harga_awal - $discount;

        Product::where('product_id',$id)->update([
            'nama'=>$request->nama,
            'kategori_id'=>$request->kategori_id,
            'harga_awal'=>$harga_awal,
            'discount'=>$request->discount,
            'harga_akhir'=>$harga_akhir,
            'stock'=>$request->stock,
            'berat'=>$request->berat,
            'keterangan'=>$request->keterangan,
            'status'=>$request->status,
            'user_id'=>\Auth::user()->id,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $files = $request->file('gambar');
        if($files){

            \App\Models\Product_gambar::where('product_id',$id)->delete();

            foreach ($files as $key => $file) {
                $nama = $file->getClientOriginalName();
                $path = $file->getRealPath();
                // dd($file);
                \Image::make($file)->resize(363,280)->save('uploads/'.$nama);
                // $oh = \Image::make(public_path().'\uploads/'.$nama)->resize(320, 240)->insert('uploads/'.$nama);
                // \Image::make( $request->file("image[$key]") )->resize( 363,380 )->save( 'uploads/' . $nama );
                // dd($oh);

                \App\Models\Product_gambar::insert([
                    'product_gambar_id'=>\Uuid::generate(4),
                    'nama'=>$nama,
                    'product_id'=>$id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }
        }

        $warna_id = $request->warna_id;
        if($warna_id){
            \DB::table('product_warna')->where('product_id',$id)->delete();
            foreach ($warna_id as $key => $wd) {
                \DB::table('product_warna')->insert([
                    'product_warna_id'=>\Uuid::generate(4),
                    'product_id'=>$id,
                    'warna_id'=>$wd,
                ]);
            }
        }

        $ukuran_id = $request->ukuran_id;
        if($ukuran_id){
            \DB::table('product_ukuran')->where('product_id',$id)->delete();
            foreach ($ukuran_id as $key => $ud) {
                \DB::table('product_ukuran')->insert([
                    'product_ukuran_id'=>\Uuid::generate(4),
                    'product_id'=>$id,
                    'ukuran_id'=>$ud,
                ]);
            }
        }

        \Session::flash('pesan','Produk berhasil diubah');
        return redirect('admin/produk');
    }

    public function delete($id){
        Product::where('product_id',$id)->delete();

        \Session::flash('pesan','Data berhasil dihapus');
        return redirect('admin/produk');
    }
}
