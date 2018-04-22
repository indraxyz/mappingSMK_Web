<?php

namespace App\Http\Controllers\Android;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sekolah;

class SekolahC extends Controller
{
    public function listSekolah($rayon)
    {

    	if($rayon == 'all'){
    		$r  = Sekolah::orderBy('nama','asc')
					->get();
    	}else{
			$r  = Sekolah::where('rayon', $rayon)
					->orderBy('nama','asc')
					->get();
    	};
        
        return response()->json($r);
    }
}
