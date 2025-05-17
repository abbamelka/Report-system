
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SWIFT & TI weakly report</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../Resource/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Resource/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Resource/css/login/util.css">
	<link rel="stylesheet" type="text/css" href="../Resource/css/login/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form  id="loginForm" class="login100-form validate-form" action="../../Back/loginback.php" method="POST">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					

					<div id="message-container">
						<?php
							if (isset($_GET['message'])) {
								echo '<div class="alert alert-danger">'.htmlspecialchars($_GET['message']).'</div>';
							}
						?>
    				</div>
					
					
					<div class="wrap-input100 validate-input " data-validate="uname is required">
						<input class="input100" type="text" id="username" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">username</span>
                        <div class="error" id="usernameError"></div>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
                        <div class="error" id="passwordError"></div>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32" style="display:none">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div style="display:none">
							<a href="#" class="txt1" >
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button id="login-form"  type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				
				</form>

				<div class="login100-more" style="background-image: url('../Resource/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="../Resource/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/vendor/bootstrap/js/popper.js"></script>
	<script src="../Resource/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/vendor/daterangepicker/moment.min.js"></script>
	<script src="../Resource/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../Resource/js/main.js"></script>


    

</body>
</html>