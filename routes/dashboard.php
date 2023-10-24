<?php
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

    Route::group([
        "middleware"=>'auth',
        'as'=>'dashboard.'
    ],function(){

        Route::get('/dashboard',[DashboardController::class,'index']);
        Route::get('/categories/trash',[CategoriesController::class,'trash'])
        ->name('categories.trash');
        Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])
        ->name('categories.restore');
        Route::delete('categories/{category}/delete',[CategoriesController::class,'forceDelete'])
        ->name('categories.forcedelete');
        Route::resource('/categories',CategoriesController::class);
        Route::resource('/products',ProductController::class);
    });