<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\DataMitra;
use App\Exports\AngsuranExport;
use App\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

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
            $id_pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->value('id_pinjaman');

            return response()->json([
                'angsuran' => $angsuran,
                'id_pinjaman' => $id_pinjaman
            ], 200);
        }
    }

    public function exportExcel($id_pinjaman){
        $nama = Pinjaman::where('id_pinjaman', $id_pinjaman)->first()->dataMitra->dataProposal->nama_pengaju;
        return FacadesExcel::download(new AngsuranExport($id_pinjaman), 'Angsuran - '.$nama.'.xlsx');
    }
}
