<?php

use Illuminate\Support\Facades\Route;

Route::resource('products', 'ProductController');

Route::get('/login', function(){
    return 'Login Page';
})->name('login');

Route::get('/', function () {
    return view('welcome');
});
