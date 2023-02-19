<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Car\CarController;
use App\Http\Controllers\Backend\Company\CompanyController;
use App\Http\Controllers\Backend\DashBoard\DashBoardController;
use App\Http\Controllers\Backend\UserDriver\UserDriverController;
use App\Http\Controllers\Backend\VideoAds\VideoAdsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Backend.index');
});
Route::get('/', [AdminController::class, 'index']);
Route::post('/login-admin', [AdminController::class, 'loginAdmin']);
Route::get('/logout-admin', [AdminController::class, 'logoutAdmin']);
Route::get('/update-profile-admin', [AdminController::class, 'showUpdateProfileAdmin']);
Route::post('/update-new-profile-admin', [AdminController::class, 'updateProfileAdmin']);

Route::get('/dashboard', [DashBoardController::class, 'index']);


 // admin company
Route::group(array('prefix' => '/dashboard'), function() {
    Route::get('/', [DashBoardController::class, 'index']);
    Route::post('/get-data-car', [DashBoardController::class, 'getDataCar']);


});


 // admin company
Route::group(array('prefix' => '/company'), function() {
    Route::get('/add-company', [CompanyController::class, 'showAddCompany']);
    Route::get('/all-company', [CompanyController::class, 'showAllCompany']);

    Route::post('/add-new-company', [CompanyController::class, 'addNewCompany']);
    Route::post('/delete-company', [CompanyController::class, 'deleteCompany']);
    Route::post('/update-new-company', [CompanyController::class, 'updateNewCompany']);
});

 // admin user car
Route::group(array('prefix' => '/car'), function() {
    Route::get('/add-car', [CarController::class, 'showAddCar']);
    Route::get('/all-car', [CarController::class, 'showAllCar']);
    Route::get('/all-car-flow-company', [CarController::class, 'showAllCarFlowCompany']);
    Route::get('/update-car/{id_car}', [CarController::class, 'showUpdateCar']);

    Route::post('/add-new-car', [CarController::class, 'addNewCar']);
    Route::get('/delete-car/{id_car}', [CarController::class, 'deleteCar']);
    Route::post('/update-new-car', [CarController::class, 'updateNewCar']);
    Route::post('/search-vehicle-number', [CarController::class, 'searchTaxiByVehicleNumber']);
});

// admin video ads
Route::group(array('prefix' => '/video'), function() {
    Route::get('/add-video', [VideoAdsController::class, 'showAddVideo']);
    Route::get('/all-video', [VideoAdsController::class, 'showAllVideo']);
    Route::get('/update-video/{id_videos_ads}', [VideoAdsController::class, 'showUpdateVideo']);

    Route::post('/add-new-video', [VideoAdsController::class, 'addNewVideo']);
    Route::get('/delete-video/{id_videos_ads}', [VideoAdsController::class, 'deleteVideo']);
    Route::post('/update-new-video', [VideoAdsController::class, 'updateNewVideo']);
});

