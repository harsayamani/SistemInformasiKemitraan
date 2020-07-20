<?php

namespace App\Http\Controllers;

use App\DataMitra;
use App\DataProposal;
use App\Jaminan;
use App\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DataProposalController extends Controller
{
    public function kelolaProposal(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $proposal = DataProposal::orderBy('status', 'asc')->get();
            $no = 0;
            return view('admin/kelolaProposal', compact('proposal', 'no'));
        }
    }

    public function setujuiProposal(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_proposal = $request->no_proposal;

            $proposal = DataProposal::findOrFail($no_proposal);
            $proposal->status = 1;

            $count_mitra = DataMitra::get()->count()+1;

            if($proposal->save()){
                $password = str_random(6);
                $username = str_random(8);
                $email = $proposal->email;
                $nama = $proposal->nama_pengaju;

                $user = new Users();
                $user->username = $username;
                $user->password = $password;
                $user->nama = $nama;
                $user->email = $email;

                try{
                    Mail::send('admin/emailPemberitahuanAkun', ['nama_pengaju' => $nama, 'username'=>$username, 'email'=>$email, 'password'=>$password], function ($message) use ($request)
                    {
                        $message->subject('Informasi Akun Mitra Sistem Kemitraan LEN Industri');
                        $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                        $message->to(DataProposal::findOrFail($request->no_proposal)->email);
                    });

                }catch(Exception $e){
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan : '.$e.'');
                }

                if($user->save()){
                    $no_jaminan = random_int(100000000, 999999999);
                    $jaminan = new Jaminan();
                    $jaminan->no_jaminan =$no_jaminan;

                    if($jaminan->save()){
                        $mitra  = new DataMitra();
                        $mitra->no_pk = "LKP/KEM/T-1/A-".strval($count_mitra);
                        $mitra->no_proposal = $no_proposal;
                        $mitra->no_jaminan = $no_jaminan;
                        $mitra->username = $username;

                        if($mitra->save()){
                            return redirect('/admin/kelola/proposal')->with('alert-success', 'Proposal '.$proposal->nama_pengaju.' sudah disetujui!');
                        }else{
                            return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                        }
                    }else{
                        return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                    }
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }else{
                return redirect('/admin/kelola/proposal')->with('alert-danger', 'Terjadi Kesalahan!');
            }
        }
    }

    public function hapusProposal(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_proposal = $request->no_proposal;
            $proposal = DataProposal::findOrFail($no_proposal);
            $nama = $proposal->nama_pengaju;

            try{
                Mail::send('admin/emailPersetujuanMitra', ['nama' => $nama], function ($message) use ($request)
                {
                    $message->subject('Konfirmasi Status Pengajuan Mitra Sistem Kemitraan LEN Industri');
                    $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                    $message->to(DataProposal::findOrFail($request->no_proposal)->email);
                });
                $proposal->delete($proposal);
                return redirect('/admin/kelola/proposal')->with('alert-success', 'Proposal berhasil dihapus!');
            }catch(Exception $e){
                return redirect('/admin/kelola/proposal')->with('alert-denger', 'Terjadi kesalahan : '.$e.'');
            }
        }
    }
}
