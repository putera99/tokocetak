<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

use App\Models\TMenu;
use App\Models\ProductCategories;

use Config;
use DB;
use Cart;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $title = 'TokoCetak | Login';
        $prodCategories = ProductCategories::where('Status',1)->get();
        $dataMenu = TMenu::where('Status',1)->get();
        return view('auth.login', ['title'=>$title,'prodCategories'=>$prodCategories,'dataMenu'=>$dataMenu]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // public function login(Request $request)
    // {
    //     $rememberMe = false;
    //     if (isset($request->remember)) {
    //         $rememberMe = true;
    //     }

    //     $this->validateLogin($request);
    //     $credentials = [ 'email' => $request->email , 'password' => $request->password];

    //     if(Auth::attempt($credentials,$rememberMe)){ 
    //         // $cartData = \Cart::content();
    //         // print_r(\Cart::store(\Auth::user()->id));exit;
    //         \Cart::store(\Auth::user()->email); 
    //         return redirect('/');
    //     }

    // }

    // protected function sendLoginResponse(Request $request) {  
    //     // print_r($request->input());exit;
    //     $customRememberMeTimeInMinutes = 1;  
    //     $rememberTokenCookieKey = Auth::getRecallerName();  
    //     Cookie::queue($rememberTokenCookieKey, Cookie::get($rememberTokenCookieKey), $customRememberMeTimeInMinutes);  
    //     $request->session()->regenerate();  
    //     $this->clearLoginAttempts($request);  
    //     return $this->authenticated($request, $this->guard()->user())  
    //         ?: redirect()->intended($this->redirectPath());  
    // }  
    
}
