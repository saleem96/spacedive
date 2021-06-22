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
                <div style="position: absolute;right: 20%;top:50px;cursor: pointer"><a href="<?php echo e(url('change_language')); ?>?lang=<?php echo e(App::getLocale() == "en" ? "danish" : 'en'); ?>">Dansk / English</a></div>
				<div class="login100-pic " style="   position:relative;
">
					<img src="images/img-01.png" alt="IMG">

				</div>

				<form class="login100-form validate-form" method="post" >
					<span class="login100-form-title">
						<?php echo e(__('strings.mlogin')); ?>

					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="<?php echo e(__('strings.email')); ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="<?php echo e(__('strings.password')); ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Terms is required">
                        <input  class="input" type="checkbox" value="0" name="terms">  <span class="txt2"><?php echo e(__('strings.remember')); ?></span>
                    </div>

                    <?php echo e(csrf_field()); ?>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
                            <?php echo e(__('strings.login')); ?>

						</button>
					</div>
                    <div class="container-login100-form-btn">
                        <a class="txt2" href="/forgotPass">
                            <?php echo e(__('strings.reset_pass')); ?>

                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
					</div>

                    <?php if(isset($errors) && count($errors->all())): ?>
                        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><?php echo e($error); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    <?php endif; ?>

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
                            <?php echo e(__('strings.create_free_account')); ?>

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
<?php /**PATH /home/spacairt/my.spacedive.io/resources/views/login.blade.php ENDPATH**/ ?>