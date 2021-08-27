<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Web Dashboard</title>
    <link rel="stylesheet" href="assets/css/postpage.css">
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
                <h1 class="app-page-title"> Current Affairs Title </h1>
            </div>
            <?php
            if (isset($_SESSION["authtoken"])) {
                $url =  Url::CURRENT_AFFAIRS;
                $data[] = "";
                $callApi = new CallApi();
                $response = $callApi->call($url, $data);
                $response = json_decode($response, true);
                $indexID = $_GET['indexID'];

                $currentAffairs = $response["data"]["currentAffairs"];
                $newsindex = $currentAffairs[$indexID];
            }

            if (!empty($newsindex["imageUrl"])) {
            ?>
                <div class="post_thumb" style="background-image: url('<?php echo $newsindex["imageUrl"]; ?>');">
                    <div class="post_thumb_overlay"></div>
                </div>
            <?php
            } else {
            ?>

                <div class="post_thumb" style="background-image: url('./assets/images/background/background-3.jpg');">
                    <div class="post_thumb_overlay"></div>
                </div>

            <?php
            }
            ?>
            <center>
                <?php
                    if (!empty($newsindex["imageUrl"])) {
                ?>
                <img src="<?php echo $newsindex["imageUrl"]; ?>" class="postpage_thumb">
                <?php } 
                else
                {
                ?>
                <img src="./assets/images/background/background-3.jpg" class="postpage_thumb">
                <?php } ?>
                <h1 class="post_title"> <?php echo $newsindex["title"] ?> </h1>
            </center>
            <div class="post_text">
                <?php echo $newsindex["body"] ?>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>
    <!--//app-wrapper-->

    <?php
    include("assets/scripts.php");
    ?>

</body>

</html>