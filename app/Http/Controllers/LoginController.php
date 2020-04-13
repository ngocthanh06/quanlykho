<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    
    public function index(){
        return view('login');
    }

    public function postIndex(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($data)){
            return redirect()->intended('listCategory');
        }
        return back()->withInput()->with('error', 'Sai tên đăng nhập hoặc mật khẩu');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->intended('login');
    }
}
