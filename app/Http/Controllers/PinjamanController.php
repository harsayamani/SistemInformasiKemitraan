<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\DataMitra;
use App\HistoriPinjaman;
use App\PengajuanDana;
use App\Pinjaman;
use App\Survei;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use JD\Cloudder\Facades\Cloudder;
use Veritrans_Config;
use Veritrans_Notification;
use Veritrans_Snap;
use App\Http\Controllers\RajaOngkirController as API;

class PinjamanController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function kelolaPinjaman(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pengajuan = PengajuanDana::orderBy('status', 'asc')->get();
            $setuju = PengajuanDana::where('status', 2)->get();
            $tgl_sekarang = Carbon::now()->format('Y-m-d');
            $pinjaman = Pinjaman::orderBy('status', 'asc')->get();

            return view('admin/kelolaPinjaman', compact('pengajuan', 'setuju', 'tgl_sekarang', 'pinjaman'));
        }
    }

    public function printDokumenPengajuan($no_proposal){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{

            $no_pk = DataMitra::where('no_proposal', $no_proposal)->value('no_pk');

            $mitra = DataMitra::findOrFail($no_pk);
            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first();

            $api = new API;
            $ac = $api->getCURL('city');
            $kota = $ac->rajaongkir->results;

            $tempat_lahir = "";

            foreach($kota as $city){
                if($mitra->tempat_lahir == $city->city_id){
                    $tempat_lahir = $city->city_name;
                    break;
                }
            }

            if($mitra){
                return view('admin/dokumenPengajuanDana', compact('mitra', 'pengajuan', 'tempat_lahir'));
            }
        }
    }

    public function setujuiPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;

            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);
            $pengajuan->status = 2;

            $nama = $pengajuan->dataMitra->dataProposal->nama_pengaju;
            $persetujuan = "DISETUJUI";

            if($pengajuan->save()){
                try{
                    Mail::send('admin/emailPengajuanDana', ['nama' => $nama, 'persetujuan'=>$persetujuan], function ($message) use ($request)
                    {
                        $message->subject('Konfirmasi Status Pengajuan Dana Sistem Kemitraan LEN Industri');
                        $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                        $message->to(PengajuanDana::findOrFail($request->id_pengajuan_dana)->dataMitra->users->email);
                    });
                    return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman disetujui!');
                }catch(Exception $e){
                    return redirect('/admin/kelola/pinjaman')->with('alert-danger', 'Terjadi kesalahan : '.$e->getMessage().'');
                }
            }else{
                return redirect('/admin/kelola/pinjaman')->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function hapusPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;
            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);
            $nama = $pengajuan->dataMitra->dataProposal->nama_pengaju;

            try{
                Mail::send('admin/emailTolakPengajuanDana', ['nama' => $nama], function ($message) use ($request)
                {
                    $message->subject('Konfirmasi Status Pengajuan Dana Sistem Kemitraan LEN Industri');
                    $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                    $message->to(PengajuanDana::findOrFail($request->id_pengajuan_dana)->dataMitra->users->email);
                });
                $survei = Survei::where('id_pengajuan_dana', $id_pengajuan_dana)->first();
                if($survei->delete($survei)){
                    $pengajuan->delete($pengajuan);
                    return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman dihapus!');
                }else{
                    return redirect('/admin/kelola/pinjaman')->with('alert-denger', 'Terjadi kesalahan!');
                }
            }catch(Exception $e){
                return redirect('/admin/kelola/pinjaman')->with('alert-denger', 'Terjadi kesalahan : '.$e->getMessage().'');
            }
        }
    }

    public function kirimJadwalSurvei(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;
            $jadwal = $request->jadwal;

            $nama_pengaju = PengajuanDana::findOrFail($id_pengajuan_dana)->dataMitra->dataProposal->nama_pengaju;

            try{
                Mail::send('admin/emailJadwalSurvei', ['nama_pengaju' => $nama_pengaju, 'jadwal'=>$jadwal], function ($message) use ($request)
                {
                    $message->subject('Informasi Jadwal Survei Lapangan Sistem Kemitraan LEN Industri');
                    $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                    $message->to($request->email);
                });
                return redirect()->back()->with('alert-success', 'Email berhasil dikirim!');
            }catch(Exception $e){
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan : '.$e->getMessage().'');
            }
        }
    }

    public function getNamaPengaju(Request $request){
        $no_pk = $request->id;
        $nama_pengaju = DataMitra::where('no_pk', $no_pk)->first()->dataProposal->nama_pengaju;
        $nominal_peminjaman = PengajuanDana::where('no_pk', $no_pk)->orderBy('created_at', 'desc')->first()->dana_aju;

        return response()->json([
            'nama_pengaju' => $nama_pengaju,
            'nominal_pinjaman' => $nominal_peminjaman
        ], 200);
    }

    public function tambahPinjaman(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'bunga' => '|numeric',
                'nominal_pinjaman' => '|numeric|regex:/^([1-9][0-9]+)/',
                'lama_angsuran' => '|numeric',
                'nominal_angsuran' => '|numeric'
            ]);

            $id_pinjaman = uniqid('PIJ-', false);

            $pinjaman = new Pinjaman();
            $pinjaman->id_pinjaman = $id_pinjaman;
            $pinjaman->no_pk = $request->no_pk;
            $pinjaman->tgl_pinjaman = $request->tgl_pinjaman;
            $pinjaman->bunga = $request->bunga;
            $pinjaman->nominal_pinjaman = $request->nominal_pinjaman;
            $pinjaman->total_pinjaman = $request->nominal_pinjaman + ($request->nominal_pinjaman*($request->bunga/100));
            $pinjaman->lama_angsuran = $request->lama_angsuran;
            $pinjaman->nominal_angsuran = $request->nominal_angsuran;
            $pinjaman->status = 0;

            if($pinjaman->save()){
                $pengajuan = PengajuanDana::where('no_pk', $request->no_pk)->where('status', 2)->first();
                $pengajuan->status = 3;
                if($pengajuan->save()){

                    $lama_angsuran = $request->lama_angsuran;
                    $total_pinjaman = $request->nominal_pinjaman + ($request->nominal_pinjaman*($request->bunga/100));
                    $nominal_angsuran = $request->nominal_angsuran;

                    for($i=0; $i<$lama_angsuran; $i++){
                        $total_pinjaman -= $nominal_angsuran;

                        $angsuran = new Angsuran();
                        $angsuran->id_angsuran = uniqid('ANGS-', false);
                        $angsuran->id_pinjaman = $id_pinjaman;
                        $angsuran->jumlah_angsuran = $nominal_angsuran;
                        $angsuran->no_pk = $request->no_pk;
                        $angsuran->utang = $total_pinjaman;
                        $angsuran->status = 0;
                        $angsuran->save();
                    }

                    return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pinjaman berhasil ditambah!');
                }
            }
        }
    }

    public function transferPinjaman(Request $request){
        $id_pinjaman = $request->id_pinjaman;
        $pinjaman = Pinjaman::findOrFail($id_pinjaman);
        $nama_admin = Session::get('namaAdmin');

        $payload = [
            'transaction_details' => [
                'order_id'      => $pinjaman->id_pinjaman,
                'gross_amount'  => $pinjaman->nominal_pinjaman,
            ],
            'customer_details' => [
                'first_name'    => $nama_admin,
                'email'         => $pinjaman->dataMitra->users->email,
                // 'phone'         => '08888888888',
                // 'address'       => '',
            ],
            'item_details' => [
                [
                    'id'       => $pinjaman->id_pinjaman,
                    'price'    => $pinjaman->nominal_pinjaman,
                    'quantity' => 1,
                    'name'     => ucwords(str_replace('_', ' ', "Transfer Pinjaman"))
                ]
            ]
        ];

        $snap_token = Veritrans_Snap::getSnapToken($payload);

        $pinjaman->token = $snap_token;
        $pinjaman->status = 1;

        if($pinjaman->save()){
            $histori_pinjaman = new HistoriPinjaman();
            $histori_pinjaman->id_transaksi = uniqid('TRPIJ-', false);
            $histori_pinjaman->id_pinjaman = $id_pinjaman;

            if($histori_pinjaman->save()){
                return response()->json([
                    'snap_token' => $snap_token
                ], 200);
            }
        }
    }

    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        $type = $notif->payment_type;
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");

        $pinjaman = Pinjaman::findOrFail($notif->order_id);
        $angsuran = Angsuran::findOrFail($notif->order_id);

        if(!empty($pinjaman)){
            if ($transaction == "capture") {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == "credit_card") {

                  if($fraud == "challenge") {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                    $pinjaman->setPending();
                  } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                    $pinjaman->setSuccess();
                  }

                }

              } elseif ($transaction == "settlement") {

                // TODO set payment status in merchant's database to 'Settlement'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $pinjaman->setSuccess();

              } elseif($transaction == "pending"){

                // TODO set payment status in merchant's database to 'Pending'
                // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $pinjaman->setPending();

              } elseif ($transaction == "deny") {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $pinjaman->setFailed();

              } elseif ($transaction == "expire") {

                // TODO set payment status in merchant's database to 'expire'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $pinjaman->setExpired();

              } elseif ($transaction == "cancel") {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $pinjaman->setFailed();

              }
          }

          if(!empty($angsuran)){
            if ($transaction == "capture") {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == "credit_card") {

                  if($fraud == "challenge") {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                    $angsuran->setPending();
                  } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                    $angsuran->setSuccess();
                  }

                }

              } elseif ($transaction == "settlement") {

                // TODO set payment status in merchant's database to 'Settlement'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $angsuran->setSuccess();

              } elseif($transaction == "pending"){

                // TODO set payment status in merchant's database to 'Pending'
                // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $angsuran->setPending();

              } elseif ($transaction == "deny") {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $angsuran->setFailed();

              } elseif ($transaction == "expire") {

                // TODO set payment status in merchant's database to 'expire'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $angsuran->setExpired();

              } elseif ($transaction == "cancel") {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $angsuran->setFailed();
              }
        }

        return;

        // $pinjam = Pinjaman::where('status', 1)->get();

        // if(!empty($pinjam)){
        //     foreach($pinjam as $pinj){
        //         $transaction = Veritrans_Transaction::status($pinj->id_pinjaman);
        //         $pinjaman = Pinjaman::where('token', $pinj->token)->firstOrFail();

        //         if ($transaction == 'settlement') {
        //             $pinjaman->status = 2;
        //             $pinjaman->save();
        //         } elseif($transaction == 'pending'){
        //             $pinjaman->status = 1;
        //             $pinjaman->save();
        //         } elseif ($transaction == 'deny') {
        //             $pinjaman->status = 0;
        //             $pinjaman->save();
        //         } elseif ($transaction == 'expire') {
        //             $pinjaman->status = 0;
        //             $pinjaman->save();

        //         } elseif ($transaction == 'cancel') {
        //             $pinjaman->status = 0;
        //             $pinjaman->save();
        //         }
        //     }
        // }

        // $angsur = Angsuran::where('status', 1)->get();

        // if(!empty($angsur)){
        //     foreach($angsur as $angs){
        //         $transaction = Veritrans_Transaction::status($angs->id_angsuran);
        //         $angsuran = Angsuran::where('token', $angs->token)->firstOrFail();
        //         if ($transaction == 'settlement') {
        //             $angsuran->status = 2;
        //             $angsuran->save();
        //         } elseif($transaction == 'pending'){
        //             $angsuran->status = 1;
        //             $angsuran->save();
        //         } elseif ($transaction == 'deny') {
        //             $angsuran->status = 0;
        //             $angsuran->save();
        //         } elseif ($transaction == 'expire') {
        //             $angsuran->status = 0;
        //             $angsuran->save();
        //         } elseif ($transaction == 'cancel') {
        //             $angsuran->status = 0;
        //             $angsuran->save();
        //         }

        //     }
        // }

        // return;
    }

    public function hasilSurvei(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;

            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);

            $no_pk = $pengajuan->dataMitra->no_pk;
            $unit_usaha = $pengajuan->dataMitra->dataProposal->unit_usaha;
            $sektor_usaha = $pengajuan->dataMitra->dataProposal->sektor_usaha;
            $alamat_kantor = $pengajuan->dataMitra->alamat_kantor;
            $no_telp = $pengajuan->dataMitra->no_telp;
            $pemilik = $pengajuan->dataMitra->dataProposal->nama_pengaju;

            $survei = Survei::where('id_pengajuan_dana', $id_pengajuan_dana)->first();
            $kepemilikan_rumah = $survei->kepemilikan_rumah;
            $lama_tempati_rumah = $survei->lama_tempati_rumah;
            $lama_jalani_usaha = $survei->lama_jalani_usaha;
            $modal_saat_ini = $survei->modal;
            $tempat_usaha = $survei->tempat_usaha;
            $lokasi_usaha = $survei->lokasi_usaha;
            $pinjaman_lain = $survei->pinjaman_lain;
            $ijin_usaha = $survei->ijin_usaha;
            $kepemilikan_usaha = $survei->kepemilikan_usaha;
            $rekening_bank = $survei->rekening_bank;
            $penghasilan_diluar_usaha = $survei->penghasilan_diluar_usaha;
            $surat_ijin_usaha = Cloudder::show($survei->surat_ijin_usaha, ['width'=>1920, 'height'=>1080]);
            $dokumen_hasil_survei = Cloudder::show($survei->dokumen_hasil_survei, ['width'=>1920, 'height'=>1080]);
            $surat_berita_acara = Cloudder::show($survei->surat_berita_acara, ['width'=>1920, 'height'=>1080]);
            $foto_pemilik = Cloudder::show($survei->foto_pemilik, ['width'=>1920, 'height'=>1080]);
            $foto_tempat_usaha = Cloudder::show($survei->foto_tempat_usaha, ['width'=>1920, 'height'=>1080]);

            return response()->json([
                'no_pk' => $no_pk,
                'unit_usaha' => $unit_usaha,
                'sektor_usaha' => $sektor_usaha,
                'alamat_kantor' => $alamat_kantor,
                'no_telp' => $no_telp,
                'pemilik' => $pemilik,
                'kepemilikan_rumah' => $kepemilikan_rumah,
                'lama_tempati_rumah' => $lama_tempati_rumah,
                'lama_jalani_usaha' => $lama_jalani_usaha,
                'modal_saat_ini' => $modal_saat_ini,
                'tempat_usaha' => $tempat_usaha,
                'lokasi_usaha' => $lokasi_usaha,
                'pinjaman_lain' => $pinjaman_lain,
                'ijin_usaha' => $ijin_usaha,
                'kepemilikan_usaha' => $kepemilikan_usaha,
                'rekening_bank' => $rekening_bank,
                'penghasilan_diluar_usaha' => $penghasilan_diluar_usaha,
                'surat_ijin_usaha' => $surat_ijin_usaha,
                'dokumen_hasil_survei' => $dokumen_hasil_survei,
                'surat_berita_acara' => $surat_berita_acara,
                'foto_pemilik' => $foto_pemilik,
                'foto_tempat_usaha' => $foto_tempat_usaha
            ], 200);
        }
    }
}
