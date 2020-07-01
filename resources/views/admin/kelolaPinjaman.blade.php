@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola Pinjaman')

@section('pinjamanActive', 'active')

@section('bigTitle', 'Kelola Pinjaman')

@section('breadcrumbTitle', 'Kelola Pinjaman')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Pengaju Pinjaman</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Tambah Pinjaman</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Transfer Pinjaman</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Daftar Pengajuan Pinjaman Mitra</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">

                                <!-- Modal Hapus Pengajuan -->

                                <div class="modal fade" id="hapusPengajuan" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mediumModalLabel"><strong>Hapus Pengajuan Pinjaman</strong></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Apakah anda yakin?</h5>
                                                <form action="/admin/kelola/pinjaman/pengajuan/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ csrf_field()}}
                                                    <div class="row form-group" hidden>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_pengajuan_dana" name="id_pengajuan_dana" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Setujui Pengajuan -->

                                <div class="modal fade" id="setujuiPengajuan" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mediumModalLabel"><strong>Setujui Pengajuan Pinjaman</strong></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Apakah anda sudah selesai mengkaji proposal yang diajukan?</h5>
                                                <form action="/admin/kelola/pinjaman/pengajuan/setujui" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ csrf_field()}}
                                                    <div class="row form-group" hidden>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_pengajuan_dana" name="id_pengajuan_dana" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Setujui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pengaju</th>
                                            <th>Unit Usaha</th>
                                            <th>Sektor Usaha</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Dana Aju</th>
                                            <th>Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $key => $peng)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->nama_pengaju}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->unit_usaha}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->kegiatan}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->tgl_pengajuan}}</td>
                                            <td>Rp.{{$peng->dataMitra->dataProposal->dana_aju}}</td>
                                            <td>
                                                <a href="/admin/kelola/pinjaman/pengajuan/{{$peng->dataMitra->no_proposal}}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-print"></i>&nbsp;
                                                    Print Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                @if ($peng->status == 0)
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-target="#setujuiPengajuan"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana="{{$peng->id_pengajuan_dana}}">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                            Setujui
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-target="#hapusPengajuan"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana="{{$peng->id_pengajuan_dana}}">
                                                        <i class="fa fa-trash-o"></i>&nbsp;
                                                            Hapus
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                            Pengajuan telah disetujui!
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Tambah Pinjaman</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <!-- form start -->
                                <form role="form" action="/admin/kelola/pinjaman/tambah" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="box-body">

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="no_pk">Nomor Mitra</label>
                                            <div class="col-12 col-md-6">
                                                <select class="form-control" id="no_pk" name="no_pk" required>
                                                        <option value="">---Pilih mitra---</option>
                                                    @foreach ($setuju as $aju)
                                                        <option value="{{$aju->no_pk}}">{{$aju->no_pk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="nama_pengaju">Nama</label>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" id="nama_pengaju" name="nama_pengaju" readonly>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="tgl_pinjaman">Tanggal</label>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" id="tgl_pinjaman" name="tgl_pinjaman" value="{{$tgl_sekarang}}" readonly>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="bunga">Bunga</label>
                                            <div class="col-12 col-md-2">
                                                <input type="number" class="form-control" id="bunga" name="bunga" value="0.5" required>
                                            </div>
                                            %
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="nominal_pinjaman">Nominal</label>
                                            <div class="col-12 col-md-6">
                                                <input type="number" class="form-control" id="nominal_pinjaman" name="nominal_pinjaman" readonly>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="lama_angsuran">Lama Angsuran</label>
                                            <div class="col-12 col-md-2">
                                                <input type="number" class="form-control" id="lama_angsuran" name="lama_angsuran"  required>
                                            </div>
                                            bulan
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="nominal_angsuran">Nominal Angsuran</label>
                                            <div class="col-12 col-md-6">
                                                <input type="number" class="form-control" id="nominal_angsuran" name="nominal_angsuran" required>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Transfer Pinjaman</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pengaju</th>
                                            <th>Tanggal Pinjaman</th>
                                            <th>Nominal Pinjaman</th>
                                            <th>Total Pinjaman</th>
                                            <th>Lama Angsuran</th>
                                            <th>Nominal Angsuran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pinjaman as $key => $pinj)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$pinj->dataMitra->dataProposal->nama_pengaju}}</td>
                                            <td>{{$pinj->tgl_pinjaman}}</td>
                                            <td>Rp.{{$pinj->nominal_pinjaman}}</td>
                                            <td>Rp.{{$pinj->total_pinjaman}}</td>
                                            <td>{{$pinj->lama_angsuran}}</td>
                                            <td>Rp.{{$pinj->nominal_angsuran}}</td>
                                            <td>
                                                @if ($pinj->status == 0)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        On Proses
                                                    </button>
                                                @elseif($pinj->status == 1)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        On Payment
                                                    </button>
                                                @elseif($pinj->status == 2)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        On Success Payment
                                                    </button>
                                                @elseif($pinj->status == 3)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Lunas
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($pinj->status == 0)
                                                <button id="transfer" type="button" class="btn btn-primary btn-sm"
                                                data-id_pinjaman="{{$pinj->id_pinjaman}}">
                                                    Transfer
                                                </button>
                                                @elseif($pinj->status == 1)
                                                    <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $pinj->token }}')">Complete Payment</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div>
    </div>

