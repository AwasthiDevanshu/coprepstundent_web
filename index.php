<html>

<head>
    <title> Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="main-cont">

        <?php

        include("login.php");

        $url2 = 'https://backend.coprepedu.com/candidate/homepage/getLayout';
        $data = [];
        $response = callApi($url2, $data);
        $response = json_decode($response, true);

        $layout = $response["data"]["layout"];
        foreach ($layout as $row) {
            $type = $row["type"];
            $title = $row["title"];
            $contentype = $row["contentType"];
            $content = $row["content"];

            echo "<div class ='row'>";
            echo $title;
            foreach ($content as $key => $value) { ?>
                <div class="cont">
                    <img src="<?php echo $value["thumbnail"]; ?>" class="thumb">
                    <h1 class="course_name"> <?php echo $value["courseName"]; ?> </h1>
                    <div class="container">
                        <div class="row">
                            <div class="col price_cont">
                                <p class="price"> Rs. <strike> <?php echo $value["mrp"]; ?> </strike> &nbsp; <b><?php echo $value["price"]; ?></b></p>
                            </div>
                            <div class="col btn_cont">
                                <a href="layout.php?courseId=<?php echo $value["courseId"]; ?>"><button class="buy_now">
                                        <?php
                                        if ($value["purchased"] == 1) {
                                            echo " View Videos ";
                                        } else {
                                            echo "Buy Now";
                                        }
                                        ?>
                                    </button></a>
                            </div>
                        </div>
                    </div>

                </div>

        <?php

                // if (++$i == 4) break;

            }
            echo "  </div>";
        }

        ?>

    </div>

</body>

</html>