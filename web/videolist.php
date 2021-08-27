<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

$_SESSION["videoMap"] = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Videos | Target With Alok</title>
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

            <form action="./videolist.php?catId=<?php echo $_GET["catId"]; ?>" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" id="search_box" placeholder="Enter video title" aria-label="Enter video title" aria-describedby="button-addon2">
                    <input type="hidden" name="catId" value="<?php if(isset($_GET['catId'])){echo $_GET['catId'];} ?>">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search Videos</button>
                </div>
            </form>

            <?php
                
                    $url =  Url::COURSE_VIDEO;
                    $data["courseId"] = $_SESSION["getcourseId"]; 
                    $data["filters"]["videoSubCategory"] = $_GET["catId"]??0; 
                    $data["filters"]["searchString"] = $_GET['search'] ?? "";
                    $callApi = new CallApi();
                    $response = $callApi->call($url, $data);
                    $response = json_decode($response, true);
                    $i = 0;

                    $videodata = $response["data"]["courseVideo"];

                    //coursemap me video ka data kyu rakha h video map saparate create kro dono me id same ho sakti h confilct aa jayega
                    if(!empty($videodata)){
                      ?>

            <div class="row g-4">
                <?php
                    
                    foreach($videodata as $videokey => $videovalue)
                    {   
                        $_SESSION["videoMap"][$videovalue["videoId"]]["title"] = $videovalue["title"];
                        $_SESSION["videoMap"][$videovalue["videoId"]]["eventDateTime"] = $videovalue["eventDateTime"];
                        $_SESSION["videoMap"][$videovalue["videoId"]]["url"] = $videovalue["url"];
                        $_SESSION["videoMap"][$videovalue["videoId"]]["fileUrl"] = $videovalue["fileUrl"];
                        $_SESSION["videoMap"][$videovalue["videoId"]]["pdfUrl"] = $videovalue["pdfUrl"];// ucaps me hi h, not necessary hr video me ho okay
                ?>

                <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <img src="<?php if(!empty($videovalue["thumbnail"])) { echo $videovalue["thumbnail"]; } else{ echo "assets/images/no image.png"; } ?>" class="video_thumb">
                        <div class="app-card-body p-3 has-card-actions">
                            <h4 class="app-doc-title truncate mb-0"> <?php echo $videovalue["title"]; ?> </h4><br>
                            <a href="watch.php?videoId=<?php echo $videovalue["videoId"]; ?>"><button class="btn" id="watch_btn"> <i class="fas fa-play"></i> &nbsp; Watch Now </button></a>
                            <!--//app-doc-meta-->
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>

                <?php

                    }
                } 
                else  
                    {
                        echo "No Videos Available";
                    }

                ?>

            </div>

        </div>

        <?php include("includes/footer.php"); ?>

    </div>
    <!--//app-wrapper-->

    <?php include("assets/scripts.php"); ?>

</body>

</html>