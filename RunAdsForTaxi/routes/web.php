<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Car\CarController;
use App\Http\Controllers\Backend\Company\CompanyController;
use App\Http\Controllers\Backend\DashBoard\DashBoardController;
use App\Http\Controllers\Backend\VideoAds\VideoAdsController;
use App\Http\Controllers\Backend\ViewAdsVideo\ViewAdsVideoController;
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

// emulator 
Route::get('/emulator-mobile', function () {
    return view('emulatorMobile');
});

Route::group(['prefix' => '/api/view-ads-video'], function()
{
    Route::get('/get-exist-video', [ViewAdsVideoController::class, 'getAllVideo_withAppID']);
    Route::post('/human-event', [ViewAdsVideoController::class, 'insertHumanEvent']);
});

 // admin dashboard
Route::group(array('prefix' => '/dashboard'), function() {
    Route::get('/', [DashBoardController::class, 'index']);
    Route::post('/get-data-statistics', [DashBoardController::class, 'getDataStatistics']);
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
    Route::get('/add-car', [CarController::class, 'showAddTaxi']);
    Route::get('/all-car', [CarController::class, 'showAllCar']);
    Route::get('/all-car-flow-company', [CarController::class, 'showAllCarFlowCompany']);
    Route::get('/update-car/{id_car}', [CarController::class, 'showUpdateCar']);

    Route::post('/add-new-car', [CarController::class, 'addTaxi']);
    Route::get('/delete-car/{id_car}', [CarController::class, 'deleteCar']);
    Route::post('/update-new-car', [CarController::class, 'updateTaxi']);
    Route::post('/search-vehicle-number', [CarController::class, 'searchTaxiByVehicleNumber']);
    Route::post('/delete-taxi', [CarController::class, 'deleteTaxi']);
});

// admin video ads
Route::group(array('prefix' => '/video'), function() {
    Route::get('/add-video', [VideoAdsController::class, 'showAddVideo']);
    Route::get('/all-video', [VideoAdsController::class, 'showAllVideo']);
    Route::get('/all-image', [VideoAdsController::class, 'showAllImage']);

    
    Route::post('/update-company-video-image', [VideoAdsController::class, 'updateCompanyVideoImage']);
    // Route::get('/update-video/{id_videos_ads}', [VideoAdsController::class, 'showUpdateVideo']);
    // Route::get('/delete-video/{id_videos_ads}', [VideoAdsController::class, 'deleteVideo']);
    // Route::post('/update-new-video', [VideoAdsController::class, 'updateNewVideo']);


    Route::post('/add-video-in-media', [VideoAdsController::class, 'addVideoInMedia']);
    Route::post('/add-image-in-media', [VideoAdsController::class, 'addImageInMedia']);
    Route::post('/delete-video-in-media', [VideoAdsController::class, 'deleteVideoInMedia']);
    Route::post('/delete-image-in-media', [VideoAdsController::class, 'deleteImageInMedia']);

    Route::post('/get-all-video-in-media', [VideoAdsController::class, 'getAllVideoAds']);
    Route::post('/get-all-image-in-media', [VideoAdsController::class, 'getAllPhoto']);



});

