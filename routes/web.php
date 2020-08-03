<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('v_login');
})->name('login');

Route::get('/', function () {
    return view('v_login_mahasiswa');
});

Route::post('/loginmahasiswa','c_aktor@loginMahasiswa');
Route::post('/loginkaryawan','c_aktor@loginKaryawan');
Route::get('/logout','c_aktor@logout');

Route::group(['middleware' => 'nim'],function() {
  Route::get('/mahasiswa','c_prestasi@indexMahasiswa');
  Route::post('/mahasiswa/tambah','c_prestasi@tambahPrestasi');
  Route::get('/mahasiswa/{id_prestasi}/hapus','c_prestasi@hapus');
  Route::get('/mahasiswa/export','c_prestasi@exportDraft');

  Route::get('/kemahasiswaan','c_prestasi@indexKemahasiswaan');
  Route::get('/kemahasiswaan/{id_prestasi}/verifikasi','c_prestasi@verifikasi');
  Route::get('/kemahasiswaan/{id_prestasi}/tolak','c_prestasi@tolak');
  Route::post('/kemahasiswaan/tambah','c_prestasi@tambahKegiatan');

  Route::get('/akademik','c_prestasi@indexAkademik');
  Route::get('/akademik/export','c_prestasi@exportExcel');
});
