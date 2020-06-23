@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Ubah Berita')

@section('beritaActive', 'active')

@section('bigTitle', 'Ubah Berita')

@section('breadcrumbTitle', 'Ubah Berita')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ubah Berita</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <!-- form start -->
                    <form role="form" action="/admin/kelola/berita/ubah" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group" hidden>
                                <label for="judul_berita">Judul Berita</label>
                                <input type="text" class="form-control" id="no_berita" name="no_berita" placeholder="Masukkan judul berita" value="{{$berita->no_berita}}" required>
                            </div>

                            <div class="form-group">
                                <label for="judul_berita">Judul Berita</label>
                                <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Masukkan judul berita" value="{{$berita->judul_berita}}" required>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <select class="form-control" id="keterangan" name="keterangan" required>
                                    @if ($berita->keterangan == "Berita")
                                        <option value="Berita" selected>Berita</option>
                                    @elseif ($berita->keterangan == "Pengumuman")
                                        <option value="Pengumuman">Pengumuman</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ilustrasi">Ilustrasi</label>
                                <input type="file" id="ilustrasi" name="ilustrasi">
                                <p class="help-block">Masukkan gambar disini!</p>
                            </div>

                            <div class="form-group">
                                <label for="isi_berita">Isi Berita</label>
                                <textarea id="isi_berita" name="isi_berita" rows="10" cols="80" required>
                                    {!!$berita->isi_berita!!}
                                </textarea>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
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

        <script>
            CKEDITOR.replace('isi_berita');
        </script>

    @endpush
@endsection
