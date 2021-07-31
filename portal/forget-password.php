<?php

    error_reporting(0);

    if(isset($_POST["submit"]))
    {
        if(!empty($_POST["email"]))
        {
            function callApi($url, $data){
            $curl = curl_init();
            $requestBody["data"] = $data;
            $requestBody["token"] = $_SESSION["authtoken"]??"";
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('body' => json_encode($requestBody)),
            ));

            $response = curl_exec($curl);
            return $response;
            }

            $url = 'https://backend.coprepedu.com/candidate/candidate/forgotPassword';
            $data["email"] = $_POST["email"];
            $data["companyId"] = "27";
            $response = callApi($url,$data);
            $response = json_decode($response,true);

        }

        else
        {
            header("Location: forget-password.php?error=Please Enter Registered Email ID");
            exit();
        }
    }

?>

<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" href="css/login.css">
    </head>

    <body>
        
        <div class="main_cont">

            <?php if($response["error"] == 1){ ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> <?php echo $response["message"]; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

            <?php if(isset($response["error"]) && $response["error"] == 0){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="success">
                <strong>Success!</strong> <?php echo $response["message"]; ?><br>
                <p> Please, Check you Spam folder for ID & Password then Try Login again. </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

            <div class="log_cont">

                <h1 style="color:white;font-weight:700;text-align:center;margin-bottom: 30px; font-size:22pt;"> Forget Passoword </h1>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control emailid" placeholder="Enter Registered Email">
                    </div>

                    <div class="login">
                        <button type="submit" name="submit" class="login_btn">Send Password to Email</button>
                    </div>
                </form>
            </div>

            <div class="register">
            <center><a href="login.php"><button class="regiester_btn"> Back to Login </button></a></center>
            </div>
        </div>

    </body>
</html>

<?php
    include("scripts.php");
?>