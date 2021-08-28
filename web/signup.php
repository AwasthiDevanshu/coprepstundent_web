<?php

$error = "";

error_reporting(0);

if (isset($_POST["submit"])) {
	if (!empty($_POST["name"]) || !empty($_POST["phone"]) || !empty($_POST["email"]) || !empty($_POST["password"])) {
		function callApi($url, $data)
		{
			$curl = curl_init();
			$requestBody["data"] = $data;
			$requestBody["token"] = $_SESSION["authtoken"] ?? "";
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array('body' => json_encode($requestBody)),
			));

			$response = curl_exec($curl);
			return $response;
		}

		$url = 'https://backend.coprepedu.com/candidate/candidate/candidateSignUp';
		$data["companyId"] = "27";
		$data["name"] = $_POST['name'];
		$data["mobile"] = $_POST['phone'];
		$data["username"] = $_POST['phone'];
		$data["email"] = $_POST['email'];
		$data["password"] = $_POST['password'];
		$response = callApi($url, $data);
		$response = json_decode($response, true);

		if (isset($response["error"]) && $response["error"] == 0) {
			header("Location: login.php");
			exit();
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register | <?php echo Constant::COMPANYNAME ?> </title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-signup p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.php"><img class="logo-icon me-2" src="assets/images/Logo New.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Register to Portal</h2>

					<div class="auth-form-container text-start mx-auto">

						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Alert!</strong> <?php echo $_GET['error']; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<?php if ($response["error"] == 1) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Alert!</strong> <?php echo $response["message"]; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<?php if (isset($response["error"]) && $response["error"] == 0) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="success">
								<strong>Success!</strong> <?php echo $response["message"]; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<form action="" method="POST" class="auth-form auth-signup-form">
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Name</label>
								<input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Full name" required="required">
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email" required="required">
							</div>

							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Phone Number</label>
								<input id="signup-email" name="phone" type="number" class="form-control signup-email" placeholder="Phone Number" required="required">
								<p style="font-size: 10pt; color:grey;margin:5px;"> Your Phone Number will be your username. </p>
							</div>

							<div class="password mb-3">
								<div class="col-12">
									<div class="input-group mb-3">
										<input name="password" type="password" class="input form-control" id="password" placeholder="Create Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
										<div class="input-group-append">
											<span class="input-group-text" id="pass_eye" onclick="password_show_hide();">
												<i class="fas fa-eye" id="show_eye"></i>
												<i class="fas fa-eye-slash d-none" id="hide_eye"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
									<label class="form-check-label" for="RememberPassword">
										I agree to <?php echo Constant::COMPANYNAME ?> <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div>
							<!--//extra-->

							<div class="text-center">
								<button type="submit" name="submit" class="btn btn-success app-btn-primary w-100 theme-btn mx-auto">Sign Up</button>
							</div>
						</form>
						<!--//auth-form-->

						<div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="login.php">Log in</a></div>
					</div>
					<!--//auth-form-container-->



				</div>
				<!--//auth-body-->

				<footer class="app-auth-footer">
					<div class="container text-center py-3">
						<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
						<small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="https://www.coprepedu.com/" target="_blank">Coprep Edu</a> for <?php echo Constant::COMPANYNAME ?> </small>

					</div>
				</footer>
				<!--//app-auth-footer-->
			</div>
			<!--//flex-column-->
		</div>
		<!--//auth-main-col-->
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
			<div class="auth-background-holder">
			</div>
			<div class="auth-background-mask"></div>
			<!-- <div class="auth-background-overlay p-3 p-lg-5">
				<div class="d-flex flex-column align-content-end h-100">
					<div class="h-100"></div>
					<div class="overlay-content p-3 p-lg-4 rounded">
						<h5 class="mb-3 overlay-title">Explore Portal Admin Template</h5>
						<div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
					</div>
				</div>
			</div> -->
			<!--//auth-background-overlay-->
		</div>
		<!--//auth-background-col-->

	</div>
	<!--//row-->

	<script>
		function password_show_hide() {
			var x = document.getElementById("password");
			var show_eye = document.getElementById("show_eye");
			var hide_eye = document.getElementById("hide_eye");
			hide_eye.classList.remove("d-none");
			if (x.type === "password") {
				x.type = "text";
				show_eye.style.display = "none";
				hide_eye.style.display = "block";
			} else {
				x.type = "password";
				show_eye.style.display = "block";
				hide_eye.style.display = "none";
			}
		}
	</script>


</body>

</html>

<?php
include("assets/scripts.php");
?>