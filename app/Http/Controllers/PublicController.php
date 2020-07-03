<?php

namespace App\Http\Controllers;

use App\Berita;
use App\FAQ;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;

class PublicController extends Controller
{
    public function index(){
        $berita = Berita::orderBy('created_at', 'desc')->paginate(3);

        return view('user/index', compact('berita'));
    }

    public function faqQuestion(Request $request){
        $pertanyaan = $request->pertanyaan;
        $kategori = $request->kategori;

        $faq = new FAQ();
        $faq->pertanyaan = $pertanyaan;
        $faq->kategori = $kategori;
        $faq->status = 0;

        if($faq->save()){
            return redirect()->back()->with('alert-success', 'Pertanyaan telah dikirim!');
        }
    }

    public function tentang(){
        $berita = Berita::orderBy('created_at', 'desc')->paginate(3);

        return view('user/tentang', compact('berita'));
    }

    public function alur(){
        $berita = Berita::orderBy('created_at', 'desc')->paginate(3);

        return view('user/alur', compact('berita'));
    }

    public function faq(){
        $administrasi = FAQ::where('kategori', "Administrasi Kemitraan")->where('status', 1)->get();
        $pengajuan = FAQ::where('kategori', "Pengajuan Proposal")->where('status', 1)->get();
        $pendanaan = FAQ::where('kategori', "Pendanaan")->where('status', 1)->get();

        $berita = Berita::orderBy('created_at', 'desc')->paginate(3);

        return view('user/faq', compact('administrasi', 'berita', 'pengajuan', 'pendanaan'));
    }
}
