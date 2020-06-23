<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProposal extends Model
{
    protected $table = 'data_proposal';

    protected $primaryKey = 'no_proposal';

    protected $fillable = ['no_proposal', 'kegiatan', 'nama_pengaju', 'tgl_pengajuan', 'unit_usaha', 'dana_aju', 'email','status'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->hasMany('App\DataMitra', 'no_proposal');
    }
}
