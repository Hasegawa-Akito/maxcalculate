<?php

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
    return view('login');
});


Route::get('/failure', function () {
    return view('failure');
});

// ログインURL
//Route::get('auth/{provider}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
// コールバックURL
//Route::get('auth/twitter/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
//tweet時のformの行先
//Route::post('/tweet','App\Http\Controllers\TrainingController@tweet');

//登録画面
Route::get('/register','App\Http\Controllers\Auth\LoginController@registerpage');


//ゲストログイン
Route::get('guest/login', 'App\Http\Controllers\Auth\LoginController@guestlogin');
//メンバーログイン ベンチプレス
Route::get('member/login', 'App\Http\Controllers\Auth\LoginController@memberlogin');
Route::post('member/login', 'App\Http\Controllers\Auth\LoginController@memberlogin');

//スクワット
Route::post('/MAXcalculate/{info}/squat','App\Http\Controllers\TrainingSquatController@MAX');
Route::get('/MAXcalculate/{info}/squat','App\Http\Controllers\TrainingSquatController@index');

//デッドリフト
Route::post('/MAXcalculate/{info}/deadlift','App\Http\Controllers\TrainingDeadliftController@MAX');
Route::get('/MAXcalculate/{info}/deadlift','App\Http\Controllers\TrainingDeadliftController@index');

//ベンチプレス
Route::post('/MAXcalculate/{info}','App\Http\Controllers\TrainingController@MAX');
Route::get('/MAXcalculate/{info}','App\Http\Controllers\TrainingController@index');

//BMI
Route::post('/bmi/{info}','App\Http\Controllers\BmiController@bmi');
Route::get('/bmi/{info}','App\Http\Controllers\BmiController@bmi_index');
//BNIでの体重目標設定
Route::post('/bmi/{info}/target','App\Http\Controllers\BmiController@target');

//記録消去
Route::post('/record/{type}/delete','App\Http\Controllers\DisplayController@dele');
//記録の種類変更
Route::post('/record/change','App\Http\Controllers\DisplayController@display_change');
//表示月変更
Route::post('/record/{type}/date','App\Http\Controllers\DisplayController@display_date');
//記録表示
Route::get('/record/{type}','App\Http\Controllers\DisplayController@display');


//新規登録
Route::post('/member/register','App\Http\Controllers\Auth\LoginController@register');

// ログアウトURL
Route::get('member/logout', 'App\Http\Controllers\Auth\LoginController@logout');

