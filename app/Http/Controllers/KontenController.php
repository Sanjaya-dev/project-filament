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
       $dataKasus = Konten::with('jenisKejahatan')->get();
       return view('data', compact('dataKasus')); 
    }

    public function getFilteredData(Request $request)
    {
       $data = Konten::join('jenis_kejahatan', 'konten.jenis_kejahatan_id', '=', 'jenis_kejahatan.id')
            ->select('jenis_kejahatan.nama_jenis as jenis_kejahatan', \DB::raw('count(konten.id) as total'))
            ->groupBy('jenis_kejahatan.nama_jenis')
            ->get();

        return response()->json($data);
    }
}
