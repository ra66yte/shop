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
    return view('index');
});

Auth::routes();

// Кабинет
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('main');

// Категории
Route::group(['prefix' => 'categories'], function(){
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories_list');
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('show_category');
});

Route::group(['middleware' => ['auth', 'role:received'], 'prefix' => 'panel'], function(){ // Если роль вообще есть, значит есть доступ к панели управления
    Route::get('/', [App\Http\Controllers\PanelController::class, 'index'])->name('panel');
    Route::post('/get_alias', [App\Http\Controllers\PanelController::class, 'getAlias'])->name('panel_get_alias');

    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'panelIndex'])->name('panel_products_list');
        Route::get('/add', [App\Http\Controllers\ProductController::class, 'create'])->name('add_product');
        Route::post('/save', [App\Http\Controllers\ProductController::class, 'store'])->name('add_product_save');
        Route::post('/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product_update');
        Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'panelShow'])->name('show_product');
    });

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'panelIndex'])->name('panel_cat_list');


        // Route::post('/exists_by_name', [App\Http\Controllers\CategoryController::class, 'existsCategoryByName'])->name('exists_cat_by_name');
        Route::get('/add', [App\Http\Controllers\CategoryController::class, 'create'])->name('add_category');
        Route::post('/save', [App\Http\Controllers\CategoryController::class, 'store'])->name('add_category_save');
        Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'panelShow'])->name('show_category');
        Route::post('/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category_update');
        Route::post('/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category_delete');
    });
});


