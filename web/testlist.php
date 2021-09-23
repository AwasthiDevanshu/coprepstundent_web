<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if(Constant::PAGE_MAP["testlist"] == false)
{
    header("Location: 404.php");
    exit();
}

$testName = $_GET["testName"];

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
    <link rel="stylesheet" type="text/css" href="assets/css/testlist.css">
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
                <h1 class="app-page-title" id="page_title"> <?php echo $testName; ?> - Test Series </h1>
            </div>
            <div class="container-xl" id="test_cont">
                <?php

                if (isset($_SESSION["authtoken"])) {
                    $url =  Url::TESTLIST_URL;
                    $data["filters"]["testSeriesId"] = $_GET["testID"];
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);
                    $test_ID =  $_GET["testID"];

                    $testList = $response["data"]["testList"];
                    $testpurchasID = $_SESSION["testMap"][$_GET["testID"]]["purchased"] ?? null;

                ?>

                    <div class="row row-cols-2" id="test_row_cont">

                        <?php

                        foreach ($testList as $key => $test_data) {

                            if ($test_data["active"] == 1) {

                        ?>

                                <div class="col" id="test_row_col">
                                    <div class="test_body">
                                        <div class="test_body_cont">
                                            <h4 class="test_title"> <?php echo $test_data["testName"]; ?> </h4>
                                            <span class="test_details"><i class="far fa-question-circle"></i> <?php echo $test_data["questionCount"]; ?> Questions </span>
                                            <span class="test_details"><i class="far fa-file-alt"></i> <?php echo $test_data["testScore"]; ?> Marks </span>
                                            <span class="test_details"><i class="fas fa-history"></i></i> <?php echo $test_data["testDuration"]; ?> Mins. </span>
                                            <?php if ($testpurchasID == 1) { ?>
                                                <button class="btn btn-primary 
                                        <?php

                                                if (date("Y-m-d H:i:s") < $test_data["startTime"] || empty($test_data["startTime"]) || empty($test_data["endTime"]) || $test_data["questionCount"] == 0) {
                                                    echo "disabled";
                                                } elseif (date("Y-m-d H:i:s") >= $test_data["endTime"]) {
                                                    echo "disabled";
                                                }

                                        ?>
                                        test_btn"
                                                    <?php

                                                    if (date("Y-m-d H:i:s") < $test_data["startTime"] || empty($test_data["startTime"]) || empty($test_data["endTime"]) || $test_data["questionCount"] == 0) {
                                                        echo ">Coming Soon";
                                                    } elseif (date("Y-m-d H:i:s") >= $test_data["endTime"]) {
                                                        echo ">Expired";
                                                    } else {
                                                        
                                                            $autoLoginData["password"] = $test_data["password"];
                                                            $autoLoginData["username"] = $test_data["userName"];
                                                            $autoLoginKey = base64_encode(json_encode($autoLoginData));  
                                                            echo "onClick(window.open('https://test.coprepedu.com/autologin/$autoLoginKey')');";
                                                        
                                                        echo ">Start Now";
                                                    }
                                                    ?>
                                                </button>
                                            <?php } else { ?>

                                                <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary
                                            
                                            <?php
                                                if (date("Y-m-d H:i:s") < $test_data["startTime"] || empty($test_data["startTime"]) || empty($test_data["endTime"]) || $test_data["questionCount"] == 0) {
                                                    echo "disabled";
                                                } elseif (date("Y-m-d H:i:s") >= $test_data["endTime"]) {
                                                    echo "disabled";
                                                }

                                            ?>
                                            test_btn" >
                                                        <?php

                                                        if (date("Y-m-d H:i:s") < $test_data["startTime"] || empty($test_data["startTime"]) || empty($test_data["endTime"]) || $test_data["questionCount"] == 0) {
                                                            echo "Coming Soon";
                                                        } elseif (date("Y-m-d H:i:s") >= $test_data["endTime"]) {
                                                            echo "Expired";
                                                        } else {
                                                            echo '<i class="fas fa-lock"></i> Unlock Now';
                                                        }
                                                        ?>
                                                    </button></a>
                                            <?php } ?>

                                        </div>
                                        <div class="test_body_footer">
                                            <span class="footer_details test_type"> <?php echo $test_data["testTypeTitle"]; ?></span>
                                            <span class="footer_details test_name"> <?php echo $testName; ?> - Test Series </span>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
</body>

</html>