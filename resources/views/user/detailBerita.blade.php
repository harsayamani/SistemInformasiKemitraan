@extends('user/masterPublic')

@section('title', "$berita->judul_berita")

@section('main')
<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="/user/assets/img/hero/Industries_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Berita</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
    <div class="row">
        <div class="col-lg-8 posts-list">
            <div class="single-post">
                <div class="feature-img">
                <img class="img-fluid" src="
                        <?php
                            $url = JD\Cloudder\Facades\Cloudder::show($berita->ilustrasi, ['width'=>750, 'height'=>375, "crop"=>"scale"]);
                            echo $url;
                        ?>
                " alt="">
                </div>
                <div class="blog_details">
                <h2>
                    {{$berita->judul_berita}}
                </h2>
                <ul class="blog-info-link mt-3 mb-4">
                    <li><a href="#"><i class="fa fa-tag"></i> {{$berita->ketearangan}}</a></li>
                </ul>
                <p class="excert">
                    {!!$berita->isi_berita!!}
                </p>
                </div>
            </div>
            {{-- <div class="navigation-top">
                <div class="d-sm-flex justify-content-between text-center">
                <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and 4
                    people like this</p>
                <div class="col-sm-4 text-center my-2 my-sm-0">
                    <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                </div>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                </ul>
                </div>
                <div class="navigation-area">
                <div class="row">
                    <div
                        class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                        <div class="thumb">
                            <a href="#">
                            <img class="img-fluid" src="assets/img/post/preview.png" alt="">
                            </a>
                        </div>
                        <div class="arrow">
                            <a href="#">
                            <span class="lnr text-white ti-arrow-left"></span>
                            </a>
                        </div>
                        <div class="detials">
                            <p>Prev Post</p>
                            <a href="#">
                            <h4>Space The Final Frontier</h4>
                            </a>
                        </div>
                    </div>
                    <div
                        class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        <div class="detials">
                            <p>Next Post</p>
                            <a href="#">
                            <h4>Telescopes 101</h4>
                            </a>
                        </div>
                        <div class="arrow">
                            <a href="#">
                            <span class="lnr text-white ti-arrow-right"></span>
                            </a>
                        </div>
                        <div class="thumb">
                            <a href="#">
                            <img class="img-fluid" src="assets/img/post/next.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div> --}}
            <div class="blog-author">
                <div class="media align-items-center">
                <img src="/img/logo.png" alt="">
                <div class="media-body">
                    <a href="#">
                        <h4>Admin Program Kemitraan</h4>
                    </a>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <form method="POST" action="/berita/search">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" id="keyword" name="keyword" class="form-control" placeholder='Search Keyword'
                                    onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Search Keyword'">
                                <div class="input-group-append">
                                    <button class="btns" type="submit"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                    </form>
                </aside>

                <aside class="single_sidebar_widget post_category_widget">
                    <h4 class="widget_title">Kategori</h4>
                    <ul class="list cat-list">
                        <li>
                            <a href="/berita/kategori/Berita" class="d-flex">
                                <p>Berita</p>
                                <p>({{$berita_count}})</p>
                            </a>
                        </li>
                        <li>
                            <a href="/berita/kategori/Pengumuman" class="d-flex">
                                <p>Pengumuman</p>
                                <p>({{$pengumuman_count}})</p>
                            </a>
                        </li>
                    </ul>
                </aside>

                <aside class="single_sidebar_widget popular_post_widget">
                    <h3 class="widget_title">Terbaru</h3>

                    @foreach($recent as $rcnt)
                    <div class="media post_item">
                        <img src="
                        <?php
                            $url = JD\Cloudder\Facades\Cloudder::show($rcnt->ilustrasi, ['width'=>100, 'height'=>80, "crop"=>"scale"]);
                            echo $url;
                        ?>" alt="post">
                        <div class="media-body">
                            <a href="/berita/{{$rcnt->judul_berita}}">
                                <h3>{{$rcnt->judul_berita}}</h3>
                            </a>
                            <p>{{$rcnt->tgl_rilis}}</p>
                        </div>
                    </div>
                    @endforeach
                </aside>
            </div>
        </div>
    </div>
    </div>
</section>
<!--================ Blog Area end =================-->

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
