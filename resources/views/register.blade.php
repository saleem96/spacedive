<!DOCTYPE html>
<html lang="en">
<head>
	<title>Spacedive - Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" href="/images/icons/favi.png" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Roboto">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

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
				<div class="login100-pic " >
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form action="/register" class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						{{__('strings.member_register')}}
					</span>

					{{csrf_field()}}
                    <input type="hidden" name="registration_token" value="{{$token}}">
					<div class="wrap-input100 validate-input" data-validate = "First name is required">
						<input class="input100" type="text" name="fname" placeholder="{{__('strings.fname')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Last name is required">
						<input class="input100" type="text" name="lname" placeholder="{{__('strings.lname')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100" data-toggle="tooltip" data-placement="top" title="{{__('strings.tooltip')}}" >
						<input class="input100" type="text" name="ssn" placeholder="{{__('strings.ssn')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100" >
							<i class="fa fa-info-circle" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="{{__('strings.email')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 " >
						<input class="input100" type="text" name="phone" placeholder="{{__('strings.phone')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
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
                       <span class="txt2"> {{__('strings.accept')}}<br>
                           {{__('strings.iaccept')}}: </span><input  class="input" type="checkbox" value="0" name="terms">
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
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
                            {{__('strings.register')}}
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="/login">
                            {{__('strings.already')}}
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
	</script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
    </script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
