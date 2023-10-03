<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;


    Route::get('/dashboard',[DashboardController::class,'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    Route::resource('dashboard/categories',CategoriesController::class);