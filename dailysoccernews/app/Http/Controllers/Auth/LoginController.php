<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Category;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        if(Auth::check() && Auth::user()->role->id ==1){
            $this->redirectTo=url('public/admin/dashboard');
        }
        elseif(Auth::check() && Auth::user()->role->id ==2){
           $this->redirectTo=url('author/dashboard');
            
        }
        else{
            return "No access";
        }
        
        $this->middleware('guest')->except('logout');
        
       
    }*/
    public function authenticated($request , $user){
        if($user->role->id==1){
            return redirect('/admin/dashboard');//->route('admin-dashboard');
        }
        elseif($user->role->id==2){
            return redirect('/author/dashboard');//->route('author-dashboard');
        }
         
        else{
                return "No access";
            }
    }
    public function showLoginForm()
        {
            $categories=Category::orderBy('name','ASC')->get();
            return view('auth.login',compact('categories'));
        }

}
