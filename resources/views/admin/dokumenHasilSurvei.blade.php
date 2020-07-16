<html>
<head>
    <title>Dokumen Pengajuan Pinjaman - {{$pengajuan->id_pengajuan_dana}}</title>
	<style type="text/css">
			.lead {
				font-family: "Verdana";
				font-weight: bold;
			}
			.value {
				font-family: "Verdana";
			}
			.value-big {
				font-family: "Verdana";
				font-weight: bold;
				font-size: large;
			}
			.td {
				valign : "top";
			}

            body { font-family: Arial; font-size: 20.4px }
            .pos { position: absolute; z-index: 0; left: 0px; top: 0px }

			/* @page { size: with x height */
			/* @page { size: 20cm 13cm; margin: 0px; } */
			@page {
				size: Letter;
				margin : 0px;
			}

	/*		@media print {
			  html, body {
			  	width: 210mm;
			  }
			}*/



            @media print{
                .page-breaker {
                    page-break-before: always;
                }
            }
			/*body { border: 2px solid #000000;  }*/
	</style>
	<script type="text/javascript">
		var beforePrint = function() {
		};
		var afterPrint = function() {
			document.location.href = '/admin/kelola/pinjaman';
		};
		if (window.matchMedia) {
			var mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function(mql) {
				if (mql.matches) {
					beforePrint();
				} else {
					afterPrint();
				}
			});
		}
		window.onbeforeprint = beforePrint;
		window.onafterprint = afterPrint;
    </script>
