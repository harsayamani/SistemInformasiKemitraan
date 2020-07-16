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
            <div class="box box-primary">
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
                                    <div class="row">
                                        <div class="col-md-8">
                                            <dl class="dl-horizontal">
                                                <dt>Nomor PK</dt>
                                                <dd id="nomor_pk"></dd>
                                                <dt>Unit Usaha</dt>
                                                <dd id="nama_pk"></dd>
                                                <dt>Sektor Usaha</dt>
                                                <dd id="usaha"></dd>
                                                <dt>Pemilik</dt>
                                                <dd id="pemilik"></dd>
                                                <dt>Nomor KTP</dt>
                                                <dd id="no_ktp"></dd>
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
                                                <dt>Nama Bank</dt>
                                                <dd id="bank"></dd>
                                                <dt>Jaminan</dt>
                                                <dd id="jaminan"></dd>
                                                <dt>Pemilik Jaminan</dt>
                                                <dd id="pemilik_jaminan"></dd>
                                            </dl>
                                            <hr>
                                            <dl class="dl-horizontal">
                                                <dt>KTP</dt>
                                                <dd id="ktp"></dd>
                                                <br>
                                                <dt>Laporan Keuangan</dt>
                                                <dd id="laporan_keuangan"></dd>
                                                <br>
                                                <dt>SKU</dt>
                                                <dd id="sku"></dd>
                                                <br>
                                                <dt>Sertifikat Jaminan</dt>
                                                <dd id="sertifikat_jaminan"></dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="pas_foto"></div>
                                        </div>
                                    </div>
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
                                        data-no_ktp ="{{$mit->ktp}}"
                                        data-pemilik ="{{$mit->dataProposal->nama_pengaju}}"
                                        data-jenis_kelamin ="{{$mit->jenis_kelamin}}"
                                        data-tgl_lahir = "{{$mit->tgl_lahir}}"
                                        data-no_telp ="{{$mit->no_telp}}"
                                        data-email ="{{$mit->users->email}}"
                                        data-bank ="{{$mit->bank}}"
                                        data-alamat_kantor ="{{$mit->alamat_kantor}}"
                                        data-lokasi_usaha ="{{$mit->lokasi_usaha}}"
                                        data-ahli_waris ="{{$mit->ahli_waris}}"
                                        data-jumlah_karyawan ="{{$mit->jumlah_karyawan}}"
                                        data-no_rek ="{{$mit->no_rek}}"
                                        data-jaminan ="{{$mit->jaminan->jaminan}}"
                                        data-pemilik_jaminan ="{{$mit->jaminan->pemilik_jaminan}}"
                                        data-sertifikat_jaminan ="{{$mit->jaminan->sertifikat_jaminan}}"
                                        data-ktp_pengaju = "{{$mit->dataProposal->ktp_pengaju}}"
                                        data-laporan_keuangan ="{{$mit->dataProposal->laporan_keuangan}}"
                                        data-sku ="{{$mit->dataProposal->sku}}"
                                        >
                                        <i class="fa fa-info"></i>&nbsp;
                                            Info
                                    </button>

                                    @if(\App\PengajuanDana::where('no_pk', $mit->no_pk)->get()->count()<1)
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-target="#hapusMitra"
                                        data-toggle="modal"
                                        data-no_pk ="{{$mit->no_pk}}">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                            Hapus
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
                    var no_ktp = button.data('no_ktp');
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
                    var sertifikat_jaminan = button.data('sertifikat_jaminan');
                    var laporan_keuangan = button.data('laoran_keuangan');
                    var sku = button.data('sku');
                    var ktp_pengaju = button.data('ktp_pengaju');
                    var bank = button.data('bank');

                    var modal = $(this);

                    modal.find('.modal-body #nomor_pk').html(no_pk);
                    modal.find('.modal-body #nama_pk').html(nama_pk);
                    modal.find('.modal-body #usaha').html(usaha);
                    modal.find('.modal-body #pemilik').html(pemilik);
                    modal.find('.modal-body #no_ktp').html(no_ktp);
                    modal.find('.modal-body #jenis_kelamin').html(jenis_kelamin);
                    modal.find('.modal-body #tgl_lahir').html(tgl_lahir);
                    modal.find('.modal-body #no_telp').html(no_telp);
                    modal.find('.modal-body #email').html(email);
                    modal.find('.modal-body #alamat_kantor').html(alamat_kantor);
                    modal.find('.modal-body #lokasi_usaha').html(lokasi_usaha);
                    modal.find('.modal-body #ahli_waris').html(ahli_waris);
                    modal.find('.modal-body #jumlah_karyawan').html(jumlah_karyawan);
                    modal.find('.modal-body #no_rek').html(no_rek);
                    modal.find('.modal-body #bank').html(bank);
                    modal.find('.modal-body #jaminan').html(jaminan);
                    modal.find('.modal-body #pemilik_jaminan').html(pemilik_jaminan);

                    $.ajax({
                        url: "/admin/kelola/dataMitra/lampiran",
                        type:"POST",
                        data : {"_token": "{{ csrf_token() }}",
                        "no_pk":no_pk},
                        dataType: "json",
                        success: function(res){
                            var ktp = res.ktp;
                            var laporan_keuangan = res.laporan_keuangan;
                            var sertifikat_jaminan = res.sertifikat_jaminan;
                            var sku = res.sku;
                            var pas_foto = res.pas_foto;

                            modal.find('.modal-body #ktp').html(`<a href="`+ktp+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #laporan_keuangan').html(`<a href="`+laporan_keuangan+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #sertifikat_jaminan').html(`<a href="`+sertifikat_jaminan+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #sku').html(`<a href="`+sku+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #pas_foto').html(`<img src="`+pas_foto+`" alt="..." target="_blank" class="img-fluid">`);
                        }
                    })
                });
            });
        </script>
    @endpush
@endsection
