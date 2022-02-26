<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentTypeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\SubjectController;
use App\Models\ContentType;

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
    return view('welcome');
});

Route::get('/test', function () {
    return view('backend.widget.widget');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('content-type', ContentTypeController::class);
    Route::resource('content', ContentController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('subjects', SubjectController::class);

    Route::get('/exam/{id}/subjects',[ExamController::class,'examSubject'])->name('exam.subject');


    Route::get('/widgets',[DashboardController::class,'widgets'])->name('widgets');

    Route::resource('setting',SettingController::class);

    

});
