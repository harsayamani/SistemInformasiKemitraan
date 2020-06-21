<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $table = 'angsuran';

    protected $primaryKey = 'id_angsuran';

    protected $fillable = ['id_angsuran', 'id_pinjaman', 'no_pk', 'jumlah_angsuran', 'tgl_angsuran', 'utang'];

    public $incrementing = false;

    public function pinjaman()
    {
        return $this->belongsTo('App\Pinjaman', 'id_pinjaman');
    }

    public function dataMitra()
    {
        return $this->belongsTo('App\DataMitra', 'no_pk');
    }

    public function historiAngsuran() {
        return $this->hasMany('App\HistoriAngsuran', 'id_angsuran');
    }
}
