<?php

namespace App\Http\Controllers\Android;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LoginC extends Controller
{
    // construct function to set time zone
	function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function sendToken(){
        return response()->json(csrf_token());   
    }

    public function getSession(){
        return response()->json(session('loginUser'));
    }

    // login
    public function login(Request $r){
        $w = ['id' => $r->username, 'password' => $r->password];
        $d = User::where($w)->first();
        if(isset($d->id) && isset($d->password)){ // berhasil login
            $r->session()->put('loginUser', $d);
            $this->lastLogin($d->id);
            return response()->json(1);
        }else{  // gagal login
            return response()->json(0);
        }
    }

    // last login
    public function lastLogin($key){
        $d = User::find($key);
        $d->last_login  = date('Y-m-d H:i:s');
        $d->timestamps = false;
        $d->save();
    }

    // logout
    public function logout(Request $r){
        $this->lastLogin(session('loginUser.id'));
        $r->session()->flush();
        return response()->json(1);
    }

}
