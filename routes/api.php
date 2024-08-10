<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/progress_proyek/{proyek_id}', 'App\Http\Controllers\Api\InfoProyekController@getDetailProgress');
Route::apiResource('products', 'App\Http\Controllers\Api\ProductController');

Route::apiResource('restorans', 'App\Http\Controllers\Api\RestoranController');

Route::apiResource('sekolah', 'App\Http\Controllers\Api\SekolahController');

Route::apiResource('info_proyek', 'App\Http\Controllers\Api\InfoProyekController');
Route::apiResource('kesiapan_lahan', 'App\Http\Controllers\Api\KesiapanLahanController');
Route::apiResource('cuaca_lokasi_amp', 'App\Http\Controllers\Api\CuacaLokasiAmp');
Route::apiResource('cuaca_lahan_penghamparan', 'App\Http\Controllers\Api\CuacaLahanPenghamparan');
Route::apiResource('kondisi_lahan_penghamparan', 'App\Http\Controllers\Api\KondisiLahan');
Route::apiResource('dimensi_lahan', 'App\Http\Controllers\Api\DimensiLahanController');
Route::apiResource('item_pekerjaan', 'App\Http\Controllers\Api\ItemPekerjaanController');