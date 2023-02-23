<?php

namespace App\Http\Controllers\Backend\VideoAds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Illuminate\Support\Facades\File;
use stdClass;
use Session;

class VideoAdsController extends Controller
{
    function showAddVideo() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataCompany = VideoAdsController::getAllCompany();

            return view('Backend.main.videos_ads.add-video-ads')
            ->with(['pagination' => 4])
            ->with(['dataCompany' => $dataCompany]);
        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllVideo() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            
            $dataVideo = VideoAdsController::getAllVideoAds();
            return view('Backend.main.videos_ads.all-video-ads')
            ->with(['dataVideo' => $dataVideo])
            ->with(['pagination' => 4]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllImage() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            
            $dataPhoto = VideoAdsController::getAllPhoto();
            return view('Backend.main.videos_ads.all-image-ads')
            ->with(['dataPhoto' => $dataPhoto])
            ->with(['pagination' => 4]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }


    function updateCompanyVideoImage(Request $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_get();

        $video_id = $request->video_id;
        $photo_id = $request->photo_id;
        $change_time = $request->change_time;
        $company_id = $request->company_id;

        

        $resultCompanyVideo = DB::table('company_video')
        ->insert([
            'company_id' => $request->company_id,
            'video_id' => $request->video_id,
            'change_time' => $request->change_time,
            'is_active' => 1,
            'created_at' => date('Y/m/d H:i:s')
        ]);
        $resultCompanyPhoto = DB::table('company_photo')
        ->insert([
            'company_id' => $request->company_id,
            'photo_id' => $request->photo_id,
            'is_active' => 1,
            'created_at' => date('Y/m/d H:i:s')
        ]);

        return $resultCompanyVideo;
    }

    function addVideoInMedia(Request $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_get();


        $get_video = $request->file('video_path');
        // dd($get_image);
        if($get_video){

            $get_name_video = $get_video->getClientOriginalName();
            $name_video = current(explode('.',$get_name_video));
            $new_video = $name_video.rand(0,99).'.'.$get_video->getClientOriginalExtension();
            $get_video->move('uploads/video/',$new_video);
            $new_link_video = 'uploads/video/'.$new_video;
            $video_path = $new_link_video;

            $resultVideo = DB::table('video')
            ->insert([
                'video_name' => $request->video_name,
                'video_description' => $request->video_description,
                'video_length' => $request->video_length,
                'video_thumbnail' => $request->video_thumbnail,
                'video_path' => $video_path,
                'created_at' => date('Y/m/d H:i:s')
            ]);
            return $resultVideo;
        }
    }

    function addImageInMedia(Request $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_get();
        
        $get_image = $request->file('photo_path');
        // dd($get_image);
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/photo/',$new_image);
            $new_link_photo = 'uploads/photo/'.$new_image;
            $photo_path = $new_link_photo;

            $resultPhoto = DB::table('photo')
            ->insert([
                'photo_name' => $request->photo_name,
                'photo_description' => $request->photo_description,
                'photo_path' => $photo_path,
                'created_at' => date('Y/m/d H:i:s')
            ]);
            return $resultPhoto;
        }
    }


    function deleteVideoInMedia(Request $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_get();
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $video_id = $request->video_id;
            $password_admin = $request->password_admin;

            if($password_admin == $inforAdmin->password_admin) {
                // dd($video_id);
                $resultDelete = DB::table('video')
                ->where(['id' => $video_id])
                ->update(['deleted_at' => date('Y/m/d H:i:s')]);

                return $resultDelete;
            } else {
                return "Your password is wrong ?!";
            }
        }else{
            return Redirect::to('/');
        }
    }

    function deleteImageInMedia(Request $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_get();

        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $photo_id = $request->photo_id;
            $password_admin = $request->password_admin;

            if($password_admin == $inforAdmin->password_admin) {
                // dd($video_id);
                $resultDelete = DB::table('photo')
                ->where(['id' => $photo_id])
                ->update(['deleted_at' => date('Y/m/d H:i:s')]);

                return $resultDelete;
            } else {
                return "Your password is wrong ?!";
            }
        }else{
            return Redirect::to('/');
        }
    }







    function getAllVideoAds() {
        $dataVideoAds = DB::table('video')
        ->where(['deleted_at' => null])
        ->orderByDesc('id')
        ->get(
            array(
                'id',
                'video_path',
                'video_name',
                'video_description',
                'video_length',
                'video_thumbnail',
                'created_at',
                'updated_at',
                'deleted_at'
                )
        );
        return $dataVideoAds;
    }

    function getAllPhoto() {
        $dataVideoAds = DB::table('photo')
        ->where(['deleted_at' => null])
        ->orderByDesc('id')
        ->get(
            array(
                'id',
                'photo_path',
                'photo_name',
                'photo_description',
                'created_at',
                'updated_at',
                'deleted_at'
                )
        );
        return $dataVideoAds;
    }
    
    function getAllCompany() {
        $dataCompany = DB::table('taxi_company')
        ->where(['parent_id'=> '0'])
        ->get(
            array(
                'company_id',
                'parent_id',
                'company_group'
                )
        );

        $newListDataCompany = new stdClass();
        $ListGroup = [];
        foreach($dataCompany as $subDataCompany) {
            $getData = DB::table('taxi_company')
            ->where(['parent_id'=> $subDataCompany->company_id])
            ->get(
                array(
                    'company_id',
                    'parent_id',
                    'company_group'
                    )
                );

            $subDataCompany->parent_group = "null";
            $ListGroup[count($ListGroup)] = (object)$subDataCompany ;
            if(count($getData) > 0) {
                foreach($getData as $getSubData) {
                    $getSubData->parent_group = $subDataCompany->company_group;
                    $ListGroup[count($ListGroup)] = (object)$getSubData ;
                }
            }
        }

        $newListDataCompany = $ListGroup;

        return $newListDataCompany;
    }

}