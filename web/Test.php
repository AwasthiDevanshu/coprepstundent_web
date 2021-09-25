<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if (Constant::PAGE_MAP["test"] == false) {
    header("Location: 404.php");
    exit();
}

$_SESSION["testMap"] = [];

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
                <h1 class="app-page-title" id="page_title"> Test Series </h1>
                <img src="assets/images/test banner.png" width="100%">
            </div>
            <div class="container-xl" id="test_row_cont">
                <?php

                if (isset($_SESSION["authtoken"])) {
                    $url =  Url::TEST_URL;
                    $data[] = "";
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);

                    $testList = $response["data"]["testList"];

                    foreach ($testList as $row) {
                        $topic = $row["topic"];
                        $testSeries = $row["testSeries"]; ?>

                        <div class="test_topic">
                            <h1> <?php echo $topic; ?> </h1>
                        </div>

                        <div class="row row-cols-4">
                            <?php
                            foreach ($testSeries as $key => $testcontent) {
                                $_SESSION["testMap"][$testcontent["testSeriesId"]]["purchased"] = $testcontent["purchased"];
                            ?>
                                <div class="col">
                                    <div class="test_cont">
                                        <img src="<?php echo $testcontent["imageUrl"]; ?>" class="test_img">
                                        <h4> <?php echo $testcontent["title"]; ?> </h4>
                                        <a href="testlist.php?testSeries=<?php echo $testcontent["testSeriesId"] . "&testName=";
                                                                            echo $testcontent["title"]; ?>"><button class="btn btn-primary" id="view_all_btn"> View All Tests </button></a>
                                        <?php
                                        if ($testcontent["purchased"] == 0) { ?>
                                            <button class="btn btn-primary" id="buy_now_btn" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-lock"></i> Buy Now </button>
                                        <?php } else { ?>
                                            <a href="testlist.php?testSeries=<?php echo $testcontent["testSeriesId"] . "&testName=";
                                                                                echo $testcontent["title"]; ?>"><button class="btn btn-primary" id="buy_now_btn"> <i class="fas fa-bolt"></i> Start Test </button></a>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                <?php }
                } ?>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buy Test Series</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="popup_body">
                                    <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><img src="assets/images/playstore.png" class="playstore_img"></a><br>
                                    <h4> OR </h4>
                                    <button class="contact_institute btn btn-primary"> <i class="fas fa-phone-alt"></i> Contact Institute </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("assets/scripts.php");
        ?>
</body>

</html>