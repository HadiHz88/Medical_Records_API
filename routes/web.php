<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app'); // Make sure the Blade view file is named app.blade.php
})->where('any', '.*');

