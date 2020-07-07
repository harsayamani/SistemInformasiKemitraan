<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DataMitra;
use App\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function loginIndex(){
        if(!Session::get('loginAdmin')){
            $admin = Admin::get()->count();
            if($admin < 1){
                $admin = new Admin();
                $admin->username = "admin";
                $admin->password = "admin123";
                $admin->nama = "Default Admin";
                $admin->save();
            }

            return view('admin/loginAdmin');
        }else{
            return redirect('/admin/dashboard');
        }
    }

    public function loginProses(Request $request){

        $username = $request->username;
        $password = $request->password;

        $admin = Admin::find($username);

        if($admin){
            if(Hash::check($password, $admin->password)){
                Session::put('loginAdmin', Hash::make($admin->username));
                Session::put('namaAdmin', $admin->nama);
                return redirect('/admin/dashboard')->with('alert-success', 'Login berhasil!');
            }else{
                return redirect('/admin/login')->with('alert-danger', 'Password yang anda masukkan salah!');
            }
        }else{
            return redirect('/admin/login')->with('alert-danger', 'Username yang anda masukkan salah!');
        }
    }

    public function logout(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Session::forget('loginAdmin');
            return redirect('/admin/login')->with('alert-success', 'Anda berhasil logout!');
        }
    }

    public function dashboardAdmin(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pinjaman_count = Pinjaman::get()->count();
            $data_mitra_count = DataMitra::get()->count();
            return view('admin/dashboardAdmin', compact('pinjaman_count', 'data_mitra_count'));
        }
    }

    public function gantiPassword(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('admin/gantiPassword');
        }
    }

    public function gantiPasswordProses(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nama = Session::get('namaAdmin');
            $admin = Admin::where('nama', $nama)->first();
            $pass_lama = $request->pass_lama;
            $pass_baru = $request->pass_baru;
            $pass_konf = $request->pass_konf;

            if(Hash::check($pass_lama, $admin->password)){
                if($pass_konf == $pass_baru){
                    $admin->password = $pass_baru;
                    $admin->save();
                    return redirect('/admin/dashboard')->with('alert-success', 'Password admin berhasil diganti!');
                }else{
                    return redirect('/admin/gantiPassword')->with('alert-danger', 'Konfirmasi password baru salah!');
                }
            }else{
                return redirect('/admin/gantiPassword')->with('alert-danger', 'Password lama salah!');
            }
        }
    }
}
