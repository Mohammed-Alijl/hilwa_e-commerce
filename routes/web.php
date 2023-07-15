<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
require __DIR__ . '/auth.php';

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

    Route::get('/',[\App\Http\Controllers\DashboardController::class,'create'])->name('dashboard');
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('settings',SettingController::class);
    Route::get('cities/{id}',[\App\Http\Controllers\CityController::class,'index']);


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::post('/check-email', [UserController::class, 'checkEmail']);
    Route::post('/check-mobile', [UserController::class, 'checkMobile']);
    Route::post('/check-code', [UserController::class, 'checkCode']);
});
