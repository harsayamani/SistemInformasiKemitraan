<?php

namespace App\Http\Controllers;

use App\Berita;
use Carbon\Carbon;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BeritaController extends Controller
{
    public function kelolaBerita(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $berita = Berita::orderBy('created_at', 'desc')->get();
            return view('admin/kelolaBerita', compact('berita'));
        }
    }

    public function tambahBerita(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Cloudder::upload($request->ilustrasi);
            $url_foto = Cloudder::getPublicId();

            $berita = new Berita();
            $berita->tgl_rilis = Carbon::now()->format('d, M Y');
            $berita->judul_berita = $request->judul_berita;
            $berita->isi_berita = $request->isi_berita;
            $berita->keterangan = $request->keterangan;
            $berita->ilustrasi = $url_foto;

            if($berita->save()){
                return redirect('/admin/kelola/berita')->with('alert-success', 'Berita berhasil ditambahkan!');
            }
        }
    }

    public function hapusBerita(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_berita = $request->no_berita;
            $berita = Berita::findOrFail($no_berita);

            if($berita->delete($berita)){
                Cloudder::destroy($berita->ilustrasi);
                return redirect('/admin/kelola/berita')->with('alert-success', 'Berita berhasil dihapus!');
            }
        }
    }

    public function ubahBeritaIndex($judul_berita){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $berita = Berita::where('judul_berita', $judul_berita)->first();
            return view('admin/ubahBerita', compact('berita'));
        }
    }

    public function ubahBerita(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_berita = $request->no_berita;
            $judul_berita = $request->judul_berita;
            $keterangan = $request->keterangan;
            $ilustrasi = $request->ilustrasi;
            $isi_berita = $request->isi_berita;

            $berita = Berita::findOrFail($no_berita);

            if($ilustrasi != null){
                Cloudder::upload($ilustrasi);
                $url_foto = Cloudder::getPublicId();

                $berita->judul_berita = $judul_berita;
                $berita->keterangan = $keterangan;
                $berita->ilustrasi = $url_foto;
                $berita->isi_berita = $isi_berita;

                if($berita->save()){
                    return redirect('/admin/kelola/berita')->with('alert-success', 'Berita berhasil diubah!');
                }
            }else{
                $berita->judul_berita = $judul_berita;
                $berita->keterangan = $keterangan;
                $berita->isi_berita = $isi_berita;

                if($berita->save()){
                    return redirect('/admin/kelola/berita')->with('alert-success', 'Berita berhasil diubah!');
                }
            }
        }
    }
}
