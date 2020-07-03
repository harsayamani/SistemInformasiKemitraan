<?php

namespace App\Http\Controllers;

use App\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FAQController extends Controller
{
    public function faq(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $faq = FAQ::orderBy('created_at', 'desc')->get();
            return view('admin/kelolaFAQ', compact('faq'));
        }
    }

    public function jawabFAQ(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id = $request->id;
            $jawaban = $request->jawaban;

            $faq = FAQ::findOrFail($id);
            $faq->jawaban = $jawaban;
            $faq->status = 1;

            if($faq->save()){
                return redirect('/admin/kelola/faq')->with('alert-success', 'Pertanyaan telah terjawab!');
            }
        }
    }

    public function hapusFAQ(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id = $request->id;

            $faq = FAQ::findOrFail($id);

            if($faq->delete($faq)){
                return redirect('/admin/kelola/faq')->with('alert-success', 'FAQ berhasil dihapus!');
            }
        }
    }
}
