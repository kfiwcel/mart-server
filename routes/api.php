<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', 'App\Http\Controllers\CategoryController');
Route::get('/test',function (){
    return 'mart.test.com';
});
