<?php

namespace App\Http\Controllers\Backend\Car;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class CarController extends Controller
{
    static function showAddCar() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataCompany = CarController::getAllCompany();
            $newListDataDriver = new stdClass();
            $ListDriver = [];
            foreach($dataDriver as $subListDataDriver) {
                $today = date('Y');
                $date = DateTime::createFromFormat("Y-m-d", $subListDataDriver->birthday_ud);
                $date = $date->format("Y");

                $age = (int)$today - (int)$date;

                $subListDataDriver->age = $age;

                $ListDriver[count($ListDriver)] = (object)$subListDataDriver ;
            }
            $newListDataDriver = $ListDriver;

            return view('Backend.main.cars.add-car')
            ->with(['pagination' => 2])
            ->with(['dataDriver' => $dataDriver])
            ->with(['dataCompany' => $dataCompany]);
        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    static function showAllCar() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            // check existed query filter url
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            if(isset($_GET['afficher'])) {
                $limit = $_GET['afficher']; 
            } else {
                $limit = 20;
            }
            if(isset($_GET['filter_company_id'])) {
                $filter_company_id = $_GET['filter_company_id']; 
            } else {
                // All Company = -1
                $filter_company_id = -1;
            }
            // process result
            $start = ($page - 1) * $limit;
            $listCompany = CarController::getAllCompany();
            $listDataCar = CarController::getAllTaxi_withCompany_ID($filter_company_id,$start,$limit);
            $result_total = count(CarController::getAllTaxi_withCompany_ID($filter_company_id));
            $total_content = count(CarController::getAllTaxi_withCompany_ID($filter_company_id));
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }
            // get info company for each taxi
            $newListDataCar = new stdClass();
            $ListCar = [];
            foreach($listDataCar as $subListDataCar) {
                $company_group = DB::table('taxi_company')->where('company_id', $subListDataCar->company_id)->get(array('company_group', 'parent_id'));
                $subListDataCar->company_group = ($company_group[0]->company_group);
                $city = DB::table('taxi_company')->where('company_id', $company_group[0]->parent_id)->get('company_group');
                $subListDataCar->city = ($city[0]->company_group);
                $ListCar[count($ListCar)] = $subListDataCar;
            }
            $newListDataCar = $ListCar; 
            // move to Page-- with after filter company present page no result
            if(count($newListDataCar)==0 && isset($_GET['page']) && $_GET['page']>1 )
            {
                $page_reduce = (int)$_GET['page']-1;
                // dd($page_reduce);
                return redirect("/car/all-car?page={$page_reduce}&filter_company_id={$_GET['filter_company_id']}");
            }
            // dd($newListDataCar);
            return view('Backend.main.cars.all-car')
            ->with(['dataAllCompanyMinimum'=>CarController::getAllCompanyMinimum()])
            ->with(['pagination' => 2])
            ->with(['page'=> $page])
            ->with(['total_page'=> $total_page])
            ->with(['afficher'=>$limit])
            ->with(['result_total' => $result_total])
            ->with(['filter_company_id' => $filter_company_id])
            ->with(['listDataCar'=> $newListDataCar]);

        }else{
            return Redirect::to('/');
        }
    }

    static function showUpdateCar($id_car) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            

                $dataCar = CarController::getDataCar_withID($id_car);
                $dataCar->dataGroupCompany = CarController::getMinimumCompany_withID($dataCar->company_id);
                
            return view('Backend.main.cars.update-car')
            ->with(['pagination' => 2])
            ->with(['dataCar' =>$dataCar])
            ->with(['dataAllCompanyMinimum' =>CarController::getAllCompanyMinimum()]);
        }else{
            return Redirect::to('/');
        }
    }
    static function checkExistTaxi_forUpdate($taxi_id,$vehicle_num=-1,$tablet_id=-1,$app_id =-1)
    {

        $dataCar = DB::table('taxi')
            ->where(function ($query) use ($vehicle_num,$tablet_id,$app_id)
            {
                $query->orWhereRaw("LOWER(TRIM(`vehicle_num`)) = '{$vehicle_num}'")
                ->orWhereRaw( "LOWER(TRIM(`tablet_id`)) = '{$tablet_id}'")
                ->orWhereRaw( "LOWER(TRIM(`app_id`)) = '{$app_id}'");
            })->where('id','!=',$taxi_id)->get()->first();
                
        return isset($dataCar); 
    }
    static function checkExistTaxi_forAdd($vehicle_num=-1)
    {
        $dataCar = DB::table('taxi')
        ->whereRaw("LOWER(TRIM(`vehicle_num`)) = '{$vehicle_num}'")
        ->get()->first();
        return isset($dataCar);
    }
    static function getAllCar() {
        $dataCompany = DB::table('taxi')
        ->get(
            array(
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                )
            );
        return $dataCompany;
    }

    static function getAllCompany() {
        $dataCompany = DB::table('taxi_company')
        ->get(
            array(
                'company_id',
                'company_group',
                'parent_id',
                )
        );

        return $dataCompany;
    }
    static function getAllCompanyMinimum()
    {
        $dataCompanies = DB::table('taxi_company')
        ->where('parent_id','>',0)
        ->get(
            array(
                'company_id',
                'company_group',
                'parent_id',
                )
        );
        $dataAllCompanyMinimum = [];
        foreach($dataCompanies as $dataCompany)
        {
            $dataAllCompanyMinimum[count($dataAllCompanyMinimum)] = CarController::getMinimumCompany_withID($dataCompany->company_id);
        };
        return $dataAllCompanyMinimum;
    }
    static function getAllDriver() {
        $dataCompany = DB::table('taxi')
        ->get('id_ud');

        $listIdUd = [];
        foreach($dataCompany as $subdataC) {
            if($subdataC->id_ud)
            $listIdUd[count($listIdUd)] = $subdataC->id_ud;
        }
        
        $dataDriver = DB::table('user_drivers')
        ->whereNotIn('id_ud', $listIdUd)
        ->get(
            array(
                'id_ud',
                'name_ud',
                'num_phone_ud',
                'password_ud',
                'birthday_ud',
                'url_avt_ud'
            )
        );
            
            // dd($dataDriver);
        
        

        return $dataDriver;
    }

    static function getAllCarForPage($start, $limit) {
        $dataCompany = DB::table('taxi')
        ->offset($start)->limit($limit)
        ->get(
            array(
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                )
        );
        return $dataCompany;
    }
    static function getMinimumCompany_withID($company_id)
    {
        $dataCompany  = DB::table('taxi_company')
        ->where('company_id',$company_id)
        ->get(
            array(
                'company_id',
                'company_group',
                'parent_id',
                )
        )->first();
        $dataCompany->dataParent = DB::table('taxi_company')
        ->where(['company_id'=>$dataCompany->parent_id,'parent_id'=>0])
        ->get(
            array(
                'company_id',
                'company_group',
                'parent_id',
                )
        )->first();
        return $dataCompany ;
    }
    static function searchTaxiByVehicleNumber(Request $request)
    {
        return response()->json(['data'=>
            CarController::getDataCar_likeVehicleNumber($request->post('textVehicleNumber'))
        ]);
    }
    static function getDataCar_withID($id_car)
    {
        return DB::table('taxi')
            ->where(['id'=>$id_car])
            ->get(
                array(
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                    )
            )->first();
    }
    static function getDataCar_withVehicleNumber($vehicleNumber)
    {
        return DB::table('taxi')
            ->where('vehicle_num','=',$vehicleNumber)
            ->get(
                array(
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                    )
                )->first();
    }
    static function getDataCar_likeVehicleNumber($vehicleNumber)
    {
        return DB::table('taxi')
            ->where('vehicle_num','LIKE',"%{$vehicleNumber}%")
            ->get(
                array(
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                    )
                );
    }
    static function updateTaxi(Request $request)
    {
        $result = 0;
        if(!CarController::checkExistTaxi_forUpdate($request->value_taxi_id,
            trim(strtolower( $request->value_vehicle_number)),
            trim(strtolower( $request->value_tablet_id))
            ,trim(strtolower( $request->value_app_id))))
        {
            $result = DB::table('taxi')->where('id', $request->value_taxi_id)
            ->update([
                  'vehicle_num'=>$request->value_vehicle_number,
                  'company_id'=>$request->value_group_id,
                  'tablet_id'=>$request->value_tablet_id,
                  'sim_number'=>$request->value_number_phone,
                  'app_id'=>$request->value_app_id,     ]);
                  return [
                    'isSuccess'=>$result,
                    'mess'=>'Success Update Taxi'
                ];
        }
        else
        {
            return [
                'isSuccess'=>$result,
                'mess'=>'Vehicle Number or Tablet ID or App ID Existed'
            ];
        }

    }
    static function showAddTaxi()
    {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $tmpDataCompanies =[];
            $dataCompanies = CarController::getAllCompanyMinimum();
            foreach($dataCompanies as $dataCompany)
            {
                $tmpDataCompanies[count($tmpDataCompanies)] = CarController::getMinimumCompany_withID($dataCompany->company_id);
            }
            // dd($tmpDataCompanies);
            return view('Backend.main.cars.add-car')
            ->with(['pagination' => 2])
            ->with(['dataAllCompanyMinimum'=>$dataCompanies]);

        }else{
            return Redirect::to('/');
        }
    }
    static function addTaxi(Request $request)
    {
        $result = 0;
        // check existed taxi
        // dd();

        if(!CarController::checkExistTaxi_forAdd(trim(strtolower( $request->value_vehicle_number))))
        {
            $time_int = strtotime(date("Y-m-d H:i:s"));
            $result = DB::table('taxi')
            ->insert([
                'vehicle_num'=>$request->value_vehicle_number,
                'company_id'=>$request->value_group_id,
                'tablet_id'=>$time_int,
                'sim_number'=>$request->value_number_phone,
                'app_id'=>"Taxi{$time_int}",
            ]);
            return [
                'isSuccess'=>$result,
                'mess'=>'Success Add Taxi'
            ];
        }
        else
        {
            return [
                'isSuccess'=>$result,
                'mess'=>'Vehicle Number Existed'
            ];
        }
        return [
            'isSuccess'=>$result,
            'mess'=>'Add Taxi Success'
        ];
    }
    static function deleteTaxi(Request $request)
    {
        if(CarController::checkPassWordAdmin($request->password_admin))
        {
            $resultDeleteTaxi = DB::table('taxi')->where(
                ['id'=>$request->taxi_id]
            )->delete();
            $resultDeleteAllViewAdsVideo = DB::table('taxi_video_statistics')
            ->where(
                ['taxi_id'=>$request->taxi_id]
            )->delete();
            return [
                'isSuccess'=>$resultDeleteTaxi,
                'mess'=>'Success Delete Taxi!!!'
            ];
        }
        else
        {
            return [
                'isSuccess'=>0,
                'mess'=>'Wrong Password!'
            ];
        }

    }
    static function checkPassWordAdmin($password)
    {
        $dataAdmin = DB::table('admin')
        ->where(['password_admin'=>$password])
        ->get()->first();
        // dd($dataAdmin);
        return isset($dataAdmin);
    }
    static function getAllTaxi_withCompany_ID($company_id,$start=-1,$limit=-1)
    {
        
        if($company_id>-1)
        {
            if($start==-1||$limit==-1)
            {
                $dataTaxies = DB::table('taxi')
                ->where(['company_id'=>$company_id])
                ->get([
                    'id',
                    'vehicle_num',
                    'company_id',
                    'tablet_id',
                    'sim_number',
                    'app_id',
            ]);
                return $dataTaxies ;
            }
            // dd($company_id,$start,$limit);
            
            $dataTaxies = DB::table('taxi')
            ->where(['company_id'=>$company_id])
            ->offset($start)->limit($limit)
            ->get([
                'id',
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id',
            ]);
            return $dataTaxies;
            
        return $dataTaxies;
        }
        else
        {
            
            if($start==-1||$limit==-1)
            {
                return CarController::getAllCar();
            }
            // dd($company_id,$start,$limit);
            return CarController::getAllCarForPage($start,$limit);
        }
        
        
    }
}
