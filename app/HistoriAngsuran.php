<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriAngsuran extends Model
{
    protected $table = 'histori_angsuran';

    protected $primaryKey = 'id_bayar';

    protected $fillable = ['id_bayar', 'id_angsuran', 'bayar_angsuran'];

    public $incrementing = false;

    public function angsuran()
    {
        return $this->belongsTo('App\Angsuran', 'id_angsuran');
    }
}
