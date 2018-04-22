<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\StoreUser;

class RudUser extends Controller
{
	function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vManageUser()
    {
    	return view('rudUser');
    }

    public function listUser()
    {
    	$r  = User::orderBy('id','asc')->get();
        return response()->json($r);
    }

    public function detailUser($id)
    {
    	$d = User::find($id);
        return response()->json($d);
    }

    public function deleteUser($id)
    {
        $d      = User::find($id);
        $r = $d->delete();
        return response()->json($r);
    }

    public function mDeleteUser(Request $r){
        $ids = explode(',', $r->ids);
        // delete data
        $rs = User::destroy($ids);
        return response()->json($rs);
    }

    public function updateUser(StoreUser $r)
    {
        // cek duplikat id
        if($r->key != $r->id){
            $cekId = User::find($r->id);
            if(isset($cekId->id)){
                return response()->json(0);    
            }  
        }
        // save data
        $d                  = User::find($r->key);
        $d->id              = $r->id;
        $d->password        = $r->password;
        $d->email           = $r->email;
        $d->nama            = $r->nama;
        $d->nik             = $r->nik;
        $d->tempat_lahir    = $r->tempat_lahir;
        $d->tgl_lahir       = $r->tgl_lahir;
        $d->kelamin         = $r->kelamin;
        $d->pekerjaan       = $r->pekerjaan;
        $d->alamat_lengkap  = $r->alamat_lengkap;
        $d->tlp             = $r->tlp;
        $d->save();
        return response()->json(1);
    }
}
