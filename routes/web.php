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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', 'AdminController@loginIndex');

Route::post('/admin/login/proses', 'AdminController@loginProses');

Route::get('/admin/dashboard', 'AdminController@dashboardAdmin');

Route::get('/admin/logout', 'AdminController@logout');

Route::get('/admin/gantiPassword', 'AdminController@gantiPassword');

Route::post('/admin/gantiPassword/proses', 'AdminController@gantiPasswordProses');

//Route Proposal

Route::get('/admin/kelola/proposal', 'DataProposalController@kelolaProposal');

Route::post('/admin/kelola/proposal/setujui', 'DataProposalController@setujuiProposal');

Route::post('/admin/kelola/proposal/hapus', 'DataProposalController@hapusProposal');

//Route Data Mitra

Route::get('/admin/kelola/dataMitra', 'DataMitraController@kelolaDataMitra');

Route::post('/admin/kelola/dataMitra/hapus', 'DataMitraController@hapusDataMitra');

//Route Berita

Route::get('/admin/kelola/berita', 'BeritaController@kelolaBerita');

Route::get('/admin/kelola/berita/ubah/{judul_berita}', 'BeritaController@ubahBeritaIndex');

Route::post('/admin/kelola/berita/tambah', 'BeritaController@tambahBerita');

Route::post('/admin/kelola/berita/hapus', 'BeritaController@hapusBerita');

Route::post('/admin/kelola/berita/ubah', 'BeritaController@ubahBerita');

//Route Pinjaman

Route::get('/admin/kelola/pinjaman', 'PinjamanController@kelolaPinjaman');

Route::get('/admin/kelola/pinjaman/pengajuan/{no_pk}', 'PinjamanController@printDokumenPengajuan');

Route::post('/admin/kelola/pinjaman/pengajuan/setujui', 'PinjamanController@setujuiPengajuan');

Route::post('/admin/kelola/pinjaman/pengajuan/hapus', 'PinjamanController@hapusPengajuan');

Route::post('/admin/kelola/pinjaman/namaPengaju', 'PinjamanController@getNamaPengaju');

Route::post('/admin/kelola/pinjaman/tambah', 'PinjamanController@tambahPinjaman');

Route::post('/admin/kelola/pinjaman/transfer', 'PinjamanController@transferPinjaman');

Route::post('/admin/kelola/pinjaman/notifikasi', 'PinjamanController@notificationHandler');

//Route Angsuran

Route::get('/admin/kelola/angsuran', 'AngsuranController@kelolaAngsuran');

//Route Mitra

Route::get('/mitra/login', 'MitraController@loginIndex');

Route::post('/mitra/login/proses', 'MitraController@loginProses');

Route::get('/mitra/dashboard', 'MitraController@dashboard');

//Route Data Mitra

Route::get('/mitra/dataMitra', 'MitraController@dataMitra');

Route::post('/mitra/dataMitra/ubah', 'MitraController@ubahMitra');

//Route pinjaman

Route::get('/mitra/pinjaman', 'MitraController@pinjaman');

Route::post('/mitra/pinjaman/ajukan', 'MitraController@ajukanPinjaman');


