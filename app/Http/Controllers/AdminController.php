<?php

namespace App\Http\Controllers;

use App\Admin;
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

    public function logOut(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Session::forget('loginAdmin');
            return redirect('/admin/dashboard')->with('alert-success', 'Anda berhasil logout!');
        }
    }

    public function dashboardAdmin(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('admin/dashboardAdmin');
        }
    }
}
