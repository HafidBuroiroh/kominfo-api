<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserApiController;
use App\Http\Controllers\api\WilayahController;

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
    Route::get('/kelurahan', [WilayahController::class, 'kelurahan']);
    Route::get('/kecamatan', [WilayahController::class, 'kecamatan']);
    
    
    Route::get('/users', [UserApiController::class, 'user']);
    Route::get('/users/{id}', [UserApiController::class, 'userdetail']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
