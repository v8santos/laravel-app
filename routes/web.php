<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return 'login page';
})->name('login');

Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function () {
    Route::get('/profile', 'TesteController@teste')->name('admin.profile');
                
    Route::get('/dashboard', 'TesteController@teste')->name('admin.dashboard');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard') ;
    })->name('admin.home');
});

Route::get('/log-user', function () {
    return redirect()->route('user.name');
})->middleware('auth');

Route::get('/name-user', function () {
    return 'name-user';
})->name('user.name');

Route::view('/home', 'welcome');

Route::redirect('/redirect1', '/redirect2');

// Route::get('/redirect1', function () {
//     return redirect('/redirect2');
// });

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
