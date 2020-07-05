@extends('user/masterPublic')

@section('title', 'Berita')

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
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">

                    @if($berita->count()>0)
                    @foreach ($berita as $brt)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="
                            <?php
                                $url = JD\Cloudder\Facades\Cloudder::show($brt->ilustrasi, ['width'=>650, 'height'=>275, "crop"=>"scale"]);
                                echo $url;
                            ?>
                            " alt="">
                            <a href="#" class="blog_item_date">
                                <p>{{$brt->tgl_rilis}}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="/berita/{{$brt->judul_berita}}">
                                <h2>{{$brt->judul_berita}}</h2>
                            </a>
                            {{-- <p>{!!substr($brt->isi_berita, 0, 60)!!}...</p> --}}
                            <ul class="blog-info-link">
                                <li><a href="/berita/kategori/{{$brt->keterangan}}"><i class="fa fa-tag"></i>{{$brt->keterangan}}</a></li>
                            </ul>
                        </div>
                    </article>
                    @endforeach
                    @else
                        <h3>Berita tidak ditemukan!</h3>
                    @endif
                    <nav class="blog-pagination justify-content-center d-flex">
                        {{ $berita->links() }}
                        {{-- <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul> --}}
                    </nav>
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
<!--================Blog Area =================-->

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
