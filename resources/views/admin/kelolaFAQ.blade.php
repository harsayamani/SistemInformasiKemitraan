@extends('admin/master/masterAdmin')

@section('titleAdmin', 'Kelola FAQ')

@section('faqActive', 'active')

@section('bigTitle', 'Kelola FAQ')

@section('breadcrumbTitle', 'Kelola FAQ')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar FAQ</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <!-- Modal Hapus FAQ -->

                    <div class="modal fade" id="hapusFAQ" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Hapus FAQ</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Apakah anda yakin?</h5>
                                    <form action="/admin/kelola/faq/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}
                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="id" name="id" class="form-control" readonly required>
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

                    <!-- Modal Jawab FAQ -->

                    <div class="modal fade" id="jawabFAQ" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="mediumModalLabel"><strong>Jawab Pertanyaan</strong></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/kelola/faq/jawab" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field()}}

                                        <h5 id="pertanyaan"></h5>

                                        <div class="row form-group" hidden>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="id" name="id" class="form-control" readonly required>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <textarea type="text" id="jawaban" name="jawaban" class="form-control" required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Jawab</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faq as $key=>$fq)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$fq->pertanyaan}}</td>
                                <td>{{$fq->kategori}}</td>
                                <td>
                                    @if ($fq->status == 0)
                                        <button type="button" class="btn btn-danger btn-sm" disabled>
                                            Belum terjawab
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" disabled>
                                            Sudah terjawab
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($fq->status == 0)
                                        <button type="button" class="btn btn-success btn-sm"
                                            data-target="#jawabFAQ"
                                            data-toggle="modal"
                                            data-id ="{{$fq->id}}"
                                            data-pertanyaan ="{{$fq->pertanyaan}}"
                                            data-jawaban ="{{$fq->jawaban}}">
                                            <i class="fa fa-question-circle"></i>&nbsp;
                                                Jawab
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-target="#hapusFAQ"
                                            data-toggle="modal"
                                            data-id ="{{$fq->id}}">
                                            <i class="fa fa-trash-o"></i>&nbsp;
                                                Hapus
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-target="#jawabFAQ"
                                            data-toggle="modal"
                                            data-id ="{{$fq->id}}"
                                            data-pertanyaan ="{{$fq->pertanyaan}}"
                                            data-jawaban ="{{$fq->jawaban}}">
                                            <i class="fa fa-question-circle"></i>&nbsp;
                                                Ubah Jawaban
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
                $('#jawabFAQ').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var pertanyaan = button.data('pertanyaan');
                    var jawaban = button.data('jawaban');
                    var modal = $(this);

                    console.log(id)

                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #pertanyaan').html(pertanyaan);
                    modal.find('.modal-body #jawaban').val(jawaban);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#hapusFAQ').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var modal = $(this);

                    console.log(id)
                    modal.find('.modal-body #id').val(id);
                });
            });
        </script>
    @endpush
@endsection
