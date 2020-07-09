<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProposal extends Model
{
    protected $table = 'data_proposal';

    protected $primaryKey = 'no_proposal';

    protected $fillable = ['no_proposal', 'ktp_pengaju', 'nama_pengaju', 'tgl_pengajuan', 'unit_usaha', 'sektor_usaha', 'laporan_keuangan', 'npwp', 'sku', 'email','status'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->hasMany('App\DataMitra', 'no_proposal');
    }
}
