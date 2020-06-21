<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriPinjaman extends Model
{
    protected $table = 'histori_pinjaman';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = ['id_transaksi', 'id_pinjaman'];

    public $incrementing = false;

    public function pinjaman()
    {
        return $this->belongsTo('App\Pinjaman', 'id_pinjaman');
    }
}
