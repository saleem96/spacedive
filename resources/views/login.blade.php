<!DOCTYPE html>
<html lang="en">
<head>
	<title>Spacedive - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" href="/images/icons/favi.png" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Roboto">


    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <div style="position: absolute;right: 20%;top:50px;cursor: pointer"><a href="{{url('change_language')}}?lang={{App::getLocale() == "en" ? "danish" : 'en'}}">Dansk / English</a></div>
				<div class="login100-pic " style="   position:relative;
">
					<img src="images/img-01.png" alt="IMG">
{{--
                    <div class="" style="position:absolute;
   bottom:0;
   width:100%;
   height:60px;">
                        <form id="change_language" method="post" action="{{url('change_language')}}">
                            {{csrf_field()}}
                            <select name="lang" id="langSelect" class="selectpicker" data-width="fit">
                                <option value="en" {{App::getLocale() == "en" ? "selected" : ''}} data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                                <option value="danish"  {{App::getLocale() == "danish" ? "selected" : ''}}  data-content='<span class="flag-icon flag-icon-mx"></span> Danish'>Danish</option>
                            </select>
                        </form>
                    </div>--}}
				</div>

				<form class="login100-form validate-form" method="post" >
					<span class="login100-form-title">
						{{__('strings.mlogin')}}
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="{{__('strings.email')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="{{__('strings.password')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Terms is required">
                        <input  class="input" type="checkbox" value="0" name="terms">  <span class="txt2">{{__('strings.remember')}}</span>
                    </div>

                    {{csrf_field()}}
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
                            {{__('strings.login')}}
						</button>
					</div>
                    <div class="container-login100-form-btn">
                        <a class="txt2" href="/forgotPass">
                            {{__('strings.reset_pass')}}
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
					</div>

                    @if(isset($errors) && count($errors->all()))
                        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach

                        </div>
                    @endif

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
                            {{__('strings.create_free_account')}}
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

				</form>
            </div>

		</div>


	</div>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
        $('#langSelect').on('change',function () {
            console.log($('#change_language'))
            $('#change_language').submit()
        })
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
