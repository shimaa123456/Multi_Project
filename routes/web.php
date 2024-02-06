<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\MainBannerController;
use App\Http\Controllers\admin\OurWorkController;
use App\Http\Controllers\admin\ContactFormController;

use App\Http\Controllers\users\FrontEnd;
use App\Http\Controllers\admin\Front;
use App\Http\Controllers\users\ConatactForm;

use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function () {
    return view('users.index');
}); */


Route::get('/', [FrontEnd::class, 'index']);
//Route::get('/admin/ourWork/create', [Front::class, 'index']);

Route::resource("/contactForm", ConatactForm::class);


/* ---------------------------------- */
Route::resource('login', LoginController::class);
Route::post('anyPath01', 'App\Http\Controllers\LoginController@verifyLogin')->name('verifyLogin');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');


/* ----------admin routes----------- */
/* Route::get('/admin', function () {
    return view('admin.index');
}); */

/* ----------------------------------- */
Route::group(['middleware' => 'AdminRole'], function () {
    Route::resource("admin/mainBanner", MainBannerController::class);
    Route::resource("admin/ourWork", OurWorkController::class);
    Route::resource("admin/contactForm", ContactFormController::class);


    Route::get('password', 'App\Http\Controllers\LoginController@password')->name('changePassword');
    Route::post('updatePassword', 'App\Http\Controllers\LoginController@updatePassword')->name('updatePassword');
});


// language role
Route::group(['prefix' => '{lang}'], function() {
    Route::get('lang/', function($lang) {
        app()->setLocale($lang);
        session()->put('locale', $lang);

        return redirect('/'.$lang);
    })->name('lang');

    /* Route::get('/', function () {
        return view('welcome');
    }); */


   Route::get('/', [FrontEnd::class, 'index']);
});