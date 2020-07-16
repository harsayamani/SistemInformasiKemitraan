<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\DataMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AngsuranController extends Controller
{
    public function kelolaAngsuran(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $angsuran = Angsuran::orderBy('no_pk', 'asc')->get();
            $mitra = DataMitra::get();
            $no = 0;

            return view('admin/kelolaAngsuran', compact('angsuran', 'no', 'mitra'));
        }
    }

    public function filter(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = $request->no_pk;
            $angsuran = Angsuran::where('no_pk', $no_pk)->where('status', 1)->get();

            return response()->json([
                'angsuran' => $angsuran
            ], 200);
        }
    }
}
