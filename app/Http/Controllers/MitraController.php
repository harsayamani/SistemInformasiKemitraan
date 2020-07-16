<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\DataMitra;
use App\DataProposal;
use App\HistoriAngsuran;
use App\HistoriPinjaman;
use App\PengajuanDana;
use App\Pinjaman;
use App\Users;
use App\Http\Controllers\RajaOngkirController as API;
use App\Jaminan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder;
use Veritrans_Config;
use Veritrans_Snap;

class MitraController extends Controller
{
    public function __construct()
    {
    	//Penyiapkan Client Disk Dropbox
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

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

    public function logout(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Session::forget('loginMitra');
            Session::forget('noPK');
            Session::forget('namaMitra');
            return redirect('/mitra/login')->with('alert-success', 'Anda berhasil logout!');
        }
    }

    public function gantiPassword(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('mitra/gantiPassword');
        }
    }

    public function gantiPasswordProses(Request $request){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{

            $pass_lama = $request->pass_lama;
            $pass_baru = $request->pass_baru;
            $pass_konf = $request->konf_pass;
            $no_pk = Session::get('noPK');

            $mitra = DataMitra::findOrFail($no_pk);

            if(Hash::check($pass_lama, $mitra->users->password)){
                if($pass_baru == $pass_konf){
                    $users = Users::findOrFail($mitra->users->username);
                    $users->password = $pass_baru;
                    if($users->save()){
                        return redirect('/mitra/dashboard')->with('alert-modal-success', 'Password berhasil diganti!');
                    }else{
                        return redirect('/mitra/gantiPassword')->with('alert-danger', 'Terjadi kesalahan!');
                    }
                }else{
                    return redirect('/mitra/gantiPassword')->with('alert-danger', 'Konfirmasi password tidak sama!');
                }
            }else{
                return redirect('/mitra/gantiPassword')->with('alert-danger', 'Password lama salah!');
            }
        }
    }

    public function lupaPassword(){
        return view('/mitra/lupaPassword');
    }

    public function lupaPasswordProses(Request $request){
        $this->validate($request, [
            'email' => '|required|email'
        ]);

        $email = $request->email;
        $username = Users::where('email', $email)->value('username');

        $nama = DataMitra::where('username', $username)->first()->dataProposal->nama_pengaju;

        $username_crypt = Crypt::encryptString($username);

        $link = env('APP_URL')."/mitra/gantiPasswordLupa/".$username_crypt."";

        Mail::send('mitra/emailGantiPassword', ['nama' => $nama, 'link'=>$link], function ($message) use ($request)
        {
            $message->subject('Konfirmasi Pengubahan Password Sistem Kemitraan LEN Industri');
            $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
            $message->to($request->email);
        });

        return redirect('/mitra/login')->with('alert-success', 'Email pengubahan password telah dikirim!');
    }

    public function gantiPasswordLupa($username){
        $username = Crypt::decryptString($username);

        return view('mitra/gantiPasswordLupa', compact('username'));
    }

    public function gantiPasswordLupaProses(Request $request){
        $pass_baru = $request->pass_baru;
        $pass_konf = $request->konf_pass;
        $username = $request->username;

        $mitra = DataMitra::where('username', $username)->first();

        if($mitra){
            if($pass_baru == $pass_konf){
                $users = Users::findOrFail($username);
                $users->password = $pass_baru;
                if($users->save()){
                    return redirect('/mitra/login')->with('alert-success', 'Password berhasil diganti!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }else{
                return redirect()->back()->with('alert-danger', 'Konfirmasi password tidak sama!');
            }
        }else{
            return redirect()->back()->with('alert-danger', 'Not Found!');
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

            $pinjaman_count = Pinjaman::where('no_pk', $no_pk)->get()->count();
            $angsuran_count = Angsuran::where('no_pk', $no_pk)->where('status', 0)->get()->count();

            return view('mitra/dashboard', compact('mitra', 'pengajuan', 'pinjaman', 'pinjaman_count', 'angsuran_count'));
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

            $validatedKTP = Validator::make($request->all(), [
                'ktp' => '|required|min:16|max:16|',
            ]);

            $validatedNamaPengaju = Validator::make($request->all(), [
                'nama_pengaju' => '|required|max:50',
            ]);

            $validatedJenisKelamin = Validator::make($request->all(), [
                'jenis_kelamin' => '|required',
            ]);

            $validatedTempatLahir = Validator::make($request->all(), [
                'tempat_lahir' => '|required',
            ]);

            $validatedTanggalLahir = Validator::make($request->all(), [
                'tgl_lahir' => '|required',
            ]);

            $validatedNoTelp = Validator::make($request->all(), [
                'no_telp' => '|required|min:11!numeric',
            ]);

            $validatedAlamatKantor = Validator::make($request->all(), [
                'alamat_kantor' => '|required|max:255',
            ]);

            $validatedLokasiUsaha = Validator::make($request->all(), [
                'lokasi_usaha' => '|required|max:255',
            ]);

            $validatedAhliWaris = Validator::make($request->all(), [
                'ahli_waris' => '|required|max:50',
            ]);

            $validatedJumlahKaryawan = Validator::make($request->all(), [
                'jumlah_karyawan' => '|required|numeric|regex:/^([1-9][0-9]+)/',
            ]);

            $validatedNoRek = Validator::make($request->all(), [
                'no_rek' => '|required|numeric',
            ]);

            $validatedUnitUsaha = Validator::make($request->all(), [
                'unit_usaha' => '|required|max:50',
            ]);

            $validatedSertifikatJaminan = Validator::make($request->all(), [
                'sertifikat_jaminan' => '|file|max:7000'
            ]);

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
            $sektor_usaha = $request->sektor_usaha;
            $unit_usaha = $request->unit_usaha;
            $pas_foto = null;
            $sertifikat_jaminan = null;

            if($request->sertifikat_jaminan != null){
                $sertifikat_jaminan = Storage::disk('dropbox')->put('jaminan/1', $request->file('sertifikat_jaminan'));
            }else{
                $data_mitra = DataMitra::findOrFail($no_pk);
                $sertifikat_jaminan = $data_mitra->jaminan->sertifikat_jaminan;
            }

            if($request->pas_foto != null){
                try{
                    Cloudder::upload($request->pas_foto);
                    $pas_foto = Cloudder::getPublicId();
                }catch(Exception $e){
                    return redirect()->back()->with('alert-danger', $e->getMessage());
                }
            }else{
                $data_mitra = DataMitra::findOrFail($no_pk);
                $pas_foto = $data_mitra->pas_foto;
            }

            $message = '';
            $alert = '';

            if($validatedKTP->fails()){
                $ktp = null;
                $message = $validatedKTP->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedNamaPengaju->fails()){
                $nama_pengaju = null;
                $message = $validatedNamaPengaju->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedAhliWaris->fails()){
                $ahli_waris = null;
                $message = $validatedAhliWaris->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedAlamatKantor->fails()){
                $alamat_kantor = null;
                $message = $validatedAlamatKantor->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedJenisKelamin->fails()){
                $jenis_kelamin = null;
                $message = $validatedJenisKelamin->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedJumlahKaryawan->fails()){
                $jenis_kelamin = null;
                $message = $validatedJumlahKaryawan->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedLokasiUsaha->fails()){
                $lokasi_usaha = null;
                $message = $validatedLokasiUsaha->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedNoTelp->fails()){
                $no_telp = null;
                $message = $validatedNoTelp->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedNoRek->fails()){
                $no_rek = null;
                $message = $validatedNoRek->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedUnitUsaha->fails()){
                $unit_usaha = null;
                $message = $validatedUnitUsaha->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedTanggalLahir->fails()){
                $tgl_lahir = null;
                $message = $validatedTanggalLahir->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedTempatLahir->fails()){
                $tempat_lahir = null;
                $message = $validatedTempatLahir->errors()->first();
                $alert = 'alert-modal-danger';
            }elseif($validatedSertifikatJaminan->fails()){
                $tempat_lahir = null;
                $message = $validatedSertifikatJaminan->errors()->first();
                $alert = 'alert-modal-danger';
            }else{
                $message = 'Data mitra berhasil disimpan!';
                $alert = 'alert-modal-success';
            }

            $mitra = DataMitra::findOrFail($no_pk);

            $users = Users::findOrFail($username);
            $users->email = $email;

            if($users->save()){
                $jamin = Jaminan::findOrFail($no_jaminan);
                $jamin->jaminan = $jaminan;
                $jamin->pemilik_jaminan = $pemilik_jaminan;
                $jamin->sertifikat_jaminan = $sertifikat_jaminan;

                if($jamin->save()){
                    $proposal = DataProposal::findOrFail($mitra->no_proposal);
                    $proposal->nama_pengaju = $nama_pengaju;
                    $proposal->sektor_usaha = $sektor_usaha;
                    $proposal->unit_usaha = $unit_usaha;

                    if($proposal->save()){
                        $mitra->ktp = $ktp;
                        $mitra->pas_foto = $pas_foto;
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
                            return redirect('/mitra/dataMitra')->with($alert, $message);
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

    public function pinjaman(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = Session::get('noPK');
            $mitra = DataMitra::findOrFail($no_pk);

            $api = new API;
            $ac = $api->getCURL('city');
            $kota = $ac->rajaongkir->results;
            $ttl = "";

            foreach($kota as $city){
                if($city->city_id == $mitra->tempat_lahir){
                    $ttl = $city->city_name.", ".$mitra->tgl_lahir;
                    break;
                }
            }

            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();
            $pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();
            $status_pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->value('status');

            if($pengajuan != null){
                if($pinjaman != null && $pengajuan->status==3){
                    if($status_pinjaman < 3){
                        return redirect('mitra/dashboard')->with('alert-modal-warning', 'Anda sudah mengajukan pinjaman dana!');
                    }else{
                        if($mitra->ktp == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');

                        }elseif($mitra->pas_foto == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->jenis_kelamin == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->tempat_lahir == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->tgl_lahir == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->no_telp == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->alamat_kantor == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->lokasi_usaha == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->ahli_waris == null){
                            return redirect('mitra/dataMitra')->with('mitra/dashboard')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->jumlah_karyawan == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->no_rek == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->jaminan->jaminan == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }elseif($mitra->jaminan->pemilik_jaminan == null){
                            return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                        }else{
                            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->get();
                            return view('mitra/pinjaman', compact('mitra', 'ttl', 'pengajuan'));
                        }
                    }
                }else{
                    return redirect('mitra/dashboard')->with('alert-modal-warning', 'Anda sudah mengajukan pinjaman dana!');
                }
            }else{
                if($mitra->ktp == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->pas_foto == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->jenis_kelamin == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->tempat_lahir == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->tgl_lahir == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->no_telp == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->alamat_kantor == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->lokasi_usaha == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->ahli_waris == null){
                    return redirect('mitra/dataMitra')->with('mitra/dashboard')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->jumlah_karyawan == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->no_rek == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->jaminan->jaminan == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }elseif($mitra->jaminan->pemilik_jaminan == null){
                    return redirect('mitra/dataMitra')->with('alert-modal-warning', 'Data mitra belum lengkap');
                }else{
                    $pengajuan = PengajuanDana::where('no_pk', $no_pk)->get();
                    return view('mitra/pinjaman', compact('mitra', 'ttl', 'pengajuan'));
                }
            }
        }
    }

    public function ajukanPinjaman(Request $request){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = $request->no_pk;
            $dana_aju = $request->dana_aju;
            $pengajuan = new PengajuanDana();
            $pengajuan->id_pengajuan_dana = uniqid("AJU-", false);
            $pengajuan->no_pk = $no_pk;
            $pengajuan->dana_aju = $dana_aju;
            $pengajuan->status = 0;

            if($pengajuan->save()){
                return redirect('/mitra/dashboard')->with('alert-modal-success', 'Pinjaman berhasil diajukan!');
            }
        }
    }

    public function angsuran(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $no_pk = Session::get('noPK');
            $id_pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->value('id_pinjaman');
            $no = 0;

            if(!empty($id_pinjaman)){
                $lama_angsuran = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->value('lama_angsuran');
                $angsuran = Angsuran::where('id_pinjaman', $id_pinjaman)->orderBy('utang', 'desc')->get();
                $pengajuan = PengajuanDana::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();
                $pinjaman = Pinjaman::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();

                $angs_finish_count = Angsuran::where('id_pinjaman', $id_pinjaman)->where('status', 2)->get()->count();

                if($angs_finish_count == $lama_angsuran){
                    $pinjaman = Pinjaman::findOrFail($id_pinjaman);
                    $pinjaman->status == 3;
                    $pinjaman->save();
                }
            }else{
                $angsuran = [];
                $pengajuan = null;
                $pinjaman = null;
            }

            return view('mitra/angsuran', compact('angsuran', 'pengajuan', 'pinjaman', 'no'));
        }
    }

    public function transferAngsuran(Request $request){
        // Buat transaksi ke midtrans kemudian save snap tokennya.
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

        $id_angsuran = $request->id_angsuran;
        $angsuran = Angsuran::findOrFail($id_angsuran);

        $payload = [
            'transaction_details' => [
                'order_id'      => $angsuran->id_angsuran,
                'gross_amount'  => $angsuran->jumlah_angsuran,
            ],
            'customer_details' => [
                'first_name'    => $angsuran->dataMitra->dataProposal->nama_pengaju,
                'email'         => $angsuran->dataMitra->users->email,
                'phone'         => $angsuran->dataMitra->no_telp,
                'address'       => $angsuran->dataMitra->alamat_kantor,
            ],
            'item_details' => [
                [
                    'id'       => $angsuran->id_angsuran,
                    'price'    => $angsuran->jumlah_angsuran,
                    'quantity' => 1,
                    'name'     => ucwords(str_replace('_', ' ', "Transfer Angsuran"))
                ]
            ]
        ];

        $snap_token = Veritrans_Snap::getSnapToken($payload);

        $angsuran->token = $snap_token;
        $angsuran->tgl_angsuran = Carbon::now()->format('Y-m-d');
        $angsuran->status = 1;

        if($angsuran->save()){

            $histori_angsuran = new HistoriAngsuran();
            $histori_angsuran->id_bayar = uniqid('HistAngs-', false);
            $histori_angsuran->id_angsuran = $id_angsuran;
            $histori_angsuran->bayar_angsuran = $angsuran->jumlah_angsuran;

            if($histori_angsuran->save()){
                return response()->json([
                    'snap_token' => $snap_token
                ], 200);
            }
        }
    }

    public function riwayatTransaksi(){
        if(!Session::get('loginMitra')){
            return redirect('/mitra/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pinjaman = HistoriPinjaman::orderBy('id_pinjaman', 'desc')->get();
            $angsuran = HistoriAngsuran::orderBy('id_angsuran', 'desc')->get();

            $no = 0;
            $no2 = 0;

            return view('mitra/riwayat', compact('angsuran', 'pinjaman', 'no', 'no2'));
        }
    }
}
