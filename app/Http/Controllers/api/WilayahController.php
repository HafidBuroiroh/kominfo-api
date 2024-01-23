<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
    public function provinsi(){
        $provinsi = DB::table('m_provinsi')->get();

        return response()->json($provinsi);
    }

    public function kabupaten(){
        $kabupaten = DB::table('m_kabupaten')->get();

        return response()->json($kabupaten);
    }

    public function kelurahan(){
        $kelurahan = DB::table('m_kelurahan')->get();

        return response()->json($kelurahan);
    }

    public function kecamatan(){
        $kecamatan = DB::table('m_kecamatan')->get();

        return response()->json($kecamatan);
    }
}
