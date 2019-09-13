<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ukuran;

class Ukuran_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';
    	$data = Ukuran::get();

    	return view('admin.ukuran.ukuran_index',compact('title','data'));
    }

    public function add(){
    	$title = 'TokoCetak | Dashboard';

    	return view('admin.ukuran.ukuran_tambah',compact('title'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required'
    	]);

    	Ukuran::insert([
    		'ukuran_id'=>\Uuid::generate(4),
    		'nama'=>$request->nama,
    	]);

    	\Session::flash('pesan','Ukuran berhasil ditambah');
    	return redirect('admin/ukuran');
    }

    public function edit($id){
    	$title = 'TokoCetak | Dashboard';
    	$data = Ukuran::where('ukuran_id',$id)->first();

    	return view('admin.ukuran.ukuran_edit',compact('title','data'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'nama'=>'required',
    	]);

    	Ukuran::where('ukuran_id',$id)->update([
    		'nama'=>$request->nama,
    	]);

    	\Session::flash('pesan','Ukuran berhasil di update');
    	return redirect('admin/ukuran');
    }

    public function delete($id){
    	Ukuran::where('ukuran_id',$id)->delete();

    	\Session::flash('pesan','Ukuran berhasil di hapus');
    	return redirect('admin/ukuran');
    }
}
