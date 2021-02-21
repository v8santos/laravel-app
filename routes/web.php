<?php

use Illuminate\Support\Facades\Route;

Route::get('/redirect2', function () {
    return 'redirect2';
});

Route::get('produtos/{flag?}', function ($flag = '') {
    return "Produto(s) $flag";
});

Route::get('/categorias/{flag}/detalhes', function ($flag) {
    return "Detalhes de $flag";
});

Route::get('/categorias/{flag}', function ($flag) {
    return "Produto da categoria: $flag";
});

Route::match(['get','post'],'/match', function () {
    return 'match';
});

Route::any('/any', function () {
    return 'any';
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/', function () {
    return view('welcome');
});
