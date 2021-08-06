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

        $url2 = 'https://backend.coprepedu.com/candidate/homepage/getLayout';
        $url3 = 'https://backend.coprepedu.com/candidate/candidate/getCourseVideos';
        $data["courseId"] = $_GET['courseId'];
        $dataid = [];
        $response = callApi($url3, $data);
        $response = json_decode($response, true);
        $response2 = callApi($url2, $dataid);
        $response2 = json_decode($response2, true);

        $layout = $response2["data"]["layout"];
        $content = $layout["0"]["content"];

        foreach ($content as $key => $purchased) {
            $purchaseid = $purchased["purchased"];
        }

        if ($purchaseid == 1) {
            $courseVideo = $response["data"]["courseVideo"];
            $i = 0;

            foreach ($courseVideo as $key2 => $video) { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
        <?php


            }
        }
    }

        ?>

</body>


</html>