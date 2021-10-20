<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if (Constant::PAGE_MAP["testresult"] == false) {
    header("Location: 404.php");
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
    <link rel="stylesheet" type="text/css" href="assets/css/testresult.css">
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
                <h1 class="app-page-title" id="page_title"> My Result </h1>
            </div>
            <div class="container-xl" id="test_cont">

                <?php

                if (isset($_GET["testAttemptId"])) {
                    $url =  Url::TEST_RESULT_URL;
                    $data["testAttemptId"] = $_GET["testAttemptId"];
                    $data["getToppers"] = true;
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);

                    $totalExam_data = $response["data"];
                    $module_data = array_values($response["data"]["moduleData"]);
                    $test_data = $response["data"]["testData"];

                    $testSeries = $_GET["testSeries"];
                    $testName = $_GET["testName"];

                    // echo "<pre>";
                    // print_r($totalExam_data);
                    // echo "</pre>";

                ?>

                    <div class="my_rank_cont">
                        <div class="container">
                            <div class="row">
                                <div class="col-10 mb-2">
                                    <h3 class="testSeries_name"> Test Series: <?php echo $testSeries; ?> </h3>
                                    <h6 class="testName_name"> Test Name: <?php echo $testName; ?> </h6>
                                </div>
                                <div class="col-3 mb-3">
                                    <div class="rank_col">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-trophy"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> My <br>Rank </h6>
                                            <h2> <?php if (!empty($totalExam_data["rank"])) {
                                                        echo $totalExam_data["rank"];
                                                    } else {
                                                        echo "N/A";
                                                    } ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mb-3">
                                    <div class="rank_col" id="totalAttempts">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-edit"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Total Attemptes </h6>
                                            <h2><?php if (!empty($totalExam_data["totalAttempts"])) {
                                                    echo $totalExam_data["totalAttempts"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-3">
                                    <div class="rank_col" id="attemptedQuestions">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-pencil-alt"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Attempted Questions </h6>
                                            <h2><?php if (!empty($test_data["attemptedQuestions"])) {
                                                    echo $test_data["attemptedQuestions"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-3">
                                    <div class="rank_col" id="totalQuestions">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-question"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Total Questions </h6>
                                            <h2><?php if (!empty($test_data["totalQuestions"])) {
                                                    echo $test_data["totalQuestions"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-2">
                                    <div class="rank_col" id="correctAnswers">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-check"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Correct Answers </h6>
                                            <h2><?php if (!empty($test_data["correctAnswers"])) {
                                                    echo $test_data["correctAnswers"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-2">
                                    <div class="rank_col" id="timeTaken">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-history"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Time Taken </h6>
                                            <h2><?php if (!empty($test_data["timeTaken"])) {
                                                    echo $test_data["timeTaken"] . "M";
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-2">
                                    <div class="rank_col" id="maxScore">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-sort-numeric-up-alt"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> Max<br>Score </h6>
                                            <h2><?php if (!empty($test_data["maxScore"])) {
                                                    echo $test_data["maxScore"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 mb-2">
                                    <div class="rank_col" id="score">
                                        <div class="rank_icon_col">
                                            <p><i class="fas fa-bolt"></i></p>
                                        </div>
                                        <div class="rank_text_col">
                                            <h6> My<br>Score </h6>
                                            <h2><?php if (!empty($test_data["score"])) {
                                                    echo $test_data["score"];
                                                } else {
                                                    echo "N/A";
                                                } ?></h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- <button class="btn btn-primary show_module" onclick="moduleShow()" id="show_btn"> Show Module Wise Result </button> -->

                    <div id="module_cont">
                        <h1 class="module_text"> Test Module </h1>

                        <ul class="nav nav-pills mb-3" id="test_piils">
                            <?php
                            $htmlresult =  "";
                            $resultactiveKey = $_GET["resultactiveKey"] ?? 0;
                            foreach ($module_data as $key => $module_content) {
                                $active = 0;
                                $resultpanediv =  '<div id="' . "module" . $module_content["moduleId"] . '" class="tab-pane fade show">';

                                if ($key == $resultactiveKey) {
                                    $resultpanediv =  '<div id="' . "module" . $module_content["moduleId"] . '" class="tab-pane fade show active">';
                                    $active = 1;
                                }
                            ?>
                                <li class="nav-item" id="nav_exam_tabs">
                                    <a data-bs-toggle="tab" class="nav-link <?php echo  $active == 1 ? "active" : "" ?>" href="#<?php echo "module" . $module_content["moduleId"]; ?> ">
                                        <?php echo $module_content["moduleName"]; ?></a>
                                </li>
                            <?php

                                $htmlresult .= $resultpanediv;
                                $subHtml = "";
                                $module_content_data = "";

                                $subHtml .= '<div class="result_cont">
                                <div class="result_inner_cont">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-8" id="module_title">
                                                <h3 class="exam_title"> ' . $module_content["moduleName"] . ' </h3>
                                            </div>
                                            <div class="col-4" id="module_topbtn">
                                                <div class="inner_col">
                                                    <div class="exam_duration">
                                                        <i class="far fa-clock"></i> 30 Min
                                                    </div>
                                                    <div class="exam_marks">
                                                        <i class="far fa-file-alt"></i> ' . $module_content["maxScore"] . ' Marks
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col exam_desc">
                                                <h5> Test Series: ' . $testSeries . ' </h5>
                                                <h5> Test Name: ' . $testName . '</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container" id="exam_data_cont">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-question"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Total Questions </h6>
                                                        <h2> ' . $module_content["totalQuestions"] . ' </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-edit"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Attempted Questions </h6>
                                                        <h2> ' . $module_content["attemptedQuestions"] . ' </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-check"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Correct Answers </h6>
                                                        <h2> ' . $module_content["correctAnswers"] . ' </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container" id="exam_data_cont">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-history"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Time Taken </h6>
                                                        <h2> ' . $module_content["timeTaken"] . ' Min </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-pen-fancy"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Max Score </h6>
                                                        <h2> ' . $module_content["maxScore"] . ' </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="cont1">
                                                    <div class="icon_cont">
                                                        <p><i class="fas fa-bolt"></i></p>
                                                    </div>
                                                    <div class="data_cont">
                                                        <h6> Your Score </h6>
                                                        <h2> ' . $module_content["score"] . ' </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                                $htmlresult .= $subHtml;
                                $htmlresult .= ' </div>';
                            } ?>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <?php echo $htmlresult; ?>
                        </div>

                    </div>

                    <h2 class="toppers_title_head"> Top 05 Rank </h2>

                    <?php

                    // echo "<pre>";
                    // print_r($response);
                    // echo "</pre>";

                    $toppers = $response["data"]["toppers"];

                    foreach ($toppers as $toppers_key => $toppers_data) {
                        $candidate_data = $toppers_data["candiateData"];
                        $test_analysis = $toppers_data["testAnalysis"];
                        $toppers_test_data = $toppers_data["testAnalysis"]["testData"];

                    ?>

                        <div class="container">
                            <div class="row" id="toppers_row">
                                <div class="col" id="rank_no">
                                    <h4> <i class="fas fa-medal" id="rank_icon"></i> <?php echo $test_analysis["rank"]; ?> </h4>
                                </div>

                                <div class="col" id="rank_user_img">
                                    <img src="assets/images/user.png" alt="user image">
                                </div>

                                <div class="col" id="rank_user_name">
                                    <h4> <?php echo $candidate_data["name"]; ?> </h4>
                                    <p> <?php echo $candidate_data["email"]; ?> </p>
                                </div>

                                <div class="col" id="rank_user_st">
                                    <div class="rank_user_score">
                                        <h4> Score </h4>
                                        <p> <i class="fas fa-bolt"></i> <?php echo $toppers_test_data["score"]; ?> </p>
                                    </div>

                                    <div class="rank_user_time">
                                        <h4> Time Taken </h4>
                                        <p> <i class="fas fa-clock"></i> <?php echo $toppers_test_data["timeTaken"]; ?>min </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
</body>

</html>