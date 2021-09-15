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
                            ?>
                                <div class="col">
                                    <div class="test_cont">
                                        <center><img src="<?php echo $testcontent["imageUrl"];?>" class="test_img"></center>
                                        <h4> <?php echo $testcontent["title"];?> </h4>
                                        <a href="testlist.php?testID=<?php echo $testcontent["testSeriesId"] ?>"><button class="btn btn-primary" id="view_all_btn"> View All Tests </button></a>
                                        <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary" id="buy_now_btn"> <i class="fas fa-lock"></i> Buy Now </button></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }} 
                    
                        echo "<pre>";
                        print_r($testSeries);
                        echo "</pre>";
                    ?>
            </div>
        </div>
</body>

</html>