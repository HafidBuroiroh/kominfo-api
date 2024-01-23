<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
    public function user(Request $request){
        $page = $request->input('paginate');
        $user = DB::table('users')->paginate($page);

        return response()->json($user);
    }
}
