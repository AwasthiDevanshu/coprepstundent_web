<?php
require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");

if (!isset($_SESSION["authtoken"])) {
    header("Location: login.php");
    exit();
}

if(Constant::PAGE_MAP["watch"] == false)
{
    header("Location: 404.php");
    exit();
}

if($_SESSION["videopurchased"] == 0)
{
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Videos | <?php echo Constant::COMPANYNAME ?> </title>
    <link rel="stylesheet" href="assets/css/watch.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <script src="assets/js/playerjs.js" type="text/javascript"></script>
</head>

<body class="app">
    <div class="loader-wrapper" id="loader2">
        <img src="assets/images/loader/loader.gif" class="loader">
    </div>

    <div class="app-wrapper" id="load">
        <?php include("includes/navbar.php"); ?>

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <?php
                if (!empty($_GET["videoId"])) {
                    $title = $_SESSION["videoMap"][$_GET["videoId"]]["title"] ?? null;
                    $posted_date = $_SESSION["videoMap"][$_GET["videoId"]]["eventDateTime"] ?? null;
                    $videourl = $_SESSION["videoMap"][$_GET["videoId"]]["url"];
                    $fileUrl = $_SESSION["videoMap"][$_GET["videoId"]]["fileurl"];
                    $pdfUrl = $_SESSION["videoMap"][$_GET["videoId"]]["pdfUrl"];
                    $chatId = $_SESSION["videoMap"][$_GET["videoId"]]["chatId"];
                    $getvideourl = explode("=", $videourl);
                    $fetchvideourl = $getvideourl[1];
                    $youtubeurl = "https://www.youtube.com/watch?v=" . $fetchvideourl . "&modestbranding=1";
                    $fileUrl = empty($fileUrl) ? $youtubeurl : $fileUrl;
                ?>

                    <div id="player"></div>
                    <h1 class="video_title"> <?php echo $title; ?> </h1>
                    <p class="posted_date"> Video posted on: <?php echo $posted_date; ?> </p>
                    <input type="hidden" value="<?php echo $fileUrl;?>">
                    <?php
                    if (!empty($pdfUrl)) {
                        echo "<button class='btn btn_primary'>" . $pdfUrl . "</button>";
                    }
                    if (!empty($chatId)) {
                        $username = $_SESSION["username"];
                        $name = $_SESSION["name"];
                        echo "<div class='chat_box'><iframe width='100%' height='400px' src='https://chat.cprep.in/?username=$name&chatId=$chatId;'></iframe></div>";
                    }
                    ?>
                <?php
                } else {
                    echo "Requested Video is not Available";
                }
                ?>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>

    </div>

    <script>
        var player = new Playerjs({
            id: "player",
            file: "<?php echo $fileUrl; ?>"
        });
    </script>

    <?php include("assets/scripts.php"); ?>

</body>

</html>