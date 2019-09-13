<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Alamat_controller extends Controller
{
    public function edit(){
		$title = 'TokoCetak | Dashboard';
		
    	$dt = \DB::table('alamat')->first();

    	return view('admin.alamat.alamat_edit',compact('title','dt'));
    }

    public function update(Request $request){
    	$this->validate($request,[
    		'alamat'=>'required',
    		'email'=>'required',
    		'nope'=>'required'
    	]);

    	\DB::table('alamat')->update([
    		'alamat_id'=>\Uuid::generate(4),
    		'email'=>$request->email,
    		'nope'=>$request->nope
    	]);

    	\Session::flash('pesan','Alamat berhasil di update');
    	return redirect('admin/alamat');
    }
}
