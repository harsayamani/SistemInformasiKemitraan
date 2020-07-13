<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Survei | Sistem Kemitraan LEN Industri</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
	<link rel="stylesheet" type="text/css" href="/survei/css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="/survei/css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="/survei/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- datepicker -->
    <link rel="stylesheet" type="text/css" href="/survei/css/jquery-ui.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="icon" type="image/png" href="/img/logo.ico"/>
</head>
<body>
	<div class="page-content" style="background-image: url('/survei/images/wizard-v4.jpg')">
		<div class="wizard-v4-content">
			<div class="wizard-form">
				<div class="wizard-header">
					<h3 class="heading">Survei Lapangan Pengaju Pinjaman</h3>
                    <p>Form Survei Lapangan</p>
                    <p>
                    <table>
                        <a href="/survei/logout"><b>LOGOUT</b></a>
                    </table>
                    </p>
                    @if ($errors->any())
                      <div class="alert alert-danger" role="alert">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{$error}}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif

                    @if(Session::has('alert-danger'))
                        <div class="alert alert-danger">
                            <div>{{Session::get('alert-danger')}}</div>
                        </div>
                    @endif
                    @if(Session::has('alert-success'))
                        <div class="alert alert-success">
                            <div>{{Session::get('alert-success')}}</div>
                        </div>
                    @endif
				</div>
                <form class="form-register" id="form" action="/survei/form/proses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-store"></i></span>
			            	<span class="step-text">Deskripsi</span>
			            </h2>
			            <section>
			                <div class="inner">
                                <h5>Unduh Contoh Dokumen Hasil Survei
                                    <a href="
                                    <?php $path = Storage::disk('dropbox')->url('files/dokumen_hasil_survei/hasil_survei_lapangan.docx');
                                        echo url($path);
                                    ?>
                                    " target="_blank" class="btn btn-primary btn-sm">
                                        DISINI
                                    </a>
                                </h5>

                                <h5>Unduh Contoh Berita Acara Peninjauan
                                    <a href="
                                    <?php $path = Storage::disk('dropbox')->url('files/surat_berita_acara/berita_acara_peninjauan.docx');
                                        echo url($path);
                                    ?>
                                    " target="_blank" class="btn btn-primary btn-sm">
                                        DISINI
                                    </a>
                                </h5>

                                <h3>Deskripsi Usaha:</h3>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="id_pengajuan_dana" name="id_pengajuan_dana" required>
                                            <option>---Pilih Pengajuan---</option>
                                            @foreach($pengajuan as $aju)
                                            <option value="{{$aju->id_pengajuan_dana}}">{{$aju->id_pengajuan_dana}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="no_pk" name="no_pk" required>
											<span class="label">Nomor Mitra</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="unit_usaha" name="unit_usaha" required>
											<span class="label">Nama Usaha</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="nama_pengaju" name="nama_pengaju" required>
											<span class="label">Pemilik</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor" required>
											<span class="label">Alamat</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="sektor_usaha" name="sektor_usaha" required>
											<span class="label">Bidang Usaha</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="no_telp" name="no_telp" required>
											<span class="label">No. Telp</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-text">Survei</span>
			            </h2>
			            <section>
			                <div class="inner">
                                <h3>Pertanyaan</h3>
                                <p>1. Kepemilikan yang sekarang ditempati</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="kepemilikan_rumah" name="kepemilikan_rumah" required>
                                            <option>--- Pilih ---</option>
                                            <option value="Rumah Sendiri">Rumah Sendiri</option>
                                            <option value="Rumah Orang Tua/Saudara">Rumah Orang Tua/Saudara</option>
                                            <option value="Rumah Kontrak/Sewa">Rumah Kontrak/Sewa</option>
                                        </select>
									</div>
                                </div>
                                <p>2. Lama menempati rumah </p>
                                <div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="number" class="form-control" id="tahun_rumah" name="tahun_rumah" required>
											<span class="label">Tahun</span>
					  						<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
										<label class="form-row-inner">
											<input type="number" class="form-control" id="bulan_rumah" name="bulan_rumah" required>
											<span class="label">Bulan</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>3. Lama menjalankan usaha </p>
                                <div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="number" class="form-control" id="tahun_usaha" name="tahun_usaha" required>
											<span class="label">Tahun</span>
					  						<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
										<label class="form-row-inner">
											<input type="number" class="form-control" id="bulan_usaha" name="bulan_usaha" required>
											<span class="label">Bulan</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>4. Jumlah modal yang dimiliki saat ini </p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="modal" name="modal" required>
											<span class="label">Modal</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>5. Tempat usaha</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="tempat_usaha" name="tempat_usaha" required>
                                            <option>--- Pilih ---</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Milik Sendiri">Milik Sendiri</option>
                                            <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
									</div>
                                </div>
                                <p>6. Lokasi usaha</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="lokasi_usaha" name="lokasi_usaha" required>
                                            <option>--- Pilih ---</option>
                                            <option value="Pinggir Jalan">Pinggir Jalan</option>
                                            <option value="Masuk Gang/Perkampungan">Masuk Gang/Perkampungan</option>
                                            <option value="Di Pasar Tradisional/Modern">Di Pasar Tradisional/Modern</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
									</div>
                                </div>
                                <p>7. Pinjaman modal dari pihak lain </p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="pinjaman_lain" name="pinjaman_lain">
                                            <option>--- Pilih ---</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
									</div>
                                </div>
                                <p>8. Surat keterangan / ijin usaha yang dimiliki</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="ijin_usaha" name="ijin_usaha">
                                            <option>--- Pilih ---</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
									</div>
                                </div>
                                <p>9. Kepemilikan usaha</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="kepemilikan_usaha" name="kepemilikan_usaha" required>
                                            <option>--- Pilih ---</option>
                                            <option value="Usaha Milik Sendiri">Usaha Milik Sendiri</option>
                                            <option value="Usaha Milik Keluarga">Usaha Milik Keluarga</option>
                                            <option value="Franchise">Franchise</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <p>10. Selama usaha memiliki rekening bank</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="rekening_bank" name="rekening_bank">
                                            <option>--- Pilih ---</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
									</div>
                                </div>
                                <p>11. Penghasilan diluar usaha</p>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<select  id="penghasilan_diluar_usaha" name="penghasilan_diluar_usaha">
                                            <option>--- Pilih ---</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
									</div>
                                </div>
                            </div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-file"></i></span>
			            	<span class="step-text">Lampiran</span>
			            </h2>
			            <section>
			                <div class="inner">
                                <h3>Lampiran yang disertakan</h3>
                                <p>Dokumen Hasil Survei</p>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="file" class="form-control" id="dokumen_hasil_survei" name="dokumen_hasil_survei" accept="image/*" required>
											<span>Format gambar, maks:7MB</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>Surat Berita Acara</p>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="file" class="form-control" id="surat_berita_acara" name="surat_berita_acara" accept="image/*" required>
											<span>Format gambar, maks:7MB</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>Surat Ijin Usaha</p>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="file" class="form-control" id="surat_ijin_usaha" name="surat_ijin_usaha" accept="image/*">
											<span>Format gambar, maks:7MB (Opsional)</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>Foto Bersama Pemilik</p>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="file" class="form-control" id="foto_pemilik" name="foto_pemilik" accept="image/*" required>
											<span>Format gambar, maks:7MB</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
                                <p>Foto Tempat Usaha</p>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="file" class="form-control" id="foto_tempat_usaha" name="foto_tempat_usaha" accept="image/*" required>
											<span>Format gambar, maks:7MB</span>
					  						<span class="border"></span>
										</label>
									</div>
                                </div>
							</div>
			            </section>
			            <!-- SECTION 4 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-plus"></i></span>
			            	<span class="step-text">Ekstra</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<h3>Tim Survei</h3>
			                	<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="anggota_tim1" name="anggota_tim1" required>
											<span class="label">Nama Anggota 1 Tim Survei</span>
					  						<span class="border"></span>
										</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="anggota_tim2" name="anggota_tim2">
                                            <span class="label">Nama Anggota 2 Tim Survei (opsional)</span>
                                              <span class="border"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="anggota_tim3" name="anggota_tim3">
                                            <span class="label">Nama Anggota 3 Tim Survei (opsional)</span>
                                              <span class="border"></span>
                                        </label>
                                    </div>
                                </div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>
    <script src="/survei/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="/survei/js/jquery.steps.js"></script>
    <script src="/survei/js/jquery-ui.min.js"></script>
    <script src="/survei/js/main.js"></script>
    <script>
        $(document).ready(function(){
            $('#id_pengajuan_dana').on('change', function(){
                $.ajax({
                    url: "/survei/form/deskripsiUsaha",
                    type:"POST",
                    data : {"_token": "{{ csrf_token() }}",
                    "id_pengajuan_dana":$(this).val()},
                    dataType: "json",
                    success: function(res){
                        $('#no_pk').val(res.no_pk)
                        $('#unit_usaha').val(res.unit_usaha)
                        $('#nama_pengaju').val(res.nama_pengaju)
                        $('#alamat_kantor').val(res.alamat_kantor)
                        $('#sektor_usaha').val(res.sektor_usaha)
                        $('#no_telp').val(res.no_telp);
                    }
                })
            })

            // init
            $('#id_pengajuan_dana').change();
        });
    </script>
</body>
</html>
