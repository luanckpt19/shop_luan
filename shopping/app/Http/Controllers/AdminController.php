<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;


class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (Auth::check()){
            return redirect()->to('home');
        }
        return view('login');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }


    public function postLoginAdmin(Request $request)
    {
        $remember = $request -> has('remember_me') ? true : false ;
       if (Auth::attempt([
           'email' => $request -> email,
           'password' => $request -> password
       ],$remember)){
           return redirect()->to('home');

       }
    }

}
