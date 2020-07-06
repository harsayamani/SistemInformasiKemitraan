<?php

namespace App\Http\Controllers;

use App\Berita;
use App\DataProposal;
use App\FAQ;
use Carbon\Carbon;
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
            return redirect()->back()->with('alert-modal-success', 'Pertanyaan telah dikirim!');
        }else{
            return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
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

    public function berita(){
        $berita = Berita::orderBy('created_at', 'desc')->paginate(7);
        $recent = Berita::orderBy('created_at', 'desc')->paginate(3);
        $berita_count = Berita::where('keterangan', 'Berita')->get()->count();
        $pengumuman_count = Berita::where('keterangan', 'Pengumuman')->get()->count();

        return view('user/berita', compact('berita', 'recent', 'berita_count', 'pengumuman_count'));
    }

    public function beritaKategori($keterangan){
        $berita = Berita::where('keterangan', $keterangan)->orderBy('created_at', 'desc')->paginate(7);
        $recent = Berita::orderBy('created_at', 'desc')->paginate(3);
        $berita_count = Berita::where('keterangan', 'Berita')->get()->count();
        $pengumuman_count = Berita::where('keterangan', 'Pengumuman')->get()->count();

        return view('user/berita', compact('berita', 'recent', 'berita_count', 'pengumuman_count'));
    }

    public function searchBerita(Request $request){
        $keyword = $request->keyword;
        $berita = Berita::where('judul_berita', "like", "%" . $keyword . "%")->paginate(7);
        $recent = Berita::orderBy('created_at', 'desc')->paginate(3);
        $berita_count = Berita::where('keterangan', 'Berita')->get()->count();
        $pengumuman_count = Berita::where('keterangan', 'Pengumuman')->get()->count();

        return view('user/berita', compact('berita', 'recent', 'berita_count', 'pengumuman_count'));
    }

    public function detailBerita($judul_berita){
        $berita = Berita::where('judul_berita', $judul_berita)->first();
        $recent = Berita::orderBy('created_at', 'desc')->paginate(3);
        $berita_count = Berita::where('keterangan', 'Berita')->get()->count();
        $pengumuman_count = Berita::where('keterangan', 'Pengumuman')->get()->count();

        return view('user/detailBerita', compact('berita', 'recent', 'berita_count', 'pengumuman_count'));
    }

    public function registrasi(){
        return view('user/registrasi');
    }

    public function registrasiProses(Request $request){
        $this->validate($request, [
            'nama_pengaju' => '|required|max:50',
            'email' => '|required|email|unique:data_proposal',
            'unit_usaha' => '|required|max:50',
            'dana_aju' => '|required|min:6|max:12|regex:/^([1-9][0-9]+)/'
        ]);

        $nama_pengaju = $request->nama_pengaju;
        $email = $request->email;
        $unit_usaha = $request->unit_usaha;
        $dana_aju = $request->dana_aju;
        $kegiatan = $request->kegiatan;

        $proposal = new DataProposal();
        $proposal->no_proposal = random_int(100000000, 999999999);
        $proposal->nama_pengaju = $nama_pengaju;
        $proposal->email = $email;
        $proposal->tgl_pengajuan = Carbon::now()->format('d, M Y');
        $proposal->unit_usaha = $unit_usaha;
        $proposal->kegiatan = $kegiatan;
        $proposal->dana_aju = $dana_aju;
        $proposal->status = 0;

        if($proposal->save()){
            return redirect()->back()->with('alert-modal-success', 'Registrasi berhasil dilakukan. Mohon menunggu untuk mendapat konfirmasi selanjutnya lewat email!');
        }else{
            return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
        }
    }
}
