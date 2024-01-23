<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
 /**
 * @OA\Get(
 *     path="/api/provinsi",
 *     summary="Get list of provinsi",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Resource not found"),
 * )
 */
    public function provinsi(){
        $provinsi = DB::table('m_provinsi')->get();

        return response()->json($provinsi);
    }

/**
 * @OA\Get(
 *     path="/api/kabupaten",
 *     summary="Get list of kabupaten",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Resource not found"),
 * )
 */

    public function kabupaten(){
        $kabupaten = DB::table('m_kabupaten')->get();

        return response()->json($kabupaten);
    }

/**
 * @OA\Get(
 *     path="/api/kelurahan",
 *     summary="Get list of kelurahan",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Resource not found"),
 * )
 */

    public function kelurahan(){
        $kelurahan = DB::table('m_kelurahan')->get();

        return response()->json($kelurahan);
    }

/**
 * @OA\Get(
 *     path="/api/kecamatan",
 *     summary="Get list of kecamatan",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Resource not found"),
 * )
 */
    public function kecamatan(){
        $kecamatan = DB::table('m_kecamatan')->get();

        return response()->json($kecamatan);
    }
}
