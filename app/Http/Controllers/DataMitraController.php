<?php

namespace App\Http\Controllers;

use App\DataMitra;
use App\DataProposal;
use App\Jaminan;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class DataMitraController extends Controller
{
    public function kelolaDataMitra(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $mitra = DataMitra::orderBy('created_at', 'desc')->get();
            return view('admin/kelolaDataMitra', compact('mitra'));
        }
    }

    public function hapusDataMitra(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = $request->no_pk;

            $mitra = DataMitra::findOrFail($no_pk);

            if($mitra->delete($mitra)){
                $user = Users::findOrFail($mitra->username);
                $jaminan = Jaminan::findOrFail($mitra->no_jaminan);
                $proposal = DataProposal::findOrFail($mitra->no_proposal);

                $user->delete($user);
                $jaminan->delete($jaminan);
                $proposal->delete($proposal);

                return redirect('/admin/kelola/dataMitra')->with('alert-success', 'Data mitra berhasil dihapus!');
            }
        }
    }

    public function lampiran(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = $request->no_pk;

            $mitra = DataMitra::findOrFail($no_pk);
            $ktp = Storage::url($mitra->dataProposal->ktp_pengaju);
            $sertifikat_jaminan = Storage::url($mitra->jaminan->sertifikat_jaminan);
            $laporan_keuangan = Storage::url($mitra->dataProposal->laporan_keuangan);
            $sku = Storage::url($mitra->dataProposal->sku);
            $pas_foto = Cloudder::show($mitra->pas_foto, ['width'=>100, 'height'=>150, "crop"=>"scale"]);

            return response()->json([
                'ktp' => $ktp,
                'sertifikat_jaminan' => $sertifikat_jaminan,
                'laporan_keuangan' => $laporan_keuangan,
                'sku' => $sku,
                'pas_foto' => $pas_foto
            ], 200);
        }
    }
}
