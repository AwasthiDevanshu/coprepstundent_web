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
                    $data["subCatId"] = $_GET['subCatId'] ?? 0;
                    $data["courseId"] = $_GET['courseId'];
                    $callApi = new CallApi();
                    $response2 = $callApi->call($url, $data);
                    $response2 = json_decode($response2, true);

                    $url3 = Url::COURSE_NOTES;
                    $data3["courseId"] = $_GET['courseId'];
                    $callApi = new CallApi();
                    $response2 = $callApi->call($url3, $data3);
                    $response2 = json_decode($response2, true);

                    $notecatlist  = $response2["data"]["notesList"];

                    foreach ($notecatlist as $key3 => $notecat) {
                        $notesList[$notecat["catId"]][] = $notecat;
                    }

                    if (!empty($_GET['courseId'])) {
                        $_SESSION["getcourseId"] = $_GET["courseId"];
                    }

                    $purchasedid = $_SESSION["courseMap"][$data["courseId"]]["purchased"] ?? null;
                    $coursename = $_SESSION["courseMap"][$data["courseId"]]["courseName"] ?? null;
                    $description = $_SESSION["courseMap"][$data["courseId"]]["description"] ?? null;
                    $thumbnail = $_SESSION["courseMap"][$data["courseId"]]["thumbnail"] ?? null;
                    $lectureCount = $_SESSION["courseMap"][$data["courseId"]]["lectureCount"] ?? null;
                    $duration = $_SESSION["courseMap"][$data["courseId"]]["duration"] ?? null;
                    $price = $_SESSION["courseMap"][$data["courseId"]]["price"] ?? null;
                    $mrp = $_SESSION["courseMap"][$data["courseId"]]["mrp"] ?? null;

                    if (!empty($purchasedid)) {
                        $_SESSION["videopurchased"] = $purchasedid;
                    }

                    if ($purchasedid == null) {
                        echo "404 Not Found";
                        exit();
                    }

                    if ($purchasedid == 1) {

            ?>

                        <div class="container-xl">
                            <h1 class="app-page-title"> <?php echo $coursename; ?> </h1>
                        </div>

                        <?php

                        $url2 = Url::COURSE_CAT;
                        $data2["courseId"] = $_GET['courseId'];
                        $callApi = new CallApi();
                        $response = $callApi->call($url2, $data2);
                        $response = json_decode($response, true);

                        $count = 0;
                        $tab_menu = "";
                        $categoryList = $response["data"]["categoryList"];

                        ?>

                        <img src="<?php echo $thumbnail; ?>" class="buy_course_thumb"> <br>
                        <div class="icon_cont">
                            <div class="lecture_icon">
                                <p> <i class="fas fa-stream"></i> <?php echo $lectureCount; ?> Lectures </p>
                            </div>
                            <div class="duration_icon">
                                <p> <i class="fas fa-clock"></i> <?php echo $duration; ?>mins. Per Lectures </p>
                            </div>
                        </div>
                        <div class="container">
                            <ul class="nav nav-pills">
                                <?php
                                $htmlSubCatList =  "";
                                $htmlNotesList = "";
                                $activeKey = $_GET["activeKey"] ?? 0;
                                foreach ($categoryList as $key => $category) {
                                    $active  = 0;
                                    $panediv =  '<div id="' . "course" . $category["id"] . '" class="tab-pane fade show">';

                                    if ($key == $activeKey) {
                                        $panediv =  '<div id="' . "course" . $category["id"] . '" class="tab-pane fade show in active">';

                                        $active = 1;
                                    } ?>
                                    <li class='<?php echo  $active == 1 ? "active" : "" ?>'><a data-toggle="tab" href="#<?php echo "course" . $category["id"]; ?>"> <?php echo $category["categoryName"]; ?></a></li>
                                <?php
                                    $htmlSubCatList .= $panediv;

                                    $SubCatList  = $category["subCategory"];
                                    $subCAthtml = '';
                                    $notCAthtml = '';

                                    foreach ($SubCatList as $key2 => $subCat) {
                                        $subCAthtml .= '<a href= "videolist.php?catId=' . $subCat['subCategoryId'] . '"><div class="folder"><span><i class="fas fa-folder" style="font-size:15pt;color:green;"></i>&nbsp;&nbsp;' . $subCat['subCategory'] . "&nbsp;&nbsp;(" . $subCat["videoCount"] . " Videos)</span><span class='arrow_icon'><i class='fas fa-chevron-right'></i></span></div></a>";
                                    }

                                    $notes =  $notesList[$category["id"]] ?? [];

                                    foreach ($notes as $key4 => $notesvalue) {
                                        $notCAthtml .= '<a href= "' . $notesvalue["url"] . '" target="_blank"><div class="folder"><span><i class="fas fa-folder" style="font-size:15pt;color:green;"></i>&nbsp;&nbsp;' . $notesvalue['title'] . "&nbsp;&nbsp; Click To Get Notes </span><span class='arrow_icon'><i class='fas fa-chevron-right'></i></span></div></a>";
                                    }

                                    $htmlSubCatList .= $subCAthtml;
                                    $htmlSubCatList .= $notCAthtml;
                                    $htmlSubCatList .= ' </div>';
                                }
                                ?>
                            </ul>

                            <div class="tab-content">

                                <?php echo $htmlSubCatList; ?>

                            </div>
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
                                    <?php
                                    if (!empty($description)) {
                                        echo $description;
                                    } else {
                                        echo " No Description Available ";
                                    }
                                    ?>
                                </p>
                            </div>

                            <div class="bottom_btn">
                                <div class="demo_video">
                                    <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary demo_btn"> See Demo Video </button></a>
                                </div>

                                <div class="course_price">
                                    <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. <?php echo $mrp ?> </strike> Rs. <?php echo $price; ?>/- </h3>
                                </div>

                                <div class="buy_now">
                                    <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary buy_btn"> Buy Course </button></a>
                                </div>
                            </div>
                        </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>

    <div class="bottom_btn mobile_bottom">
        <div class="course_price">
            <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. <?php echo $mrp ?> </strike> Rs. <?php echo $price; ?>/- </h3>
        </div>

        <div class="demo_video">
            <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary demo_btn"> See Demo Video </button></a>
        </div>

        <div class="buy_now">
            <a href="<?php echo Constant::ANDROID_APP_LINK; ?>" target="_blank"><button class="btn btn-primary buy_btn"> Buy Course </button></a>
        </div>
    </div>

<?php
                    }
                }
            } ?>
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