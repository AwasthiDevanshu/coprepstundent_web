<?php
    require_once("assets/phpclasses/callApi.php");
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Web Dashboard</title>
        <link rel="stylesheet" href="assets/css/dashboard.css">
        <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
        <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
        <link rel="stylesheet" type="text/css" href="assets/css/videopage.css">
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
                
                if(isset($_SESSION["authtoken"])){

                    $url = 'https://backend.coprepedu.com/candidate/homepage/getLayout';
                    $url2 = 'https://backend.coprepedu.com/candidate/candidate/getCourseVideos';
                    $data["courseId"] = $_GET['courseId'];
                    $dataid = [];
                    $callApi = new CallApi();
                    $response = $callApi -> call($url, $dataid);
                    $response = json_decode($response,true);
                    $response2 = $callApi -> call($url2, $data);
                    $response2 = json_decode($response2,true);

                    $layout = $response["data"]["layout"];
                    $content = $layout["0"]["content"];



                    foreach ($content as $key1 => $value1)
                    {
                        $purchaseid = $value1["purchased"];
                    }

                    // echo "<pre>";
                    // print_r($response);
                    // echo "</pre>";

                    if($purchaseid == 1) { ?>

                    <div class="container-xl">
                        <h1 class="app-page-title"> Video Course </h1>
                    </div>
                    
                    <div class="row g-4">
                    </div>
                    <?php } ?>

                    <?php if($purchaseid == 0) { ?>

                    <div class="container-xl">
                        <h1 class="app-page-title"> Buy Course </h1>

                        <img src="assets/images/background/background-1.jpg" class="buy_course_thumb"> <br>
                        <h1 class="course_name"> <?php echo $_SESSION["courseName"] ?> </h1>
                        <div class="icon_cont">
                            <div class="lecture_icon">
                                <p> <i class="fas fa-stream"></i> 360 Lectures </p>
                            </div>
                            <div class="duration_icon">
                                <p> <i class="fas fa-clock"></i> 60mins. Per Lectures </p>
                            </div>
                        </div>
                        <div class="description_box">
                            <p> 
                                <?php if(!empty($_SESSION["description"])) { 
                                echo $_SESSION["description"];}
                                else{
                                    echo " No Description Available ";
                                } ?> </p>
                        </div>

                        <div class="bottom_btn">
                            <div class="demo_video">
                                <button class="btn btn-primary demo_btn"> See Demo Video </button>
                            </div>

                            <div class="course_price">
                                <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. 7000 </strike>  Rs. 6000/- </h3>
                            </div>

                            <div class="buy_now">
                                <button class="btn btn-primary buy_btn"> Buy Course </button>
                            </div>
                        </div>

                        <div class="bottom_btn mobile_bottom">
                            <div class="course_price">
                                <h3> <strike style="font-size: 14pt; margin-right:10px;color:grey;font-weight:400;"> MRP. 7000 </strike>  Rs. 6000/- </h3>
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
            <?php }}} ?>
            </div>

            <?php include ("includes/footer.php"); ?>
        </div>

        <script src="assets/plugins/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Charts JS -->
        <script src="assets/plugins/chart.js/chart.min.js"></script> 
        <script src="assets/js/index-charts.js"></script> 
        
        <!-- Page Specific JS -->
        <script src="assets/js/app.js"></script>
        <?php
	    include("assets/scripts.php");
        ?>
    </body>
</html>