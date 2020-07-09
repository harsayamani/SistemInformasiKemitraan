<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanDana extends Model
{
    protected $table = 'pengajuan_dana';

    protected $primaryKey = 'id_pengajuan_dana';

    protected $fillable = ['id_pengajuan_dana', 'no_pk', 'dana_aju', 'status'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->belongsTo('App\DataMitra', 'no_pk');
    }

    public function survei()
    {
        return $this->hasMany('App\Survei', 'id_pengajuan_dana');
    }
}
