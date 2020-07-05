<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Berita | Program Kemitraan LEN Industri</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- <link rel="manifest" href="site.webmanifest"> --}}
		<link rel="shortcut icon" type="image/x-icon" href="/img/logo.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="/user/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="/user/assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="/user/assets/css/flaticon.css">
            <link rel="stylesheet" href="/user/assets/css/slicknav.css">
            <link rel="stylesheet" href="/user/assets/css/animate.min.css">
            <link rel="stylesheet" href="/user/assets/css/magnific-popup.css">
            <link rel="stylesheet" href="/user/assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="/user/assets/css/themify-icons.css">
            <link rel="stylesheet" href="/user/assets/css/slick.css">
            <link rel="stylesheet" href="/user/assets/css/nice-select.css">
            <link rel="stylesheet" href="/user/assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    </head>

   <body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="/img/logo.png" style="width: 50px; height: 50px" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt"></i>Soekarno-Hatta St No.442, Pasirluyu, Regol, Bandung City, West Java 40254</li>
                                        <li><i class="fas fa-envelope"></i>marketing@len.co.id</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-1 col-md-1">
                                <div class="logo">
                                  <a href="index.html"><img src="/img/logo.png" width="50px" height="50px" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/tentang">Tentang</a></li>
                                            <li><a href="/alur">Alur</a></li>
                                            <li><a href="/berita">Berita</a></li>
                                            <li><a href="/faq">FAQ</a></li>
                                            <li><a href="/daftar">Registrasi</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <a href="/mitra/login" class="btn header-btn">Login</a>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

    <main>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('alert-success'))
              <div class="alert alert-success" role="alert">
                  {{session()->get('alert-success')}}
              </div>
        @endif

        @if (session()->has('alert-danger'))
              <div class="alert alert-danger" role="alert">
                  {{session()->get('alert-danger')}}
              </div>
        @endif

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

    </main>
   <footer>
       <!-- Footer Start-->
       <div class="footer-area footer-padding">
           <div class="container">
               <div class="row d-flex justify-content-between">
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                      <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                             <!-- logo -->
                            <div class="footer-logo">
                                <a href="/"><img src="/img/logo.png" width="100px" height="100px" alt=""></a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>PT Len Industri adalah perusahaan peralatan elektronik industri milik Pemerintah Indonesia yang berkantor pusat di Bandung, Jawa Barat.</p>
                               </div>
                            </div>
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                                <a href="#"><i class="fab fa-twitter-square"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-pinterest-square"></i></a>
                            </div>
                        </div>
                      </div>
                   </div>
                   <div class="col-xl-2 col-lg-2 col-md-4 col-sm-5">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Company</h4>
                               <ul>
                                   <li><a href="#">Home</a></li>
                                   <li><a href="#">About Us</a></li>
                                   <li><a href="#">Services</a></li>
                                   <li><a href="#">Cases</a></li>
                                   <li><a href="#">Contact Us</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Services</h4>
                               <ul>
                                   <li><a href="#">Commercial Cleaning</a></li>
                                   <li><a href="#">Office Cleaning</a></li>
                                   <li><a href="#">Building Cleaning</a></li>
                                   <li><a href="#">Floor Cleaning</a></li>
                                   <li><a href="#">Apartment Cleaning</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Get in Touch</h4>
                               <ul>
                                <li><a href="#">152-515-6565</a></li>
                                <li><a href="#">marketing@len.co.id</a></li>
                                <li><a href="#">Soekarno-Hatta St No.442, Pasirluyu, Regol, Bandung City, West Java 40254</a></li>
                            </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area footer-bg">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>

	<!-- JS here -->

		<!-- All JS Custom Plugins Link Here here -->
        <script src="/user/assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="/user/assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="/user/assets/js/popper.min.js"></script>
        <script src="/user/assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="/user/assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="/user/assets/js/owl.carousel.min.js"></script>
        <script src="/user/assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="/user/assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="/user/assets/js/wow.min.js"></script>
		<script src="/user/assets/js/animated.headline.js"></script>
        <script src="/user/assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="/user/assets/js/jquery.scrollUp.min.js"></script>
        <script src="/user/assets/js/jquery.nice-select.min.js"></script>
		<script src="/user/assets/js/jquery.sticky.js"></script>

        <!-- contact js -->
        <script src="/user/assets/js/contact.js"></script>
        <script src="/user/assets/js/jquery.form.js"></script>
        <script src="/user/assets/js/jquery.validate.min.js"></script>
        <script src="/user/assets/js/mail-script.js"></script>
        <script src="/user/assets/js/jquery.ajaxchimp.min.js"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="/user/assets/js/plugins.js"></script>
        <script src="/user/assets/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    </body>
</html>
