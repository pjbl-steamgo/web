<?php

use Illuminate\Support\Facades\Route;

// Redirect root URL (/) ke dashboard jika diperlukan
Route::get('/', function () {
    return redirect('/dashboard');  
});