<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if (Constant::PAGE_MAP["postpage"] == false) {
    header("Location: 404.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Current Affairs | <?php echo Constant::COMPANYNAME ?> </title>
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
            <?php
            // https://backend.coprepedu.com/candidate/common/getCurrentAffairs use this to get single affair pass data":{"currentAffairId":"1263"}
            if (!empty($_GET["postid"])) {

                $imageURL = $_SESSION["currentaffairsmap"][$_GET["postid"]]["imageUrl"];
                $posttitle = $_SESSION["currentaffairsmap"][$_GET["postid"]]["title"];
                $postsmallBody = $_SESSION["currentaffairsmap"][$_GET["postid"]]["smallBody"];
                $postbody = $_SESSION["currentaffairsmap"][$_GET["postid"]]["body"];
            }

            if (!empty($imageURL)) {
            ?>
                <div class="post_thumb" style="background-image: url('<?php echo $imageURL; ?>');">
                    <div class="post_thumb_overlay"></div>
                </div>
            <?php
            } else {
            ?>

                <div class="post_thumb" style="background-image: url('./assets/images/no image.png');">
                    <div class="post_thumb_overlay"></div>
                </div>

            <?php
            }
            ?>
            <?php
            if (!empty($imageURL)) {
            ?>
                <img src="<?php echo $imageURL; ?>" class="postpage_thumb">
            <?php } else {
            ?>
                <img src="./assets/images/no image.png" class="postpage_thumb">
            <?php } ?>
            <h1 class="post_title"> <?php echo $posttitle; ?> </h1>

            <div class="post_text">
                <?php echo $postbody ?>
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