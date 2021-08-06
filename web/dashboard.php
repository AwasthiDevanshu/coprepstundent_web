<?php
	include("includes/navbar.php");
    require_once("assets/phpclasses/callApi.php");
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Web Dashboard</title>
    </head>

    <body class="app">

        <div class="app-wrapper">
            
                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        <h1 class="app-page-title">Dashboard</h1>
                    </div>

                    <div class="row g-4">

                        <?php

                            if(isset($_SESSION["authtoken"])){

                            $url = 'https://backend.coprepedu.com/candidate/homepage/getLayout';
                            $data[] = "";
                            $callApi = new CallApi();
                            $response = $callApi -> call($url, $data);
                            $response = json_decode($response,true);

                            print_r($response);

                            $layout = $response["data"]["layout"];
                            foreach($layout as $row)
                            {
                                $type = $row["type"];
                                $title = $row["title"];
                                $contentype = $row["contentType"];
                                $content = $row["content"];

                                foreach($content as $key => $value)
                            { 

                        ?>

                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="app-card app-card-doc shadow-sm h-100">
                                <div class="app-card-thumb-holder p-3">
                                    <span class="icon-holder">
                                        <img src="<?php echo $value["thumbnail"]; ?>">
                                    </span>
                                    <!-- <span class="badge bg-success">NEW</span> -->
                                    <a class="app-card-link-mask" href="#file-link"></a>
                                </div>
                                <div class="app-card-body p-3 has-card-actions">
                                    
                                    <h4 class="app-doc-title truncate mb-0"><a href="#file-link"><?php echo $value["courseName"]; ?></a></h4>
                                    <div class="app-doc-meta">
                                        <ul class="list-unstyled mb-0">
                                            <li><span class="text-muted">Type:</span> Text</li>
                                            <li><span class="text-muted">Size:</span> 512KB</li>
                                            <li><span class="text-muted">Uploaded:</span> 3 mins ago</li>
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
                                echo "Session Expired";
                            }

                        ?>
                    </div>
                </div>

            <footer class="app-footer">
                <div class="container text-center py-3">
                    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                    <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
                </div>
            </footer><!--//app-footer-->
	    
        </div><!--//app-wrapper-->

        <!-- Javascript -->          
        <script src="assets/plugins/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Charts JS -->
        <script src="assets/plugins/chart.js/chart.min.js"></script> 
        <script src="assets/js/index-charts.js"></script> 
        
        <!-- Page Specific JS -->
        <script src="assets/js/app.js"></script>

    </body>
</html>

<?php
	include("assets/scripts.php");
?>