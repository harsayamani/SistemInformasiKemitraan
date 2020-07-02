@extends('mitra/master/masterMitra')

@section('title_bar', 'Dashboard | Kemitraan LEN Industri')

@section('active1', 'active')

@section('title_page', 'Dashboard')

@section('section')

@if($pinjaman != null && $pinjaman->status == 3 && $pengajuan->status == 2)
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body alert-success">
        <p>Pinjaman anda telah berakhir, Anda dapat mengajukan pinjaman kembali di menu Pinjaman!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif

<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        @if ($mitra->ktp == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->jenis_kelamin == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->tempat_lahir == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->tgl_lahir == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->no_telp == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->ahli_waris == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->jumlah_karyawan == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->no_rek == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @else
        <div class="alert alert-success" role="alert">
            Data mitra sudah lengkap
        </div>
        @endif
    </div>
</section>

<!-- Member Section-->
<section class="client no-padding-top">
    <div class="container-fluid">
      <div class="row">

        <!-- Profile -->
        <div class="col-lg-6">
          <div class="client card">
            <div class="card-body text-center">
              <div class="client-title">
                <h3>{{Session::get('namaMitra')}}</h3><span>Mitra</span><a href="/mitra/dataMitra">Lengkapi Data Mitra</a>
              </div>
            </div>
          </div>
          <div class="overdue card">
            <div class="card-body">
              <center><h3>Pengajuan Pinjaman</h3></center>
              @if ($pengajuan == null || $pengajuan->count()<1 || $pinjaman->status == 3 && $pengajuan->status == 2)
                <div class="number text-center">Belum Diajukan</div>
              @elseif($pengajuan->status == 0)
                <div class="number text-center">Sedang Diajukan</div>
              @else
                <div class="number text-center">Pengajuan Telah Disetujui</div>
              @endif
            </div>
          </div>
        </div>

        <!-- Status -->
        <div class="col-lg-6">
            <div class="work-amount card">
              <div class="card-body">
                <center><h3>Status Pinjaman Terakhir</h3></center>
                <div class="chart text-center">
                    @if ($pinjaman == null || $pinjaman->count()<1 || $pengajuan->status < 2)
                        <div class="text"><b>Pinjaman belum diproses!</b></div>
                        <canvas id="pieChart"></canvas>
                    @else
                        @if ($pinjaman->status == 0)
                            <div class="text"><b>On Proses</b></div>
                            <canvas id="pieChart"></canvas>
                        @elseif ($pinjaman->status == 1)
                            <div class="text"><b>On Payment</b></div>
                            <canvas id="pieChart"></canvas>
                        @elseif ($pinjaman->status == 2)
                            <div class="text"><b>On Success Payment</b></div>
                            <canvas id="pieChart"></canvas>
                        @elseif ($pinjaman->status == 3)
                            <div class="text"><b>Finish</b></div>
                            <canvas id="pieChart"></canvas>
                        @endif
                    @endif
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</section>

@endsection
