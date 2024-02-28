<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        //first-time for make password
        //dd(Hash::make(12345678));
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return view('admin.dashboard');

            }elseif(Auth::user()->user_type == 2){
                return view('editor.dashboard');
            }
        }else{
            return view('auth.login');
        }
        
    }

    //for Login
    public function AuthLogin(Request $request)
    {
        //dd($request->all());
        $remember = !empty($request->remember) ? true: false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return view('admin.dashboard');

            }elseif(Auth::user()->user_type == 2){
                return view('editor.dashboard');
            }
            
        }else{
            return redirect()->back()->with('error','email and password wrong.');
        }
    }

    //for logout
    public function Logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
