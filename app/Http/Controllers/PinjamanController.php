<?php

namespace App\Http\Controllers;

use App\DataMitra;
use App\PengajuanDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PinjamanController extends Controller
{
    public function kelolaPinjaman(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pengajuan = PengajuanDana::orderBy('status', 'asc')->get();
            return view('admin/kelolaPinjaman', compact('pengajuan'));
        }
    }

    public function printDokumenPengajuan($no_pk){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $mitra = DataMitra::findOrFail($no_pk);
            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->first();

            if($mitra){
                return view('admin/dokumenPengajuanDana', compact('mitra', 'pengajuan'));
            }
        }
    }

    public function setujuiPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;

            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);
            $pengajuan->status = 1;

            if($pengajuan->save()){
                return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman disetujui!');
            }
        }
    }

    public function hapusPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;
            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);

            if($pengajuan->delete($pengajuan)){
                return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman dihapus!');
            }
        }
    }
}
