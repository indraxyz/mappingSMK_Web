<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Sekolah_Like;
use App\Sekolah;

class LikeC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vLikeSekolah()
    {
    	return view('like');
    }

    public function listLike()
    {

    	// $d = DB::table('sekolah_likes')
	    //         ->join('sekolah', 'sekolah_likes.id_sekolah', '=', 'sekolah.id')
	    //         ->select(
	    //         	'sekolah_likes.*', 
	    //         	'sekolah.nama as nama_sekolah',
	    //         	DB::raw('count(id_sekolah) AS jml_like')
	    //         )
	    //         ->groupBy('id_sekolah')
	    //         ->orderBy('waktu','desc')
	    //         ->get();

	     $d = Sekolah::leftJoin('sekolah_likes', 'sekolah.id', 'sekolah_likes.id_sekolah')
                            ->select(
                                'sekolah.nama',
                                'sekolah.email',
                                'sekolah.akreditas',
                                'sekolah.website',
                                DB::raw('count(sekolah_likes.id) AS jml_like')
                            )
                            ->groupBy('sekolah.id')
                            ->get();

        return response()->json($d);
    }
}
