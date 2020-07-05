@extends('user/masterPublic')

@section('title', 'Tentang')

@section('main')
<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="/user/assets/img/hero/contact_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Tentang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- We Trusted Start-->
<div class="we-trusted-area trusted-padding">
    <div class="container">
        <div class="row d-flex align-items-end">
            <div class="col-xl-7 col-lg-7">
                <div class="trusted-img">
                    <img src="/user/assets/img/team/wetrusted.jpg" alt="">
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="trusted-caption">
                   <h2>Program Kemitraan PT. LEN industri</h2>
                   <p>Program kemitraan adalah program perusahaan untuk meningkatkan kesejahteraan untuk masyarakat, program kemitraan di PT. Len sendiri telah membantu ratusan UMKM dalam mengembangkan dan memperluas pasar produk. Sistem kemitraan ini sendiri merupakan sistem yang membantu proses kegiatan transaksi sekaligus penyebaran bagi calon mitra dan mitra </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- We Trusted End-->

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
