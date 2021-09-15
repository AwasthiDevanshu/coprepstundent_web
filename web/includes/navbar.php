<header class="app-header fixed-top">
	<div class="app-header-inner">
		<div class="container-fluid py-2">
			<div class="app-header-content">
				<div class="row justify-content-between align-items-center">

					<div class="col-auto">
						<a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
								<title>Menu</title>
								<path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
							</svg>
						</a>
					</div>
					<!--//col-->

					<div class="app-utilities col-auto">

						<a href="<?php echo CONSTANT::ANDROID_APP_LINK ?>" target="_blank" style="padding: 10px;"> Download App</a>

						<div class="app-utility-item app-notifications-dropdown dropdown">
							<a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">
								<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
									<path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
								</svg>
								<span class="icon-badge">3</span>
							</a>
							<!--//dropdown-toggle-->

							<div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
								<div class="dropdown-menu-header p-3">
									<h5 class="dropdown-menu-title mb-0">Notifications</h5>
								</div>
								<!--//dropdown-menu-title-->
								<div class="dropdown-menu-content">
									<div class="item p-3">
										<div class="row gx-2 justify-content-between align-items-center">
											<div class="col-auto">
												<img class="profile-image" src="assets/images/profiles/profile-1.png" alt="">
											</div>
											<!--//col-->
											<div class="col">
												<div class="info">
													<div class="desc">Amy shared a file with you. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
													<div class="meta"> 2 hrs ago</div>
												</div>
											</div>
											<!--//col-->
										</div>
										<!--//row-->
										<a class="link-mask" href="notifications.html"></a>
									</div>
									<!--//item-->
									<div class="item p-3">
										<div class="row gx-2 justify-content-between align-items-center">
											<div class="col-auto">
												<div class="app-icon-holder">
													<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
														<path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
													</svg>
												</div>
											</div>
											<!--//col-->
											<div class="col">
												<div class="info">
													<div class="desc">You have a new invoice. Proin venenatis interdum est.</div>
													<div class="meta"> 1 day ago</div>
												</div>
											</div>
											<!--//col-->
										</div>
										<!--//row-->
										<a class="link-mask" href="notifications.html"></a>
									</div>
									<!--//item-->
									<div class="item p-3">
										<div class="row gx-2 justify-content-between align-items-center">
											<div class="col-auto">
												<div class="app-icon-holder icon-holder-mono">
													<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
													</svg>
												</div>
											</div>
											<!--//col-->
											<div class="col">
												<div class="info">
													<div class="desc">Your report is ready. Proin venenatis interdum est.</div>
													<div class="meta"> 3 days ago</div>
												</div>
											</div>
											<!--//col-->
										</div>
										<!--//row-->
										<a class="link-mask" href="notifications.html"></a>
									</div>
									<!--//item-->
									<div class="item p-3">
										<div class="row gx-2 justify-content-between align-items-center">
											<div class="col-auto">
												<img class="profile-image" src="assets/images/profiles/profile-2.png" alt="">
											</div>
											<!--//col-->
											<div class="col">
												<div class="info">
													<div class="desc">James sent you a new message.</div>
													<div class="meta"> 7 days ago</div>
												</div>
											</div>
											<!--//col-->
										</div>
										<!--//row-->
										<a class="link-mask" href="notifications.html"></a>
									</div>
									<!--//item-->
								</div>
								<!--//dropdown-menu-content-->

								<div class="dropdown-menu-footer p-2 text-center">
									<a href="notifications.html">View all</a>
								</div>

							</div>
							<!--//dropdown-menu-->
						</div>
						<!--//app-utility-item-->

						<div class="app-utility-item app-user-dropdown dropdown">
							<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="assets/images/profiles/user.png" alt="user profile"></a>
							<ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<!-- <li><a class="dropdown-item" href="settings.html">Settings</a></li>
								<li><hr class="dropdown-divider"></li> -->
								<li><a class="dropdown-item" href="logout.php">Log Out</a></li>
							</ul>
						</div>
						<!--//app-user-dropdown-->
					</div>
					<!--//app-utilities-->
				</div>
				<!--//row-->
			</div>
			<!--//app-header-content-->
		</div>
		<!--//container-fluid-->
	</div>
	<!--//app-header-inner-->

	<div id="app-sidepanel" class="app-sidepanel">
		<div id="sidepanel-drop" class="sidepanel-drop"></div>
		<div class="sidepanel-inner d-flex flex-column">
			<a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
			<div class="app-branding">
				<a class="app-logo" href="index.php"><img class="logo-icon me-2" src="<?php echo Constant::LOGO_URL ?>" alt="logo">
					<!--<span class="logo-text"><?php echo Constant::COMPANYNAME ?></span>-->
				</a>

			</div>
			<!--//app-branding-->

			<nav id="app-nav" class="app-nav flex-grow-1">
				<ul class="app-menu list-unstyled accordion" id="menu-accordion">
					<li class="nav-item selected_nav">
						<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						<a class="nav-link" href="index.php">
							<span class="nav-icon">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
									<path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
								</svg>
							</span>
							<span class="nav-link-text">Dashboard</span>
						</a>
						<!--//nav-link-->
					</li>

					<!--//nav-item-->
					<li class="nav-item">
						<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						<a class="nav-link currentTarget" href="currentaffairs.php">
							<span class="nav-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
									<path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
									<path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
								</svg>
							</span>
							<span class="nav-link-text">Current Affairs</span>
						</a>
						<!--//nav-link-->
					</li>

					<li class="nav-item">
						<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						<a class="nav-link currentTarget" href="test.php">
							<span class="nav-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
									<path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z" />
									<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
									<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
								</svg>
							</span>
							<span class="nav-link-text">Test Series</span>
						</a>
						<!--//nav-link-->
					</li>
					<!--//nav-item-->
				</ul>
				<!--//app-menu-->
			</nav>
			<!--//app-nav-->
			<!--//app-sidepanel-footer-->

		</div>
		<!--//sidepanel-inner-->
	</div>
	<!--//app-sidepanel-->
</header>
<!--//app-header-->

<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script>
<script src="assets/js/index-charts.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>

<?php
include("assets/scripts.php");
?>

<script>
	$(document).ready(function() {
		$('ul.app-menu > li')
			.click(function(e) {
				$('ul.app-menu > li')
					.removeClass('selected_nav');
				$(this).addClass('selected_nav');
			});
	});
	$(document).ready(function() {
		console.log($("app-menu > li  a").attr("href"));
		console.log(window.location.href);
		if ($("app-menu > li  a").attr("href") == window.location.href) {
			$("app-menu > li").attr("class", "nav-item selected_nav");
		} else {
			$(".nav-item").attr("class", "nav-item");
		}
	});
</script>