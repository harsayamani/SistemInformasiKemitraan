<?php

namespace App\Http\Controllers;

use App\DataMitra;
use App\PengajuanDana;
use App\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Veritrans_Config;
use Veritrans_Snap;

class PinjamanController extends Controller
{
    public function kelolaPinjaman(){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $pengajuan = PengajuanDana::orderBy('status', 'asc')->get();
            $setuju = PengajuanDana::where('status', 1)->get();
            $tgl_sekarang = Carbon::now();
            $pinjaman = Pinjaman::orderBy('status', 'asc')->get();

            return view('admin/kelolaPinjaman', compact('pengajuan', 'setuju', 'tgl_sekarang', 'pinjaman'));
        }
    }

    public function printDokumenPengajuan($no_pk){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
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

            if($pengajuan->save()){
                return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman disetujui!');
            }
        }
    }

    public function hapusPengajuan(Request $request){
        if(!Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id_pengajuan_dana = $request->id_pengajuan_dana;
            $pengajuan = PengajuanDana::findOrFail($id_pengajuan_dana);

            if($pengajuan->delete($pengajuan)){
                return redirect('/admin/kelola/pinjaman')->with('alert-success', 'Pengajuan pinjaman dihapus!');
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
                'lama_angsuran' => '|numeric|regex:/^([1-9][0-9]+)/',
                'nominal_angsuran' => '|numeric'
            ]);

            $pinjaman = new Pinjaman();
            $pinjaman->id_pinjaman = uniqid('PIJ-', false);
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
        $pinjaman->save();

        return response()->json([
            'snap_token' => $snap_token
        ], 200);
    }
}
