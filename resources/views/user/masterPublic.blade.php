<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title') | Program Kemitraan LEN Industri</title>
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

        @if (session()->has('alert-warning'))
              <div class="alert alert-warning" role="alert">
                  {{session()->get('alert-warning')}}
              </div>
        @endif

        @if (Session()->has('alert-modal-success'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body alert-success">
                    <p>{{session()->get('alert-modal-success')}}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
        @endif

        @if (Session()->has('alert-modal-danger'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body alert-danger">
                    <p>{{session()->get('alert-modal-danger')}}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
        @endif

        @if (Session()->has('alert-modal-warning'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body alert-warning">
                    <p>{{session()->get('alert-modal-warning')}}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
        @endif

        @yield('main')

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

                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                       <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Program Kemitraan</h4>
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/tentang">Tentang</a></li>
                                    <li><a href="/alur">Alur</a></li>
                                    <li><a href="/berita">Berita</a></li>
                                    <li><a href="/faq">FAQ</a></li>
                                </ul>
                            </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Get in Touch</h4>
                               <ul>
                                <li><a href="#">Telp: +62-22-5202682</a></li>
                                <li><a href="#">Fax : +62-22-5202695 </a></li>
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

        <script>
            $('#myModal').modal('show')
          </script>
    </body>
</html>
