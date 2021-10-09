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
});

Route::group(['middleware' => ['auth', 'role:received'], 'prefix' => 'panel'], function(){ // Если роль вообще есть, значит есть доступ к панели управления
    Route::get('/', [App\Http\Controllers\PanelController::class, 'index'])->name('panel');

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'panelIndex'])->name('panel_cat_list');
        Route::get('/add', [App\Http\Controllers\CategoryController::class, 'create'])->name('add_category');
        Route::post('/save', [App\Http\Controllers\CategoryController::class, 'store'])->name('add_category_save');
        Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('show_category');
        Route::post('/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category_update');
        Route::post('/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category_delete');
    });
});

