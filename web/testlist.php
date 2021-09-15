<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course | <?php echo Constant::COMPANYNAME ?> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" type="text/css" href="assets/css/test.css">
    <script>
        document.getElementsByTagName("html")[0].className += " js";
    </script>
</head>

<body class="app">

    <div class="loader-wrapper" id="loader2">
        <img src="assets/images/loader/loader.gif" class="loader">
    </div>

    <div class="app-wrapper" id="load">

        <?php include("includes/navbar.php"); ?>

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title" id="page_title"> Test List </h1>
            </div>
            <div class="container-xl" id="test_row_cont">
                <?php

                if (isset($_SESSION["authtoken"])) {
                    $url =  Url::TESTLIST_URL;
                    $data["testSeriesId"] = $_GET["testID"];                                                                                                                       
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);

                    echo "<pre>";
                    print_r($response);
                    echo "</pre>";
                }
                    ?>
            </div>
        </div>
    </div>
</body>
</html>