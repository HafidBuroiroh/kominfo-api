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
        $user = DB::table('form_submissions')
    ->leftJoin('users', 'form_submissions.id_user', '=', 'users.id')
    ->leftJoin('profil_user', 'users.id', '=', 'profil_user.id_user')
    ->leftJoin('forms', 'form_submissions.form_id', '=', 'forms.id')
    ->select('users.email', 'users.no_wa', 'profil_user.*', 'form_submissions.*')
    ->whereNotNull('profil_user.jenis_kelamin')
    ->paginate(10);

$userLevelsCount = [
    'Leader' => 0,
    'Adopter' => 0,
    'Observer' => 0,
    'Beginner' => 0,
    'Novice' => 0,
];

if (count($user) > 0) {
    $form_id = $user[0]->form_id; // Use id_submit instead of form_id
    $logic = DB::table('m_logic_level')->where('id_form', $form_id)->where('aktif', 1)->get();
} else {
    $logic = '';
    $level = '';
}

foreach ($user as $value) {
    if ($logic != null or $logic != '') {
        $arr_level = [];
        $data_submission = json_decode($value->data, true);
        if ($value->data == '{}') {
            continue;
        }
        foreach ($logic as $data_logic) {
            $arr_logic = json_decode($data_logic->logic, true);
            $expectedLevel = $data_logic->id_level;
            foreach ($arr_logic as $formula) {
                if ($formula['parameter'] == 'false') {
                    if ($data_submission[$formula['input_id']] == null || $data_submission[$formula['input_id']] == '') {
                        $arr_level[] = $expectedLevel;
                    }
                } elseif ($formula['parameter'] == 'true') {
                    if ($data_submission[$formula['input_id']] != null || $data_submission[$formula['input_id']] != '') {
                        if (array_key_exists("val-param", $formula)) {
                            if ($data_submission[$formula['input_id']] == $formula['val-param']) {
                                $arr_level[] = $expectedLevel;
                            }
                        } else {
                            $arr_level[] = $expectedLevel;
                        }
                    }
                }
            }
        }
        $arr_level = array_unique($arr_level);
        sort($arr_level);
        if (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level) && in_array(4, $arr_level)) {
            $level = 'Leader';
        } elseif (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level)) {
            $level = 'Adopter';
        } elseif (in_array(1, $arr_level) && in_array(2, $arr_level)) {
            $level = 'Observer';
        } elseif (in_array(1, $arr_level)) {
            $level = 'Beginner';
        } else {
            $level = 'Novice';
        }
        $value->id_level = implode(', ', $arr_level);
        $value->level = $level;
        $userLevelsCount[$level]++;
        unset($value->data, $value->logic, $value->id_level, $value->import);
    }
}

        return response()->json(['levelcount'=>$userLevelsCount]);
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
