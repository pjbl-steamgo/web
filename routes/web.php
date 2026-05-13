<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/dashboard', function () {
    return view('index');
});