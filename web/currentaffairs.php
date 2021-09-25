<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

error_reporting(0);
$per_page = 8;
$pageno = 1;

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if(Constant::PAGE_MAP["current_affairs"] == false)
{
    header("Location: 404.php");
    exit();
}

if (isset($_GET["pageno"])) {
    $pageno = $_GET["pageno"];
}

$_SESSION["currentaffairsmap"] = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Current Affairs | <?php echo Constant::COMPANYNAME ?></title>
    <link rel="stylesheet" href="assets/css/currentaffairs.css">
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
                <h1 class="app-page-title"> Current Affairs </h1>
            </div>

            <?php
            if (isset($_SESSION["authtoken"])) {
                require_once("assets/phpclasses/datefunction.php");
                $fromdate =  $_GET["fromDate"] ?? "2021-01-01";
                $todate =  $_GET["toDate"] ?? date("Y-m-d");
                validateDate($fromdate);
                validateDate($todate);
                $language = $_GET["language"]??"en";

                $url =  Url::CURRENT_AFFAIRS;
                $data["filters"]["from"] =  $fromdate;
                $data["filters"]["to"] =  $todate;
                $data["filters"]["langCode"] = $language;
                $data["limit"] = $per_page;
                $data["offset"] = ($pageno - 1) * $per_page;
                $data[] = "";
                $callApi = new CallApi();
                $response = $callApi->call($url, $data);
                $response = json_decode($response, true);

                $currentAffairs = $response["data"]["currentAffairs"];

                // echo "<pre>";
                // print_r($currentAffairs);
                // echo "</pre>";

                $i = 0;
                $record = $response["data"]["count"];
                $pagi = ceil($record / $per_page);

                $previous = $pageno - 1;
                $next = $pageno + 1;
            }
            ?>
            <div class="row g-4" id="news_row">

                <form action="" method="GET">
                    <div class="container" id="search_tab">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">From Date</label>
                                    <input type="date" name="fromDate" class="form-control" value="<?php if(isset($fromdate)){ echo $fromdate; } ?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">To Date</label>
                                    <input type="date" name="toDate" class="form-control" value="<?php if(isset($todate)){ echo $todate; }?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Select Language</label>
                                    <select class="form-select" name="language" aria-label="Default select example">
                                        <option selected value="en">English</option>
                                        <option value="hi">Hindi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary search_btn" type="submit"> Search </button>
                    </div>
                </form>

                <?php

                if(!empty($currentAffairs))
                {
                foreach ($currentAffairs as $key => $value) {
                    $_SESSION["currentaffairsmap"][$value["currentAffairId"]]["title"] = $value["title"];
                    $_SESSION["currentaffairsmap"][$value["currentAffairId"]]["smallBody"] = $value["smallBody"];
                    $_SESSION["currentaffairsmap"][$value["currentAffairId"]]["body"] = $value["body"];
                    $_SESSION["currentaffairsmap"][$value["currentAffairId"]]["imageUrl"] = $value["imageUrl"];
                ?>
                    <div class="col-6 col-md-4 col-xl-3 col-xxl-2" id="news_col">
                        <div class="app-card app-card-doc shadow-sm h-100">
                            <div class="app-card-body p-3 has-card-actions">
                                <?php
                                if (!empty($value["imageUrl"])) {
                                ?>
                                    <a href="postpage.php?postid=<?php echo $value["currentAffairId"]; ?>"><img src="<?php echo $value["imageUrl"]; ?>" class="news_thumb"></a>
                                <?php
                                } else {
                                ?>
                                    <a href="postpage.php?postid=<?php echo $value["currentAffairId"]; ?>"><img src="./assets/images/no image.png" class="news_thumb"></a>
                                <?php } ?>

                                <h4 class="app-doc-title truncate mb-0" id="news_title"> <?php echo $value["title"]; ?> </h4>
                                <div class="app-doc-meta">
                                    <p class="news_desc">
                                        <?php echo $value["smallBody"]; ?>
                                    </p>
                                </div>
                                <a href="postpage.php?postid=<?php echo $value["currentAffairId"]; ?>"><button class="btn btn-primary" id="news_btn"> Read More </button></a>
                            </div>
                        </div>
                    </div>
                <?php
                    //     if(++$i == 6)
                    // {
                    //     break;
                    // }
                }}
                else
                {
                    ?>

                    <img src="assets/images/no record.png" class="no_record_img">
                    <h4 style='text-align:center;color:black'>No Record Found </h4>

                    <?php
                }
                ?>

                <nav aria-label="...">
                    <ul class="pagination pagination-sm">
                        <li class="page-item <?php if ($pageno == 1) {
                                                    echo "disabled";
                                                } ?>"><a class="page-link" href="currentaffairs.php?pageno=<?php echo "1";
                                                                                                            echo "&fromDate=" . $fromdate;
                                                                                                            echo "&toDate=" . $todate; echo "&language=" . $language;?>">First</a></li>
                        <li class="page-item <?php if ($pageno == 1) {
                                                    echo "disabled";
                                                } ?>"><a class="page-link" href="currentaffairs.php?pageno=<?php echo $previous;
                                                                                                            echo "&fromDate=" . $fromdate;
                                                                                                            echo "&toDate=" . $todate; echo "&language=" . $language;?>">Previous</a></li>
                        <?php for ($j = 1; $j <= $pagi; $j++) {
                            if ($pageno < $j + 3 && $pageno > $j - 3) {
                        ?>
                                <li class="page-item <?php if ($pageno == $j) {
                                                            echo "active";
                                                        } ?>"><a class="page-link" href="currentaffairs.php?pageno=<?php echo $j;
                                                                                                                    echo "&fromDate=" . $fromdate;
                                                                                                                    echo "&toDate=" . $todate; echo "&language=" . $language;?>"><?php echo $j; ?></a></li>
                        <?php }
                        } ?>
                        <li class="page-item <?php if ($pagi == $pageno) {
                                                    echo "disabled";
                                                } ?>"><a class="page-link" href="currentaffairs.php?pageno=<?php echo $next;
                                                                                                            echo "&fromDate=" . $fromdate;
                                                                                                            echo "&toDate=" . $todate; echo "&language=" . $language;?>">Next</a></li>
                        <li class="page-item <?php if ($pagi == $pageno) {
                                                    echo "disabled";
                                                } ?>"><a class="page-link" href="currentaffairs.php?pageno=<?php echo $pagi;
                                                                                                    echo "&fromDate=" . $fromdate;
                                                                                                    echo "&toDate=" . $todate; echo "&language=" . $language;?>">Last</a></li>
                    </ul>
                </nav>
            </div>

            <?php include("includes/footer.php"); ?>

        </div>
        <?php
        include("assets/scripts.php");
        ?>
</body>

</html>