<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\M_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function countuser(){
        $countUser = DB::table('profil_user')->whereNotNull('jenis_kelamin')->count();
        $countPria = DB::table('profil_user')->where('jenis_kelamin','Like', '%pria%')->count();
        $countPerempuan = DB::table('profil_user')->where('jenis_kelamin', 'Like','%perempuan%')->orwhere('jenis_kelamin', 'Like','%wanita%')->count();
        return response()->json(['total_user' => $countUser, 'total_laki-laki' => $countPria, 'total_perempuan' => $countPerempuan]);
    }

    public function skalausaha(){
        $skalaultramikro =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%Ultra Mikro%')
        ->count();


        $skalamikro =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%Mikro%')
        ->where('data', 'NOT LIKE', '%Ultra Mikro%')
        ->count();

        $skalamenengah = DB::table('form_submissions')
        ->where('data', 'LIKE', '%Menengah%')
        ->count();

        $skalabesar = DB::table('form_submissions')
        ->where('data', 'LIKE', '%Besar%')
        ->count();
        return response()->json(['ultra_mikro'=>$skalaultramikro, 'mikro'=>$skalamikro, 'menengah'=>$skalamenengah, 'besar'=>$skalabesar]);
    }

    public function levelumkm(){
        $beginner = User::with('level')->wherehas('level', function($query){
            $query->where('level', 'LIKE', '%Beginner%');
        })->count();

        $observer = User::with('level')->wherehas('level', function($query){
            $query->where('level', 'LIKE', '%Observer%');
        })->count();

        $adopter = User::with('level')->wherehas('level', function($query){
            $query->where('level', 'LIKE', '%Adopter%');
        })->count();

        $leader = User::with('level')->wherehas('level', function($query){
            $query->where('level', 'LIKE', '%Leader%');
        })->count();

        $novice = User::with('level')->wherehas('level', function($query){
            $query->where('level', 'LIKE', '%Novice%');
        })->count();

        return response()->json(['beginner'=>$beginner, 'observer'=>$observer, 'adopter'=>$adopter, 'leader'=>$leader, 'novice'=>$novice]);
    }

    public function adopsiteknologi(){
        $sosialmedia =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"3d35aa20-4505-451b-95f7-ae5a1f4bc742":"a. Sudah"%')
        ->count();

        $marketplace =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"0612b4c3-fa71-4882-9afd-bf4c83d447fa":"a. sudah"%')
        ->count();

        $possystem =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"3df62c7c-6764-4fc4-bb9f-0110dfbfd056":"a. ada"%')
        ->count();

        $omnichannel =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"058bb895-ed78-4e20-9deb-9bb954240e6d":"a. sudah"%')
        ->count();

        $whatsapp =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"4f8e2914-4468-4fff-9741-8ae8744f8e25":"a. sudah"%')
        ->count();

        $website =  DB::table('form_submissions')
        ->where('data', 'LIKE', '%"6d7cc3ee-0833-4706-a121-89080d5d778f":"a. Iya"%')
        ->count();

        return response()->json(['sosial_media'=>$sosialmedia, 'marketplace'=>$marketplace, 'pos_system'=>$possystem, 'omnichannel'=>$omnichannel, 'whatsapp'=>$whatsapp, 'website'=>$website]);
    }
}
