@extends('mitra/master/masterMitra')

@section('title_bar', 'Angsuran | Kemitraan LEN Industri')

@section('active4', 'active')

@section('title_page', 'Angsuran')

@section('section')

<section class="forms">

    <div class="container-fluid">
      <div class="row">
        <!-- Form Elements -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Daftar Angsuran</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>No.</th>
                          <th>ID Pinjaman</th>
                          <th>Nomor Mitra</th>
                          <th>Tanggal Bayar</th>
                          <th>Jumlah Angsuran</th>
                          <th>Utang</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($angsuran as $key=>$angs)
                      @if($pengajuan != null && $pengajuan->status == 3)
                        <tr>
                            <td>{{$no+=1}}</td>
                            <td>{{$angs->id_pinjaman}}</td>
                            <td>{{$angs->no_pk}}</td>
                            <td>
                                @if($angs->tgl_angsuran != null)
                                {{$angs->tgl_angsuran}}
                                @else
                                -
                                @endif
                            </td>
                            <td>Rp.{{$angs->jumlah_angsuran}}</td>
                            <td>Rp.{{$angs->utang}}</td>
                            <td>
                                @if ($angs->status == 0)
                                    <button type="button" class="btn btn-warning btn-sm" disabled>
                                        Belum Melakukan Pembayaran
                                    </button>
                                @elseif($angs->status == 1)
                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                        Dalam Proses Pembayaran
                                    </button>
                                @elseif($angs->status == 2)
                                    <button type="button" class="btn btn-sucess btn-sm" disabled>
                                        Lunas
                                    </button>
                                @endif
                            </td>
                            <td>
                                @if($angs->status == 0)
                                <button id="transfer" type="button" class="btn btn-primary btn-sm"
                                data-id_angsuran="{{$angs->id_angsuran}}">
                                    Transfer
                                </button>
                                @elseif($angs->status == 1)
                                    <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $angs->token }}')">Selesaikan Pembayaran</button>
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
</section>

@endsection

@section('script')
@push('script')
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script>
    $(document).ready(function(){
        $('#transfer').click(function(){
            var id_angsuran = $(this).attr('data-id_angsuran');

            console.log(id_angsuran)

            $.ajax({
                url: "/mitra/angsuran/transfer",
                type:"POST",
                data : {"_token": "{{ csrf_token() }}",
                "id_angsuran":id_angsuran},
                dataType: "json",
                success: function(res){
                    snap.pay(res.snap_token, {
                        // Optional
                        onSuccess: function (result) {
                            location.reload();
                        },
                        // Optional
                        onPending: function (result) {
                            location.reload();
                        },
                        // Optional
                        onError: function (result) {
                            location.reload();
                        }
                    });
                }
            })
        })
    });
</script>
@endpush
@endsection
