@extends('user/masterPublic')

@section('title', 'Alur Program')

@section('main')
<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="/user/assets/img/hero/services_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Alur Program Kemitraan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- services Area Start-->
<div class="services-area section-padding2">
    <div class="container">
        <!-- section tittle -->
        <div class="row">
            <div class="col-md-6">
                <div class="single-services text-center mb-30">
                    <div class="services-icon">
                        <span class="flaticon-checklist"></span>
                    </div>
                    <div class="services-caption">
                        <h4>1. Pendaftaran</h4>
                        <p>Silahkan daftarkan diri anda dengan menyiapkan KTP, No. Rekening, dan SKU (Surat Keterangan Usaha)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-services text-center mb-30">
                    <div class="services-icon">
                        <span class="flaticon-audit"></span>
                    </div>
                    <div class="services-caption">
                        <h4>2. Pengajuan Propsal</h4>
                        <p>Setelah anda melakukan pendaftaran silahkan anda akses halaman yang berisi form melengkapi data registrasi anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-services text-center mb-30">
                    <div class="services-icon">
                        <span class="flaticon-checklist-1"></span>
                    </div>
                    <div class="services-caption">
                        <h4>3. Mendapatkan Notifikasi</h4>
                        <p>Setelah semua registrasi selesai anda tinggal menunggu notifikasi keputusan proposal anda melalui email, jika anda diterima anda akan mendapatkan username dan password untuk login</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-services text-center mb-30">
                    <div class="services-icon">
                        <span class="flaticon-checklist-1"></span>
                    </div>
                    <div class="services-caption">
                        <h4>4. Peminjaman dan Pembayaran Angsuran</h4>
                        <p>Anda dapat mengajukan jumlah dana yang ingin dipinjam namun jumlah pencairan dana sepenuhnya adalah hak staf penanggung jawab kemitraan dan tidak dapat diganggu gugat dan pembayaran dilakukan setiap bulan dengan batas waktu maksimal dana telah lunas selama 3 tahun</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Area Start -->
<div class="recent-area section-paddingt">
    <div class="container">
        <!-- section tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <h2>Our Recent News</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($berita as $brt)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-recent-cap mb-30">
                    <div class="recent-img">
                        <img src=
                        "<?php
                            $url = JD\Cloudder\Facades\Cloudder::show($brt->ilustrasi, ['width'=>600, 'height'=>500, "crop"=>"scale"]);
                            echo $url;
                        ?>
                        " alt="">
                    </div>
                    <div class="recent-cap">
                        <span>{{$brt->keterangan}}</span>
                        <h4><a href="/berita/{{$brt->judul_berita}}">{{$brt->judul_berita}}</a></h4>
                        <p>{{$brt->tgl_rilis}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Recent Area End-->

<!-- Request Back Start -->
<div class="request-back-area section-padding30">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="request-content">
                    <h3>Siapkan Pertanyaan</h3>
                    <p>Anda dapat mengajukan pertanyaan terkait Program Kemitraan PT. Len Industri.</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7">
                <!-- Contact form Start -->
                <div class="form-wrapper">
                    <form id="contact-form" action="/faq/send" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-box  mb-30">
                                    <input type="text" name="pertanyaan" id="pertanyaan" placeholder="Pertanyaan?" required>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 mb-30">
                                <div class="select-itms">
                                    <select name="kategori" id="kategori" required>
                                        <option value="">Kategori</option>
                                        <option value="Administrasi Kemitraan">Administrasi Kemitraan</option>
                                        <option value="Pengajuan Proposal">Pengajuan Proposal</option>
                                        <option value="Pendanaan">Pendanaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <button type="submit" class="send-btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     <!-- Contact form End -->
        </div>
    </div>
</div>
<!-- Request Back End -->
@endsection
