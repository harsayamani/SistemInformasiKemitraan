<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    protected $table = 'jaminan';

    protected $primaryKey = 'no_jaminan';

    protected $fillable = ['no_jaminan', 'jaminan', 'pemilik_jaminan'];

    public $incrementing = false;

    public function dataMitra()
    {
        return $this->hasMany('App\DataMitra', 'no_jaminan');
    }
}
