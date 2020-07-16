<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMitra extends Model
{
    protected $table = 'data_mitra';

    protected $primaryKey = 'no_pk';

    protected $fillable = ['no_pk', 'ktp', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'no_telp', 'alamat_kantor', 'lokasi_usaha', 'ahli_waris', 'jumlah_karyawan', 'no_rek', 'bank', 'username', 'no_jaminan', 'no_proposal'];

    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo('App\Users', 'username');
    }

    public function dataProposal()
    {
        return $this->belongsTo('App\DataProposal', 'no_proposal');
    }

    public function jaminan()
    {
        return $this->belongsTo('App\Jaminan', 'no_jaminan');
    }

    public function angsuran()
    {
        return $this->hasMany('App\Angsuran', 'no_pk');
    }

    public function pinjaman()
    {
        return $this->hasMany('App\Pinjaman', 'no_pk');
    }

    public function pengajuanDana()
    {
        return $this->hasMany('App\PengajuanDana', 'no_pk');
    }

    public function survei()
    {
        return $this->hasMany('App\Survei', 'no_pk');
    }

}
