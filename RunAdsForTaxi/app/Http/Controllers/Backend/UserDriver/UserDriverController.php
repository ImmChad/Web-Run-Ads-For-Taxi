<?php

namespace App\Http\Controllers\Backend\UserDriver;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class UserDriverController extends Controller
{
    function showAddDriver() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return view('Backend.main.user_drivers.add-user-driver');
        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showAllDriver() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){


            $listDataDriver = UserDriverController::getAllDriver();


            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = count($listDataProduct);
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($listDataDriver);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataDriver = UserDriverController::getAllDriverForPage($start, $limit);




            $newListDataDriver = new stdClass();
            $ListDriver = [];
            foreach($listDataDriver as $subListDataDriver) {
                $today = date('Y');
                $date = DateTime::createFromFormat("Y-m-d", $subListDataDriver->birthday_ud);
                $date = $date->format("Y");

                $age = (int)$today - (int)$date;

                $subListDataDriver->age = $age;

                $ListDriver[count($ListDriver)] = (object)$subListDataDriver ;
            }
            $newListDataDriver = $ListDriver;




            return view('Backend.main.user_drivers.all-user-driver')
            ->with(['page'=> $page])
            ->with(['total_page'=> $total_page])
            ->with(['listDataDriver'=> $newListDataDriver]);

        }else{
            return Redirect::to('/');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function showUpdateDriver($id_ud) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $dataDriver = DB::table('user_drivers')
            ->where(['id_ud'=>$id_ud])
            ->get(
                array(
                    'id_ud',
                    'name_ud',
                    'num_phone_ud',
                    'password_ud',
                    'birthday_ud',
                    'url_avt_ud'
                    )
            )->first();
            return view('Backend.main.user_drivers.update-user-driver')->with(['dataDriver' => $dataDriver]);
        }else{
            return Redirect::to('/');
        }
    }

    function addNewDriver(Request $request) {
        $get_image = $request->file('url_avt_ud');
        // dd($get_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/user_drivers/',$new_image);
            $new_link_image = 'uploads/user_drivers/'.$new_image;
            $url_avt_ud = $new_link_image;
            $resultBrand = DB::table('user_drivers')->insert([
                'name_ud' => $request->name_ud,
                'num_phone_ud' => $request->num_phone_ud,
                'birthday_ud' => $request->birthday_ud,
                'url_avt_ud' => $url_avt_ud
            ]);
            return $resultBrand;
        }
        return Redirect::to('driver/add-driver');
    }
    
    function updateNewDriver(Request $request) {

        $get_image = $request->file('url_avt_ud');
        // dd($get_image);
        if($get_image){

             // unlink image news
            $res_Image_News = DB::table('user_drivers')->where('id_ud', $request->id_ud)->get(['url_avt_ud']);
            // dd($res_Image_News[0]->news_image);
            $path_Image = ($res_Image_News[0]->url_avt_ud);
            // dd($path_Image);
            // dump($path_Image);

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/user_drivers/',$new_image);
            $new_link_image = 'uploads/user_drivers/'.$new_image;
            $url_avt_ud = $new_link_image;
            $resultDriver = DB::table('user_drivers')
            ->where(['id_ud'=>$request->id_ud])
            ->update([
                'name_ud' => $request->name_ud,
                'num_phone_ud' => $request->num_phone_ud,
                'birthday_ud' => $request->birthday_ud,
                'url_avt_ud' => $url_avt_ud
            ]);
            return $resultDriver;
        } else {

            $resultDriver = DB::table('user_drivers')
            ->where(['id_ud'=>$request->id_ud])
            ->update([
                'name_ud' => $request->name_ud,
                'num_phone_ud' => $request->num_phone_ud,
                'birthday_ud' => $request->birthday_ud
            ]);
            return $resultDriver;
        }


        return Redirect::to('driver/all-driver');
    }

    function deleteDriver($id_ud) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
             // unlink image news
            $res_Image_News = DB::table('user_drivers')->where('id_ud', $id_ud)->get(['url_avt_ud']);
            $path_Image = ($res_Image_News[0]->url_avt_ud);
            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }
            $dataBrand = DB::table('user_drivers')
            ->where(['id_ud'=>$id_ud])
            ->delete(); 

            return Redirect::to('/driver/all-driver');
        }else{
            return Redirect::to('/');
        }
    }

    function getAllDriver() {
        $dataCompany = DB::table('user_drivers')
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
        return $dataCompany;
    }

    function getAllDriverForPage($start, $limit) {
        $dataCompany = DB::table('user_drivers')
        ->offset($start)->limit($limit)
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
        return $dataCompany;
    }
}
