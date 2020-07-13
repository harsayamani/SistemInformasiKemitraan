@extends('mitra/master/masterMitra')

@section('title_bar', 'Riwayat Transaksi | Kemitraan LEN Industri')

@section('active5', 'active')

@section('title_page', 'Riwayat Transaksi')

@section('section')

<section class="forms">
    <div class="container-fluid">
      <div class="row">
        <!-- Form Elements -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Daftar Riwayat Transaksi</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-pinjaman-tab" data-toggle="pill" href="#pills-pinjaman" role="tab" aria-controls="pills-pinjaman" aria-selected="true">Pinjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-angsuran-tab" data-toggle="pill" href="#pills-angsuran" role="tab" aria-controls="pills-angsuran" aria-selected="false">Angsuran</a>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-pinjaman" role="tabpanel" aria-labelledby="pills-pinjaman-tab">
                        <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Pinjaman</th>
                                    <th>Tanggal Waktu</th>
                                    <th>Nominal Pinjaman</th>
                                    <th>Nominal Angsuran</th>
                                    <th>Lama Angsuran</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($pinjaman as $key=>$pij)
                                @if($pij->pinjaman->no_pk == Session::get('noPK'))
                                  <tr>
                                      <td>{{$no+=1}}</td>
                                      <td>{{$pij->id_pinjaman}}</td>
                                      <td>{{$pij->created_at}}</td>
                                      <td>Rp.{{$pij->pinjaman->nominal_pinjaman}}</td>
                                      <td>Rp.{{$pij->pinjaman->nominal_angsuran}}</td>
                                      <td>{{$pij->pinjaman->lama_angsuran}}</td>
                                      <td>
                                          @if ($pij->pinjaman->status == 1)
                                              <button type="button" class="btn btn-primary btn-sm" disabled>
                                                  Sedang Ditransfer
                                              </button>
                                          @elseif($pij->pinjaman->status == 2)
                                              <button type="button" class="btn btn-success btn-sm" disabled>
                                                  Transfer Sukses
                                              </button>
                                          @elseif($pij->pinjaman->status == 3)
                                              <button type="button" class="btn btn-success btn-sm" disabled>
                                                  Lunas
                                              </button>
                                          @endif
                                      </td>
                                  </tr>
                                @endif
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-angsuran" role="tabpanel" aria-labelledby="pills-angsuran-tab">
                        <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Angsuran</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Jumlah Angsuran</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($angsuran as $keys=>$angs)
                                @if($angs->angsuran->no_pk == Session::get('noPK'))
                                  <tr>
                                      <td>{{$no2+=1}}</td>
                                      <td>{{$angs->id_angsuran}}</td>
                                      <td>{{$angs->angsuran->tgl_angsuran}}</td>
                                      <td>Rp.{{$angs->bayar_angsuran}}</td>
                                      <td>
                                          @if ($angs->angsuran->status == 1)
                                              <button type="button" class="btn btn-primary btn-sm" disabled>
                                                  Dalam Proses Pembayaran
                                              </button>
                                          @elseif($angs->angsuran->status == 2)
                                              <button type="button" class="btn btn-success btn-sm" disabled>
                                                  Pembayaran Berhasil
                                              </button>
                                          @endif
                                      </td>
                                  </tr>
                                @endif
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('script')
@push('script')

@endpush
@endsection
