<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get(config("endpoint.CATEGORY"), "getCategoryWithPagination");
    Route::get(config("endpoint.CATEGORY") . "/all", "getCategoryWithoutPagination");
    Route::get(config("endpoint.CATEGORY") . "/{categoryId}", "getCategoryById");
    Route::post(config("endpoint.CATEGORY"), "saveCategory");
    Route::put(config("endpoint.CATEGORY") . "/{categoryId}", "updateCategory");
    Route::delete(config("endpoint.CATEGORY") . "/{categoryId}", "deleteCategory");
});
