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
 *     path="/api/kabupaten/{id_provinsi}",
 *     summary="Get a list of kabupaten by id provinsi",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *      @OA\Parameter(
*         name="id_provinsi",
*         in="path",
*         description="Provinsi ID",
*         required=true,
*         @OA\Schema(
*             type="integer",
*             format="int64"
*         )
*     ),
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Data not found"),
 * )
 */

    public function filterkabupaten(Request $request, $id_provinsi){
        $filterkabupaten = DB::table('m_kabupaten')->where('id_provinsi', $id_provinsi)->get();

        return response()->json($filterkabupaten);
    }

/**
 * @OA\Get(
 *     path="/api/kecamatan/{id_kabupaten}",
 *     summary="Get a list of kecamatan by id kabupaten",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *      @OA\Parameter(
*         name="id_kabupaten",
*         in="path",
*         description="Kabupaten ID",
*         required=true,
*         @OA\Schema(
*             type="integer",
*             format="int64"
*         )
*     ),
    *     @OA\Response(response="200", description="Successful operation"),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    *     @OA\Response(response="404", description="Data not found"),
    * )
    */

    public function filterkecamatan(Request $request, $id_kabupaten){
        $filterkecamatan = DB::table('m_kecamatan')->where('id_kabupaten', $id_kabupaten)->get();

        return response()->json($filterkecamatan);
    }

/**
 * @OA\Get(
 *     path="/api/kelurahan/{id_kecamatan}",
 *     summary="Get a list of kelurahan by id Kelurahan",
 *     tags={"Wilayah"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *      @OA\Parameter(
*         name="id_kecamatan",
*         in="path",
*         description="Kelurahan ID",
*         required=true,
*         @OA\Schema(
*             type="integer",
*             format="int64"
*         )
*     ),
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Data not found"),
 * )
 */

    public function filterkelurahan(Request $request, $id_kecamatan){
        $filterkelurahan = DB::table('m_kelurahan')->where('id_kecamatan', $id_kecamatan)->get();

        return response()->json($filterkelurahan);
    }
}
