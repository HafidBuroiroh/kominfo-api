<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class UserApiController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get a list of users",
 *     tags={"Users"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *      @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             default=1,
 *         ),
 *      ),
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *     @OA\Response(response="404", description="Resource not found"),
 * )
 */
    public function user(Request $request){
        $curYear = date('Y');
        $user = DB::table('users')
            ->paginate(10);

        // if (count($user) > 0) {
        //     $form_id = $user[0]->form_id; // Use id_submit instead of form_id
        //     $logic = DB::table('m_logic_level')->where('id_form', $form_id)->where('aktif', 1)->get();
        // } else {
        //     $logic = '';
        //     $level = '';
        // }
        // foreach ($user as $value) {
        //     if ($logic != null or $logic != '') {
        //         $arr_level = [];
        //         $data_submission = json_decode($value->data, true);
        //         if ($value->data == '{}') {
        //           continue;
        //         }
        //         foreach ($logic as $data_logic) {
        //             $arr_logic = json_decode($data_logic->logic, true);
        //             $expectedLevel = $data_logic->id_level;
        //             foreach ($arr_logic as $formula) {
        //                 if ($formula['parameter'] == 'false') {
        //                     if($data_submission[$formula['input_id']] == null || $data_submission[$formula['input_id']] == ''){
        //                         $arr_level[] = $expectedLevel;
        //                     }else{}
        //                 }elseif ($formula['parameter'] == 'true') {
        //                     if($data_submission[$formula['input_id']] != null || $data_submission[$formula['input_id']] != ''){
        //                       if(array_key_exists("val-param", $formula)){
        //                         if ($data_submission[$formula['input_id']] == $formula['val-param']) {
        //                           $arr_level[] = $expectedLevel;
        //                         }
        //                       }else{
        //                         $arr_level[] = $expectedLevel;
        //                       }
        //                     }else{}
        //                 }else{
        //                 }
        //             }
        //         }
        //         $arr_level = array_unique($arr_level);
        //         sort($arr_level);
        //         if (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level) && in_array(4, $arr_level) ) {
        //             $level = 'Leader';
        //         }elseif (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level)) {
        //             $level = 'Adopter';
        //         }
        //         elseif (in_array(1, $arr_level) && in_array(2, $arr_level)) {
        //             $level = 'Observer';
        //         }
        //         elseif (in_array(1, $arr_level)) {
        //             $level = 'Beginner';
        //         }else{
        //             $level = 'Novice'; 
        //         }
        //         // dd(in_array([1,2], $arr_level));
        //     }
        //     $value->id_level = implode(', ', $arr_level);  
        //     $value->level = $level;  
        //     unset($value->data, $value->logic, $value->id_level, $value->import);
        // }

        return response()->json($user);
    }

/**
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Get a list of users by id",
 *     tags={"Users"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *      @OA\Parameter(
*         name="id",
*         in="path",
*         description="User ID",
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
 *     @OA\Response(response="404", description="User not found"),
 * )
 */
    public function userdetail($id){
        $userdetail = DB::table('form_submissions')
            ->Join('users', 'form_submissions.id_user', '=', 'users.id')
            ->Join('profil_user', 'users.id', '=', 'profil_user.id_user')
            ->Join('forms', 'form_submissions.form_id', '=', 'forms.id')
            ->select('users.email', 'users.no_wa', 'profil_user.*', 'form_submissions.*')
            ->whereNotNull('profil_user.jenis_kelamin')
            ->where('form_submissions.id_user', $id)
            ->paginate(10);

        if (count($userdetail) > 0) {
            $form_id = $userdetail[0]->form_id; // Use id_submit instead of form_id
            $logic = DB::table('m_logic_level')->where('id_form', $form_id)->where('aktif', 1)->get();
        } else {
            $logic = '';
            $level = '';
        }
        foreach ($userdetail as $value) {
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
                            if($data_submission[$formula['input_id']] == null || $data_submission[$formula['input_id']] == ''){
                                $arr_level[] = $expectedLevel;
                            }else{}
                        }elseif ($formula['parameter'] == 'true') {
                            if($data_submission[$formula['input_id']] != null || $data_submission[$formula['input_id']] != ''){
                              if(array_key_exists("val-param", $formula)){
                                if ($data_submission[$formula['input_id']] == $formula['val-param']) {
                                  $arr_level[] = $expectedLevel;
                                }
                              }else{
                                $arr_level[] = $expectedLevel;
                              }
                            }else{}
                        }else{
                        }
                    }
                }
                $arr_level = array_unique($arr_level);
                sort($arr_level);
                if (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level) && in_array(4, $arr_level) ) {
                    $level = 'Leader';
                }elseif (in_array(1, $arr_level) && in_array(2, $arr_level) && in_array(3, $arr_level)) {
                    $level = 'Adopter';
                }
                elseif (in_array(1, $arr_level) && in_array(2, $arr_level)) {
                    $level = 'Observer';
                }
                elseif (in_array(1, $arr_level)) {
                    $level = 'Beginner';
                }else{
                    $level = 'Novice'; 
                }
                // dd(in_array([1,2], $arr_level));
            }
            $value->id_level = implode(', ', $arr_level);  
            $value->level = $level;  
            unset($value->data, $value->logic, $value->id_level, $value->import);
        }

        return response()->json($userdetail);
    }
}
