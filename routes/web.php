<?php

use Illuminate\Support\Facades\Route;

Route::get('/{vueRoutes?}', function() {
    return view('welcome');
})->where('vueRoutes', '[\/\w\.-]*');