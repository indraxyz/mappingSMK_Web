<?php

namespace App\Http\Controllers\Android;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sekolah_Like;
use App\Komentar;
use App\Http\Requests\StoreUserAnd;

class UserC extends Controller
{

    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function detailUser($id){
        $d = User::find($id);
        return response()->json($d);	
    }

    public function saveNew(Request $r){

        if($r->id == ''){
            return response()->json(0);
        }

        // cek duplikat id
        $cekId = User::find($r->id);
        if(isset($cekId->id)){
            return response()->json(2);    
        }  

    	// save data
    	$user = new User ;
        $user->id    		    = $r->id;
        $user->password    	    = $r->password;
        $user->email    	    = $r->email;
        $user->nama             = $r->nama;
        $user->nik              = $r->nik;
        $user->tempat_lahir     = $r->tempat_lahir;
        $user->tgl_lahir        = $r->tgl_lahir;
        $user->kelamin          = $r->kelamin;
        $user->pekerjaan        = $r->pekerjaan;
        $user->alamat_lengkap   = $r->alamat_lengkap;
        $user->tlp              = $r->tlp;
        // $user->foto             = $r->foto;
        $user->save();
        return response()->json(1);

    }

    public function updateUser(Request $r){

        // id require
        if($r->id == ''){
            return response()->json(0);
        }

        // cek duplikat username
        if($r->id != $r->key){
            $cekId = User::find($r->id);
            if(isset($cekId->id)){
                return response()->json(2);    
            }  
        }

        // update data
        $user                   = User::find($r->key);
        $user->id               = $r->id;
        $user->password         = $r->password;
        $user->email            = $r->email;
        $user->nama             = $r->nama;
        $user->nik              = $r->nik;
        $user->tempat_lahir     = $r->tempat_lahir;
        $user->tgl_lahir        = $r->tgl_lahir;
        $user->kelamin          = $r->kelamin;
        $user->pekerjaan        = $r->pekerjaan;
        $user->alamat_lengkap   = $r->alamat_lengkap;
        $user->tlp              = $r->tlp;
        $user->save();

        // update session
        $user                   = User::find($r->id);
        $r->session()->put('loginUser', $user);

        return response()->json(1);

    }

    public function getUserLike($idSekolah){
        // cek data
        $w = ['id_sekolah' => $idSekolah, 'id_user' => session('loginUser.id')];
        $d = Sekolah_Like::where($w)->first();
        if(isset($d->id)){ // sudah like
            return response()->json($d);
        }else{
            return response()->json(0);
        } 

    }

    public function sendLike(Request $r){
        // save data
        $d = new Sekolah_Like;
        $d->waktu           = date('Y-m-d H:i:s');
        $d->id_sekolah      = $r->idSekolah;
        $d->id_user         = session('loginUser.id');
        $d->save();

        // return data
        $w = ['id_sekolah' => $r->idSekolah, 'id_user' => session('loginUser.id')];
        $d = Sekolah_Like::where($w)
                            ->orderBy('waktu', 'desc')
                            ->first();
                            
        return response()->json($d);
    }

    public function deleteUserLike($key)
    {
        $d      = Sekolah_Like::find($key);
        $r      = $d->delete();
        return response()->json(1);
    }

    public function countUserLike($id){
        $d = Sekolah_Like::where('id_sekolah', $id)->count();
        return response()->json($d);
    }

    public function getKomentar ($id){
        $d = Komentar::where('id_sekolah', $id)
                    ->orderBy('waktu', 'asc')
                    ->get();
        return response()->json($d);
    }

    public function getLike($id)
    {
        $d = Sekolah_Like::where('id_sekolah', $id)
                    ->orderBy('waktu', 'asc')
                    ->get();
        return response()->json($d);
    }


    public function sendKomentar(Request $r){
        // save data
        $d = new Komentar;
        $d->teks            = $r->teks;
        $d->waktu           = date('Y-m-d H:i:s');;
        $d->id_user         = session('loginUser.id');
        $d->id_sekolah      = $r->id_sekolah;            
        $d->save();

        $d = Komentar::where('id_user', session('loginUser.id'))
                        ->orderBy('waktu', 'desc')
                        ->first();
        return response()->json($d);
    }

    public function countKomentar($id){
        $d = Komentar::where('id_sekolah', $id)->count();
        return response()->json($d);
    }

}
