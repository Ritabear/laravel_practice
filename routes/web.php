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
Route::view('/', 'home');
Route::view('/admin', 'backend.module', ['header' => '123123']);

Route::view('/title', 'layouts.layout');

Route::prefix('admin')->group(function () {
    Route::get('/title', [TitleController::class, 'index']);
    Route::get('/ad', [AdController::class, 'index']);
    Route::get('/image', [ImageController::class, 'index']);
    Route::get('/mvim', [MvimController::class, 'index']);
    Route::get('/total', [TotalController::class, 'index']);
    Route::get('/bottom', [BottomController::class, 'index']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/menu', [MenuController::class, 'index']);
    //符合這個route會導到次選單管理頁面
    Route::get('/submenu/{menu_id}', [SubMenuController::class, 'index']);

    //post
    Route::post('/title', [TitleController::class, 'store']);
    Route::post('/ad', [AdController::class, 'store']);
    Route::post('/image', [ImageController::class, 'store']);
    Route::post('/mvim', [MvimController::class, 'store']);
    Route::post('/news', [NewsController::class, 'store']);
    Route::post('/admin', [AdminController::class, 'store']);
    Route::post('/menu', [MenuController::class, 'store']);
    Route::post('/submenu/{menu_id}', [SubMenuController::class, 'store']);

    //update
    Route::patch('/title/{id}', [TitleController::class, 'update']);
    Route::patch('/ad/{id}', [AdController::class, 'update']);
    Route::patch('/image/{id}', [ImageController::class, 'update']);
    Route::patch('/mvim/{id}', [MvimController::class, 'update']);
    Route::patch('/total/{id}', [TotalController::class, 'update']);
    Route::patch('/bottom/{id}', [BottomController::class, 'update']);
    Route::patch('/news/{id}', [NewsController::class, 'update']);
    Route::patch('/admin/{id}', [AdminController::class, 'update']);
    Route::patch('/menu/{id}', [MenuController::class, 'update']);
    Route::patch('/submenu/{id}', [SubMenuController::class, 'update']);

    //delete
    Route::delete('/title/{id}', [TitleController::class, 'destroy']);
    Route::delete('/ad/{id}', [AdController::class, 'destroy']);
    Route::delete('/image/{id}', [ImageController::class, 'destroy']);
    Route::delete('/mvim/{id}', [MvimController::class, 'destroy']);
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);
    Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
    Route::delete('/submenu/{id}', [SubMenuController::class, 'destroy']);

    //show
    //patch 小心長得像會跑錯，如果放上面就會先跑sh，會跑錯
    Route::patch('/title/sh/{id}', [TitleController::class, 'display']);
    Route::patch('/ad/sh/{id}', [AdController::class, 'display']);
    Route::patch('/image/sh/{id}', [ImageController::class, 'display']);
    Route::patch('/mvim/sh/{id}', [MvimController::class, 'display']);
    Route::patch('/news/sh/{id}', [NewsController::class, 'display']);
    Route::patch('/menu/sh/{id}', [MenuController::class, 'display']);
});

//modals
Route::view('/modals/addTitle', 'modals.base_modal');
