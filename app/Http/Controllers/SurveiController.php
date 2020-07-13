<?php

namespace App\Http\Controllers;

use App\PengajuanDana;
use App\Survei;
use App\TimSurvei;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class SurveiController extends Controller
{
    public function loginIndex(){
        if(!Session::get('loginTimSurvei')){
            $tim = TimSurvei::get()->count();
            if($tim < 1){
                $tim = new TimSurvei();
                $tim->username = "timsurvei";
                $tim->password = "timsurvei123";
                $tim->save();
            }
            return view('survei/login');
        }else{
            return redirect('/survei/form');
        }
    }

    public function loginProses(Request $request){
        $username = $request->username;
        $password = $request->password;

        $tim = TimSurvei::findOrFail($username);

        if($tim){
            if(Hash::check($password, $tim->password)){
                Session::put('loginTimSurvei', Hash::make($username));
                return redirect('/survei/form')->with('alert-success', 'Login berhasil!');
            }else{
                return redirect('/survei/login')->with('alert-danger', 'Password salah!');
            }
        }else{
            return redirect('/survei/login')->with('alert-danger', 'Username salah!');
        }
    }

    public function logout(){
        Session::forget('loginTimSurvei');
        return redirect('/survei/login')->with('alert-danger', 'Anda berhasil logout!');
    }

    public function formSurvei(){
        if(!Session::get('loginTimSurvei')){
            return redirect('/survei/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pengajuan = PengajuanDana::where('status', 0)->get();
            return view('survei/formSurvei', compact('pengajuan'));
        }
    }

    public function deskripsiUsaha(Request $request){
        if(!Session::get('loginTimSurvei')){
            return redirect('/survei/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;

            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);

            return response()->json([
                'nama_pengaju' => $pengajuan->dataMitra->dataProposal->nama_pengaju,
                'unit_usaha' => $pengajuan->dataMitra->dataProposal->unit_usaha,
                'sektor_usaha' => $pengajuan->dataMitra->dataProposal->sektor_usaha,
                'alamat_kantor' => $pengajuan->dataMitra->alamat_kantor,
                'no_telp' => $pengajuan->dataMitra->no_telp,
                'no_pk' => $pengajuan->dataMitra->no_pk
            ], 200);
        }
    }

    public function surveiProses(Request $request){
        if(!Session::get('loginTimSurvei')){
            return redirect('/survei/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'dokumen_hasil_survei' => '|required|file|max:7000',
                'surat_berita_acara' => '|required|file|max:7000',
                'surat_ijin_usaha' => '|file|max:7000',
                'foto_pemilik' => '|required|file|max:7000',
                'foto_tempat_usaha' => '|required|file|max:7000',
            ]);


            $no_survei = random_int(100000000, 999999999);
            $no_pk = $request->no_pk;
            $id_pengajuan_dana = $request->id_pengajuan_dana;
            $kepemilikan_rumah = $request->kepemilikan_rumah;
            $lama_tempati_rumah = $request->tahun_rumah." tahun ".$request->bulan_rumah." bulan ";
            $lama_jalani_usaha = $request->tahun_usaha." tahun ".$request->bulan_usaha." bulan";
            $modal = $request->modal;
            $tempat_usaha = $request->tempat_usaha;
            $lokasi_usaha = $request->lokasi_usaha;
            $pinjaman_lain = $request->pinjaman_lain;
            $ijin_usaha = $request->ijin_usaha;
            $kepemilikan_usaha = $request->kepemilikan_usaha;
            $rekening_bank = $request->rekening_bank;
            $penghasilan_diluar_usaha = $request->penghasilan_diluar_usaha;
            $surat_ijin_usaha = null;

            if($request->surat_ijin_usaha != null){
                Cloudder::upload($request->surat_ijin_usaha);
                $surat_ijin_usaha = Cloudder::getPublicId();
            }

            Cloudder::upload($request->dokumen_hasil_survei);
            $dokumen_hasil_survei = Cloudder::getPublicId();
            Cloudder::upload($request->surat_berita_acara);
            $surat_berita_acara = Cloudder::getPublicId();
            Cloudder::upload($request->foto_pemilik);
            $foto_pemilik = Cloudder::getPublicId();
            Cloudder::upload($request->foto_tempat_usaha);
            $foto_tempat_usaha = Cloudder::getPublicId();
            $anggota_tim1 = $request->anggota_tim1;
            $anggota_tim2 = $request->anggota_tim2;
            $anggota_tim3 = $request->anggota_tim3;

            $survei = new Survei();
            $survei->no_survei = $no_survei;
            $survei->id_pengajuan_dana = $id_pengajuan_dana;
            $survei->no_pk = $no_pk;
            $survei->kepemilikan_rumah = $kepemilikan_rumah;
            $survei->lama_tempati_rumah = $lama_tempati_rumah;
            $survei->lama_jalani_usaha = $lama_jalani_usaha;
            $survei->modal = $modal;
            $survei->tempat_usaha = $tempat_usaha;
            $survei->lokasi_usaha = $lokasi_usaha;
            $survei->pinjaman_lain = $pinjaman_lain;
            $survei->ijin_usaha = $ijin_usaha;
            $survei->kepemilikan_usaha = $kepemilikan_usaha;
            $survei->rekening_bank = $rekening_bank;
            $survei->penghasilan_diluar_usaha = $penghasilan_diluar_usaha;
            $survei->surat_ijin_usaha = $surat_ijin_usaha;
            $survei->dokumen_hasil_survei = $dokumen_hasil_survei;
            $survei->surat_berita_acara = $surat_berita_acara;
            $survei->foto_pemilik = $foto_pemilik;
            $survei->foto_tempat_usaha = $foto_tempat_usaha;
            $survei->anggota_tim1 = $anggota_tim1;
            $survei->anggota_tim2 = $anggota_tim2;
            $survei->anggota_tim3 = $anggota_tim3;

            if($survei->save()){
                $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);
                $pengajuan->status = 1;
                $pengajuan->save();

                return redirect()->back()->with('alert-success', 'Survei berhasil ditambah!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }
}
