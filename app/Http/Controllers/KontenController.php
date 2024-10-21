<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Konten;
use Illuminate\Http\Request;
use App\Models\JenisKejahatan;

class KontenController extends Controller
{
    public function index()
    {

       return view('data'); 
    }

    public function getFilteredData(Request $request)
    {
       $data = DB::select("
            SELECT jenis_kejahatan.nama_jenis AS jenis_kejahatan, 
                   COUNT(konten.id) AS total 
            FROM konten 
            JOIN jenis_kejahatan 
            ON konten.jenis_kejahatan_id = jenis_kejahatan.id 
            GROUP BY jenis_kejahatan.nama_jenis
        ");

        return response()->json($data);
    }
}
