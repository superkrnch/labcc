<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api-test', function () {
    return view('api-test');
});

Route::resource('people', PersonController::class);
