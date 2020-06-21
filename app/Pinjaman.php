<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $primaryKey = 'id_pinjaman';

    protected $fillable = ['id_pinjaman', 'no_pk', 'jumlah_pinjaman', 'bunga', 'total_pinajaman'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->belongsTo('App\DataMitra', 'no_pk');
    }

    public function angsuran() {
        return $this->hasMany('App\Angsuran', 'id_pinjaman');
    }

    public function historiPinjaman() {
        return $this->hasMany('App\HistoriPinjaman', 'id_pinjaman');
    }
}
