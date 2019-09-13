<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Beranda_controller extends Controller
{
    public function index(){
    	$title = 'TokoCetak | Dashboard';

    	return view('admin.beranda.beranda_index',compact('title'));
    }

    public function keluar(){
    	\Auth::logout();

    	return redirect('/');
    }
}
