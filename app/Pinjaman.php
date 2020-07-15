<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $primaryKey = 'id_pinjaman';

    protected $fillable = ['id_pinjaman', 'no_pk', 'tgl_pinjaman','nominal_pinjaman', 'bunga', 'total_pinjaman', 'lama_angsuran', 'nominal_angsuran', 'status', 'token'];

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
