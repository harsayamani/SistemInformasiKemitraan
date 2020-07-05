@extends('user/masterPublic')

@section('title', "FAQ")

@section('main')
<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="/user/assets/img/hero/gallery_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>FAQ</h2>
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
            <div class="col-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" >
                <a class="btn btn-primary active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Administrasi Kemitraan</a>
                <br>
                <a class="btn btn-primary" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Pengajuan Proposal</a>
                <br>
                <a  class="btn btn-primary" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Pendanaan</a>
              </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    @foreach($administrasi as $key=>$adm)
                    <div class="row">
                        <div class="col-12">
                            <a class="genric-btn default radius" data-toggle="collapse" href="#collapse{{$adm->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <h5>{{++$key}}. {{$adm->pertanyaan}}</h5>
                            </a>
                            <div class="col-12">
                                <div class="collapse" id="collapse{{$adm->id}}">
                                    <div class="card card-body">
                                        <p>{{$adm->jawaban}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    @foreach($pengajuan as $key=>$adm)
                    <div class="row">
                        <div class="col-12">
                            <a class="genric-btn default radius" data-toggle="collapse" href="#collapse{{$adm->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <h5>{{++$key}}. {{$adm->pertanyaan}}</h5>
                            </a>
                            <div class="col-12">
                                <div class="collapse" id="collapse{{$adm->id}}">
                                    <div class="card card-body">
                                        <p>{{$adm->jawaban}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    @foreach($pendanaan as $key=>$adm)
                    <div class="row">
                        <div class="col-12">
                            <a class="genric-btn default radius" data-toggle="collapse" href="#collapse{{$adm->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <h5>{{++$key}}. {{$adm->pertanyaan}}</h5>
                            </a>
                            <div class="col-12">
                                <div class="collapse" id="collapse{{$adm->id}}">
                                    <div class="card card-body">
                                        <p>{{$adm->jawaban}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
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