</head>
<body>
   <nobr><nowrap>
    <div class="page-breaker">
        <div class="pos" id="_0:0" style="top:0">
            <img name="_1100:850" src="/img/page_001.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
            <div class="pos" id="_100:101" style="top:101;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            Kepada </span>
            </div>
            <div class="pos" id="_100:139" style="top:139;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            Yth. Bagian Program Kemitraan dan Bina Lingkungan (PKBL)</span>
            </div>
            <div class="pos" id="_100:176" style="top:176;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            PT. Len industri (persero)</span>
            </div>
            <div class="pos" id="_100:214" style="top:214;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            Jalan Soekarno Hatta No. 442 </span>
            </div>
            <div class="pos" id="_100:251" style="top:251;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            Bandung, Jawa Barat</span>
            </div>
            <div class="pos" id="_100:326" style="top:326;left:100">
            <span id="_15.0" style="font-weight:bold; font-family:Times New Roman; font-size:15.0px; color:#000000">
            Dengan hormat<span style="font-weight:normal"> , </span></span>
            </div>
            <div class="pos" id="_100:363" style="top:363;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Saya bertanda tangan dibawah ini :</span>
            </div>
            <div class="pos" id="_100:401" style="top:401;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Nama</span>
            </div>
            <div class="pos" id="_249:401" style="top:401;left:249">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            : {{$mitra->dataProposal->nama_pengaju}}</span>
            </div>
            <div class="pos" id="_100:438" style="top:438;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Tempat, tanggal lahir</span>
            </div>
            <div class="pos" id="_100:438" style="top:438;left:249">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            : {{$mitra->tempat_lahir}}, {{$mitra->tgl_lahir}}</span>
            </div>
            <div class="pos" id="_100:476" style="top:476;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Alamat</span>
            </div>
            <div class="pos" id="_249:476" style="top:476;left:249">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            : {{$mitra->alamat_kantor}}</span>
            </div>
            <div class="pos" id="_100:551" style="top:551;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Berdasarkan  peraturan  menteri  negara  BUMN  No:  PER-02-MBU-2017  tanggal  5  juli  2017  tentang </span>
            </div>
            <div class="pos" id="_100:577" style="top:577;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Perubahan Ke-2 atas Peraturan Menteri BADAN USAHA MILIK NEGARA No. PER-09/MBU/07/2015 </span>
            </div>
            <div class="pos" id="_100:603" style="top:603;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            tentang Program Kemitraan BUMN dengan Usaha Kecil dan Program Bina Lingkungan (PKBL) Badan </span>
            </div>
            <div class="pos" id="_100:630" style="top:630;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Usaha  Milik  Negara,  maka  dengan  ini  saya  mengajukan  dengan  hormat  sebagai  penerima  pinjaman </span>
            </div>
            <div class="pos" id="_100:656" style="top:656;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            Program Kemitraan BUMN dari PT. Len Industri (Persero) untuk sektor usaha : <b>{{$mitra->dataProposal->unit_usaha}}</b></span>
            </div>
            <div class="pos" id="_100:682" style="top:682;left:100">
            <span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#000000">
            sebesar <b>Rp. {{$pengajuan->dana_aju}} </b> dengan rencana penggunaan dana pinjaman untuk {{$mitra->dataProposal->unit_usaha}}</span>
            </div>
    </div>

    <div class="page-breaker">
        <div class="pos" id="_0:0" style="top:1100">
        <img name="_1100:850" src="/img/page_001.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
        <div class="pos" id="_100:1201" style="top:1201;left:100">
        <span id="_14.7" style="font-weight:bold; font-family:Times New Roman; font-size:14.7px; color:#000000">
        PROPOSAL PERMOHONAN BANTUAN PKBL PT. LEN INDUSTRI (PERSERO)</span>
        </div>
        <div class="pos" id="_553:1388" style="top:1250;left:603">
        <img src="
        <?php
            $url = JD\Cloudder\Facades\Cloudder::show($mitra->pas_foto, ['width'=>200, 'height'=>300, "crop"=>"scale"]);
            echo $url;
        ?>
        " style="width: 2cm; height:3cm">
        </div>
        <div class="pos" id="_553:1388" style="top:1388;left:553">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Foto yang mengajukan proposal</span>
        </div>
        <div class="pos" id="_100:1426" style="top:1426;left:100">
        <span id="_14.7" style="font-weight:bold; font-family:Times New Roman; font-size:14.7px; color:#000000">
        PEMOHON/ PEMILIK USAHA </span>
        </div>
        <div class="pos" id="_100:1463" style="top:1463;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Nama</span>
        </div>
        <div class="pos" id="_300:1463" style="top:1463;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->dataProposal->nama_pengaju}}</span>
        </div>
        <div class="pos" id="_100:1501" style="top:1501;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Tempat, tanggal lahir </span>
        </div>
        <div class="pos" id="_300:1501" style="top:1501;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->tempat_lahir}}, {{$mitra->tgl_lahir}}</span>
        </div>
        <div class="pos" id="_100:1538" style="top:1538;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Alamat</span>
        </div>
        <div class="pos" id="_300:1538" style="top:1538;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->alamat_kantor}}</span>
        </div>
        <div class="pos" id="_100:1576" style="top:1576;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        No. KTP</span>
        </div>
        <div class="pos" id="_300:1576" style="top:1576;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->ktp}}</span>
        </div>
        <div class="pos" id="_100:1613" style="top:1613;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        No. TELP/HP</span>
        </div>
        <div class="pos" id="_300:1613" style="top:1613;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->no_telp}}</span>
        </div>
        <div class="pos" id="_100:1688" style="top:1688;left:100">
        <span id="_14.7" style="font-weight:bold; font-family:Times New Roman; font-size:14.7px; color:#000000">
        UNIT USAHA </span>
        </div>
        <div class="pos" id="_100:1726" style="top:1726;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Nama usaha </span>
        </div>
        <div class="pos" id="_300:1726" style="top:1726;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->dataProposal->unit_usaha}}</span>
        </div>
        <div class="pos" id="_100:1763" style="top:1763;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Sektor usaha </span>
        </div>
        <div class="pos" id="_300:1763" style="top:1763;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->dataProposal->sektor_usaha}}</span>
        </div>
        <div class="pos" id="_100:1801" style="top:1801;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Lokasi usaha </span>
        </div>
        <div class="pos" id="_300:1801" style="top:1801;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->lokasi_usaha}}</span>
        </div>
        <div class="pos" id="_100:1838" style="top:1838;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Jumlah tenaga kerja </span>
        </div>
        <div class="pos" id="_300:1838" style="top:1838;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->jumlah_karyawan}}</span>
        </div>
        <div class="pos" id="_100:1875" style="top:1875;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Nomor rekening </span>
        </div>
        <div class="pos" id="_100:1875" style="top:1875;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->no_rek}}</span>
        </div>
        <div class="pos" id="_100:1913" style="top:1913;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Pemilik rekening</span>
        </div>
        <div class="pos" id="_300:1913" style="top:1913;left:300">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->dataProposal->nama_pengaju}}</span>
        </div>
        <div class="pos" id="_0:0" style="top:2200">
        <img name="_1100:850" src="/img/page_003.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
        <div class="pos" id="_100:2301" style="top:2301;left:100">
        <span id="_14.8" style="font-weight:bold; font-family:Times New Roman; font-size:14.8px; color:#000000">
        AHLI WARIS USAHA </span>
        </div>
        <div class="pos" id="_100:2339" style="top:2339;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Nama</span>
        </div>
        <div class="pos" id="_300:2339" style="top:2339;left:300">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->ahli_waris}}</span>
        </div>
        <div class="pos" id="_100:2414" style="top:2414;left:100">
        <span id="_14.8" style="font-weight:bold; font-family:Times New Roman; font-size:14.8px; color:#000000">
        BARANG TITIPAN </span>
        </div>
        <div class="pos" id="_100:2451" style="top:2451;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Jenis barang titipan</span>
        </div>
        <div class="pos" id="_300:2451" style="top:2451;left:300">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->jaminan->jaminan}}</span>
        </div>
        <div class="pos" id="_100:2488" style="top:2488;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        No. barang titipan</span>
        </div>
        <div class="pos" id="_300:2488" style="top:2488;left:300">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->jaminan->no_jaminan}}</span>
        </div>
        <div class="pos" id="_100:2526" style="top:2526;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Nama Pemilik</span>
        </div>
        <div class="pos" id="_300:2526" style="top:2526;left:300">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->jaminan->pemilik_jaminan}}</span>
        </div>
        <div class="pos" id="_100:2563" style="top:2563;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Demikian proposal ini saya buat dengan sebenar-benarnya, atas perhatiannya saya ucapkan terimakasih.</span>
        </div>
        <div class="pos" id="_100:2601" style="top:2601;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Pemohon. </span>
        </div>
    </div>

    <div class="page_breaker">
        <div class="pos" id="_0:0" style="top:3300">
        <img name="_1100:850" src="/img/page_004.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
        <div class="pos" id="_100:3401" style="top:3401;left:100">
        <span id="_14.8" style="font-weight:bold; font-family:Times New Roman; font-size:14.8px; color:#000000">
        SURAT PERNYATAAN BUKAN MITRA BINAAN BUMN LAIN </span>
        </div>
        <div class="pos" id="_100:3476" style="top:3476;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Yang bertanda tangan dibawah ini : </span>
        </div>
        <div class="pos" id="_100:3514" style="top:3514;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Nama</span>
        </div>
        <div class="pos" id="_199:3514" style="top:3514;left:199">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->dataProposal->nama_pengaju}}</span>
        </div>
        <div class="pos" id="_100:3551" style="top:3551;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        No. KTP</span>
        </div>
        <div class="pos" id="_199:3551" style="top:3551;left:199">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->ktp}}</span>
        </div>
        <div class="pos" id="_100:3588" style="top:3588;left:100">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        Alamat</span>
        </div>
        <div class="pos" id="_199:3588" style="top:3588;left:199">
        <span id="_14.8" style=" font-family:Times New Roman; font-size:14.8px; color:#000000">
        : {{$mitra->alamat_kantor}}</span>
        </div>
        <div class="pos" id="_100:3663" style="top:3663;left:100">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        Sehubungan dengan permohonan bantuan pembinaan yang kami ajukan kepada PKBL PT. Len Industri </span>
        </div>
        <div class="pos" id="_100:3690" style="top:3690;left:100">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        (Persero), menyatakan dengan sesungguhnya : </span>
        </div>
        <div class="pos" id="_125:3727" style="top:3727;left:125">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        1. Pada saat bersamaan tidak menerima bantuan pinjaman dari BUMN lain. </span>
        </div>
        <div class="pos" id="_125:3754" style="top:3754;left:125">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        2. Bersedia menerima kunjungan tim PKBL PT. Len Industri (Persero)</span>
        </div>
        <div class="pos" id="_125:3780" style="top:3780;left:125">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        3. Bersedia  memberikan  data  atau  informasi  yang  diperlukan  oleh  tim  PKBL  PT.  Len  Industri </span>
        </div>
        <div class="pos" id="_150:3806" style="top:3806;left:150">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        (Persero), mengenai keberadaan perusahaan. </span>
        </div>
        <div class="pos" id="_125:3833" style="top:3833;left:125">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        4. Apabila  perusahaan  kami  menjadi  mitra  binaan  tim  PKBL  PT.  Len  Industri  (Persero),  kami </span>
        </div>
        <div class="pos" id="_150:3859" style="top:3859;left:150">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        bersedia melaksanakan segala ketentuan yang tercantum dalam surat perjanjian kerjasama dengan </span>
        </div>
        <div class="pos" id="_150:3885" style="top:3885;left:150">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        penuh tanggung jawab. </span>
        </div>
        <div class="pos" id="_100:3923" style="top:3923;left:100">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        Demikian surat pernyataan ini saya buat dengan sebenarnya dan tanpa adanya unsur paksaan dari pihak </span>
        </div>
        <div class="pos" id="_100:3949" style="top:3949;left:100">
        <span id="_15.2" style=" font-family:Times New Roman; font-size:15.2px; color:#000000">
        manapun, serta untuk dapat dipergunakan sebagaimana mestinya. </span>
        </div>
    </div>

    <div>
        <div class="pos" id="_0:0" style="top:4400">
        <img name="_1100:850" src="/img/page_005.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
        <div class="pos" id="_100:4501" style="top:4501;left:100">
        <span id="_14.7" style="font-weight:bold; font-family:Times New Roman; font-size:14.7px; color:#000000">
        SURAT PERNYATAAN KEPEMILIKAN BARANG TITIPAN </span>
        </div>
        <div class="pos" id="_100:4576" style="top:4576;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Yang bertanda tangan dibawah ini : </span>
        </div>
        <div class="pos" id="_100:4614" style="top:4614;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Nama</span>
        </div>
        <div class="pos" id="_199:4614" style="top:4614;left:199">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->dataProposal->nama_pengaju}}</span>
        </div>
        <div class="pos" id="_100:4651" style="top:4651;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        No. KTP</span>
        </div>
        <div class="pos" id="_199:4651" style="top:4651;left:199">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->ktp}}</span>
        </div>
        <div class="pos" id="_100:4688" style="top:4688;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Alamat</span>
        </div>
        <div class="pos" id="_199:4688" style="top:4688;left:199">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        : {{$mitra->alamat_kantor}}</span>
        </div>
        <div class="pos" id="_100:4726" style="top:4726;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Dengan ini menyatakan bahwa barang titipan yang diserahkan kepada PT. Len Industri (Persero) berupa </span>
        </div>
        <div class="pos" id="_100:4752" style="top:4752;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        {{$mitra->jaminan->jaminan}} dengan Nomor {{$mitra->jaminan->no_jaminan}}, adalah <U>b</U><U>e</U><U>n</U><U>a</U><U>r</U><U> </U>milik {{$mitra->jaminan->pemilik_jaminan}} secara sah, dan apabila </span>
        </div>
        <div class="pos" id="_100:4779" style="top:4779;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        dikemudian  hari  terjadi  sesuatu  hal  yang  mengakibatkan  saya  tidak  dapat  melaksanakan  kewajiban </span>
        </div>
        <div class="pos" id="_100:4805" style="top:4805;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        mengangsur pinjaman kepada PKBL PT. Len Industri (Persero) maka saya siap bertanggung jawab secara </span>
        </div>
        <div class="pos" id="_100:4831" style="top:4831;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        hukum maupun dalam bentuk lainnya yang akan diberikan oleh pihak PT. Len Industri (Persero). </span>
        </div>
        <div class="pos" id="_100:4869" style="top:4869;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        Demikian surat pernyataan ini saya buat dengan sebenarnya dan tanpa adanya unsur paksaan dari pihak </span>
        </div>
        <div class="pos" id="_100:4895" style="top:4895;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
        manapun, serta untuk dapat dipergunakan sebagaimana mestinya. </span>
        </div>
        <div class="pos" id="_100:5082" style="top:5082;left:100">
        <span id="_14.7" style=" font-family:Times New Roman; font-size:14.7px; color:#000000">
         </span>
        </div>
    </div>

    </nowrap></nobr>

    <hr>
    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
            window.print();
		});
	</script>
</body>
</html>
