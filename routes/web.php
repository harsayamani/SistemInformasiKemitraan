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

use Illuminate\Support\Facades\Route;

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

Route::post('/admin/kelola/dataMitra/lampiran', 'DataMitraController@lampiran');

//Route Berita

Route::get('/admin/kelola/berita', 'BeritaController@kelolaBerita');

Route::get('/admin/kelola/berita/ubah/{judul_berita}', 'BeritaController@ubahBeritaIndex');

Route::post('/admin/kelola/berita/tambah', 'BeritaController@tambahBerita');

Route::post('/admin/kelola/berita/hapus', 'BeritaController@hapusBerita');

Route::post('/admin/kelola/berita/ubah', 'BeritaController@ubahBerita');

//Route Pinjaman

Route::get('/admin/kelola/pinjaman', 'PinjamanController@kelolaPinjaman');

Route::get('/admin/kelola/pinjaman/pengajuan/{no_proposal}', 'PinjamanController@printDokumenPengajuan');

Route::post('/admin/kelola/pinjaman/pengajuan/setujui', 'PinjamanController@setujuiPengajuan');

Route::post('/admin/kelola/pinjaman/pengajuan/hapus', 'PinjamanController@hapusPengajuan');

Route::post('/admin/kelola/pinjaman/namaPengaju', 'PinjamanController@getNamaPengaju');

Route::post('/admin/kelola/pinjaman/tambah', 'PinjamanController@tambahPinjaman');

Route::post('/admin/kelola/pinjaman/transfer', 'PinjamanController@transferPinjaman');

Route::post('/admin/kelola/pinjaman/pengajuan/survei/kirimJadwal', 'PinjamanController@kirimJadwalSurvei');

Route::post('/admin/kelola/pinjaman/pengajuan/survei/hasilSurvei', 'PinjamanController@hasilSurvei');

//Route Angsuran

Route::get('/admin/kelola/angsuran', 'AngsuranController@kelolaAngsuran');

Route::post('/admin/kelola/angsuran/filter', 'AngsuranController@filter');

Route::get('/admin/kelola/angsuran/export/excel/{id_pinjaman}', 'AngsuranController@exportExcel');

//Route FAQ

Route::get('/admin/kelola/faq', 'FAQController@faq');

Route::post('/admin/kelola/faq/jawab', 'FAQController@jawabFAQ');

Route::post('/admin/kelola/faq/hapus', 'FAQController@hapusFAQ');


//Route Mitra

Route::get('/mitra/login', 'MitraController@loginIndex');

Route::post('/mitra/login/proses', 'MitraController@loginProses');

Route::get('/mitra/dashboard', 'MitraController@dashboard');

Route::get('/mitra/logout', 'MitraController@logout');

Route::get('/mitra/gantiPassword', 'MitraController@gantiPassword');

Route::post('/mitra/gantiPassword/proses', 'MitraController@gantiPasswordProses');

Route::get('/mitra/lupaPassword', 'MitraController@lupaPassword');

Route::post('/mitra/lupaPassword/proses', 'MitraController@lupaPasswordProses');

Route::get('/mitra/gantiPasswordLupa/{username}', 'MitraController@gantiPasswordLupa');

Route::post('/mitra/gantiPasswordLupa/proses', 'MitraController@gantiPasswordLupaProses');

Route::get('/mitra/riwayat', 'MitraController@riwayatTransaksi');

//Route Data Mitra

Route::get('/mitra/dataMitra', 'MitraController@dataMitra');

Route::post('/mitra/dataMitra/ubah', 'MitraController@ubahMitra');

//Route pinjaman

Route::get('/mitra/pinjaman', 'MitraController@pinjaman');

Route::post('/mitra/pinjaman/ajukan', 'MitraController@ajukanPinjaman');

//Route angsuran

Route::get('/mitra/angsuran', 'MitraController@angsuran');

Route::post('/mitra/angsuran/transfer', 'MitraController@transferAngsuran');


//Route public

Route::get('/', 'PublicController@index');

Route::post('/faq/send', 'PublicController@faqQuestion');

Route::get('/tentang', 'PublicController@tentang');

Route::get('/alur', 'PublicController@alur');

Route::get('/faq', 'PublicController@faq');

Route::get('/berita', 'PublicController@berita');

Route::get('/berita/kategori/{keterangan}', 'PublicController@beritaKategori');

Route::post('/berita/search', 'PublicController@searchBerita');

Route::get('/berita/{judul_berita}', 'PublicController@detailBerita');

Route::get('/daftar', 'PublicController@registrasi');

Route::post('/daftar/proses', 'PublicController@registrasiProses');

//Route Midtrans

Route::post('/midtrans/notification', 'PinjamanController@notificationHandler');

Route::post('/midtrans/finish', function () {
    return redirect()->back()->with('alert-success', 'Pembayaran berhasil!');
});

Route::post('/midtrans/unfinish', function () {
    return redirect()->back()->with('alert-warning', 'Pembayaran belum selesai, segera lakukan pembayaran sebelum batas waktu!');
});

Route::post('/midtrans/error', function () {
    return redirect()->back()->with('alert-danger', 'Pembayaran gagal, silahkan ulang pembayaran anda!');
});


//Route Tim Survei

Route::get('/surveitim', function () {
    return redirect('/survei/login');
});

Route::get('/survei/login', 'SurveiController@loginIndex');

Route::post('/survei/login/proses', 'SurveiController@loginProses');

Route::get('/survei/logout', 'SurveiController@logout');

Route::get('/survei/form', 'SurveiController@formSurvei');

Route::post('/survei/form/deskripsiUsaha', 'SurveiController@deskripsiUsaha');

Route::post('/survei/form/proses', 'SurveiController@surveiProses');
