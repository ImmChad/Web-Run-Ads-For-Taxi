<?php

namespace App\Http\Controllers\Backend\ViewAdsVideo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\DashBoard\DashBoardController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ViewAdsVideoController extends Controller
{
    function getAllVideo_withAppID(Request $request)
    {
        $dataTaxi = ViewAdsVideoController::getDataTaxi_withAppID($request->app_id);
        if(!isset($dataTaxi))
        {
            return ["isLogin"=>null];
        }
        $video_latest = ViewAdsVideoController::getLatest_VideoAdsWorked_withCompanyID($dataTaxi->company_id);
        $photo_latest = ViewAdsVideoController::getLatest_PhotoAdsWorked_withCompanyID($dataTaxi->company_id);
        $video = ViewAdsVideoController::getDataVideo_withVideo_ID($video_latest->video_id);
        $photo = ViewAdsVideoController::getDataPhoto_withPhoto_ID($photo_latest->photo_id);
        
        $photo->md5_encrypt = md5($photo->photo_path);
        if(md5($video->video_path) == $request->video_md5_encrypt)
        {
            $video = null;
            
        }
        else
        {
            $video->md5_encrypt = md5($video->video_path);
        }

        // if(md5($photo->photo_path) == $request->photo_md5_encrypt)
        // {
        //     $photo = null;
            
        // }
        // else
        // {
        //     $photo->md5_encrypt = md5($photo->photo_path);
        // }

        return [
            'video'=>$video,
            'photo'=>$photo,
            'change_time'=>$video_latest->change_time,
            'isLogin'=>$request->app_id,
        ];
    }
    function insertHumanEvent(Request $request)
    {
        $dataTaxi = ViewAdsVideoController:: getDataTaxi_withAppID($request->app_id);
        $video_latest = ViewAdsVideoController::getLatest_VideoAdsWorked_withCompanyID($dataTaxi->company_id);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now = date("Y-m-d H:i:s");     
        $result = DB::statement("insert into `taxi_video_statistics` (`taxi_id`, `company_video_id`, `human_type`, `human_time`) values ({$dataTaxi->id}, {$video_latest->id}, {$request->human_type},'{$now}')");
        return [
            'is_success'=>$result
        ];
    }
    function getDataTaxi_withAppID($app_id)
    {
        return DB::table('taxi')
        ->where(['app_id'=>$app_id])->get()->first();
    }
    function getLatest_VideoAdsWorked_withCompanyID($company_id)
    {
        // dump($company_id);
        DB::enableQueryLog();
        $childGroup  = DashBoardController::getDataCompany_withCompanyID($company_id);
        $tmp = DB::table('company_video')
        ->where(['company_id'=>$company_id          
                    ])
            ->orWhere(['company_id'=>$childGroup->parent_id  ] )
            ->orWhere(['company_id'=>0  ] )
            ->where(['is_active'=>1  ])        
        ->orderBy('id','DESC')->get()->first();
        // dd( $tmp,$childGroup,DB::getQueryLog());
        return $tmp;
    }
    function getLatest_PhotoAdsWorked_withCompanyID($company_id)
    {
        $childGroup  = DashBoardController::getDataCompany_withCompanyID($company_id);
        $tmp = DB::table('company_photo')
        ->where(['company_id'=>$company_id,
                    'is_active'=>1            
                ])
        ->orWhere(['company_id'=>$childGroup->parent_id,
        'is_active'=>1            
        ])
        ->orderBy('id','DESC')->get()->first();
        return $tmp;
    }
    function getDataVideo_withVideo_ID($video_id)
    {
        // dd($video_id);
        $data = DB::table('video')
        ->where(['id'=>$video_id])->get()->first();

        return $data;
    }
    function getDataPhoto_withPhoto_ID($photo_id)
    {
        return DB::table('photo')
        ->where(['id'=>$photo_id,          
                ])->get()->first();
    }
}
