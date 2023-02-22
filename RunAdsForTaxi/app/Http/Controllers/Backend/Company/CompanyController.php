<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class CompanyController extends Controller
{
    function showAddCompany() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return view('Backend.main.companys.add-company')
            ->with(['pagination' => 3]);
        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllCompany() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            
            $listDataCompany = CompanyController::getAllCompany();
            $result_total = count($listDataCompany);

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = count($listDataProduct);
            if(isset($_GET['afficher'])) {
                $limit = $_GET['afficher']; 
            } else {
                $limit = 20;
            }
            
            $start = ($page - 1) * $limit;    
            $total_content = count($listDataCompany);          
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataCompany = CompanyController::getAllCompanyForPage($start, $limit);


            return view('Backend.main.companys.all-company')
            ->with(['pagination' => 3])
            ->with(['page' => $page])
            ->with(['afficher' => $limit])
            ->with(['result_total' => $result_total])
            ->with(['total_page' => $total_page])
            ->with(['listDataCompany' => $listDataCompany]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }




    function addNewCompany(Request $request) {



        $compnay_id = DB::table('taxi_company')->insertGetId([
            'company_group' => $request->company_group,
            'parent_id' => 0
        ]);


        $listGroup = json_decode($request->listGroup);
        foreach($listGroup as $subListGroup) {

            $save_list = DB::table('taxi_company')->insert([
                'company_group' => $subListGroup->group_name,
                'parent_id' => $compnay_id
            ]);
        }




        return $compnay_id;
    }

    
    function updateNewCompany(Request $request) {
        $listGroup = json_decode($request->listGroup);
        if(count($listGroup) > 0) {
            $compnay_id = DB::table('taxi_company')
            ->where(['company_id' => $request->company_id])
            ->update([
                'company_group' => $request->company_group
            ]);

            $count = 0;
            foreach($listGroup as $subListGroup) {
                $name_company_group = DB::table('taxi_company')
                ->where(['company_group' => $subListGroup->group_name])
                ->where(['parent_id' => $request->company_id])
                ->get();

                if( count($name_company_group) > 0 ) {
                    unset($listGroup[$count]);
                } 
                $count = $count + 1;
            }

            if($listGroup > 0) {
                foreach($listGroup as $subListGroup) {
                    $save_list = DB::table('taxi_company')->insert([
                        'company_group' => $subListGroup->group_name,
                        'parent_id' => $request->company_id
                    ]);
                }
            }

        } else {
            $compnay_id = DB::table('taxi_company')
            ->where(['company_id' => $request->company_id])
            ->update([
                'company_group' => $request->company_group
            ]);
        }
        return $listGroup;
    }

    function deleteCompany(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $company_id = $request->company_id;
            $password_admin = $request->password_admin;

            if($password_admin == $inforAdmin->password_admin) {
                $parent_id = DB::table('taxi_company')
                ->where(['company_id' => $company_id])
                ->get(['parent_id']);
    
                if( $parent_id[0]->parent_id == 0 ) {
                    $dataParentCompany = DB::table('taxi_company')
                    ->where(['parent_id' => $company_id])
                    ->get(['company_id']);
    
                    if(count($dataParentCompany) > 0) {
                        foreach($dataParentCompany as $subDataParentCompany) {
                            // query all COMPANY PHOTO
                            $dataCompanyPhoto = DB::table('company_photo')
                            ->where(['company_id' => $subDataParentCompany->company_id])
                            ->get(['id']);
                            // delete COMPANY PHOTO
                            if(count($dataCompanyPhoto) > 0){
                                foreach($dataCompanyPhoto as $subDataCompanyPhoto) {
                                    $dataBrand = DB::table('company_photo')
                                    ->where(['id'=>$subDataCompanyPhoto->id])
                                    ->delete(); 
                                }
                            }
                            // query all COMPANY VIDEO
                            $dataCompanyVideo = DB::table('company_video')
                            ->where(['company_id' => $subDataParentCompany->company_id])
                            ->get(['id']);
                            if(count($dataCompanyVideo) > 0) {
                                foreach($dataCompanyVideo as $subDataCompanyVideo) {
                                    $detete_Company_video_is_Active_0 = DB::table('company_video')
                                    ->where(['id'=>$subDataCompanyVideo->id])
                                    ->delete(); 
                                }
                            }
                            // find query all TAXI from COMPANY GROUP
                            $dataTaxi = DB::table('taxi')
                            ->where(['company_id' => $subDataParentCompany->company_id])
                            ->get(['id']);
                            // select and delete all TAXI VIDEO STATISTICS
                            if(count($dataTaxi) > 0) {
                                foreach($dataTaxi as $subDataTaxi) {
                                    $get_id_taxi_video_statistics = DB::table('taxi_video_statistics')
                                    ->where(['taxi_id' => $subDataTaxi->id])
                                    ->get(['id']);
            
                                    if(count($get_id_taxi_video_statistics) > 0) {
                                        foreach($get_id_taxi_video_statistics as $sub_get_id_taxi_video_statistics){
                                            $detete_taxi_video_statistics = DB::table('taxi_video_statistics')
                                            ->where(['id' => $sub_get_id_taxi_video_statistics->id])
                                            ->delete(); 
                                        }
                                    }
            
                                    $detete_taxi = DB::table('taxi')
                                    ->where(['id' => $subDataTaxi->id])
                                    ->delete(); 
                                }
                            }
        
        
                            $detete_company_group = DB::table('taxi_company')
                            ->where(['company_id'=>$subDataParentCompany->company_id])
                            ->delete(); 
                        }
                    }
    
                    $detete_parent_company = DB::table('taxi_company')
                    ->where(['company_id' => $company_id])
                    ->delete(); 
                } else {
    
                    // query all COMPANY PHOTO
                    $dataCompanyPhoto = DB::table('company_photo')
                    ->where(['company_id' => $company_id])
                    ->get(['id']);
                    // delete COMPANY PHOTO
                    if(count($dataCompanyPhoto) > 0){
                        foreach($dataCompanyPhoto as $subDataCompanyPhoto) {
                            $dataBrand = DB::table('company_photo')
                            ->where(['id'=>$subDataCompanyPhoto->id])
                            ->delete(); 
                        }
                    }
                    // query all COMPANY VIDEO
                    $dataCompanyVideo = DB::table('company_video')
                    ->where(['company_id' => $company_id])
                    ->get(['id']);
                    if(count($dataCompanyVideo) > 0) {
                        foreach($dataCompanyVideo as $subDataCompanyVideo) {
                            $detete_Company_video_is_Active_0 = DB::table('company_video')
                            ->where(['id'=>$subDataCompanyVideo->id])
                            ->delete(); 
                        }
                    }
                    // find query all TAXI from COMPANY GROUP
                    $dataTaxi = DB::table('taxi')
                    ->where(['company_id' => $company_id])
                    ->get(['id']);
                    // select and delete all TAXI VIDEO STATISTICS
                    if(count($dataTaxi) > 0) {
                        foreach($dataTaxi as $subDataTaxi) {
                            $get_id_taxi_video_statistics = DB::table('taxi_video_statistics')
                            ->where(['taxi_id' => $subDataTaxi->id])
                            ->get(['id']);
    
                            if(count($get_id_taxi_video_statistics) > 0) {
                                foreach($get_id_taxi_video_statistics as $sub_get_id_taxi_video_statistics){
                                    $detete_taxi_video_statistics = DB::table('taxi_video_statistics')
                                    ->where(['id' => $sub_get_id_taxi_video_statistics->id])
                                    ->delete(); 
                                }
                            }
    
                            $detete_taxi = DB::table('taxi')
                            ->where(['id' => $subDataTaxi->id])
                            ->delete(); 
                        }
                    }
    
    
                    $detete_company_group = DB::table('taxi_company')
                    ->where(['company_id'=>$company_id])
                    ->delete(); 
                    
                }
                return $company_id;
            } else {
                return "Your password is wrong ?!";
            }
        }else{
            return Redirect::to('/');
        }
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

    function getAllCompanyForPage($start, $limit) {
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
        
        $ListGroup = array_slice($ListGroup, $start, $limit);
        
        $newListDataCompany = $ListGroup;
            
            

        return $newListDataCompany;
    }
}
