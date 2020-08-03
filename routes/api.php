<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','c_aktor@register');

Route::get('/getMahasiswa/{nim}', 'c_api@getIndexMahasiswa');
Route::get('/getKemahasiswaan', 'c_api@getIndexKemahasiswaan');
Route::get('/getAkademik', 'c_api@getIndexAkademik');
Route::post('/mahasiswatambah', 'c_api@mahasiswaTambah');
Route::post('/kegiatantambah', 'c_api@kegiatanTambah');
Route::get('/getHapus/{id_prestasi}', 'c_api@getHapus');
Route::get('/getTolak/{id_prestasi}', 'c_api@getTolak');
Route::get('/getVerifikasi/{id_prestasi}', 'c_api@getVerifikasi');
Route::get('/exportpdf', 'c_api@exportpdf');
Route::get('/exportexcel', 'c_api@exportexcel');
