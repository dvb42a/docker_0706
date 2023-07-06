<?php

namespace App\Http\Controllers\api\Mirror;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeautyMirror\NormalInspection;
use App\Models\BeautyMirror\Standard;
use App\Models\Beauty\Tag;
use App\Models\User;
use DB;

class algorithmController extends Controller
{

    public function index()
    {
            $users=User::whereHas('inspection')
            ->select('users.id')
            ->get();

            foreach($users as $user)
            {
                if($user->inspection != NULL)
                {
                    $user->inspection->head=$user->inspection->bmni_head;

                    $user->inspection->eyebrow = $user->inspection->bmni_eyebrow;

                    $user->inspection->fishtail=($user->inspection->bmni_fishtail_b+$user->inspection->bmni_fishtail_c)/2;

                    $user->inspection->tears=($user->inspection->bmni_tears_b+$user->inspection->bmni_tears_c)/2;

                    $user->inspection->nasolabial=($user->inspection->bmni_nasolabial_d+$user->inspection->bmni_nasolabial_e)/2;

                    $user->inspection->skin=($user->inspection->bmni_skin_a+$user->inspection->bmni_skin_b+$user->inspection->bmni_skin_e+$user->inspection->bmni_skin_f)/4;

                    $user->inspection->pigmentation=($user->inspection->bmni_pigmentation_a+$user->inspection->bmni_pigmentation_b)/2;

                    $user->inspection->pandaeye=($user->inspection->bmni_pandaeye_b +$user->inspection->bmni_pandaeye_c)/2 ;

                    $user->inspection->acne=($user->inspection->bmni_acne_a+$user->inspection->bmni_acne_b+$user->inspection->bmni_acne_c +$user->inspection->bmni_acne_d)/4;

                    $user->inspection->waterOil=($user->inspection->bmni_waterOil_d+$user->inspection->bmni_waterOil_e)/2 ;
                }

            }
            $count=$users->count();
            //dd($users->toArray());
            return response()->json(['users'=>$users , 'count'=>$count], 200);
    }


}
