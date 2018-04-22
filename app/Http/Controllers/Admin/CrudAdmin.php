<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Http\Requests\StoreMyProfile;
use App\Http\Requests\StoreAdmin;

class CrudAdmin extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vHomeAdmin(){
    	return view('home');
    }

    //MY PROFILE
    public function vMyProfile(){
    	//ambil data
        $key = session('loginAdmin.username');
        $d = Admin::find($key);
    	return view('myProfile',$d);
    }

    public function myProfile($username){
        $d = Admin::find($username);
        return response()->json($d);	
    }

    public function updateMyProfile(StoreMyProfile $r){
        // cek duplikat username
        if($r->key != $r->username){
            $cekUsername = Admin::find($r->username);
            if(isset($cekUsername->username)){
                return response()->json(0);    
            }  
        }

        $d             = Admin::find($r->key);
        $d->username   = $r->username;
        $d->password   = $r->password;
        $d->email      = $r->email;
        $d->save();

        // update session
        $w = ['username' => $r->username, 'password' => $r->password];
        $d = Admin::where($w)->first();
        $r->session()->put('loginAdmin', $d);
        
        return response()->json($d);
    }

    // CRUD admin
    public function vCrudAdmin()
    {
        return view('crudAdmin');
    }

    public function listAdmin()
    {
        $r  = Admin::where([
                            ['username','<>',session('loginAdmin.username')],
                            ['akses','=','0']
                        ])
                        ->orderBy('username', 'asc')
                        ->get();
        return response()->json($r);
    }

    public function detailAdmin($key)
    {
        $d = Admin::find($key);
        return response()->json($d);
    }

    public function deleteAdmin($key)
    {
        $d      = Admin::find($key);
        $r = $d->delete();
        return response()->json($r);
    }

    public function mDeleteAdmin(Request $r){
        $ids = explode(',', $r->ids);
        // delete data
        $rs = Admin::destroy($ids);
        return response()->json($rs);
    }

    public function storeAdmin(StoreAdmin $r)
    {
        // cek duplikat username
        $cekUsername = Admin::find($r->username);
        if(isset($cekUsername->username)){
            return response()->json(0);    
        }  
        // save data
        $admin = new Admin;
        $admin->username    = $r->username;
        $admin->password    = $r->password;
        $admin->email       = $r->email;
        $admin->akses       = $r->akses;
        $admin->save();
        return response()->json(1);
    }

    public function updateAdmin(StoreAdmin $r)
    {
        if($r->key != $r->username){
            $cekUsername = Admin::find($r->username);
            if(isset($cekUsername->username)){
                return response()->json(0);    
            }  
        }
        // save data
        $d              = Admin::find($r->key);
        $d->username    = $r->username;
        $d->password    = $r->password;
        $d->email       = $r->email;
        $d->akses       = $r->akses;
        $d->save();
        return response()->json(1);
    }
}
