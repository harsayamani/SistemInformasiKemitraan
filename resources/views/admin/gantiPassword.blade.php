<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin Sistem Kemitraan | Ganti Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/adminlte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Favicon-->
        <link rel="shortcut icon" href="/img/logo.ico">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Ganti Password Admin</div>
            <form action="/admin/gantiPassword/proses" method="post">
                {{ csrf_field() }}
                <div class="body bg-gray">
                    @if ($errors->any())
                        <div class="form-group alert alert-danger" role="alert">
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

                    <div class="form-group">
                        <input type="password" name="pass_lama" id="pass_lama" class="form-control" placeholder="Masukkan password lama" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass_baru" id="pass_baru" class="form-control" placeholder="Masukkan password baru"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass_konf" id="pass_konf" class="form-control" placeholder="Konfirmasi password baru"/>
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Ganti Password</button>
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/adminlte/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
