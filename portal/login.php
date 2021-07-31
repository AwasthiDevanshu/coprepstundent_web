<?php

    $error = "";    

    if(isset($_POST["submit"]))
    {
        if(!empty($_POST["username"]) || !empty($_POST["password"]))
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

            $url = 'https://backend.coprepedu.com/candidate/candidate/candidateLogin';
            $data["username"] = $_POST["username"];
            $data["password"] = $_POST["password"];
            $data["companyId"] = "27";
            $response = callApi($url,$data);
            $response = json_decode($response,true);
            
            if(!empty($response["data"]["authToken"])){
                $_SESSION["authtoken"] = $response["data"]["authToken"];
                
                header("Location: login.php?success=Login Successfull! Logging in...");
                exit();
            } 
            
            else {
                header("Location: login.php?error=Incorrect Username or Password");
                exit();
            }
        }

        else
        {
            header("Location: login.php?error=Please Enter Required Fields");
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

            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> <?php echo $_GET['error']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="success">
                <strong>Success!</strong> <?php echo $_GET['success']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

            <div class="log_cont">
                <center><img src="media/login.png" class="login_img"></center>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                        <input type="text" name="username" class="form-control emailid" placeholder="Username">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                        <input type="password" name="password" class="form-control password" placeholder="Password">
                    </div>

                    <div class="forgot_remeber">
                        <div class="remember_me">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label remember_label" for="flexCheckChecked">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="forgot_pass_cont">
                            <a href="forget-password.php" class="forgor_password"> Forgot Password </a>
                        </div>
                    </div>

                    <div class="login">
                        <button type="submit" name="submit" class="login_btn">Login</button>
                    </div>
                </form>
            </div>

            <div class="register">
            <center><button class="regiester_btn"> Click to Register </button></center>
            </div>
        </div>

    </body>
</html>

<?php
    include("scripts.php");
?>