<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::any('products/search', 'ProductController@search')->name('products.search')->middleware('auth');

Route::resource('products', 'ProductController')->middleware(['auth','check.is.admin']);

Route::get('/login', function(){
    return 'Login Page';
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => true]);