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
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Daftar Pengajuan Proposal Mitra</h3>
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
                                                <a href="/admin/kelola/pinjaman/pengajuan/{{$peng->no_pk}}" class="btn btn-primary btn-sm">
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

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
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

        {{-- <script>
            CKEDITOR.replace('isi_berita');
        </script> --}}

    @endpush
@endsection
