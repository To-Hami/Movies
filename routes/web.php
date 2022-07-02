<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
//        'auth',
//        'role:admin|super_admin',
    ]


], function () {
Route::get('/', [WelcomeController::class,'index'])->name('welcome');

Route::get('/home', [HomeController::class ,'index'])->name('home');

Auth::routes();




});

