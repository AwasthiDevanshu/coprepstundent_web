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
                $url =  Url::CURRENT_AFFAIRS;
                $data["filters"]["fromDate"] = "21-08-2021"; //show a filter above to switch lang and pass its value "langCode":"en","hi" to get lang specific
                // instead of index pass to another page, simply open up a modal / overlay
                $callApi = new CallApi();
                $response = $callApi->call($url, $data);
                $response = json_decode($response, true);

                $currentAffairs = $response["data"]["currentAffairs"];
                $newsindex = $currentAffairs["0"];   //kya use h iska
                $i = 0;
                

            
            }
            ?>
            <div class="row g-4" id="news_row">

                <?php
                    foreach($currentAffairs as $key => $value)
                    {
                ?>
                <div class="col-6 col-md-4 col-xl-3 col-xxl-2" id="news_col">
                    <div class="app-card app-card-doc shadow-sm h-100">
                        <div class="app-card-body p-3 has-card-actions">
                            <?php
                                if(!empty($value["imageUrl"]))
                                {
                            ?>
                            <a href="postpage.php?indexID=<?php echo $key; ?>"><img src="<?php echo $value["imageUrl"]; ?>" class="news_thumb"></a> 
                            <?php
                                }

                                else
                                {
                            ?>
                            <a href="postpage.php?indexID=<?php echo $key; ?>"><img src="./assets/images/no image.png" class="news_thumb"></a>
                            <?php } ?>

                            <h4 class="app-doc-title truncate mb-0" id="news_title"> <?php echo $value["title"]; ?> </h4>
                            <div class="app-doc-meta">
                                <p class="news_desc">
                                    <?php echo $value["smallBody"]; ?>
                                </p>
                            </div>
                            <a href="postpage.php?indexID=<?php echo $key; ?>"><button class="btn btn-primary" id="news_btn"> Read More </button></a>
                            <!--//app-doc-meta-->
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <?php
                //     if(++$i == 6)
                // {
                //     break;
                // }
            }
                ?>
            </div>

            <?php include("includes/footer.php"); ?>

        </div>
        <!--//app-wrapper-->

        <?php
        include("assets/scripts.php");
        ?>

</body>

</html>