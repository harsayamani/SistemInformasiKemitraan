<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\DataMitra;
use App\HistoriPinjaman;
use App\PengajuanDana;
use App\Pinjaman;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Veritrans_Config;
use Veritrans_Notification;
use Veritrans_Snap;

class PinjamanController extends Controller
{
    public function kelolaPinjaman(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pengajuan = PengajuanDana::orderBy('status', 'asc')->get();
            $setuju = PengajuanDana::where('status', 1)->get();
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
            $pengajuan = PengajuanDana::where('no_pk', $no_pk)->first();

            if($mitra){
                return view('admin/dokumenPengajuanDana', compact('mitra', 'pengajuan'));
            }
        }
    }

    public function setujuiPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;

            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);
            $pengajuan->status = 1;

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
                    return redirect('/admin/kelola/pinjaman')->with('alert-danger', 'Terjadi kesalahan : '.$e.'');
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
            $persetujuan = "TIDAK DISETUJUI";

            try{
                Mail::send('admin/emailPengajuanDana', ['nama' => $nama, 'persetujuan'=>$persetujuan], function ($message) use ($request)
                {
                    $message->subject('Konfirmasi Status Pengajuan Dana Sistem Kemitraan LEN Industri');
                    $message->from('harsoftdev@gmail.com', 'Sistem Kemitraan | LEN Industri.');
                    $message->to(PengajuanDana::findOrFail($request->id_pengajuan_dana)->dataMitra->users->email);
                });
                $pengajuan->delete($pengajuan);
                return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman dihapus!');
            }catch(Exception $e){
                return redirect('/admin/kelola/pinjaman')->with('alert-denger', 'Terjadi kesalahan : '.$e.'');
            }
        }
    }

    public function getNamaPengaju(Request $request){
        $no_pk = $request->id;
        $nama_pengaju = DataMitra::findOrFail($no_pk)->dataProposal->nama_pengaju;
        $nominal_peminjaman = DataMitra::findOrFail($no_pk)->dataProposal->dana_aju;

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
                $pengajuan = PengajuanDana::where('no_pk', $request->no_pk)->where('status', 1)->first();
                $pengajuan->status = 2;
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
        // Buat transaksi ke midtrans kemudian save snap tokennya.
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

        $id_pinjaman = $request->id_pinjaman;
        $pinjaman = Pinjaman::findOrFail($id_pinjaman);

        $payload = [
            'transaction_details' => [
                'order_id'      => $pinjaman->id_pinjaman,
                'gross_amount'  => $pinjaman->nominal_pinjaman,
            ],
            'customer_details' => [
                'first_name'    => $pinjaman->dataMitra->dataProposal->nama_pengaju,
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

    public function notificationHandler()
    {
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');

        $notif = new Veritrans_Notification();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $pinjaman = Pinjaman::findOrFail($orderId);
        $angsuran = Angsuran::findOrFail($orderId);

        if(!empty($pinjaman)){
            if ($transaction == 'capture') {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                  if($fraud == 'challenge') {
                    $pinjaman->status = 1;
                  } else {
                    $pinjaman->status = 2;
                  }

                }

            } elseif ($transaction == 'settlement') {

                $pinjaman->status = 2;

            } elseif($transaction == 'pending'){

                $pinjaman->status = 1;

            } elseif ($transaction == 'deny') {

                $pinjaman->status = 0;

            } elseif ($transaction == 'expire') {

                $pinjaman->status = 0;

            } elseif ($transaction == 'cancel') {

                $pinjaman->status = 0;

            }

            $pinjaman->save();

        }elseif(!empty($angsuran)){
            if ($transaction == 'capture') {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                  if($fraud == 'challenge') {
                    $angsuran->status = 1;
                  } else {
                    $angsuran->status = 2;
                  }

                }

            } elseif ($transaction == 'settlement') {

                $angsuran->status = 2;

            } elseif($transaction == 'pending'){

                $angsuran->status = 1;

            } elseif ($transaction == 'deny') {

                $angsuran->status = 0;

            } elseif ($transaction == 'expire') {

                $angsuran->status = 0;

            } elseif ($transaction == 'cancel') {

                $angsuran->status = 0;

            }

            $angsuran->save();
        }

        return;
    }
}
