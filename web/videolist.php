<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}
$_SESSION["courseMap"] = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Videos </title>
    <link rel="stylesheet" href="assets/css/videolist.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
</head>

<body class="app">

    <div class="loader-wrapper" id="loader2">
        <img src="assets/images/loader/loader.gif" class="loader">
    </div>

    <div class="app-wrapper" id="load">

        <?php include("includes/navbar.php"); ?>

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title"> Video List </h1>
            </div>

            <div class="row g-4">

                <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <img src="assets/images/background/background-1.jpg" style="width: 100%; height:auto;">
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"> Title of the Video </h4>
                            <button> Watch Now </button>
                            <!--//app-doc-meta-->
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>

            </div>

        </div>

        <?php include("includes/footer.php"); ?>

    </div>
    <!--//app-wrapper-->

    <?php include("assets/scripts.php"); ?>

</body>

</html>