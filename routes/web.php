<?php

use Illuminate\Support\Facades\Route;

//admin
Route::get('admin', function () {
    return redirect('admin/login');
});

Route::get('/', function () {
    return redirect('admin/login');
});

Route::get('admin/login', 'admin\UserController@login');
Route::get('admin/welcome', 'admin\UserController@welcome');
Route::get('admin/logout', 'admin\UserController@logout');
Route::post('admin/login', 'admin\UserController@login_action');
Route::get('admin/user/welcome', 'admin\UserController@welcome');
Route::get('admin/pertumbuhan/ibu', 'admin\pertumbuhan\IbuController@ibu');
Route::get('admin/pertumbuhan/balita/{ibu_id}', 'admin\pertumbuhan\BalitaController@balita');
Route::get('admin/pertumbuhan/kuesioner', 'admin\pertumbuhan\KuesionerController@kuesioner');
Route::get('admin/pertumbuhan/prosentasekuesioner', 'admin\pertumbuhan\KuesionerController@prosentasekuesioner');
Route::get('admin/pertumbuhan/historibaca', 'admin\pertumbuhan\KuesionerController@historibaca');







Route::get('/product')->name('product.index')->uses('ProductController@index');
Route::get('/yajra')->name('yajra.index')->uses('ProductController@datatablesIndex');