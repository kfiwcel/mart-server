<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', 'App\Http\Controllers\CategoryController');
Route::apiResource('products', 'App\Http\Controllers\ProductController');
Route::get('/test',function (){
    return 'mart.test.com';
});
