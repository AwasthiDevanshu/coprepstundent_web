<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");
error_reporting(0);

if(Constant::PAGE_MAP["reset_pass"] == false)
{
    header("Location: 404.php");
    exit();
}

if (isset($_POST["submit"])) {
	if (!empty($_POST["email"])) {

		$url = Url::FORGET_URL;
		$data["email"] = $_POST["email"];
		$data["companyId"] = Constant::COMPANYID;
		$callApi = new CallApi();
		$response = $callApi->call($url, $data);
		$response = json_decode($response, true);
	} else {
		header("Location: forget-password.php?error=Please Enter Registered Email ID");
		exit();
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Forgot Password | <?php echo Constant::COMPANYNAME ?> </title>

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

<body class="app app-reset-password p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.php"><img class="logo-icon me-2" src=" <?php echo Constant::LOGO_URL ?>" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Forgot Password</h2>

					<div class="auth-intro mb-4 text-center">Enter your email address below. We'll email you Your Login ID and Password.</div>

					<div class="auth-form-container text-left">

						<?php if ($response["error"] == 1) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Alert!</strong> <?php echo $response["message"]; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Alert!</strong> <?php echo $_GET['error']; ?>.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<?php if (isset($response["error"]) && $response["error"] == 0) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="success">
								<strong>Success!</strong> <?php echo $response["message"]; ?><br>
								<p> Please, Check you Spam folder for ID & Password then Try Login again. </p>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div> <?php } ?>

						<form action="" method="POST" class="auth-form resetpass-form">
							<div class="email mb-3">
								<label class="sr-only" for="reg-email">Your Email</label>
								<input id="reg-email" name="email" type="email" class="form-control login-email" placeholder="Your Email" required="required">
							</div>
							<!--//form-group-->
							<div class="text-center">
								<button type="submit" name="submit" class="btn btn-success app-btn-primary btn-block theme-btn mx-auto">Send Password</button>
							</div>
						</form>

						<div class="auth-option text-center pt-5"><a class="app-link" href="login.php">Log in</a> <span class="px-2">|</span> <a class="app-link" href="signup.php">Register</a></div>
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
						<div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
					</div>
				</div>
			</div> -->
			<!--//auth-background-overlay-->
		</div>
		<!--//auth-background-col-->

	</div>
	<!--//row-->


</body>

</html>

<?php
include("assets/scripts.php");
?>