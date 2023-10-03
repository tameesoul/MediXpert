<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

    Route::group([
        "middleware"=>'auth',
        'as'=>'dashboard.'
    ],function(){
        Route::get('/dashboard',[DashboardController::class,'index']);
        Route::resource('dashboard/categories',CategoriesController::class);
    });