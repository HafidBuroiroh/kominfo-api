<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeknologiController extends Controller
{
    public function sosialmedia(){
        $instagram = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"21f77341-fa46-45d9-bac6-1a04d3cf3764":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $instagram_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"21f77341-fa46-45d9-bac6-1a04d3cf3764":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $instagram_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"21f77341-fa46-45d9-bac6-1a04d3cf3764":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();
        
            
        $tiktok = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"f02eebeb-d578-4c39-a383-984e33dceea7":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $tiktok_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"f02eebeb-d578-4c39-a383-984e33dceea7":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $tiktok_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"f02eebeb-d578-4c39-a383-984e33dceea7":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        return response()->json(['instagram'=>$instagram, 'instagram_per_provinsi'=>$instagram_per_provinsi, 'instagram_per_kabupaten'=>$instagram_per_kabupaten, 'tiktok'=>$tiktok, 'tiktok_per_provinsi'=>$tiktok_per_provinsi, 'tiktok_per_kabupaten'=>$tiktok_per_kabupaten]);
    }

    public function sosialmedia2(){
        $facebook = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8285d9a0-e209-4bf4-a858-21c942efc67d":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $facebook_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8285d9a0-e209-4bf4-a858-21c942efc67d":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $facebook_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8285d9a0-e209-4bf4-a858-21c942efc67d":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        
        $lainnya = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"bc329487-d123-4f53-ac72-e2c343422ff1":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $lainnya_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"bc329487-d123-4f53-ac72-e2c343422ff1":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $lainnya_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"bc329487-d123-4f53-ac72-e2c343422ff1":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        return response()->json(['facebook'=>$facebook, 'facebook_per_provinsi'=>$facebook_per_provinsi, 'facebook_per_kabupaten'=>$facebook_per_kabupaten, 'lainnya'=>$lainnya, 'lainnya_per_provinsi'=>$lainnya_per_provinsi, 'lainnya_per_kabupaten'=>$lainnya_per_kabupaten]);
    }

    public function marketplace(){
        $shopee = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"7e7d93fe-f890-4912-b5f7-8cec9aeb07f9":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $shopee_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"7e7d93fe-f890-4912-b5f7-8cec9aeb07f9":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $shopee_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"7e7d93fe-f890-4912-b5f7-8cec9aeb07f9":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        
        $tokopedia = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->where('profil_user.id_provinsi', '!=', 0)
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"52747ee5-a58c-4eef-ba80-747b19fd454f":true%'])
            ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->first();

        $tokopedia_per_provinsi = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"52747ee5-a58c-4eef-ba80-747b19fd454f":true%'])
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        $tokopedia_per_kabupaten = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"52747ee5-a58c-4eef-ba80-747b19fd454f":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->get();

        return response()->json(['shopee'=>$shopee, 'shopee_per_provinsi'=>$shopee_per_provinsi, 'shopee_per_kabupaten'=>$shopee_per_kabupaten, 'tokopedia'=>$tokopedia, 'tokopedia_per_provinsi'=>$tokopedia_per_provinsi, 'tokopedia_per_kabupaten'=>$tokopedia_per_kabupaten]);
    }

    public function marketplace2(){
        $lazada = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"4899bd76-84fe-4d3b-b026-98369b812b16":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $lazada_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"4899bd76-84fe-4d3b-b026-98369b812b16":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $lazada_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"4899bd76-84fe-4d3b-b026-98369b812b16":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();


    $blibli = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"933d946d-6b6d-401f-93ce-796b7d53eefe":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $blibli_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"933d946d-6b6d-401f-93ce-796b7d53eefe":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $blibli_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"933d946d-6b6d-401f-93ce-796b7d53eefe":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();


   

    return response()->json(['lazada'=>$lazada, 'lazada_per_provinsi'=>$lazada_per_provinsi, 'lazada_per_kabupaten'=>$lazada_per_kabupaten, 'blibli'=>$blibli, 'blibli_per_provinsi'=>$blibli_per_provinsi, 'blibli_per_kabupaten'=>$blibli_per_kabupaten]);

    }

    public function marketplace3(){
        $bukalapak = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"43a9fd21-c843-46ab-873b-32c9e2cf07e9":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $bukalapak_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"43a9fd21-c843-46ab-873b-32c9e2cf07e9":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $bukalapak_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"43a9fd21-c843-46ab-873b-32c9e2cf07e9":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();


    $gofood = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"9fd98221-0e07-4ff7-b30f-348a9bb8fc35":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $gofood_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"9fd98221-0e07-4ff7-b30f-348a9bb8fc35":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $gofood_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"9fd98221-0e07-4ff7-b30f-348a9bb8fc35":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();


    

    return response()->json(['bukalapak'=>$bukalapak, 'bukalapak_per_provinsi'=>$bukalapak_per_provinsi, 'bukalapak_per_kabupaten'=>$bukalapak_per_kabupaten, 'gofood'=>$gofood, 'gofood_per_provinsi'=>$gofood_per_provinsi, 'gofood_per_kabupaten'=>$gofood_per_kabupaten]);
    }

    public function marketplace4(){
        $shopeefood = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8acf25cb-2477-462f-8468-6bf514dde2d0":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $shopeefood_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8acf25cb-2477-462f-8468-6bf514dde2d0":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $shopeefood_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8acf25cb-2477-462f-8468-6bf514dde2d0":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();


    $grabfood = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"d0f5410f-66e2-4a93-ae25-19f1dbd6d401":true%'])
        ->select(DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->first();

    $grabfood_per_provinsi = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"d0f5410f-66e2-4a93-ae25-19f1dbd6d401":true%'])
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

    $grabfood_per_kabupaten = DB::table('profil_user')
        ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"d0f5410f-66e2-4a93-ae25-19f1dbd6d401":true%'])
        ->whereNotNull('profil_user.nama_kabupaten')
        ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
        ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
        ->get();

        return response()->json(['shopeefood'=>$shopeefood, 'shopeefood_per_provinsi'=>$shopeefood_per_provinsi, 'shopeefood_per_kabupaten'=>$shopeefood_per_kabupaten, 'grabfood'=>$grabfood, 'grabfood_per_provinsi'=>$grabfood_per_provinsi, 'grabfood_per_kabupaten'=>$grabfood_per_kabupaten]);
    }

    public function sosialmediaperdaerah(Request $request){
        $id_provinsi = $request->input('id_provinsi');

        $instagram = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"21f77341-fa46-45d9-bac6-1a04d3cf3764":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $tiktok = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"f02eebeb-d578-4c39-a383-984e33dceea7":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $facebook = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8285d9a0-e209-4bf4-a858-21c942efc67d":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $lainnya = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"bc329487-d123-4f53-ac72-e2c343422ff1":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        return response()->json(['instagram'=>$instagram, 'tiktok'=>$tiktok, 'facebok'=>$facebook, 'lainnya'=>$lainnya]);
    }

    public function marketplaceperdaerah(Request $request){
        $id_provinsi = $request->input('id_provinsi');

        $shopee = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"7e7d93fe-f890-4912-b5f7-8cec9aeb07f9":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $tokopedia = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"52747ee5-a58c-4eef-ba80-747b19fd454f":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $lazada = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"4899bd76-84fe-4d3b-b026-98369b812b16":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $blibli = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"933d946d-6b6d-401f-93ce-796b7d53eefe":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $bukalapak = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"43a9fd21-c843-46ab-873b-32c9e2cf07e9":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        return response()->json(['shopee'=>$shopee, 'tokopedia'=>$tokopedia, 'lazada'=>$lazada, 'blibli'=>$blibli, 'bukalapak'=>$bukalapak]);
    }

    public function foodperdaerah(Request $request){
        $id_provinsi = $request->input('id_provinsi');

        $gofood = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"9fd98221-0e07-4ff7-b30f-348a9bb8fc35":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        $grabfood = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"d0f5410f-66e2-4a93-ae25-19f1dbd6d401":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();


        $shopeefood = DB::table('profil_user')
            ->join('form_submissions', 'profil_user.id_user', '=', 'form_submissions.id_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->whereRaw("LOWER(form_submissions.data) LIKE ?", ['%"8acf25cb-2477-462f-8468-6bf514dde2d0":true%'])
            ->whereNotNull('profil_user.nama_kabupaten')
            ->where('profil_user.id_provinsi', $id_provinsi)
            ->groupBy('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", ""))'))
            ->select('m_provinsi.nama_provinsi', DB::raw('LOWER(REPLACE(profil_user.nama_kabupaten, ".", "")) AS nama_kabupaten'), DB::raw('COUNT(profil_user.id_user) AS total_user'))
            ->orderBy('total_user', 'desc')
            ->get();

        return response()->json(['gofood'=>$gofood, 'shopeefood'=>$shopeefood, 'grabfood'=>$grabfood]);
    }

    public function daerah(){
        $daerah = DB::table('profil_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
            ->get();

        return response()->json($daerah);
    }
}
