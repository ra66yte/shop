<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


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



Auth::routes();

// Main
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'main'])->name('main');

// Категории
Route::group(['prefix' => 'categories'], function(){
    Route::get('/', [CategoryController::class, 'index'])->name('categories_list');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('show_category');
});

Route::group(['middleware' => ['auth', 'role:received'], 'prefix' => 'panel'], function(){ // Если роль вообще есть, значит есть доступ к панели управления
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::post('/get_alias', [PanelController::class, 'getAlias'])->name('panel_get_alias');

    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [ProductController::class, 'panelIndex'])->name('panel_products_list');
        Route::get('/add', [ProductController::class, 'create'])->name('panel_product_add');
        Route::post('/save', [ProductController::class, 'store'])->name('add_product_save');
        Route::post('/update', [ProductController::class, 'update'])->name('product_update');
        Route::post('/delete', [ProductController::class, 'delete'])->name('product_delete');
        Route::get('/{id}', [ProductController::class, 'panelShow'])->name('panel_product_show');

    });

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [CategoryController::class, 'panelIndex'])->name('panel_cat_list');
        Route::get('/add', [CategoryController::class, 'create'])->name('panel_category_add');
        Route::post('/save', [CategoryController::class, 'store'])->name('add_category_save');
        Route::post('/update', [CategoryController::class, 'update'])->name('category_update');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('category_delete');
        // Route::post('/exists_by_name', [CategoryController::class, 'existsCategoryByName'])->name('exists_cat_by_name');
        Route::get('/{id}', [CategoryController::class, 'panelShow'])->name('panel_category_show');
    });
});


