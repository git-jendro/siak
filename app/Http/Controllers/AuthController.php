<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Auth::guard('staff')->user());
        return view('login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Harap masukan username !',
            'password.required' => 'Harap masukan password !'
        ]);
        if (auth()->attempt(array('username' => $request->username, 'password' => $request->password))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
        // if (Auth::guard('staff')->attempt(array('username' => $request->username, 'password' => $request->password))) {
        //     $details = Auth::guard('staff')->user();
        //     $user = $details['original'];  
        //     if(!auth()->guard('staff')->check()){
        //         dd('gagal login');
        //     } else {
        //         dd('bisa login');
        //     }
        //     dd(Auth::user()->name->check());
        //     return redirect()->route('dashboard');
        // } else {
        //     return redirect()->route('login')->with('error','Username atau Password salah !');
        // }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
