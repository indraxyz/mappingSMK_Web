<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;

class LoginAdmin extends Controller
{
    // construct function to set time zone
	function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    //vlogin
    function vLogin(){
        return view('login');
    }

    // login
    public function login(Request $r){
        $w = ['username' => $r->username, 'password' => $r->password];
        $d = Admin::where($w)->first();
        if(isset($d->username) && isset($d->password)){ // berhasil login
            $r->session()->put('loginAdmin', $d);
            $this->lastLogin($d->username);
            return response()->json(1);
        }else{  // gagal login
            return response()->json(0);
        }
    }

    // logout
    public function logout(Request $r){
        $this->lastLogin(session('loginAdmin.username'));
        $r->session()->flush();
        return redirect('vLoginAdmin');
    }

    // last login
    public function lastLogin($key){
        $d = Admin::find($key);
        $d->last_login  = date('Y-m-d H:i:s');
        $d->timestamps = false;
        $d->save();
    }

}
