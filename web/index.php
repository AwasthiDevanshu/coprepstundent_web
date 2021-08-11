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
    </head>

    <body class="app">

    <div class="loader-wrapper" id="loader2">
        <img src="assets/images/loader/loader.gif" class="loader">
    </div>

    <div class="app-wrapper" id="load">
    
    <?php include("includes/navbar.php"); ?>

                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        <h1 class="app-page-title">Dashboard</h1>
                    </div>

                    <div class="row g-4">

                        <?php
                        if (!is_writable(session_save_path())) {
                            echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
                        }

                            if(isset($_SESSION["authtoken"])){

                            $url = 'https://backend.coprepedu.com/candidate/homepage/getLayout';
                            $data[] = "";
                            $callApi = new CallApi();
                            $response = $callApi -> call($url, $data);
                            $response = json_decode($response,true);

                            $layout = $response["data"]["layout"];

                            echo "<pre>";
                            print_r($layout);
                            echo "</pre>";

                            foreach($layout as $row)
                            {
                                $type = $row["type"];
                                $title = $row["title"];
                                $contentype = $row["contentType"];
                                $content = $row["content"];

                                ?>
                            <div class="course_title">
                                <h1> <?php echo $title; ?> </h1>
                            </div>
                                <?php

                                foreach($content as $key => $value)
                                {   
                                    $_SESSION["purchased"] = $value["purchased"]; 
                                    $_SESSION["courseName"] = $value["courseName"];
                                    $_SESSION["description"] = $value["description"];
                                    $_SESSION["price"] = $value["price"];
                                    $_SESSION["mrp"] = $value["mrp"];

                        ?>

                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="app-card app-card-doc shadow-sm h-100">
                            <a href="videopage.php?courseId=<?php echo $value["courseId"]; ?>"><img src="<?php echo $value["thumbnail"]; ?>" style="width: 100%; height:auto;"></a>
                                <div class="app-card-body p-3 has-card-actions">  
                                    <h4 class="app-doc-title truncate mb-0"><a href="videopage.php?courseId=<?php echo $value["courseId"]; ?>"><?php echo $value["courseName"]; ?></a></h4>
                                    <div class="app-doc-meta">
                                        <ul class="list-unstyled mb-0">
                                            <li><span class="text-muted">Type:</span> Text</li>
                                            <li><span class="text-muted">Size:</span> 512KB</li>
                                            <li><span class="text-muted">Uploaded:</span> 3 mins ago</li>
                                            <?php echo "Purchase ID = ". $value["purchased"]; ?>
                                        </ul>
                                    </div><!--//app-doc-meta-->							    						    
                                </div><!--//app-card-body-->

                            </div><!--//app-card-->
                        </div>

                        <?php

                            // if (++$i == 4) break;

                            }}}

                            else
                            {
                                header("Location: login.php");
                                exit();
                            }

                        ?>
                    </div>
                </div>

            <?php include ("includes/footer.php"); ?>
	    
        </div><!--//app-wrapper-->

        <!-- Javascript -->          
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