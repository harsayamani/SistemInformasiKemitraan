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

//Route Proposal

Route::get('/admin/kelola/proposal', 'DataProposalController@kelolaProposal');

Route::post('/admin/kelola/proposal/setujui', 'DataProposalController@setujuiProposal');

Route::post('/admin/kelola/proposal/hapus', 'DataProposalController@hapusProposal');

//Route Data Mitra

Route::get('/admin/kelola/dataMitra', 'DataMitraController@kelolaDataMitra');

Route::post('/admin/kelola/dataMitra/hapus', 'DataMitraController@hapusDataMitra');
