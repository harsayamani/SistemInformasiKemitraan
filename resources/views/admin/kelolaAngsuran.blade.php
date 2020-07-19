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
                    <div class="col-md-12">
                        <h3 class="box-title">Daftar Angsuran </h3>
                        <br>
                    </div>
                    <br>
                        <div class="col-md-9">
                            <select class="form-control" id="no_pk" name="no_pk">
                                <option value="">---Pilih Mitra---</option>
                                @foreach ($mitra as $mit)
                                <option value="{{$mit->no_pk}}">{{$mit->dataProposal->nama_pengaju}}</option>
                                @endforeach
                            </select>
                            <br>
                            <div id="unduh">
                            </div>
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
                                <th>Angsuran Ke-</th>
                                <th>Jumlah Angsuran</th>
                                <th>Tanggal Angsuran</th>
                                <th>Utang</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_angsuran">
                            {{-- @foreach ($angsuran as $key => $angs)
                            @if($angs->tgl_angsuran!=null)
                            <tr>
                                <td>{{$no+=1}}</td>
                                <td>{{$angs->id_pinjaman}}</td>
                                <td>{{$angs->no_pk}}</td>
                                <Td>{{++$key}}</td>
                                <td>Rp.{{$angs->jumlah_angsuran}}</td>
                                <td>{{$angs->tgl_angsuran}}</td>
                                <td>Rp.{{$angs->utang}}</td>
                            </tr>
                            @endif
                            @endforeach --}}
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

                            var id_pinjaman = res.id_pinjaman;

                            if(id_pinjaman != null){
                                $('#unduh').html(`<a href="/admin/kelola/angsuran/export/excel/${id_pinjaman}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>&nbsp;
                                Unduh Excel</a>`)
                            }else{
                                $('#unduh').empty()
                            }

                            if(panjang_angsuran < 1){
                                $('#tabel_angsuran').empty()
                            }else{
                                var no = 1;
                                var a = 0;
                                $('#tabel_angsuran').empty();

                                for(let i=0; i<panjang_angsuran; i++){

                                    var html;

                                    if(i!=0){
                                        if(res.angsuran[i].id_pinjaman == res.angsuran[Math.abs(i-1)].id_pinjaman){
                                            a += 1;
                                        }else{
                                            a = 1;
                                            a += 1;
                                        }
                                    }else{
                                        a = 1;
                                    }


                                    html = `
                                            <tr>
                                                <td>${no++}</td>
                                                <td>${res.angsuran[i].id_pinjaman}</td>
                                                <td>${res.angsuran[i].no_pk}</td>
                                                <td>${a}</td>
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
