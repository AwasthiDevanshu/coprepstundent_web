<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");
$error = "";

if (isset($_POST["submit"])) {
	if (!empty($_POST["username"]) || !empty($_POST["password"])) {
		$url = Url::LOGIN_URL;
		$data["username"] = $_POST["username"];
		$data["password"] = $_POST["password"];
		$data["companyId"] = "27";
		$callApi = new CallApi();
		$response = $callApi->call($url, $data);
		$response = json_decode($response, true);

		if (!empty($response["data"]["authToken"])) {
			$_SESSION["authtoken"] = $response["data"]["authToken"];
			$_SESSION["username"] = $data["username"];

			exit(header("Location: index.php"));
		} else {
			header("Location: login.php?error=Incorrect Username or Password");
			exit();
		}
	} else {
		header("Location: login.php?error=Please Enter Required Fields");
		exit();
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Login | <?php echo Constant::COMPANYNAME ?></title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.php"><img class="logo-icon me-2" src=" <?php echo Constant::LOGO_URL ?>" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
					<div class="auth-form-container text-start">

						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Alert!</strong> <?php echo $_GET['error']; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<form action="" method="POST" class="auth-form login-form">
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Username</label>
								<input id="signin-email" name="username" type="text" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>" class="form-control signin-email" placeholder="Username">
							</div>
							<!--//form-group-->
							<div class="password mb-3">
								<div class="col-12">
									<div class="input-group mb-3">
										<input name="password" type="password" value="<?php if(isset($_POST["password"])){echo $_POST["password"];} ?>" class="input form-control" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
										<div class="input-group-append">
											<span class="input-group-text" id="pass_eye" onclick="password_show_hide();">
												<i class="fas fa-eye" id="show_eye"></i>
												<i class="fas fa-eye-slash d-none" id="hide_eye"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
												Remember me
											</label>
										</div>
									</div>
									<!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.php">Forgot password?</a>
										</div>
									</div>
									<!--//col-6-->
								</div>
								<!--//extra-->
							</div>
							<!--//form-group-->
							<div class="text-center">
								<button type="submit" name="submit" class="btn btn-success app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>

						<div class="auth-option text-center pt-5">No Account? Register <a class="text-link" href="signup.php">here</a>.</div>
					</div>
					<!--//auth-form-container-->

				</div>
				<!--//auth-body-->

				<footer class="app-auth-footer">
					<div class="container text-center py-3">
						<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
						<small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="https://www.coprepedu.com/" target="_blank">Coprep Edu</a> for <?php echo Constant::COMPANYNAME ?></small>

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
						<div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license.</div>
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