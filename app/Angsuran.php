<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $table = 'angsuran';

    protected $primaryKey = 'id_angsuran';

    protected $fillable = ['id_angsuran', 'id_pinjaman', 'no_pk', 'jumlah_angsuran', 'tgl_angsuran', 'utang', 'token', 'status'];

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

     /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status'] = 1;
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status'] = 2;
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status'] = 0;
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status'] = 0;
        self::save();
    }
}
