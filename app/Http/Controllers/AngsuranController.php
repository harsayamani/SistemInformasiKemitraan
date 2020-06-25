<?php

namespace App\Http\Controllers;

use App\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AngsuranController extends Controller
{
    public function kelolaAngsuran(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $angsuran= Angsuran::orderBy('id_pinjaman', 'asc')->get();

            return view('admin/kelolaAngsuran', compact('angsuran'));
        }
    }
}
