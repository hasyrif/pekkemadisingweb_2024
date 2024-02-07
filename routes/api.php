<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ibu
Route::post('pertumbuhan/ibu/login', 'Api\pertumbuhan\IbuController@login');
Route::post('pertumbuhan/ibu/edit', 'Api\pertumbuhan\IbuController@edit');
Route::post('pertumbuhan/ibu/register', 'Api\pertumbuhan\IbuController@register');

//balita
Route::post('pertumbuhan/balita', 'Api\pertumbuhan\BalitaController@balita');
Route::post('pertumbuhan/balita/edit', 'Api\pertumbuhan\BalitaController@edit');
Route::post('pertumbuhan/balita/getnamadanumur', 'Api\pertumbuhan\BalitaController@getnamadanumur');

//berat badan tinggi badan
Route::post('pertumbuhan/prosespertumbuhan/status', 'Api\pertumbuhan\ProsespertumbuhanController@status');
Route::post('pertumbuhan/prosespertumbuhan/histori', 'Api\pertumbuhan\ProsespertumbuhanController@histori');

Route::post('pertumbuhan/materi/waktubaca', 'Api\pertumbuhan\ProsespertumbuhanController@waktubaca');

//kuesioner
Route::post('pertumbuhan/kuesioner/proses', 'Api\pertumbuhan\KuesionerpertumbuhanController@proses');
//tes
Route::get('statusberatbadan', 'Api\TesController@statusberatbadan');
Route::get('statuspanjangbadan', 'Api\TesController@statuspanjangbadan');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
