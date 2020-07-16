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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Angsuran</h3>
                    <br>
                    <br>
                        <div class="col-md-9">
                            <select class="form-control" id="no_pk" name="no_pk">
                                <option value="">---Pilih Mitra---</option>
                                @foreach ($mitra as $mit)
                                <option value="{{$mit->no_pk}}">{{$mit->dataProposal->nama_pengaju}}</option>
                                @endforeach
                            </select>
                        </div>
                    <br>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Pinjaman</th>
                                <th>Nomor Mitra</th>
                                <th>Jumlah Angsuran</th>
                                <th>Tanggal Angsuran</th>
                                <th>Utang</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_angsuran">
                            @foreach ($angsuran as $key => $angs)
                            @if($angs->tgl_angsuran!=null)
                            <tr>
                                <td>{{$no+=1}}</td>
                                <td>{{$angs->id_pinjaman}}</td>
                                <td>{{$angs->no_pk}}</td>
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

        <script>
            $(document).ready(function(){
                $('#no_pk').on('change', function(){
                    $.ajax({
                        url: "/admin/kelola/angsuran/filter",
                        type:"POST",
                        data : {"_token": "{{ csrf_token() }}",
                        "no_pk":$(this).val()},
                        dataType: "json",
                        success: function(res){
                            console.log(res.angsuran);

                            var panjang_angsuran = res.angsuran.length;

                            if(panjang_angsuran < 1){
                                $('#tabel_angsuran').empty()
                            }else{
                                var no = 1;
                                $('#tabel_angsuran').empty();

                                for(let i=0; i<panjang_angsuran; i++){
                                    var html = `
                                        <tr>
                                            <td>${no++}</td>
                                            <td>${res.angsuran[i].id_pinjaman}</td>
                                            <td>${res.angsuran[i].no_pk}</td>
                                            <td>Rp.${res.angsuran[i].jumlah_angsuran}</td>
                                            <td>${res.angsuran[i].tgl_angsuran}</td>
                                            <td>Rp.${res.angsuran[i].utang}</td>
                                        </tr>
                                    `;
                                    $('#tabel_angsuran').append(html);
                                }
                            }
                        }
                    });
                });

                // init
                $('#no_pk').change();
            });
        </script>
    @endpush
@endsection
