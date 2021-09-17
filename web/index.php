<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");
if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}
$_SESSION["courseMap"] = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> User Dashboard | <?php echo Constant::COMPANYNAME ?> </title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
</head>

<body class="app">
    <input style="display:none" value="dashboard" />
    <div class="loader-wrapper" id="loader2">
        <img src="assets/images/loader/loader.gif" class="loader">
    </div>

    <div class="app-wrapper" id="load">

        <?php include("includes/navbar.php"); ?>

        <div class="app-content pt-3 p-md-3 p-lg-4">

            <div class="row g-4">

                <?php

                if (isset($_SESSION["authtoken"])) {
                    $url =  Url::COURSE_LAYOUT;
                    $data["mycourses"] = "1";
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);

                    $layout = $response["data"]["layout"];

                    foreach ($layout as $row) {
                        $type = $row["type"];
                        $title = $row["title"];
                        $contentype = $row["contentType"];
                        $content = $row["content"];
                        // echo "<pre>";
                        // print_r($content);
                        // echo "</pre>";
                ?>

                        <div class="course_title">
                            <h1> <?php echo $title; ?> </h1>
                        </div>

                        <?php
                        foreach ($content as $key => $value) {
                            $_SESSION["courseMap"][$value["courseId"]]["purchased"] = $value["purchased"];
                            $_SESSION["courseMap"][$value["courseId"]]["courseName"] = $value["courseName"];
                            $_SESSION["courseMap"][$value["courseId"]]["description"] = $value["description"];
                            $_SESSION["courseMap"][$value["courseId"]]["thumbnail"] = $value["thumbnail"];
                            $_SESSION["courseMap"][$value["courseId"]]["price"] = $value["price"];
                            $_SESSION["courseMap"][$value["courseId"]]["mrp"] = $value["mrp"];
                            $_SESSION["courseMap"][$value["courseId"]]["lectureCount"] = $value["lectureCount"];
                            $_SESSION["courseMap"][$value["courseId"]]["duration"] = $value["duration"];
                            $_SESSION["courseMap"][$value["courseId"]]["discountPercent"] = $value["discountPercent"];

                        ?>

                            <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                                <div class="app-card app-card-doc shadow-sm h-100">
                                <a href="videopage.php?courseId=<?php echo $value["courseId"]; ?>"><img src="<?php echo $value["thumbnail"]; ?>" style="width: 100%; height:auto;"></a>                                    <div class="app-card-body p-3 has-card-actions">
                                        <?php if (!empty($value["isNew"])) { ?>
                                            <div class="new_course"> New </div><?php } ?>
                                        <h4 class="app-doc-title truncate mb-0" id="course_title"><a class="stretched-link" href="videopage.php?courseId=<?php echo $value["courseId"]; ?>"><?php echo $value["courseName"] ?></a></h4>
                                        <div class="app-doc-meta">
                                            <ul class="list-unstyled mb-0">
                                                <?php if ($value["purchased"] == 0 && ($value["price"] > 10 || $value["price"] == 0)) { ?>
                                                    <li id="course_price"><span class="text-muted" id="course_price">Price:</span> ₹<?php echo $value["price"]; ?></li>
                                                    <li id="course_mrp"><span class="text-muted" id="course_mrp"><strike>MRP:</span> ₹<?php echo $value["mrp"]; ?></strike></li>
                                                    <li id="course_discount"><span class="text-muted" id="course_discount">Discount:</span> ₹<?php echo $value["discountPercent"]; ?>%</li>
                                                <?php } else if ($value["purchased"] == 1) { ?>
                                                    <li id="course_price"><span class="text-muted" id="course_price">Validity:</span> <?php echo $value["validity"]; ?></li>
                                                    <li id="course_mrp"><span class="text-muted" id="course_mrp">Purchased on:</span> <?php echo $value["purchaseDate"]; ?></li>
                                                <?php } else if ($value["price"] > 0) {
                                                ?>
                                                    <li id="course_discount"><span class="text-muted" id="course_discount">Admission closed</span></li>
                                                <?php
                                                } ?>

                                            </ul>
                                        </div>
                                        <!--//app-doc-meta-->
                                    </div>
                                    <!--//app-card-body-->
                                </div>
                                <!--//app-card-->
                            </div>

                <?php

                            // if (++$i == 4) break;

                        }
                    }
                }
                ?>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>

    </div>
    <!--//app-wrapper-->

    <?php
    include("assets/scripts.php");
    ?>

    <!-- cd-tabs -->
    <script src="assets/js/util.js"></script>
    <!-- util functions included in the CodyHouse framework -->
    <script src="assets/js/main.js"></script>

</body>

</html>