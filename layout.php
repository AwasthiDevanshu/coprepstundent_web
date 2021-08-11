<html>

<head>
    <title> Layout </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php

    if (isset($_GET['courseId'])) {

        include("login.php");

        $url2 = Url::LAYOUT_URL;
        $url3 = Url::COURSE_VIDEO_LIST;
        $data["courseId"] = $_GET['courseId'];
        $data["filters"]["searchString"] = $_GET['search'] ?? "";
        $dataid = [];
        print_r($data);
        $response = callApi($url3, $data);
        $response = json_decode($response, true);
        $response2 = callApi($url2, $dataid);
        $response2 = json_decode($response2, true);

        $layout = $response2["data"]["layout"];
        $content = $layout["0"]["content"];


        $i = 0;


        $courseVideo = $response["data"]["courseVideo"]; ?>

        <form action="./layout.php" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                            echo $_GET['search'];
                                                        } ?>" class="form-control" placeholder="Search Videos">
                <input type="hidden" name="courseId" value="<?php echo $data['courseId'] ?>">
                <button type="submit" class="btn btn-primary"> Search </button>
            </div>
        </form>

        <div class="main-cont">

            <?php

            foreach ($content as $key1 => $value1) {
                $purchaseid = $value1["purchased"];
            }

            if ($purchaseid == 1) {

                foreach ($courseVideo as $key => $value) { ?>

                    <div class="cont">

                        <?php

                        $getvideoid = explode("/=", $value["url"]);

                        $videoid = $getvideoid[1];

                        ?>

                        <iframe width="100%" height="170px" src="https://www.youtube.com/embed/<?php echo $videoid; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <h1 class="course_name"> <?php echo $value["title"]; ?> </h1>
                        <div class="container">
                            <div class="row">
                                <div class="col price_cont">
                                    <p class="price"> Duration: <?php echo $value["duration"]; ?> mins.</p>
                                </div>
                                <div class="col btn_cont">
                                    <a href="<?php echo $value["pdfUrl"]; ?>"><button class="buy_now">
                                            Download PDF
                                        </button></a>
                                </div>
                            </div>
                        </div>

                    </div>

        <?php
                }
            } else {
                echo "<script> alert('Buy this course'); </script>";
                header("Location: index.php");
            }
        }


        ?>

        </div>

</body>


</html>