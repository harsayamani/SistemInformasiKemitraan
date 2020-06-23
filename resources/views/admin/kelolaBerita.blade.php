@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola Berita')

@section('beritaActive', 'active')

@section('bigTitle', 'Kelola Berita')

@section('breadcrumbTitle', 'Kelola Berita')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Buat Berita</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Daftar Berita</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Buat Berita</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">

                                <!-- form start -->
                                <form role="form" action="/admin/kelola/berita/tambah" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="judul_berita">Judul Berita</label>
                                            <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Masukkan judul berita" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <select class="form-control" id="keterangan" name="keterangan" required>
                                                <option value="Berita">Berita</option>
                                                <option value="Pengumuman">Pengumuman</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="ilustrasi">Ilustrasi</label>
                                            <input type="file" id="ilustrasi" name="ilustrasi" required>
                                            <p class="help-block">Masukkan gambar disini!</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="isi_berita">Isi Berita</label>
                                            <textarea id="isi_berita" name="isi_berita" rows="10" cols="80" required>

                                            </textarea>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Daftar Berita</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">

                                <!-- Modal Hapus Berita -->

                                <div class="modal fade" id="hapusBerita" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mediumModalLabel"><strong>Hapus Berita</strong></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Apakah anda yakin?</h5>
                                                <form action="/admin/kelola/berita/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ csrf_field()}}
                                                    <div class="row form-group" hidden>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="no_berita" name="no_berita" class="form-control" readonly required>
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

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Rilis</th>
                                            <th>Judul Berita</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($berita as $key => $brt)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$brt->tgl_rilis}}</td>
                                            <td>{{$brt->judul_berita}}</td>
                                            <td>{{$brt->keterangan}}</td>
                                            <td>
                                                <a href="/admin/kelola/berita/ubah/{{$brt->judul_berita}}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>&nbsp;
                                                        Ubah
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-target="#hapusBerita"
                                                    data-toggle="modal"
                                                    data-no_berita ="{{$brt->no_berita}}">
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
                $('#hapusBerita').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var no_berita = button.data('no_berita');
                    var modal = $(this);

                    modal.find('.modal-body #no_berita').val(no_berita);
                });
            });
        </script>

        <script>
            CKEDITOR.replace('isi_berita');
        </script>

    @endpush
@endsection
