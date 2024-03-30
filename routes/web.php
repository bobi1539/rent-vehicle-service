<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get(config("endpoint.CATEGORY"), "getCategoryWithPagination")->middleware('auth');
    Route::get(config("endpoint.CATEGORY") . "/all", "getCategoryWithoutPagination")->middleware('auth');
    Route::get(config("endpoint.CATEGORY") . "/{categoryId}", "getCategoryById")->middleware('auth');
    Route::post(config("endpoint.CATEGORY"), "saveCategory")->middleware('auth');
    Route::put(config("endpoint.CATEGORY") . "/{categoryId}", "updateCategory")->middleware('auth');
    Route::delete(config("endpoint.CATEGORY") . "/{categoryId}", "deleteCategory")->middleware('auth');
});

Route::controller(AuthController::class)->group(function () {
    Route::post(config("endpoint.AUTH_LOGIN"), "login");
    Route::post(config("endpoint.AUTH_LOGOUT"), "logout");
    Route::get(config("endpoint.AUTH_USER"), "getUserData");
});
