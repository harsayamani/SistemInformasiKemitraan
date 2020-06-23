@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola Proposal')

@section('proposalActive', 'active')

@section('bigTitle', 'Kelola Proposal')

@section('breadcrumbTitle', 'Kelola Proposal')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Pengajuan Proposal Mitra</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <!-- Modal Hapus Proposal -->

                    <div class="modal fade" id="hapusProposal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Hapus Proposal</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah anda yakin?</h5>
                                    <form action="/admin/kelola/proposal/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}
                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="no_proposal" name="no_proposal" class="form-control" readonly required>
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

                    {{-- <!-- Modal Batalkan Proposal -->

                    <div class="modal fade" id="hapusProposal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Batalkan Proposal</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah anda yakin?</h5>
                                    <form action="/admin/kelola/proposal/batalkan" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}
                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="no_proposal" name="no_proposal" class="form-control" readonly required>
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
                    </div> --}}

                    <!-- Modal Setujui Proposal -->

                    <div class="modal fade" id="setujuiProposal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Setujui Proposal</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah anda sudah selesai mengkaji proposal yang diajukan?</h5>
                                    <form action="/admin/kelola/proposal/setujui" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}
                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="no_proposal" name="no_proposal" class="form-control" readonly required>
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
                                <th>Kegiatan Pengajuan</th>
                                <th>Nama Pengaju</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Unit Usaha</th>
                                <th>Dana Aju</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposal as $prop)
                            <tr>
                                <td>{{$prop->no_proposal}}</td>
                                <td>{{$prop->kegiatan}}</td>
                                <td>{{$prop->nama_pengaju}}</td>
                                <td>{{$prop->tgl_pengajuan}}</td>
                                <td>{{$prop->unit_usaha}}</td>
                                <td>Rp.{{$prop->dana_aju}}</td>
                                <td>
                                    @if ($prop->status == 0)
                                        <button type="button" class="btn btn-success btn-sm"
                                            data-target="#setujuiProposal"
                                            data-toggle="modal"
                                            data-no_proposal ="{{$prop->no_proposal}}">
                                            <i class="fa fa-check"></i>&nbsp;
                                                Setujui
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-target="#hapusProposal"
                                            data-toggle="modal"
                                            data-no_proposal ="{{$prop->no_proposal}}">
                                            <i class="fa fa-trash-o"></i>&nbsp;
                                                Hapus
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary btn-sm" disabled>
                                                Proposal telah disetujui!
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

@endsection

@section('script')
    @push('script')
        <!-- DATA TABES SCRIPT -->
        <script src="/adminlte/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/adminlte/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#hapusProposal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var no_proposal = button.data('no_proposal');
                    var modal = $(this);
                    console.log(no_proposal)
                    modal.find('.modal-body #no_proposal').val(no_proposal);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#setujuiProposal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var no_proposal = button.data('no_proposal');
                    var modal = $(this);
                    console.log(no_proposal)
                    modal.find('.modal-body #no_proposal').val(no_proposal);
                });
            });
        </script>

    {{-- <script type="text/javascript">
        $(document).ready(function(){
            $('#batalkanProposal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var no_proposal = button.data('no_proposal');
                var modal = $(this);
                modal.find('.modal-body #no_proposal').val(no_proposal);
            });
        });
    </script> --}}

    @endpush
@endsection
