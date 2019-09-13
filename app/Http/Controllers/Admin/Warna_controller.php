<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Warna;
use Uuid;

class Warna_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Warna::orderBy('nama','asc')->get();

    	return view('admin.warna.warna_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';

    	return view('admin.warna.warna_tambah',compact('title'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required',
    		'kode'=>'required',
    	]);

    	Warna::insert([
    		'warna_id'=>Uuid::generate(4),
    		'nama'=>$request->nama,
    		'kode'=>$request->kode,
    	]);

    	\Session::flash('pesan','Warna berhasil ditambah');
    	return redirect('admin/warna');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Warna::where('warna_id',$id)->first();

    	return view('admin.warna.warna_edit',compact('title','data'));
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'nama'=>'required',
    		'kode'=>'required',
    	]);

    	Warna::where('warna_id',$id)->update([
    		'nama'=>$request->nama,
    		'kode'=>$request->kode,
    	]);

    	\Session::flash('pesan','Warna berhasil diubah');
    	return redirect('admin/warna');
    }

    public function delete($id){
    	Warna::where('warna_id',$id)->delete();

    	\Session::flash('pesan','Warna berhasil dihapus');
    	return redirect('admin/warna');
    }
}
