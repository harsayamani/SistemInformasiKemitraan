<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    protected $table = 'survei';

    protected $primaryKey = 'no_survei';

    protected $fillable = ['no_survei', 'no_pk', 'id_pengajuan_dana', 'kepemilikan_rumah', 'lama_tempati_rumah', 'lama_jalani_usaha', 'modal', 'tempat_usaha', 'lokasi_usaha', 'pinjaman_lain', 'ijin_usaha', 'kepemilikan_usaha', 'rekening_bank', 'penghasilan_diluar_usaha', 'surat_ijin_usaha', 'dokumen_hasil_survei', 'surat_berita_acara', 'foto_pemilik', 'foto_tempat_usaha', 'anggota_tim1', 'anggota_tim2', 'anggota_tim3'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->belongsTo('App\DataMitra', 'no_pk');
    }

    public function pengajuanDana()
    {
        return $this->belongsTo('App\PengajuanDana', 'id_pengajuan_dana');
    }
}
