<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_bar')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">

    @include('/mitra/style/style')

  </head>

  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="/mitra/dashboard" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><img src="/img/logo.png" width="30px" height="40px"> <span>Kemitraan</span> <strong>LEN Industri</strong></div>
                  </a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications-->
                <li class="nav-item"><a href="/mitra/gantiPassword" class="nav-link logout"><span class="d-none d-sm-inline">Ganti Password</span><i class="fa fa-exchange"></i></a></li>

                <!-- Logout    -->
                <li class="nav-item"><a href="/mitra/logout" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <h5>Halo, {{Session::get('namaMitra')}}</h5>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Menu</span>
            <ul class="list-unstyled">
              <li class="@yield('active1')"><a href="/mitra/dashboard"> <i class="icon-home"></i>Dashboard</a></li>
              <li class="@yield('active2')"><a href="/mitra/dataMitra"> <i class="fa fa-user"></i>Data Mitra</a></li>
              <li class="@yield('active3')"><a href="/mitra/pinjaman"> <i class="fa fa-list"></i>Pinjaman</a></li>
              <li class="@yield('active4')"><a href="/mitra/angsuran"> <i class="fa fa-list"></i>Angsuran</a></li>
              <li class="@yield('active5')"><a href="/mitra/riwayat"> <i class="fa fa-clock-o"></i>Riwayat</a></li>
            </ul>
        </nav>

        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">@yield('title_page')</h2>
            </div>
          </header>

          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if (session()->has('alert-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session()->get('alert-success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if (session()->has('alert-danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session()->get('alert-danger')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if (session()->has('alert-warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session()->get('alert-warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
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

          @yield('section')

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>&copy; Sistem Kemitraan LEN Industri <?php echo date("Y"); ?></p>
                </div>
                <div class="col-sm-6 text-right">
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>

    @include('/mitra/script/script')

    @yield('script')

  </body>
</html>
