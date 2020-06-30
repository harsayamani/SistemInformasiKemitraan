<?php

namespace App\Http\Controllers;

use App\DataMitra;
use App\DataProposal;
use App\PengajuanDana;
use App\Pinjaman;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RajaOngkirController as API;
use App\Jaminan;

class MitraController extends Controller
{
    public function loginIndex(){
        if(!Session::get('loginMitra')){
            return view('mitra/loginMitra');
        }else{
            return redirect('/mitra/dashboard');
        }
    }

    public function loginProses(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = Users::find($username);

        if($user){
            if(Hash::check($password, $user->password)){
                $mitra = DataMitra::where('username', $username)->first();
                Session::put('loginMitra', Hash::make($user->no_pk));
                Session::put('noPK', $mitra->no_pk);
                Session::put('namaMitra', $mitra->dataProposal->nama_pengaju);

                return redirect('/mitra/dashboard')->with('alert-success', 'Login berhasil!');
            }else{
                return redirect('/mitra/login')->with('alert-danger', 'Password salah!');
            }
        }else{
            return redirect('/mitra/login')->with('alert-danger', 'Username salah!');
        }
    }

    public function dashboard(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = Session::get('noPK');

            $mitra = DataMitra::findOrFail($no_pk);

            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();
            $pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();

            if($pengajuan == null){
                $pengajuan = [];
            }elseif($pinjaman == null){
                $pinjaman = [];
            }

            return view('mitra/dashboard', compact('mitra', 'pengajuan', 'pinjaman'));
        }
    }

    public function dataMitra(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = Session::get('noPK');
            $mitra = DataMitra::findOrFail($no_pk);

            $api = new API;
            $ac = $api->getCURL('city');
            $kota = $ac->rajaongkir->results;

            return view('mitra/dataMitra', compact('mitra', 'kota'));
        }
    }

    public function ubahMitra(Request $request){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = $request->no_pk;
            $ktp = $request->ktp;
            $nama_pengaju = $request->nama_pengaju;
            $jenis_kelamin = $request->jenis_kelamin;
            $tempat_lahir = $request->tempat_lahir;
            $tgl_lahir = $request->tgl_lahir;
            $no_telp = $request->no_telp;
            $alamat_kantor = $request->alamat_kantor;
            $lokasi_usaha = $request->lokasi_usaha;
            $ahli_waris = $request->ahli_waris;
            $jumlah_karyawan = $request->jumlah_karyawan;
            $no_rek = $request->no_rek;
            $username = $request->username;
            $email = $request->email;
            $jaminan = $request->jaminan;
            $pemilik_jaminan = $request->pemilik_jaminan;
            $no_jaminan = $request->no_jaminan;

            $mitra = DataMitra::findOrFail($no_pk);

            $users = Users::findOrFail($username);
            $users->email = $email;

            if($users->save()){
                $jamin = Jaminan::findOrFail($no_jaminan);
                $jamin->jaminan = $jaminan;
                $jamin->pemilik_jaminan = $pemilik_jaminan;

                if($jamin->save()){
                    $proposal = DataProposal::findOrFail($mitra->no_proposal);
                    $proposal->nama_pengaju = $nama_pengaju;

                    if($proposal->save()){
                        $mitra->ktp = $ktp;
                        $mitra->jenis_kelamin = $jenis_kelamin;
                        $mitra->tempat_lahir = $tempat_lahir;
                        $mitra->tgl_lahir = $tgl_lahir;
                        $mitra->no_telp = $no_telp;
                        $mitra->alamat_kantor =  $alamat_kantor;
                        $mitra->lokasi_usaha = $lokasi_usaha;
                        $mitra->ahli_waris = $ahli_waris;
                        $mitra->jumlah_karyawan = $jumlah_karyawan;
                        $mitra->no_rek = $no_rek;

                        if($mitra->save()){
                            return redirect('/mitra/dataMitra')->with('alert-modal-success', 'Data mitra berhasil disimpan!');
                        }else{
                            return redirect('/mitra/dataMitra')->with('alert-modal-danger', 'Terjadi kesalahan!');
                        }
                    }else{
                        return redirect('/mitra/dataMitra')->with('alert-modal-danger', 'Terjadi kesalahan!');
                    }
                }else{
                    return redirect('/mitra/dataMitra')->with('alert-modal-danger', 'Terjadi kesalahan!');
                }
            }
        }
    }
}
