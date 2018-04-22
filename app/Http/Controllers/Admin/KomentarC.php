<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Komentar;

class KomentarC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vKomentar()
    {
    	return view('komentar');
    }

    public function listKomentar()
    {
    	$r = DB::table('komentar')
	            ->join('sekolah', 'komentar.id_sekolah', '=', 'sekolah.id')
	            ->select('komentar.*', 'sekolah.nama as nama_sekolah')
	            ->orderBy('waktu','desc')
	            ->get();

    	// $r  = Komentar::orderBy('waktu','desc')->get();
        return response()->json($r);
    }

    public function deleteKomentar($key)
    {
        $d      = Komentar::find($key);
        $r = $d->delete();
        return response()->json($r);
    }

    public function mDeleteKomentar(Request $r){
        $ids = explode(',', $r->ids);
        // delete data
        $rs = Komentar::destroy($ids);
        return response()->json($rs);
    }

}
