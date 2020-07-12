<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Tim Survei | Sistem Kemitraan LEN Industri</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/img/logo.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/timsurvei/css/util.css">
	<link rel="stylesheet" type="text/css" href="/timsurvei/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="/survei/login/proses">
					<span class="login100-form-title p-b-51">
						Tim Survei
					</span>
                    @if ($errors->any())
                      <div class="form-control alert alert-danger" role="alert">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{$error}}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif

                    @if(Session::has('alert-danger'))
                        <div class="form-control alert alert-danger">
                            <div>{{Session::get('alert-danger')}}</div>
                        </div>
                    @endif
                    @if(Session::has('alert-success'))
                        <div class="form-control alert alert-success">
                            <div>{{Session::get('alert-success')}}</div>
                        </div>
                    @endif

                    {{ csrf_field() }}

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Wajib isi!">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input m-b-16" data-validate = "Wajib isi!">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="/timsurvei/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/vendor/bootstrap/js/popper.js"></script>
	<script src="/timsurvei/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/vendor/daterangepicker/moment.min.js"></script>
	<script src="/timsurvei/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/timsurvei/js/main.js"></script>

</body>
</html>
