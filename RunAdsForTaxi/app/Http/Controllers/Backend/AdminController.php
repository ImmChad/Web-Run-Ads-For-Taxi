<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use stdClass;

class AdminController extends Controller

{
    public function AuthLogin(){
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/login');
        }
    }
    function index() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return Redirect::to('/dashboard');
        }else{
            return view('Backend.login');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }



    function loginAdmin(Request $request) {

        $numPhone = $request->numPhone;
        $password = $request->password;

        // dd($password);

        $login = DB::table('admin')
        ->where(['num_phone_admin'=>$numPhone])
        ->where(['password_admin'=>$password])->get()->first();

        if($login) {
            $inforAdmin = new stdClass();
            $inforAdmin->id_admin = $login->id_admin;
            $inforAdmin->name_admin = $login->name_admin;
            $inforAdmin->num_phone_admin = $login->num_phone_admin;
            $inforAdmin->password_admin = $login->password_admin;
            $inforAdmin->birthday_admin = $login->birthday_admin;
            // dd($login);

            $request->session()->put('inforAdmin', $inforAdmin);
            return Redirect::to('/dashboard');
        } else {
            return view('Backend.login')
            ->with('messToast', 'Your number phone or password wrong.');
        }
        
    }

    function logoutAdmin() {
        Session::forget('inforAdmin');
        return view('Backend.login')
        ->with('messToast', 'Log out successful.');
    }


    function showUpdateProfileAdmin() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){


            // dd($inforAdmin);
            return view('Backend.update-admin')
            ->with(['inforAdmin' => $inforAdmin]);
        }else{
            return view('Backend.login');
        }
    }


}