</section><!-- /.content -->

@endsection

@section('script')
    @push('script')

        <!-- DATA TABES SCRIPT -->
        <script src="/adminlte/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/adminlte/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="/adminlte/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="/adminlte/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="/adminlte/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="/adminlte/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="/adminlte./js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="/adminlte/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="/adminlte/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $("#example2").dataTable();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#hapusPengajuan').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id_pengajuan_dana = button.data('id_pengajuan_dana');
                    var modal = $(this);

                    modal.find('.modal-body #id_pengajuan_dana').val(id_pengajuan_dana);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#setujuiPengajuan').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id_pengajuan_dana = button.data('id_pengajuan_dana');
                    var modal = $(this);
                    console.log(id_pengajuan_dana)
                    modal.find('.modal-body #id_pengajuan_dana').val(id_pengajuan_dana);
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                $('#no_pk').on('change', function(){
                    $.ajax({
                        url: "/admin/kelola/pinjaman/namaPengaju",
                        type:"POST",
                        data : {"_token": "{{ csrf_token() }}",
                        "id":$(this).val()},
                        dataType: "json",
                        success: function(res){
                            $('#nama_pengaju').val(res.nama_pengaju)
                            $('#nominal_pinjaman').val(res.nominal_pinjaman)
                        }
                    })

                })

                // init
                $('#no_pk').change();
            });
        </script>

        <script>

            $(document).ready(function(){
                $('#bunga').keyup(function(){
                    var bunga = parseFloat(document.getElementById("bunga").value);
                    var nominal_pinjaman = parseFloat(document.getElementById("nominal_pinjaman").value);
                    var lama_angsuran = parseFloat( document.getElementById("lama_angsuran").value);

                    var total_pinjaman = nominal_pinjaman + (nominal_pinjaman*(bunga/100));
                    var nominal_angsuran = total_pinjaman/lama_angsuran;
                    $('#nominal_angsuran').val(nominal_angsuran.toFixed(2))
                });

                $('#nominal_pinjaman').keyup(function(){
                    var bunga = parseFloat(document.getElementById("bunga").value);
                    var nominal_pinjaman = parseFloat(document.getElementById("nominal_pinjaman").value);
                    var lama_angsuran = parseFloat( document.getElementById("lama_angsuran").value);

                    var total_pinjaman = nominal_pinjaman + (nominal_pinjaman*(bunga/100));
                    var nominal_angsuran = total_pinjaman/lama_angsuran;
                    $('#nominal_angsuran').val(nominal_angsuran.toFixed(2))
                });

                $('#lama_angsuran').keyup(function(){
                    var bunga = parseFloat(document.getElementById("bunga").value);
                    var nominal_pinjaman = parseFloat(document.getElementById("nominal_pinjaman").value);
                    var lama_angsuran = parseFloat( document.getElementById("lama_angsuran").value);

                    var total_pinjaman = nominal_pinjaman + (nominal_pinjaman*(bunga/100));
                    var nominal_angsuran = total_pinjaman/lama_angsuran;
                    $('#nominal_angsuran').val(nominal_angsuran.toFixed(0))
                });
            });

        </script>

        <script>
            $(document).ready(function(){
                $('#transfer').click(function(){
                    var id_pinjaman = $(this).attr('data-id_pinjaman');

                    console.log(id_pinjaman)

                    $.ajax({
                        url: "/admin/kelola/pinjaman/transfer",
                        type:"POST",
                        data : {"_token": "{{ csrf_token() }}",
                        "id_pinjaman":id_pinjaman},
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
