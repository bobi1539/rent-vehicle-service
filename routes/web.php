<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get(config("endpoint.CATEGORY"), "getCategories");
    Route::post(config("endpoint.CATEGORY"), "saveCategory");
});
