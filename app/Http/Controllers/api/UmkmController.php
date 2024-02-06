<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
    public function countdaerah(){
        $TotalUserDaerah = DB::table('profil_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->select('profil_user.id_provinsi', 'm_provinsi.nama_provinsi', DB::raw('COUNT(*) as user_count'))
        ->groupBy('profil_user.id_provinsi', 'm_provinsi.nama_provinsi')
        ->get();

    return response()->json($TotalUserDaerah);
    }

    public function countperdaerah(Request $request){
        $idProvinsi = $request->input('id_provinsi');
        
        $namaProvinsi =  DB::table('profil_user')
            ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->select('m_provinsi.nama_provinsi')->where('profil_user.id_provinsi', $idProvinsi)->first();
        // count user by jenis kelamin
        $userCount = DB::table('profil_user')->where('id_provinsi', $idProvinsi)->whereNotNull('jenis_kelamin')->count();
        $userCountLaki = DB::table('profil_user')->where('id_provinsi', $idProvinsi)
            ->where('jenis_kelamin', 'LIKE', '%pria%')
            ->count();

        $userCountPerempuan = DB::table('profil_user')->where(function ($query){
            $query->where('jenis_kelamin', 'like', '%wanita%')
                ->orWhere('jenis_kelamin', 'like', '%perempuan%');
            })
            ->where('id_provinsi', $idProvinsi)
            ->count();

        // count user by skala usaha
        $skalaultramikro =  DB::table('form_submissions')
        ->join('users', 'form_submissions.id_user', '=', 'users.id')
        ->join('profil_user', 'users.id', '=', 'profil_user.id_user')
        ->where('profil_user.id_provinsi', '=', $idProvinsi)
        ->where('form_submissions.data', 'like', '%Ultra Mikro%')
        ->distinct('form_submissions.id_user')
        ->count();

        $skalamikro =  DB::table('form_submissions')
        ->join('users', 'form_submissions.id_user', '=', 'users.id')
        ->join('profil_user', 'users.id', '=', 'profil_user.id_user')
        ->where('profil_user.id_provinsi', '=', $idProvinsi)
        ->where('form_submissions.data', 'like', '%Mikro%')
        ->where('form_submissions.data', 'not like', '%Ultra Mikro%')
        ->distinct('form_submissions.id_user')
        ->count();

        $skalamenengah =  DB::table('form_submissions')
        ->join('users', 'form_submissions.id_user', '=', 'users.id')
        ->join('profil_user', 'users.id', '=', 'profil_user.id_user')
        ->where('profil_user.id_provinsi', '=', $idProvinsi)
        ->where('form_submissions.data', 'like', '%Menengah%')
        ->distinct('form_submissions.id_user')
        ->count();

        $skalabesar = DB::table('form_submissions')
        ->join('users', 'form_submissions.id_user', '=', 'users.id')
        ->join('profil_user', 'users.id', '=', 'profil_user.id_user')
        ->where('profil_user.id_provinsi', '=', $idProvinsi)
        ->where('form_submissions.data', 'like', '%Besar%')
        ->distinct('form_submissions.id_user')
        ->count();

        // count user by level
        $beginner = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('m_level', 'users.final_level', '=', 'm_level.id')
        ->where('m_level.level', 'LIKE', '%Beginner%')
        ->count();

        $observer = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('m_level', 'users.final_level', '=', 'm_level.id')
        ->where('m_level.level', 'LIKE', '%Observer%')
        ->count();

        $adopter = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('m_level', 'users.final_level', '=', 'm_level.id')
        ->where('m_level.level', 'LIKE', '%Adopter%')
        ->count();

        $leader = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('m_level', 'users.final_level', '=', 'm_level.id')
        ->where('m_level.level', 'LIKE', '%Leader%')
        ->count();

        $novice = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('m_level', 'users.final_level', '=', 'm_level.id')
        ->where('m_level.level', 'LIKE', '%Novice%')
        ->count();

        // count user by adopsi teknologi
        $sosialmedia = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"3d35aa20-4505-451b-95f7-ae5a1f4bc742":"a. Sudah"%')
        ->count();
        
        $marketplace = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"0612b4c3-fa71-4882-9afd-bf4c83d447fa":"a. sudah"%')
        ->count();
        
        $possystem = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"3df62c7c-6764-4fc4-bb9f-0110dfbfd056":"a. ada"%')
        ->count();
        
        $omnichannel = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"058bb895-ed78-4e20-9deb-9bb954240e6d":"a. sudah"%')
        ->count();
        
        $whatsapp = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"4f8e2914-4468-4fff-9741-8ae8744f8e25":"a. sudah"%')
        ->count();
        
        $website = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"6d7cc3ee-0833-4706-a121-89080d5d778f":"a. Iya"%')
        ->count();

        // count user by jenis usaha
        // $makanan = '"cc8e0137-5a07-4873-bc54-77e53c7a0b91":true';
        // $minuman = '"7c991113-f761-40c1-9673-3a9164d46852":true';
        // $pakaian = '"0d78540f-14c4-4878-9576-77f2a6e3c532":true';
        // $kerajinankulit = '"da8ee909-8bff-49d9-9514-361713220b18":true';
        // $kerajinantangan = '"cec6436e-431e-4f82-a3bb-11a6af141484":true';
        $makanan = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"cc8e0137-5a07-4873-bc54-77e53c7a0b91":true%')
        ->count();
        
        $minuman = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"7c991113-f761-40c1-9673-3a9164d46852":true%')
        ->count();
        $makanan_minuman = $makanan + $minuman;

        $pakaian = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"0d78540f-14c4-4878-9576-77f2a6e3c532":true%')
        ->count();
        
        $kerajinankulit = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"da8ee909-8bff-49d9-9514-361713220b18":true%')
        ->count();
        
        $kerajinantangan = DB::table('profil_user')
        ->join('users', 'profil_user.id_user', '=', 'users.id')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->join('form_submissions', 'users.id', '=', 'form_submissions.id_user')
        ->where('form_submissions.data', 'LIKE', '%"cec6436e-431e-4f82-a3bb-11a6af141484":true%')
        ->count();

        // rata rata tahun
        $totalTahun = DB::table('form_submissions')
        ->join('profil_user', 'form_submissions.id_user', '=', 'profil_user.id_user')
        ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
        ->where('m_provinsi.id_provinsi', '=', $idProvinsi)
        ->select(DB::raw('CAST(AVG(CASE WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, \'$.86fd1876-8903-4378-b1ad-8ccf9840a802\')) IS NOT NULL THEN CAST(REPLACE(JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, \'$.86fd1876-8903-4378-b1ad-8ccf9840a802\')), \',\', \'\') AS DECIMAL) ELSE 0 END) AS UNSIGNED) AS total_tahun_rata_rata'))
        ->first();

        // rata rata Penghasilan
        $rataRataPendapatan = DB::table('form_submissions')
    ->join('profil_user', 'form_submissions.id_user', '=', 'profil_user.id_user')
    ->join('m_provinsi', 'profil_user.id_provinsi', '=', 'm_provinsi.id_provinsi')
    ->whereNotNull(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b'))"))
    ->where(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b'))"), '<>', 'null')
    ->where('m_provinsi.id_provinsi', $idProvinsi)
    ->groupBy('m_provinsi.id_provinsi', 'form_submissions.data') // Include form_submissions.data in GROUP BY
    ->select(
        'm_provinsi.id_provinsi',
        'form_submissions.data',
        DB::raw("CASE
            WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b')) = 'a. 1 - 5 juta' THEN 3
            WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b')) = 'b. 5 - 10 juta' THEN 8
            WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b')) = 'c. 10 - 20 juta' THEN 15
            WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b')) = 'd. 20 - 50 juta' THEN 30
            WHEN JSON_UNQUOTE(JSON_EXTRACT(form_submissions.data, '$.2edce79e-0944-4427-a820-552b8764527b')) = 'e. > 50 juta' THEN 50
            ELSE 0
        END AS pendapatan"),
        DB::raw("COUNT(*) AS count_choice")
    )
    ->get();



        return response()->json(['nama_provinsi'=>$namaProvinsi,'usercount'=>$userCount,'userCountLaki'=>$userCountLaki, 'userCountPerempuan'=>$userCountPerempuan,'skala_ultra_mikro'=>$skalaultramikro,'skala_mikro'=>$skalamikro,'skala_menengah'=>$skalamenengah,'skala_besar'=>$skalabesar,'level_beginner'=>$beginner,'level_observer'=>$observer,'level_adopter'=>$adopter,'level_leader'=>$leader,'level_novice'=>$novice,'sosial_media'=>$sosialmedia,'marketplace'=>$marketplace,'possystem'=>$possystem,'omnichannel'=>$omnichannel,'whatsapp'=>$whatsapp,'website'=>$website,'makanan_minuman'=>$makanan_minuman,'pakaian'=>$pakaian,'kerajinan_kulit'=>$kerajinankulit,'kerajinan_tangan'=>$kerajinantangan, 'total_tahun'=>$totalTahun->total_tahun_rata_rata,'pendapatan'=>round($rataRataPendapatan->avg('pendapatan'))]);
    }
}
