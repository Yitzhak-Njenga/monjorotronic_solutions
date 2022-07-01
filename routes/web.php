<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;



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

    return view('home');
});
Route::post('/getquatation',[\App\Http\Controllers\Formcontroller::class,'quote']);
Route::post('/contact',[\App\Http\Controllers\Formcontroller::class,'contact']);

Auth::routes();
Route::get('/admin',function (){
    return view('login');
});
Route::get('/sms',function (){
    return view('sms');
});
Route::post('/login',[\App\Http\Controllers\LoginController::class,'index']);
Route::post('/upload',[\App\Http\Controllers\SmsController::class,'uploadFile']);
//logout and remove session
Route::get('/logout',function (){
    Session::forget('user');
    return redirect('/');
});
