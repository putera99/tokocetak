<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Models\Kategori;

class Kategori_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Kategori::orderBy('nama','asc')->get();

    	return view('admin.kategori.kategori_index',compact('title','data'));
    }

    public function add(){
        $title = 'TokoCetak | Dashboard';

        return view('admin.kategori.kategori_tambah',compact('title'));
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'nama'=>'required',
    	]);

    	$file = $request->file('image');

    	if($file){
    		$nama_gambar = $file->getClientOriginalName();
    		\Image::make(Input::file('image'))->resize(263, 280)->save('uploads/'.$nama_gambar);

    		$kt = new Kategori;
    		$kt->kategori_id = \Uuid::generate(4);
    		$kt->nama = $request->nama;
    		$kt->gambar = $nama_gambar;
    		$kt->save();

    		\Session::flash('pesan','Kategori berhasil ditambah');
    		return redirect('admin/kategori');
    	}else{
    		\Session::flash('pesan','Gambar wajib dimasukkan');
    		return redirect()->back();
    	}
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Kategori::where('kategori_id',$id)->first();

    	return view('admin.kategori.kategori_edit',compact('title','data'));
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'nama'=>'required',
    	]);

    	Kategori::where('kategori_id',$id)->update([
    		'nama'=>$request->nama,
            'updated_at'=>date('Y-m-d H:i:s'),
    	]);

    	$file = $request->file('image');
    	if($file){
    		$nama_gambar = $file->getClientOriginalName();
    		\Image::make(Input::file('image'))->resize(263, 280)->save('uploads/'.$nama_gambar);

    		Kategori::where('kategori_id',$id)->update([
    			'gambar'=>$nama_gambar,
    		]);
    	}

    	\Session::flash('pesan','Kategori berhasil di update');
    	return redirect('admin/kategori');
    }

    public function delete($id){
    	Kategori::where('kategori_id',$id)->delete();

    	\Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/kategori');
    }
}
