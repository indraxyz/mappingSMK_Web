<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sekolah;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CrudSekolah extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vCrudSekolah()
    {
    	return view('crudSekolah');
    }

    public function listSekolah()
    {
    	$r  = Sekolah::orderBy('nama','asc')->get();
        return response()->json($r);
    }

    public function detailSekolah($key)
    {
        $d = Sekolah::find($key);
        return response()->json($d);
    }

    public function deleteSekolah($key)
    {
        $d      = Sekolah::find($key);
        $r = $d->delete();
        unlink(public_path('img/sekolah/'.$d->foto));

        return response()->json($r);
    }

    public function mDeleteSekolah(Request $r){
        $ids = explode(',', $r->ids);
        // delete data
        $rs = Sekolah::destroy($ids);
        return response()->json($rs);
    }

    public function storeSekolah(Request $r)
    {

        // save data
        $d = new Sekolah;
        $d->nama        = $r->nama;
        $d->alamat      = $r->alamat;
        $d->email       = $r->email;
        $d->tlp         = $r->tlp;
        $d->akreditas   = $r->akreditas;
        $d->website     = $r->website;
        $d->deskripsi       = $r->deskripsi;
        $d->kep_sek         = $r->kep_sek;
        $d->status_mutu     = $r->status_mutu;
        $d->sertifikasi_iso = $r->sertifikasi_iso;
        $d->rayon           = $r->rayon;
        $d->lat             = $r->lat;
        $d->long            = $r->long;

        // upload foto
        $namaFoto   = $r->email.date('Y-m-d H-i-s').'.'.$r->foto->extension();
        $r->file('foto')->move('img/sekolah',$namaFoto);
        // save foto
        $d->foto       = $namaFoto;
        
        $d->save();
        return response()->json(1);
    }

    public function updateSekolah(Request $r)
    {
        // cek foto

        // save data
        $d              = Sekolah::find($r->key);
        $d->nama        = $r->nama;
        $d->alamat      = $r->alamat;
        $d->email       = $r->email;
        $d->tlp         = $r->tlp;
        $d->akreditas   = $r->akreditas;
        $d->website     = $r->website;
        $d->deskripsi       = $r->deskripsi;
        $d->kep_sek         = $r->kep_sek;
        $d->status_mutu     = $r->status_mutu;
        $d->sertifikasi_iso = $r->sertifikasi_iso;
        $d->rayon           = $r->rayon;
        $d->lat             = $r->lat;
        $d->long            = $r->long;

        // edit foto
        if($r->hasFile('foto')){
            //delete old foto
            unlink(public_path('img/sekolah/'.$r->oldFoto));

            // upload foto
            $namaFoto   = $r->nama.date('Y-m-d H-i-s').'.'.$r->foto->extension();
            $r->file('foto')->move('img/sekolah',$namaFoto);
            // save foto
            $d->foto       = $namaFoto;
        }

        $d->save();
        return response()->json(1);
    }

}
