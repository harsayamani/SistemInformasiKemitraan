@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola Angsuran')

@section('angsuranActive', 'active')

@section('bigTitle', 'Kelola Angsuran')

@section('breadcrumbTitle', 'Kelola Angsuran')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Angsuran</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Pinjaman</th>
                                <th>Nama</th>
                                <th>Jumlah Angsuran</th>
                                <th>Tanggal Angsuran</th>
                                <th>Utang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($angsuran as $key => $angs)
                            @if($angs->tgl_angsuran!=null)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$angs->id_pinjaman}}</td>
                                <td>{{$angs->dataMitra->dataProposal->nama_pengaju}}</td>
                                <td>Rp.{{$angs->jumlah_angsuran}}</td>
                                <td>{{$angs->tgl_angsuran}}</td>
                                <td>Rp.{{$angs->utang}}</td>
                            </tr>
                            @endif
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
            });
        </script>
    @endpush
@endsection
