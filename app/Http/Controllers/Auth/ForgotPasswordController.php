<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

use App\Models\TMenu;
use App\Models\ProductCategories;

use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm(Request $request)
    {

        $title = 'TokoCetak | Login';
        $token = $request->token;
        $email = $request->email;
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        if($token=='')
        {
            return view('auth.passwords.email');
        }
        else{
            return view('auth.passwords.reset', ['title'=>$title,'prodCategories'=>$prodCategories,'dataMenu'=>$dataMenu,'token'=>$token,'email'=>$email]);
        }

    }

}
