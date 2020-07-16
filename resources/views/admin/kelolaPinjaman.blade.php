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

                                <!-- Kirim Notifikasi Jadwal Survei -->

                                <div class="modal fade" id="kirimJadwalSurvei" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mediumModalLabel"><strong>Kirim Jadwal Survei</strong></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Sistem akan segera mengirim jadwal survei lewat email!</h5>
                                                <br>
                                                <form action="/admin/kelola/pinjaman/pengajuan/survei/kirimJadwal" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ csrf_field()}}
                                                    <div class="row form-group" hidden>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_pengajuan_dana" name="id_pengajuan_dana" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group" hidden>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="email" name="email" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-12 col-md-9">
                                                            <label>Pilih Tanggal Survei</label>
                                                            <input type="text" id="jadwal" name="jadwal" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="hasilSurvei" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mediumModalLabel"><strong>Hasil Survei</strong></h3>
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
                                                            <dt>Nama Usaha</dt>
                                                            <dd id="unit_usaha"></dd>
                                                            <dt>Pemilik</dt>
                                                            <dd id="pemilik"></dd>
                                                            <dt>Alamat Kantor</dt>
                                                            <dd id="alamat_kantor"></dd>
                                                            <dt>Bidang Usaha</dt>
                                                            <dd id="sektor_usaha"></dd>
                                                            <dt>Nomor Telp.</dt>
                                                            <dd id="no_telp"></dd>
                                                            <dt>Kepemilikan Rumah</dt>
                                                            <dd id="kepemilikan_rumah"></dd>
                                                            <dt>Lama Menempati Rumah</dt>
                                                            <dd id="lama_tempati_rumah"></dd>
                                                            <dt>Lama Menjalankan Usaha</dt>
                                                            <dd id="lama_jalani_usaha"></dd>
                                                            <dt>Modal Saat Ini</dt>
                                                            <dd id="modal_saat_ini"></dd>
                                                            <dt>Tempat Usaha </dt>
                                                            <dd id="tempat_usaha"></dd>
                                                            <dt>Lokasi Usaha</dt>
                                                            <dd id="lokasi_usaha"></dd>
                                                            <dt>Pinjaman Lain</dt>
                                                            <dd id="pinjaman_lain"></dd>
                                                            <dt>Ijin Usaha</dt>
                                                            <dd id="ijin_usaha"></dd>
                                                            <dt>Kepemilikan Usaha</dt>
                                                            <dd id="kepemilikan_usaha"></dd>
                                                            <dt>Rekening Bank</dt>
                                                            <dd id="rekening_bank"></dd>
                                                            <dt>Penghasilan Diluar Usaha</dt>
                                                            <dd id="penghasilan_diluar_usaha"></dd>
                                                        </dl>
                                                        <hr>
                                                        <dl class="dl-horizontal">
                                                            <dt>Dokumen Hasil Survei</dt>
                                                            <dd id="dokumen_hasil_survei"></dd>
                                                            <br>
                                                            <dt>Surat Berita Acara</dt>
                                                            <dd id="surat_berita_acara"></dd>
                                                            <br>
                                                            <dt>Surat Ijin Usaha</dt>
                                                            <dd id="surat_ijin_usaha"></dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p>Foto bersama pemilik</p>
                                                        <div id="foto_pemilik"></div>
                                                        <br>
                                                        <p>Foto tempat usaha</p>
                                                        <div id="foto_tempat_usaha"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pengaju</th>
                                            <th>Unit Usaha</th>
                                            <th>Sektor Usaha</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Dana Aju</th>
                                            <th>Dokumen</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $key => $peng)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->nama_pengaju}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->unit_usaha}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->sektor_usaha}}</td>
                                            <td>{{$peng->dataMitra->dataProposal->tgl_pengajuan}}</td>
                                            <td>Rp.{{$peng->dana_aju}}</td>
                                            <td>
                                                <a href="/admin/kelola/pinjaman/pengajuan/{{$peng->dataMitra->no_proposal}}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-print"></i>&nbsp;
                                                    Print Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                @if($peng->status == 0)
                                                    <button type="button" class="btn btn-warning btn-sm" disabled>
                                                        Survei belum dilakukan
                                                    </button>
                                                @elseif($peng->status == 1)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        Survei selesai dilakukan, <br>menunggu persetujuan
                                                    </button>
                                                @elseif($peng->status == 2)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        Pengajuan disetujui, menunggu tambah pinjaman
                                                    </button>
                                                @elseif($peng->status == 3)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        Pijaman telah ditambahkan
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($peng->status == 0)
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-target="#kirimJadwalSurvei"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana="{{$peng->id_pengajuan_dana}}"
                                                        data-email="{{$peng->dataMitra->users->email}}"
                                                        >
                                                        <i class="fa fa-envelope"></i>&nbsp;
                                                            Kirim Jadwal Survei
                                                    </button>
                                                @elseif ($peng->status == 1)
                                                <button type="button" class="btn btn-info btn-sm"
                                                        data-target="#hasilSurvei"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana ="{{$peng->id_pengajuan_dana}}"
                                                        >
                                                        <i class="fa fa-file"></i>&nbsp;
                                                            Hasil Survei
                                                    </button>
                                                    <br>
                                                    <br>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-target="#setujuiPengajuan"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana="{{$peng->id_pengajuan_dana}}">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                            Setujui
                                                    </button>
                                                    <br>
                                                    <br>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-target="#hapusPengajuan"
                                                        data-toggle="modal"
                                                        data-id_pengajuan_dana="{{$peng->id_pengajuan_dana}}">
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
                                                <input type="number" class="form-control" id="bunga" name="bunga" value="3" required>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                %
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="nominal_pinjaman">Nominal</label>
                                            <div class="col-12 col-md-6">
                                                <input type="number" class="form-control" id="nominal_pinjaman" name="nominal_pinjaman" required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="lama_angsuran">Lama Angsuran</label>
                                            <div class="col-12 col-md-2">
                                                <input type="number" class="form-control" id="lama_angsuran" name="lama_angsuran"  required>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                bulan
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="control-label col-md-2" for="nominal_angsuran">Nominal Angsuran</label>
                                            <div class="col-12 col-md-6">
                                                <input type="number" class="form-control" id="nominal_angsuran" name="nominal_angsuran" readonly required>
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
                                                        Sedang Diproses
                                                    </button>
                                                @elseif($pinj->status == 1)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        Sedang Ditransfer
                                                    </button>
                                                @elseif($pinj->status == 2)
                                                    <button type="button" class="btn btn-primary btn-sm" disabled>
                                                        Transfer Sukses
                                                    </button>
                                                @elseif($pinj->status == 3)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Pinjaman Lunas
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

        <script>
            var today, datepicker;
                today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                datepicker = $('#jadwal').datepicker({
                    minDate: today
                })
        </script>

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

        <script type="text/javascript">
            $(document).ready(function(){
                $('#kirimJadwalSurvei').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id_pengajuan_dana = button.data('id_pengajuan_dana');
                    var email = button.data('email');
                    var modal = $(this);
                    console.log(id_pengajuan_dana)
                    modal.find('.modal-body #id_pengajuan_dana').val(id_pengajuan_dana);
                    modal.find('.modal-body #email').val(email);
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
                            console.log(res.nama_pengaju)
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
                    $('#nominal_angsuran').val(nominal_angsuran.toFixed(0))
                });

                $('#nominal_pinjaman').keyup(function(){
                    var bunga = parseFloat(document.getElementById("bunga").value);
                    var nominal_pinjaman = parseFloat(document.getElementById("nominal_pinjaman").value);
                    var lama_angsuran = parseFloat( document.getElementById("lama_angsuran").value);

                    var total_pinjaman = nominal_pinjaman + (nominal_pinjaman*(bunga/100));
                    var nominal_angsuran = total_pinjaman/lama_angsuran;
                    $('#nominal_angsuran').val(nominal_angsuran.toFixed(0))
                });

                $('#lama_angsuran').keyup(function(){
                    var bunga = parseFloat(document.getElementById("bunga").value);
                    var nominal_pinjaman = parseFloat(document.getElementById("nominal_pinjaman").value);
                    var lama_angsuran = parseFloat( document.getElementById("lama_angsuran").value);

                    if(lama_angsuran > 36){
                        lama_angsuran = 36
                        $('#lama_angsuran').val(lama_angsuran)
                    }

                    // if(lama_angsuran < 6){
                    //     lama_angsuran = 6
                    //     $('#lama_angsuran').val(lama_angsuran)
                    // }

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

        <script type="text/javascript">
            $(document).ready(function(){
                $('#hasilSurvei').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id_pengajuan_dana = button.data('id_pengajuan_dana');
                    var modal = $(this);

                    $.ajax({
                        url: "/admin/kelola/pinjaman/pengajuan/survei/hasilSurvei",
                        type:"POST",
                        data : {"_token": "{{ csrf_token() }}",
                        "id_pengajuan_dana":id_pengajuan_dana},
                        dataType: "json",
                        success: function(res){
                            var no_pk = res.no_pk;
                            var unit_usaha = res.unit_usaha;
                            var sektor_usaha = res.sektor_usaha;
                            var pemilik = res.pemilik;
                            var alamat_kantor = res.alamat_kantor;
                            var no_telp = res.no_telp;
                            var kepemilikan_rumah = res.kepemilikan_rumah;
                            var lama_tempati_rumah = res.lama_tempati_rumah;
                            var lama_jalani_usaha = res.lama_jalani_usaha;
                            var modal_saat_ini = res.modal_saat_ini;
                            var tempat_usaha = res.tempat_usaha;
                            var lokasi_usaha = res.lokasi_usaha;
                            var pinjaman_lain = res.pinjaman_lain;
                            var ijin_usaha = res.ijin_usaha;
                            var kepemilikan_usaha = res.kepemilikan_usaha;
                            var rekening_bank = res.rekening_bank;
                            var penghasilan_diluar_usaha = res.penghasilan_diluar_usaha;
                            var surat_ijin_usaha = res.surat_ijin_usaha;
                            var dokumen_hasil_survei = res.dokumen_hasil_survei;
                            var surat_berita_acara = res.surat_berita_acara;
                            var foto_pemilik = res.foto_pemilik;
                            var foto_tempat_usaha = res.foto_tempat_usaha;

                            modal.find('.modal-body #nomor_pk').html(no_pk);
                            modal.find('.modal-body #unit_usaha').html(unit_usaha);
                            modal.find('.modal-body #sektor_usaha').html(sektor_usaha);
                            modal.find('.modal-body #pemilik').html(pemilik);
                            modal.find('.modal-body #alamat_kantor').html(alamat_kantor);
                            modal.find('.modal-body #no_telp').html(no_telp);
                            modal.find('.modal-body #kepemilikan_rumah').html(kepemilikan_rumah);
                            modal.find('.modal-body #lama_tempati_rumah').html(lama_tempati_rumah);
                            modal.find('.modal-body #lama_jalani_usaha').html(lama_jalani_usaha);
                            modal.find('.modal-body #modal_saat_ini').html("Rp."+modal_saat_ini);
                            modal.find('.modal-body #tempat_usaha').html(tempat_usaha);
                            modal.find('.modal-body #lokasi_usaha').html(lokasi_usaha);
                            modal.find('.modal-body #pinjaman_lain').html(pinjaman_lain);
                            modal.find('.modal-body #ijin_usaha').html(ijin_usaha);
                            modal.find('.modal-body #kepemilikan_usaha').html(kepemilikan_usaha);
                            modal.find('.modal-body #rekening_bank').html(rekening_bank);
                            modal.find('.modal-body #penghasilan_diluar_usaha').html(penghasilan_diluar_usaha);

                            modal.find('.modal-body #surat_ijin_usaha').html(`<a href="`+surat_ijin_usaha+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #dokumen_hasil_survei').html(`<a href="`+dokumen_hasil_survei+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #surat_berita_acara').html(`<a href="`+surat_berita_acara+`" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i>&nbsp;
                                        Unduh
                                    </a>`);
                            modal.find('.modal-body #foto_pemilik').html(`<img src="`+foto_pemilik+`" alt="..." target="_blank" width="150px" height="150px" class="img-fluid">`);
                            modal.find('.modal-body #foto_tempat_usaha').html(`<img src="`+foto_tempat_usaha+`" alt="..." target="_blank" width="150px" height="150px" class="img-fluid">`);
                        }
                    })
                });
            });
        </script>

    @endpush
@endsection
