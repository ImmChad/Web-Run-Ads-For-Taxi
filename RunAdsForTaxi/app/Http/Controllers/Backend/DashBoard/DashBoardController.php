<?php

namespace App\Http\Controllers\Backend\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class DashBoardController extends Controller
{
    function index() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){



            return view('Backend.main.dashboard.indexDashBoard')
            ->with(['pagination' => 1]);
            
        }else{
            return Redirect::to('/');
        }
    }




    function getDataCar(Request $request) {

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
    
}
