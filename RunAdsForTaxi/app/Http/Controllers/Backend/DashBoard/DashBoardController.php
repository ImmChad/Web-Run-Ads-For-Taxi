<?php

namespace App\Http\Controllers\Backend\DashBoard;
use App\Http\Controllers\Backend\Car\CarController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class DashBoardController extends Controller
{
    static function index() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $parentGroups = DashBoardController::getDataAllGroupParent(); 
            foreach($parentGroups as $parentGroup)
            {
                $childGroups = DashBoardController::getDataAllGroupChild_withParentID($parentGroup->company_id);
                foreach($childGroups as $childGroup)
                {
                    $childGroup->taxies = DashBoardController::getDataAllTaxi_withCompanyID($childGroup->company_id);
                }
                $parentGroup->childGroups = $childGroups;
            }
            return view('Backend.main.dashboard.indexDashBoard')
            ->with(['parentGroups' =>$parentGroups])
            ->with(['pagination' => 1]);
            
        }else{
            return Redirect::to('/');
        }
    }
    static function getDataStatistics(Request $request)
    {
            $text_search = $_POST['text-search'];
            $taxi_id = isset($_POST['taxi-id'])&&$_POST['taxi-id']!=-1?$_POST['taxi-id']:-1;
            $company_id = isset($_POST['company-id'])&&$_POST['company-id']!=-1?$_POST['company-id']:-1;
            $start_time = isset($_POST['start-time'])&&$_POST['start-time']!=-1?$_POST['start-time']:'00:00:00 01/01/1000';
            $end_time = isset($_POST['end-time'])&&$_POST['end-time']!=-1?$_POST['end-time']:'00:00:00 31/2/9999';

            $viewAdsVideos =  DashBoardController::getDataSearch($text_search,$start_time,$end_time);

            $dataStatistics = DashBoardController::loadViewAdsVideo_to_Statistics($viewAdsVideos);

            // dump($dataStatistics,$viewAdsVideos);
            return $dataStatistics;
    }
    static function loadViewAdsVideo_to_Statistics($view_ads_video)
    {
        $total_length_time_run =(object)[];
        $total_length_time_run->seconds = 0;
        $total_length_time_pause_image =(object)[];
        $total_length_time_pause_image->seconds = 0;
        $total_play_video = 0  ;
        $start_time_run = 0;
        $start_time_pause_image = 0;
        for($i=0;$i<count($view_ads_video);$i++)
        {   
            
            if($view_ads_video[$i]->human_type==1)
            {
                $start_time_run = strtotime($view_ads_video[$i]->human_time);
            }
            if($view_ads_video[$i]->human_type==0)
            {
                $total_length_time_run->seconds+=strtotime($view_ads_video[$i]->human_time) - $start_time_run ;
                // dump(strtotime($view_ads_video[$i]->human_time),$start_time_run);
                $total_play_video++;
            }
            if($view_ads_video[$i]->human_type ==2)
            {
                $start_time_pause_image = strtotime($view_ads_video[$i]->human_time);
            }
            if($view_ads_video[$i]->human_type ==3)
            {
                $total_length_time_pause_image->seconds+=strtotime($view_ads_video[$i]->human_time) - $start_time_pause_image ;
            }
            
        }
        $total_length_time_run->hours = (int)($total_length_time_run->seconds/60/60);
        $total_length_time_run->minutes = ($total_length_time_run->seconds/60%60); 
        $total_length_time_run->seconds=$total_length_time_run->seconds%60;

        $total_length_time_pause_image->hours = (int)($total_length_time_pause_image->seconds/60/60);
        $total_length_time_pause_image->minutes = ($total_length_time_pause_image->seconds/60%60); 
        $total_length_time_pause_image->seconds=$total_length_time_pause_image->seconds%60;

        return [
            'total_play_video'=>$total_play_video,
            'total_length_time_run'=>$total_length_time_run,
            'total_length_time_pause_image'=>$total_length_time_pause_image,
        ];
    }
    static function getDataAllTaxi()
    {
        return DB::table('taxi')
            ->get();
    }
    static function getDataAllGroupParent()
    {
        return DB::table('taxi_company')
            ->where(['parent_id'=>0])
            ->get();
    }
    static function getDataAllGroupChild_withParentID($parent_id)
    {
        return DB::table('taxi_company')
            ->where(['parent_id'=>$parent_id])
            ->get();
    }
    static function getDataGroupParent_withParentID($parent_id)
    {
        return DB::table('taxi_company')
            ->where(['company_id'=>$parent_id,
                     'parent_id'=>0])
            ->get()->first();
    }
    static function getDataCompany_withCompanyID($company_id)
    {
        return DB::table('taxi_company')
            ->where(['company_id'=>$company_id,
                    ])
            ->get()->first();
    }
    static function getDataAllTaxi_withCompanyID($company_id)
    {
        return DB::table('taxi')
            ->where(['company_id'=>$company_id])
            ->get();
    }

    static function getDataAllTaxi_likeVehicleNumber($vehicle_num)
    {
        return DB::table('taxi')
            ->where('vehicle_num','like',"%{$vehicle_num}%")
            ->get();
    }
    static function getDataHasVideo_ofCompany($company_id)
    {
        return DB::table('company_video')
        ->where(['company_id'=>$company_id])
        ->get();
    }
    static function getDataAllViewAdsVideo_withCompanyHasVideo_ID($company_video_id,$start_time=-1,$end_time=-1)
    {
        // dump($company_video_id);
        return DB::table('taxi_video_statistics')
                ->where(['company_video_id'=>$company_video_id])
                ->whereBetween('human_time',[DB::raw("STR_TO_DATE('{$start_time}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
                ->orderBy('id','ASC')
                ->get();
    }
    static function getDataAllViewAdsVideo_withTaxi_ID($taxi_id,$start_time=-1,$end_time=-1)
    {
        // dd($taxi_id,$start_time,$end_time);
            return DB::table('taxi_video_statistics')
            ->where(['taxi_id'=>$taxi_id])
            ->whereBetween('human_time',[DB::raw("STR_TO_DATE('{$start_time}','%H:%i:%s %d/%m/%Y')"),DB::raw("STR_TO_DATE('{$end_time}','%H:%i:%s %d/%m/%Y')")])
            ->orderBy('id','ASC')
            ->get();
        // return DB::table('taxi_video_statistics')
        //         ->where(['taxi_id'=>$taxi_id])
        //         ->get();
    }
    
    static function getDataAllViewAdsVideo_withCompany_ID($company_id,$start_time=-1,$end_time=-1)
    {
        // $company = DashBoardController:: getDataCompany_withCompanyID($company_id);
        $dataGlobal = DashBoardController::getDataHasVideo_ofCompany(0);
        $dataAllViewAdsVideo =[];
        $taxies = DashBoardController:: getDataAllTaxi_withCompanyID($company_id);
        if(isset($dataGlobal) && count($dataGlobal))
        {
            foreach ($dataGlobal as $companies_has_video )
            {   
                $tmp_dataAllViewAdsVideo = DashBoardController:: getDataAllViewAdsVideo_withCompanyHasVideo_ID($companies_has_video->id,$start_time,$end_time);
                
                foreach($tmp_dataAllViewAdsVideo as $item)
                {
                    foreach($taxies as $taxi)
                    {
                        if($item->taxi_id == $taxi->id)
                        {
                            $dataAllViewAdsVideo[count($dataAllViewAdsVideo)] = $item;
                        }
                    }

                }
            }
        }
        $companies_has_videos =DashBoardController:: getDataHasVideo_ofCompany($company_id);
        foreach ($companies_has_videos as $companies_has_video )
        {   
            $tmp_dataAllViewAdsVideo = DashBoardController:: getDataAllViewAdsVideo_withCompanyHasVideo_ID($companies_has_video->id,$start_time,$end_time);
            
            foreach($tmp_dataAllViewAdsVideo as $item)
            {
                $dataAllViewAdsVideo[count($dataAllViewAdsVideo)] = $item;
            }
        }

        return $dataAllViewAdsVideo;
    }
    static function getDataSearch($text_search,$start_time=-1,$end_time=-1)
    {
       
        $data_tmp = CarController::getDataCar_withVehicleNumber($text_search);
        if(isset($data_tmp))
        {
            return DashBoardController ::getDataAllViewAdsVideo_withTaxi_ID($data_tmp->id,$start_time,$end_time);
        }
        // split text
        $words = explode('-',$text_search);
        if(count($words)==2)
        {
            $data_parent = DashBoardController::getDataCompany_withNameGroup($words[0]);
            // dump( $data_parent);
        }
        else
        {
            return [];
        }
        
        if($data_parent)
        {   
            $childGroups =DashBoardController::getDataAllGroupChild_withParentID($data_parent->company_id);
            foreach($childGroups as $childGroup)
            {
                if(trim(strtolower($childGroup->company_group)) == trim(strtolower($words[1])))
                {
                    // dump( $childGroup);
                    $data_tmp = $childGroup;
                }
            }
            
        }
        else
        {
            return [];
        }
        if(isset($data_tmp))
        {
            return DashBoardController:: getDataAllViewAdsVideo_withCompany_ID($data_tmp->company_id,$start_time,$end_time);
        }
        else
        {
            return [];
        }

    }


    static function getDataCompany_withNameGroup($name_group)
    {
        $name_group = trim(strtolower($name_group));
        $length_name_group =  strlen($name_group);
        // dd($name_group);
        return DB::table('taxi_company')
            ->whereRaw("LENGTH(TRIM(company_group)) = {$length_name_group}")
            ->whereRaw( "LOWER(`company_group`) LIKE '{$name_group}'")
            ->get()->first();
    }


    static function getDataCar(Request $request) {

        $dataDriver = DB::table('cars')
        ->where(['id_company'=> $request->id_company])
        ->get(
            array(
                'id_car',
                'id_ud',
                'id_company',
                'vehical_num'
                )
        );
        return $dataDriver;
    }


    static function getAllCompany() {
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
    
}
