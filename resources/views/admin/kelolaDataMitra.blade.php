@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola Data Mitra')

@section('dataMitraActive', 'active')

@section('bigTitle', 'Kelola Data Mitra')

@section('breadcrumbTitle', 'Kelola Data Mitra')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Mitra yang Telah Disetujui</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <!-- Modal Hapus Data Mitra -->

                    <div class="modal fade" id="hapusMitra" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Hapus Mitra</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah anda yakin?</h5>
                                    <form action="/admin/kelola/dataMitra/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}
                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="no_pk" name="no_pk" class="form-control" readonly required>
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

                    <div class="modal fade" id="infoMitra" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Info Mitra</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <dl class="dl-horizontal">
                                        <dt>Nomor PK</dt>
                                        <dd id="nomor_pk"></dd>
                                        <dt>Unit Usaha</dt>
                                        <dd id="nama_pk"></dd>
                                        <dt>Sektor Usaha</dt>
                                        <dd id="usaha"></dd>
                                        <dt>Pemilik</dt>
                                        <dd id="pemilik"></dd>
                                        <dt>Jenis Kelamin</dt>
                                        <dd id="jenis_kelamin">.</dd>
                                        <dt>Tanggal Lahir</dt>
                                        <dd id="tgl_lahir"></dd>
                                        <dt>Nomor Telp.</dt>
                                        <dd id="no_telp"></dd>
                                        <dt>Email</dt>
                                        <dd id="email"></dd>
                                        <dt>Alamat Kantor</dt>
                                        <dd id="alamat_kantor"></dd>
                                        <dt>Lokasi Usaha</dt>
                                        <dd id="lokasi_usaha"></dd>
                                        <dt>Ahli Waris</dt>
                                        <dd id="ahli_waris"></dd>
                                        <dt>Jumlah Karyawan</dt>
                                        <dd id="jumlah_karyawan"></dd>
                                        <dt>Nomor Rekening</dt>
                                        <dd id="no_rek"></dd>
                                        <dt>Jaminan</dt>
                                        <dd id="jaminan"></dd>
                                        <dt>Pemilik Jaminan</dt>
                                        <dd id="pemilik_jaminan"></dd>
                                    </dl>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor PK</th>
                                <th>Unit Usaha</th>
                                <th>Sektor Usaha</th>
                                <th>Pemilik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mitra as $mit)
                            <tr>
                                <td>{{$mit->no_pk}}</td>
                                <td>{{$mit->dataProposal->unit_usaha}}</td>
                                <td>{{$mit->dataProposal->sektor_usaha}}</td>
                                <td>{{$mit->dataProposal->nama_pengaju}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm"
                                        data-target="#infoMitra"
                                        data-toggle="modal"
                                        data-no_pk ="{{$mit->no_pk}}"
                                        data-nama_pk ="{{$mit->dataProposal->unit_usaha}}"
                                        data-usaha ="{{$mit->dataProposal->sektor_usaha}}"
                                        data-pemilik ="{{$mit->dataProposal->nama_pengaju}}"
                                        data-jenis_kelamin ="{{$mit->jenis_kelamin}}"
                                        data-tgl_lahir = "{{$mit->tgl_lahir}}"
                                        data-no_telp ="{{$mit->no_telp}}"
                                        data-email ="{{$mit->users->email}}"
                                        data-alamat_kantor ="{{$mit->alamat_kantor}}"
                                        data-lokasi_usaha ="{{$mit->lokasi_usaha}}"
                                        data-ahli_waris ="{{$mit->ahli_waris}}"
                                        data-jumlah_karyawan ="{{$mit->jumlah_karyawan}}"
                                        data-no_rek ="{{$mit->no_rek}}"
                                        data-jaminan ="{{$mit->jaminan->jaminan}}"
                                        data-pemilik_jaminan ="{{$mit->jaminan->pemilik_jaminan}}"
                                        >
                                        <i class="fa fa-info"></i>&nbsp;
                                            Info
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-target="#hapusMitra"
                                        data-toggle="modal"
                                        data-no_pk ="{{$mit->no_pk}}">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                            Hapus
                                    </button>
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
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#hapusMitra').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var no_pk = button.data('no_pk');
                    var modal = $(this);

                    modal.find('.modal-body #no_pk').val(no_pk);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#infoMitra').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var no_pk = button.data('no_pk');
                    var nama_pk = button.data('nama_pk');
                    var usaha = button.data('usaha');
                    var pemilik = button.data('pemilik');
                    var jenis_kelamin = button.data('jenis_kelamin');
                    var tgl_lahir = button.data('tgl_lahir');
                    var no_telp = button.data('no_telp');
                    var email = button.data('email');
                    var alamat_kantor = button.data('alamat_kantor');
                    var lokasi_usaha = button.data('lokasi_usaha');
                    var ahli_waris = button.data('ahli_waris');
                    var jumlah_karyawan = button.data('jumlah_karyawan');
                    var no_rek = button.data('no_rek');
                    var jaminan = button.data('jaminan');
                    var pemilik_jaminan = button.data('pemilik_jaminan');
                    var modal = $(this);

                    modal.find('.modal-body #nomor_pk').html(no_pk);
                    modal.find('.modal-body #nama_pk').html(nama_pk);
                    modal.find('.modal-body #usaha').html(usaha);
                    modal.find('.modal-body #pemilik').html(pemilik);
                    modal.find('.modal-body #jenis_kelamin').html(jenis_kelamin);
                    modal.find('.modal-body #tgl_lahir').html(tgl_lahir);
                    modal.find('.modal-body #no_telp').html(no_telp);
                    modal.find('.modal-body #email').html(email);
                    modal.find('.modal-body #alamat_kantor').html(alamat_kantor);
                    modal.find('.modal-body #lokasi_usaha').html(lokasi_usaha);
                    modal.find('.modal-body #ahli_waris').html(ahli_waris);
                    modal.find('.modal-body #jumlah_karyawan').html(jumlah_karyawan);
                    modal.find('.modal-body #no_rek').html(no_rek);
                    modal.find('.modal-body #jaminan').html(jaminan);
                    modal.find('.modal-body #pemilik_jaminan').html(pemilik_jaminan);

                });
            });
        </script>
    @endpush
@endsection
