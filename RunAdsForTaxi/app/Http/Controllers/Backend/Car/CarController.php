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
    function showAddCar() {
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

    function showAllCar() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $listDataCar = CarController::getAllCar();

            $result_total = count($listDataCar);


            $listCompany = CarController::getAllCompany();


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
            // $page = count($listDataProduct);
            $start = ($page - 1) * $limit;    
            $total_content = count($listDataCar);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataCar = CarController::getAllCarForPage($start, $limit);






            
            $newListDataCar = new stdClass();
            $ListCar = [];
            foreach($listDataCar as $subListDataCar) {
                
                $company_group = DB::table('taxi_company')->where('company_id', $subListDataCar->company_id)->get(array('company_group', 'parent_id'));
                $subListDataCar->company_group = ($company_group[0]->company_group);

                $city = DB::table('taxi_company')->where('company_id', $company_group[0]->parent_id)->get('company_group');
                $subListDataCar->city = ($city[0]->company_group);


                $ListCar[count($ListCar)] = $subListDataCar;
            }
            // dd($subListDataCar->company_group);
            $newListDataCar = $ListCar;


            return view('Backend.main.cars.all-car')
            ->with(['pagination' => 2])
            ->with(['page'=> $page])
            ->with(['total_page'=> $total_page])
            ->with(['afficher'=>$limit])
            ->with(['result_total' => $result_total])
            ->with(['listDataCar'=> $newListDataCar]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllCarFlowCompany() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            if(isset($_GET['company'])) {
                $id_company = $_GET['company'];
            } else {
                return Redirect::to('/car/all-car');
            }

            $listDataCar = CarController::getAllCarFlowCompany($id_company);
            $listCompany = CarController::getAllCompany();


            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = count($listDataProduct);
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($listDataCar);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataCar = CarController::getAllCarForPageFlowCompany($start, $limit, $id_company);







         

            return view('Backend.main.cars.all-car')
            ->with(['page'=> $page])
            ->with(['total_page'=> $total_page])
            ->with(['company_id'=> $id_company])
            ->with(['listCompany'=> $listCompany])
            ->with(['listDataCar'=> $newListDataCar]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showUpdateCar($id_car) {
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

    function addNewCar(Request $request) {
        $id_ud = $request->id_ud;
        $vehical_num = $request->vehical_num;

        $listDataCar = CarController::getAllCar();
        foreach($listDataCar as $subListDataCar) {
            if($vehical_num == $subListDataCar->vehical_num) {
                $resultMessage = "The vehical is has been used !";
                return $resultMessage;
            }
        }


        // dd($get_image);
        if($id_ud != 0){
            $resultCar = DB::table('taxi')->insert([
                'vehical_num' => $request->vehical_num,
                'company_id' => $request->company_id,
                'id_ud' => $request->id_ud
            ]);
            return $resultCar;
        } else {
            $resultCar = DB::table('taxi')->insert([
                'vehical_num' => $request->vehical_num,
                'company_id' => $request->company_id
            ]);
            return $resultCar;
        }
        return Redirect::to('car/add-car');
    }
    
    function updateNewCar(Request $request) {

        $id_ud = $request->id_ud;
        $vehical_num = $request->vehical_num;

        $listDataCar = CarController::getAllCar();
        foreach($listDataCar as $subListDataCar) {
            if($vehical_num == $subListDataCar->vehical_num && $id_ud == $subListDataCar->id_ud) {
                $resultMessage = "The vehical is has been used !";
                return $resultMessage;
            }
        }


        // dd($get_image);
        if($id_ud != 0){
            $resultCar = DB::table('taxi')
            ->where(['id_car'=>$request->id_car])
            ->update([
                'vehical_num' => $request->vehical_num,
                'company_id' => $request->company_id,
                'id_ud' => $request->id_ud
            ]);
            return $resultCar;
        } else {
            $resultCar = DB::table('taxi')
            ->where(['id_car'=>$request->id_car])
            ->update([
                'vehical_num' => $request->vehical_num,
                'company_id' => $request->company_id
            ]);
            return $resultCar;
        }

        return Redirect::to('driver/all-driver');
    }

    function deleteCar($id_car) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            
            $dataBrand = DB::table('taxi')
            ->where(['id_car'=>$id_car])
            ->delete(); 

            return Redirect::to('/cars/all-car');
        }else{
            return Redirect::to('/');
        }
    }

    function getAllCar() {
        $dataCompany = DB::table('taxi')
        ->get(
            array(
                'vehicle_num',
                'company_id',
                'tablet_id',
                'sim_number',
                'app_id'
                )
        );
        return $dataCompany;
    }

    function getAllCarFlowCompany($id_company) {
        $dataCompany = DB::table('taxi')
        ->where(['company_id' => $id_company])
        ->get(
            array(
                'id_car',
                'id_ud',
                'company_id',
                'vehical_num'
                )
        );
        return $dataCompany;
    }

    function getAllCarForPageFlowCompany($start, $limit, $id_company) {
        $dataCompany = DB::table('taxi')
        ->where(['company_id' => $id_company])
        ->offset($start)->limit($limit)
        ->get(
            array(
                'id_car',
                'id_ud',
                'company_id',
                'vehical_num'
                )
        );
        return $dataCompany;
    }

    function getAllCompany() {
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
    function getAllCompanyMinimum()
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
    function getAllDriver() {
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

    function getAllCarForPage($start, $limit) {
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
    function getMinimumCompany_withID($company_id)
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
    function searchTaxiByVehicleNumber(Request $request)
    {
        return response()->json(['data'=>
            CarController::getDataCar_withVehicleNumber($request->post('textVehicleNumber'))
        ]);
    }
    function getDataCar_withID($id_car)
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

    function getDataCar_withVehicleNumber($vehicleNumber)
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
}
