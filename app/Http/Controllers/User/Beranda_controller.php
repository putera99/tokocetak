<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

use App\User;
use App\Models\Products;
use App\Models\TMenu;
use App\Models\viewStoreProducts;
use App\Models\viewProductAttributes;
use App\Models\ProductCategories;
use App\Models\InfoProductLastView;
use App\Models\UserAddress;
use Response;

use Config;
use Session;
use Wishlist;

class Beranda_controller extends Controller
{
    public function index(){
    	$title = 'Tokocetak.id | Homepage';
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
    	return view('user.profile',compact('title','prodCategories','dataMenu'));
    }

    public function settings()
    {
        $title = 'Tokocetak.id | Settings';
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
    	return view('user.settings',compact('title','prodCategories','dataMenu'));
    }

    public function address_list()
    {
        $query = UserAddress::with('provinsi')->with('postal_code')->where('UserID', \Auth::user()->id)->select('*')->get();

        // print_r(datatables()->of($query)->addIndexColumn()->make(true));
        // print_r($query[0]->provinsi->Name);exit;
        if(request()->ajax()){
            return datatables()->of($query)
            ->addColumn('action', function ($query) {
                return '<a href="edit_address?id='.$query->UserAddressID.'" class="btn btn-sm btn-primary">Ubah</a>';
            })
            ->addIndexColumn()
            ->make(true);
            // return datatables()->eloquent($query)->addIndexColumn()->make(true);
            // return datatables()->eloquent($query)->addIndexColumn()->make(true);
        }

        return view('user.addess_list');
    }

    public function edit_address(Request $request)
    {
        // print_r($request->input());exit;
        $title = 'Tokocetak.id | Settings';
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        $userAddressID = $request->input('id');
        $userAddress = UserAddress::where('UserAddressID', $userAddressID)->first();

        // print_r($userAddress->provinsi['Name']);exit;

        return view('user.edit_address', compact('title','dataMenu','prodCategories','userAddress'));
    }

    public function save_address(Request $request)
    {
        $this->validate($request,[
			'_token'=>'required',
			'nama1'=>'required',
			'addProvince'=>'required',
			'addCity'=>'required',
			'addKecamatan'=>'required',
			'addKelurahan'=>'required',
			'addPos'=>'required',
            'nope'=>'required',
            'alamat'=>'required'
		]);
		
        // print_r($request->input());exit;
        $userID = \Auth::user()->id;
        $userAddressID = !empty($request->input('UAID')) ? $request->input('UAID') :null;
        $time = date('Y-m-d h:i:s');
        
        // print_r($time);exit;

        if($userAddressID){
            // print_r("A");exit;
            $updateAll = DB::table('UserAddress')->where('UserID','=',$userID)->update(array('IsDefault'=>false));
            $updateAll = DB::table('UserAddress')->where('UserAddressID','=',$userAddressID)->where('UserID','=',$userID)
                ->update(array(
                    'IsDefault'=>true,
                    'ProvinceCode'=>$request->input('addProvince'),
                    'Receiver'=>$request->input('nama1'),
                    'Address'=>$request->input('alamat'),
                    'ContactNumber'=>$request->input('nope'),
                    'PostalCodeID'=>$request->input('addPos'),
                    'updated_at'=>$time
                ));
            
            \Session::flash('pesan','Alamat berhasil diperbaharui ...');

            return redirect('settings');
        }
        else{
            // print_r('B');exit;
            $updateAll = DB::table('UserAddress')->where('UserID','=',\Auth::user()->id)->update(array('IsDefault'=>false));
            
            $id = \Uuid::generate(1);
            UserAddress::insert([
                'UserAddressID'=>$id,
                'UserID'=>$userID,
                'ProvinceCode'=>$request->input('addProvince'),
                'PostalCodeID'=>$request->input('addPos'),
                'Receiver'=>$request->input('nama1'),
                'Address'=>$request->input('alamat'),
                'ContactNumber'=>$request->input('nope'),
                'IsDefault'=>false,
                'created_at'=>$time	
            ]);

            \Session::flash('pesan','Alamat berhasil ditambahkan ...');

            return redirect('settings');
        }
    }

    public function save_birthdate(Request $request)
    {
        // print_r($request->input());exit;
        $userID = \Auth::user()->id;
        $time = date('Y-m-d h:i:s');
        $update = DB::table('users')->where('id','=',$userID)
            ->update(array(
                'BirthDate'=>$request->birthDate,
                'updated_at'=>$time
            ));
            
        \Session::flash('pesan','Tanggal Lahir Berhasil Ditambahkan ...');

        return redirect('settings');
    }

    public function save_gender(Request $request)
    {
        // print_r($request->input('optradio'));exit;
        $userID = \Auth::user()->id;
        $time = date('Y-m-d h:i:s');
        $update = DB::table('users')->where('id','=',$userID)
            ->update(array(
                'gender'=>$request->optradio,
                'updated_at'=>$time
            ));
            
        \Session::flash('pesan','Jenis Kelamin Berhasil Ditambahkan ...');

        return redirect('settings');
    }

    public function change_password(Request $request)
    {
        // print_r($request->input('arrData')[0]['value']);exit;
        
        $email = $request->input('arrData')[0]['value'];
        $oldPassword = $request->input('arrData')[1]['value'];
        $password = $request->input('arrData')[2]['value'];
        $konfPassword = $request->input('arrData')[3]['value'];

        // Create a new MessageBag instance.
        $errors = new MessageBag;
        $userID = \Auth::user()->id;
        $user = User::findOrFail($userID);
        
        // print_r(Hash::make($password).' - '. Auth::user()->password);exit;
        if(\Auth::user()->email <> $email){
            return response()->json(['error' => ['Email tidak valid'] ]);
        }

        else if (!Hash::check($oldPassword, \Auth::user()->password)) {
            return response()->json(['error' => ['The old password does not match our records.'] ]);
        }

        else if($konfPassword <> $password){
            return response()->json(['error' => ['Konfirmasi Password harus sama dengan password baru'] ]);
        }
        else{
            try {
                $user->fill([
                    'password' => Hash::make($password)
                ])->save();
    
                return response()->json(['success' => ['Password berhasil diubah']]);

            } catch (\Exception $th) {
                return response()->json(['error' => $th->getMessage()]);
            }
                
        }
    }
}

