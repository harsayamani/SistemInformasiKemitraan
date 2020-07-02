@extends('mitra/master/masterMitra')

@section('title_bar', 'Data Mitra | Kemitraan LEN Industri')

@section('active2', 'active')

@section('title_page', 'Data Mitra')

@section('section')

<section class="forms">
    <div class="container-fluid">
        @if ($mitra->ktp == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->jenis_kelamin == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->tempat_lahir == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->tgl_lahir == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->no_telp == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->ahli_waris == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->jumlah_karyawan == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @elseif ($mitra->no_rek == null)
        <div class="alert alert-warning" role="alert">
            Data mitra anda belum lengkap silahkan lengkapi terlebih dahulu!
        </div>
        @else
        <div class="alert alert-success" role="alert">
            Data mitra sudah lengkap
        </div>
        @endif
    </div>
    <div class="container-fluid">
      <div class="row">
        <!-- Form Elements -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Data Mitra</h3>
            </div>
            <div class="card-body">
              <form class="form-horizontal" method="POST" action="/mitra/dataMitra/ubah" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="number-input" class=" form-control-label">Nomor Mitra</label>
                    </div>
                    <div class="col-12 col-md-6">
                    <input type="text" id="no_pk" name="no_pk"  class="form-control" value="{{$mitra->no_pk}}" readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-12">
                        <label><strong>INFORMASI MITRA</strong></label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nomor KTP</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="ktp" name="ktp" placeholder="Masukkan nomor KTP" class="form-control" value="{{$mitra->ktp}}" required>
                        <small class="form-text text-muted">Tuliskan nomor KTP!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nama Pengaju</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="nama_pengaju" name="nama_pengaju" placeholder="Masukkan nama pengaju" class="form-control" value="{{$mitra->dataProposal->nama_pengaju}}" required>
                        <small class="form-text text-muted">Tuliskan nama lengkap!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="text_input" class=" form-control-label">Jenis Kelamin</label></div>
                    <div class="col-12 col-md-6">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="">---Pilih Jenis Kelamin---</option>
                            <option value="L" @if($mitra->jenis_kelamin == "L") selected @endif>Laki-Laki</option>
                            <option value="P" @if($mitra->jenis_kelamin == "P") selected @endif>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="tempat_lahir" class=" form-control-label">Tempat Lahir</label></div>
                    <div class="col-12 col-md-6">
                        <select class="select2" style="width:100%" name="tempat_lahir" id="tempat_lahir">
                            <option value="">---Pilih Tempat Lahir---</option>
                            @foreach($kota as $city)
                            <option value="{{$city->city_id}}" @if($mitra->tempat_lahir == $city->city_id) selected @endif>{{$city->type." ".$city->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Tanggal Lahir</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan tanggal lahir" class="form-control" value="{{$mitra->tgl_lahir}}" required readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nomor Telepon</label>
                    </div>
                    <div class="col-12 col-md-6">
                    <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" class="form-control" required value="{{$mitra->no_telp}}">
                        <small class="form-text text-muted">Tuliskan nomor telepon!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Alamat Kantor</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <textarea id="alamat_kantor" name="alamat_kantor" placeholder="Masukkan alamat kantor" class="form-control" required>{{$mitra->alamat_kantor}}</textarea>
                        <small class="form-text text-muted">Tuliskan alamat lengkap!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-12">
                        <label><strong>INFORMASI USAHA</strong></label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Unit Usaha</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="unit_usaha" name="unit_usaha" placeholder="Masukkan unit usaha" class="form-control" value="{{$mitra->dataProposal->unit_usaha}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Sektor Usaha</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="kegiatan" name="kegiatan" placeholder="Masukkan sektor usaha" class="form-control" value="{{$mitra->dataProposal->kegiatan}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Lokasi Usaha</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <textarea id="lokasi_usaha" name="lokasi_usaha" placeholder="Masukkan lokasi usaha" class="form-control" required>{{$mitra->lokasi_usaha}}</textarea>
                        <small class="form-text text-muted">Tuliskan lokasi usaha!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Ahli Waris</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="ahli_waris" name="ahli_waris" placeholder="Masukkan ahli waris" class="form-control" value="{{$mitra->ahli_waris}}" required>
                        <small class="form-text text-muted">Tuliskan ahli waris!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Jumlah Karyawan</label>
                    </div>
                    <div class="col-12 col-md-2">
                        <input type="number" id="jumlah_karyawan" name="jumlah_karyawan" class="form-control" value="{{$mitra->jumlah_karyawan}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nomor Rekening</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="no_rek" name="no_rek" placeholder="Masukkan nomor rekening" class="form-control" value="{{$mitra->no_rek}}" required>
                        <small class="form-text text-muted">Tuliskan nomor rekening!</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-12">
                        <label><strong>JAMINAN</strong></label>
                    </div>
                </div>

                <div class="row form-group" hidden>
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Nomor Jaminan</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="number" id="no_jaminan" name="no_jaminan" class="form-control" value="{{$mitra->jaminan->no_jaminan}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Jaminan</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="jaminan" name="jaminan" class="form-control"  placeholder="Masukkan jaminan" value="{{$mitra->jaminan->jaminan}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Pemilik Jaminan</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="pemilik_jaminan" name="pemilik_jaminan" class="form-control"  placeholder="Masukkan pemilik jaminan" value="{{$mitra->jaminan->pemilik_jaminan}}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-12">
                        <label><strong>INFORMASI AKUN</strong></label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Username</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="username" name="username" class="form-control"  placeholder="Masukkan username" value="{{$mitra->users->username}}" readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" id="email" placeholder="Masukkan email" name="email" class="form-control" value="{{$mitra->users->email}}" required>
                    </div>
                </div>

                <div class="line"></div>
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-9">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('script')
@push('script')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".select2").select2({
              placeholder: 'Pilih minat',
              theme: 'bootstrap4'
            });
        });
    </script>

    <script>
        $('#tgl_lahir').datepicker({
            format: 'dd mmm yyyy',
            uiLibrary: 'bootstrap4'
        });
    </script>
@endpush
@endsection
