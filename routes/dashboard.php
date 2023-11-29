<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;



Route::group([
    'middleware'=>'auth',
    'as'=>'dashboard.',
    'prefix'=>'dashboard'
],function(){

    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::get('/',[DashboardController::class,'index']);
    Route::get('/categories/trash',[CategoryController::class,'trash'])
    ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoryController::class,'restore'])
    ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategoryController::class,'force_delete'])
    ->name('categories.force-delete');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/products',ProductController::class);

});
