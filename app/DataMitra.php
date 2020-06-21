<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMitra extends Model
{
    protected $table = 'data_mitra';

    protected $primaryKey = 'no_pk';

    protected $fillable = ['no_pk', 'nama_pk', 'usaha', 'pemilik', 'ktp', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'no_telp', 'alamat_kantor', 'lokasi_usaha', 'ahli_waris', 'jumlah_karyawan', 'no_rek', 'username', 'no_jaminan', 'no_proposal'];

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
}
