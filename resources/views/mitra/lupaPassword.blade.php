<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lupa Password | Kemitraan LEN Industri</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/mitra/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/mitra/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="/mitra/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/mitra/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/mitra/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/img/logo.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
                <div class="info d-flex align-items-center">
                    <div class="content">
                        <div class="logo">
                          <h1>Sistem Informasi Kemitraan</h1>
                        </div>
                        <p>LEN Industri</p>
                        <p>Lupa Password</p>
                      </div>
                  </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">

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
                        <div class="form-group alert alert-danger">
                            <div>{{Session::get('alert-danger')}}</div>
                        </div>
                    @endif
                    @if(Session::has('alert-success'))
                        <div class="form-group alert alert-success">
                            <div>{{Session::get('alert-success')}}</div>
                        </div>
                    @endif

                    <form class="form-validate" method="POST" action="/mitra/lupaPassword/proses">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="label-material">Alamat Email</label>
                            <input id="email" type="email" name="email" required placeholder="Masukkan alamat email" class="input-material">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="/mitra/vendor/jquery/jquery.min.js"></script>
    <script src="/mitra/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="/mitra/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/mitra/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/mitra/vendor/chart.js/Chart.min.js"></script>
    <script src="/mitra/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="/mitra/js/front.js"></script>
  </body>
</html>
