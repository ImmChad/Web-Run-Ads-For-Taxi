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
            ->with(['pagination' => 3])
            ->with(['dataCompany' => $dataCompany]);
        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllVideo() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $listVideoAds = VideoAdsController::getAllVideoAds();

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = count($listDataProduct);
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($listVideoAds);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listVideoAds = VideoAdsController::getAllVideoForPage($start, $limit);


            $newListVideoAds = new stdClass();
            $ListVideo = [];
            foreach($listVideoAds as $subListVideoAds) {

                $dataRelationship = DB::table('relationship_video_company')
                ->where('id_videos_ads', $subListVideoAds->id_videos_ads)->get(['id_company']);



                $ListCompany = [];
                foreach($dataRelationship as $subDataRelationship) {
                    if($subDataRelationship->id_company != 0) {
                        $dataCompany = DB::table('company_taxi')
                        ->where('id_company', $subDataRelationship->id_company)->get(['id_company', 'name_company'])->first();
                    } else {
                        $dataCompany = new stdClass();
                        $dataCompany->id_company = 0;
                        $dataCompany->name_company = "All Company";
                    }
                    $ListCompany[count($ListCompany)] = $dataCompany;
                }
                
                $subListVideoAds->listCompany = $ListCompany;

                $ListVideo[count($ListVideo)] = (object)$subListVideoAds ;
            }
            $newListVideoAds = $ListVideo;
            // dd($newListVideoAds);
            return view('Backend.main.videos_ads.all-video-ads')
            ->with(['pagination' => 3])
            ->with(['page'=> $page])
            ->with(['total_page'=> $total_page])
            ->with(['listVideoAds'=> $newListVideoAds]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showUpdateVideo($id_videos_ads) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataVideoAds = DB::table('videos_ads')
            ->where(['id_videos_ads'=>$id_videos_ads])
            ->get(
                array(
                    'id_videos_ads',
                    'name_videos_ads',
                    'url_videos_ads',
                    'length_video_ads',
                    'date_debut'
                    )
            )->first();

            $newListVideoAds = new stdClass();
            $ListVideo = [];

            $dataRelationship = DB::table('relationship_video_company')
            ->where('id_videos_ads', $dataVideoAds->id_videos_ads)->get(['id_company']);

            $ListCompany = [];
            foreach($dataRelationship as $subDataRelationship) {
                if($subDataRelationship->id_company != 0) {
                    $dataCompany = DB::table('company_taxi')
                    ->where('id_company', $subDataRelationship->id_company)->get(['id_company', 'name_company'])->first();
                } else {
                    $dataCompany = new stdClass();
                    $dataCompany->id_company = 0;
                    $dataCompany->name_company = "All Company";
                }
                $ListCompany[count($ListCompany)] = $dataCompany;
            }
            $dataVideoAds->listCompany = $ListCompany;


            $dataCompany = VideoAdsController::getAllCompany();

            return view('Backend.main.videos_ads.update-video-ads')
            ->with(['pagination' => 3])
            ->with(['dataCompany' => $dataCompany])
            ->with(['dataVideoAds' => $dataVideoAds]);
        }else{
            return Redirect::to('/');
        }
    }

    function addNewVideo(Request $request) {
        $get_video = $request->file('url_videos_ads');
        $listCompany = json_decode($request->listCompany);
        $dataCompany = VideoAdsController::getAllCompany();

        // dd($get_image);
        if($get_video){
            $get_name_video = $get_video->getClientOriginalName();
            $name_video= current(explode('.',$get_name_video));
            $new_video = $name_video.rand(0,99).'.'.$get_video->getClientOriginalExtension();
            $get_video->move('uploads/video_ads/',$new_video);
            $new_link_image = 'uploads/video_ads/'.$new_video;
            $url_videos_ads = $new_link_image;
            $id_videos_ads = DB::table('videos_ads')->insertGetId([
                'name_videos_ads' => $request->name_videos_ads,
                'length_video_ads' => $request->length_video_ads,
                'date_debut' => $request->date_debut,
                'url_videos_ads' => $url_videos_ads
            ]);
            if(count($listCompany) < count($dataCompany) ) {
                foreach($listCompany as $subListCompany) {
                    $resultRelationship = DB::table('relationship_video_company')->insert([
                        'id_company' => intval($subListCompany->id_company),
                        'id_videos_ads' => $id_videos_ads
                    ]);
                }
            } else {
                $resultRelationship = DB::table('relationship_video_company')->insert([
                    'id_company' => 0,
                    'id_videos_ads' => $id_videos_ads
                ]);
            }
            return $id_videos_ads;
        }
        
        return Redirect::to('video/add-video');
    }
    
    function updateNewVideo(Request $request) {

        $get_video = $request->file('url_videos_ads');
        $listCompany = json_decode($request->listCompany);
        $dataCompany = VideoAdsController::getAllCompany();

        // dd($get_image);
        if($get_video){
             // unlink image news
            $res_Video_News = DB::table('videos_ads')->where('id_videos_ads', $request->id_videos_ads)->get(['url_videos_ads']);

            $path_Video = ($res_Video_News[0]->url_videos_ads);

            if (File::exists($path_Video)) {
                File::delete($path_Video);
            }

            $dataRelationship = DB::table('relationship_video_company')
            ->where(['id_videos_ads'=> $request->id_videos_ads])
            ->delete(); 

            if(count($listCompany) < count($dataCompany) ) {
                foreach($listCompany as $subListCompany) {
                    $resultRelationship = DB::table('relationship_video_company')->insert([
                        'id_company' => intval($subListCompany->id_company),
                        'id_videos_ads' => $request->id_videos_ads
                    ]);
                }
            } else {
                $resultRelationship = DB::table('relationship_video_company')->insert([
                    'id_company' => 0,
                    'id_videos_ads' => $request->id_videos_ads
                ]);
            }


            $get_name_video = $get_video->getClientOriginalName();
            $name_image = current(explode('.',$get_name_video));
            $new_video = $name_image.rand(0,99).'.'.$get_video->getClientOriginalExtension();
            $get_video->move('uploads/video_ads/',$new_video);
            $new_link_image = 'uploads/video_ads/'.$new_video;
            $url_videos_ads = $new_link_image;
            $resultVideo = DB::table('videos_ads')
            ->where(['id_videos_ads'=>$request->id_videos_ads])
            ->update([
                'name_videos_ads' => $request->name_videos_ads,
                'length_video_ads' => $request->length_video_ads,
                'date_debut' => $request->date_debut,
                'url_videos_ads' => $url_videos_ads
            ]);
            return $resultVideo;
        } else {

            $dataRelationship = DB::table('relationship_video_company')
            ->where(['id_videos_ads'=> $request->id_videos_ads])
            ->delete(); 

            if(count($listCompany) < count($dataCompany) ) {
                foreach($listCompany as $subListCompany) {
                    $resultRelationship = DB::table('relationship_video_company')->insert([
                        'id_company' => intval($subListCompany->id_company),
                        'id_videos_ads' => $request->id_videos_ads
                    ]);
                }
            } else {
                $resultRelationship = DB::table('relationship_video_company')->insert([
                    'id_company' => 0,
                    'id_videos_ads' => $request->id_videos_ads
                ]);
            }

            $resultDriver = DB::table('videos_ads')
            ->where(['id_videos_ads'=>$request->id_videos_ads])
            ->update([
                'name_videos_ads' => $request->name_videos_ads,
                'length_video_ads' => $request->length_video_ads,
                'date_debut' => $request->date_debut
            ]);
            return $resultDriver;
        }


        return Redirect::to('driver/all-driver');
    }

    function deleteVideo($id_videos_ads) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
             // unlink image news

            $dataRelationship = DB::table('relationship_video_company')
            ->where(['id_videos_ads'=>$id_videos_ads])
            ->delete(); 
            
            $res_Image_News = DB::table('videos_ads')->where('id_videos_ads', $id_videos_ads)->get(['url_videos_ads']);
            $path_Image = ($res_Image_News[0]->url_videos_ads);
            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }
            $dataVideoAds = DB::table('videos_ads')
            ->where(['id_videos_ads'=>$id_videos_ads])
            ->delete(); 

            return Redirect::to('/video/all-video');
        }else{
            return Redirect::to('/');
        }
    }

    function getAllVideoAds() {
        $dataVideoAds = DB::table('videos_ads')
        ->get(
            array(
                'id_videos_ads',
                'name_videos_ads',
                'url_videos_ads',
                'length_video_ads',
                'date_debut'
                )
        );
        return $dataVideoAds;
    }
    
    function getAllCompany() {
        $dataCompany = DB::table('company_taxi')
        ->get(
            array(
                'id_company',
                'name_company',
                'num_sim',
                'url_logo_company'
                )
        );
        return $dataCompany;
    }

    function getAllVideoForPage($start, $limit) {
        $dataVideoAds = DB::table('videos_ads')
        ->offset($start)->limit($limit)
        ->get(
            array(
                'id_videos_ads',
                'name_videos_ads',
                'url_videos_ads',
                'length_video_ads',
                'date_debut'
                )
        );
        return $dataVideoAds;
    }
}