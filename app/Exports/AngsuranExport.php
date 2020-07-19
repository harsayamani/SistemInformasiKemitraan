<?php

namespace App\Exports;

use App\Angsuran;
use App\Pinjaman;
use Maatwebsite\Excel\Concerns\FromCollection;

class AngsuranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $id_pinjaman;

    public function __construct($id_pinjaman)
    {
        $this->id_pinjaman = $id_pinjaman;
    }

    public function collection()
    {
        $id_pinjaman = $this->id_pinjaman;
        $no_pk = Pinjaman::where('id_pinjaman', $id_pinjaman)->value('no_pk');
        return Angsuran::where('no_pk', $no_pk)->where('status', 1)->get();
    }
}
