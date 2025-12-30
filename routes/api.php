<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/progress_proyek/{proyek_id}', 'App\Http\Controllers\Api\InfoProyekController@getDetailProgress');


Route::apiResource('posts', 'App\Http\Controllers\Api\PostController');
Route::apiResource('comments', 'App\Http\Controllers\Api\CommentController');
Route::get('/posts/{postId}/comments', 'App\Http\Controllers\Api\CommentController@commentsByPost');
Route::apiResource('likes', 'App\Http\Controllers\Api\LikesController');

Route::middleware(['auth:sanctum', 'check.expiration'])->group(function () {
    Route::apiResource('products', 'App\Http\Controllers\Api\ProductController');
    Route::get('/logout', 'App\Http\Controllers\Api\Auth\LoginController@_invoke');
    Route::get('/users/{userId}/posts', 'App\Http\Controllers\Api\PostController@getUserPosts');

});
Route::post('/register', 'App\Http\Controllers\Api\Auth\RegisterController@_invoke');
Route::post('/login', 'App\Http\Controllers\Api\Auth\LoginController@_invoke');

Route::apiResource('restorans', 'App\Http\Controllers\Api\RestoranController');
Route::apiResource('sekolah', 'App\Http\Controllers\Api\SekolahController');

Route::apiResource('info_proyek', 'App\Http\Controllers\Api\InfoProyekController');
Route::apiResource('kesiapan_lahan', 'App\Http\Controllers\Api\KesiapanLahanController');
Route::apiResource('cuaca_lokasi_amp', 'App\Http\Controllers\Api\CuacaLokasiAmp');
Route::apiResource('cuaca_lahan_penghamparan', 'App\Http\Controllers\Api\CuacaLahanPenghamparan');
Route::apiResource('kondisi_lahan_penghamparan', 'App\Http\Controllers\Api\KondisiLahan');
Route::apiResource('dimensi_lahan', 'App\Http\Controllers\Api\DimensiLahanController');
Route::apiResource('item_pekerjaan', 'App\Http\Controllers\Api\ItemPekerjaanController');
