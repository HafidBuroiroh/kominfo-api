<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MainController;
use App\Http\Controllers\api\UmkmController;
use App\Http\Controllers\api\UserApiController;
use App\Http\Controllers\api\WilayahController;
use App\Http\Controllers\api\TeknologiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/provinsi', [WilayahController::class, 'provinsi']);
    Route::get('/kabupaten', [WilayahController::class, 'kabupaten']);
    Route::get('/kabupaten/{id_provinsi}', [WilayahController::class, 'filterkabupaten']);
    Route::get('/kecamatan', [WilayahController::class, 'kecamatan']);
    Route::get('/kecamatan/{id_kabupaten}', [WilayahController::class, 'filterkecamatan']);
    Route::get('/kelurahan', [WilayahController::class, 'kelurahan']);
    Route::get('/kelurahan/{id_kecamatan}', [WilayahController::class, 'filterkelurahan']);
    
    
    Route::get('/users', [UserApiController::class, 'user']);
    Route::get('/users/{id}', [UserApiController::class, 'userdetail']);
    Route::get('/userkabupaten', [UserApiController::class, 'userkabupaten']);
    Route::get('/userkecamatan', [UserApiController::class, 'userkecamatan']);
    Route::get('/userkelurahan', [UserApiController::class, 'userkelurahan']);
    Route::get('/usersearch', [UserApiController::class, 'usersearch']);

    Route::get('/countumkm', [MainController::class, 'countuser']);
    Route::get('/skalausaha', [MainController::class, 'skalausaha']);
    Route::get('/levelumkm', [MainController::class, 'levelumkm']);
    Route::get('/adopsiteknologi', [MainController::class, 'adopsiteknologi']);
    
    
    Route::get('/sosialmedia1', [TeknologiController::class, 'sosialmedia']);
    Route::get('/sosialmedia2', [TeknologiController::class, 'sosialmedia2']);
    Route::get('/marketplace1', [TeknologiController::class, 'marketplace']);
    Route::get('/marketplace2', [TeknologiController::class, 'marketplace2']);
    Route::get('/marketplace3', [TeknologiController::class, 'marketplace3']);
    Route::get('/marketplace4', [TeknologiController::class, 'marketplace4']);
    Route::get('/sosialmediaperdaerah', [TeknologiController::class, 'sosialmediaperdaerah']);
    Route::get('/daerah', [TeknologiController::class, 'daerah']);
    Route::get('/marketplaceperdaerah', [TeknologiController::class, 'marketplaceperdaerah']);
    Route::get('/foodperdaerah', [TeknologiController::class, 'foodperdaerah']);
    
    Route::get('/countdaerah', [UmkmController::class, 'countdaerah']);
    Route::get('/countperdaerah', [UmkmController::class, 'countperdaerah']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
