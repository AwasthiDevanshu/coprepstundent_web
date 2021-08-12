<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Web Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" type="text/css" href="assets/css/videopage.css">
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

            <?php

            if (isset($_GET['courseId'])) {

                if (isset($_SESSION["authtoken"])) {

                    $url = Url::COURSE_VIDEO;
                    $data["subCatId"] = $_GET['subCatId']??0;
                    $data["courseId"] = $_GET['courseId'];
                    $callApi = new CallApi();
                    $response2 = $callApi->call($url, $data);
                    $response2 = json_decode($response2, true);

                    $purchasedid = $_SESSION["courseMap"][$data["courseId"]]["purchased"] ?? null;
                    $coursename = $_SESSION["courseMap"][$data["courseId"]]["courseName"] ?? null;
                    $description = $_SESSION["courseMap"][$data["courseId"]]["description"] ?? null;
                    $thumbnail = $_SESSION["courseMap"][$data["courseId"]]["thumbnail"] ?? null;
                    $lectureCount = $_SESSION["courseMap"][$data["courseId"]]["lectureCount"] ?? null;
                    $duration = $_SESSION["courseMap"][$data["courseId"]]["duration"] ?? null;
                    $price = $_SESSION["courseMap"][$data["courseId"]]["price"] ?? null;
                    $mrp = $_SESSION["courseMap"][$data["courseId"]]["mrp"] ?? null;

                    // echo "<pre>";
                    // print_r($response);
                    // echo "</pre>";

                    if ($purchasedid == null) {
                        echo "404 Not Found";
                        exit();
                    }

                    if ($purchasedid == 1) { ?>

                        <div class="container-xl">
                            <h1 class="app-page-title"> Video Course </h1>
                        </div>

                        <?php

                        $url2 = "https://backend.coprepedu.com/course/course/getCourseCategories";
                        $data2["courseId"] = $_GET['courseId'];
                        $callApi = new CallApi();
                        $response = $callApi->call($url2, $data2);
                        $response = json_decode($response, true);

                        // echo "<pre>";
                        // print_r($response["data"]);
                        // echo "</pre>";

                        $categoryList = $response["data"]["categoryList"];

                        ?>

                        <img src="<?php echo $thumbnail; ?>" class="buy_course_thumb"> <br>
                        <h1 class="course_name"> <?php echo $coursename; ?> </h1>
                        <div class="icon_cont">
                            <div class="lecture_icon">
                                <p> <i class="fas fa-stream"></i> <?php echo $lectureCount; ?> Lectures </p>
                            </div>
                            <div class="duration_icon">
                                <p> <i class="fas fa-clock"></i> <?php echo $duration; ?>mins. Per Lectures </p>
                            </div>
                        </div>
                        <ul class="nav nav-pills">
                            <?php
                            $htmlSubCatList =  "";
                            $activeKey = $_GET["activeKey"]??0;
                            foreach ($categoryList as $key => $category) {
                                $active  = 0;
                                $panediv =  '<div id="'.$key.'" class="tab-pane fade">';

                                if ($key == $activeKey) {
                                    $panediv =  '<div id="'.$key.'" class="tab-pane fade in active">';

                                    $active = 1;
                                } ?>
                                <li class='<?php $active = 1 ? "active" : "" ?>'><a data-toggle="tab"  href="#<?php echo $key.'">'. $category["categoryName"]?></a></li>
                            <?php
                                $htmlSubCatList .= $panediv;

                                $SubCatList  = $category["subCategory"];
                                $subCAthtml = '';
                                foreach ($SubCatList as $key2 => $subCat) {
                                    $subCAthtml .= "<list id  = '" . $subCat['subCategoryId'] . "'>" . $subCat['subCategory'] . "</list>";
                                }
                                $htmlSubCatList .= $subCAthtml;
                                $htmlSubCatList .= ' </div>';
                            } ?>
                        </ul>

                        
<div class="tab-content">
                        <?php echo $htmlSubCatList; ?>
                        </div>
                        <div class="row g-4">
                        </div>
                    <?php } ?>

                    <?php if ($purchasedid == 0) { ?>

                        <div class="container-xl">
                            <h1 class="app-page-title"> Buy Course </h1>

                            <img src="<?php echo $thumbnail; ?>" class="buy_course_thumb"> <br>
                            <h1 class="course_name"> <?php echo $coursename; ?> </h1>
                            <div class="icon_cont">
                                <div class="lecture_icon">
                                    <p> <i class="fas fa-stream"></i> <?php echo $lectureCount; ?> Lectures </p>
                                </div>
                                <div class="duration_icon">
                                    <p> <i class="fas fa-clock"></i> <?php echo $duration; ?>mins. Per Lectures </p>
                                </div>
                            </div>
                            <div class="description_box">
                                <p>
                                    <?php if (!empty($description)) {
                                        echo $description;
                                    } else {
                                        echo " No Description Available ";
                                    } ?> </p>
                            </div>

                            <div class="bottom_btn">
                                <div class="demo_video">
                                    <button class="btn btn-primary demo_btn"> See Demo Video </button>
                                </div>

                                <div class="course_price">
                                    <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. <?php echo $mrp ?> </strike> Rs. <?php echo $price; ?>/- </h3>
                                </div>

                                <div class="buy_now">
                                    <button class="btn btn-primary buy_btn"> Buy Course </button>
                                </div>
                            </div>

                            <div class="bottom_btn mobile_bottom">
                                <div class="course_price">
                                    <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. <?php echo $mrp ?> </strike> Rs. <?php echo $price; ?>/- </h3>
                                </div>

                                <div class="demo_video">
                                    <button class="btn btn-primary demo_btn"> See Demo Video </button>
                                </div>

                                <div class="buy_now">
                                    <button class="btn btn-primary buy_btn"> Buy Course </button>
                                </div>
                            </div>

                        </div>

                        <div class="row g-4">
                        </div>
            <?php }
                }
            } ?>
        </div>

        <?php include("includes/footer.php"); ?>
    </div>

    <?php
    include("assets/scripts.php");
    ?>

    <!-- cd-tabs -->
    <script src="assets/js/util.js"></script>
    <!-- util functions included in the CodyHouse framework -->
    <script src="assets/js/main.js"></script>

</body>

</html>