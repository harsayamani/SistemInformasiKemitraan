<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $primaryKey = 'no_berita';

    protected $fillable = ['tgl_rilis', 'judul_berita', 'isi_berita', 'keterangan', 'ilustrasi'];
}
