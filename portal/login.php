<?php
include_once("callApi.php");
include_once("../Constant.php");
$error = "";

if (isset($_POST["submit"])) {
    if (!empty($_POST["username"]) || !empty($_POST["password"])) {
        $data["username"] = $_POST["username"];
        $data["password"] = $_POST["password"];
        $data["companyId"] = Constant::COMPANYID;
        $response = callApi(Url::LOGIN_URL, $data);
        $response = json_decode($response, true);

        if (!empty($response["data"]["authToken"])) {
            $_SESSION["authtoken"] = $response["data"]["authToken"];

            header("Location: login.php?success=Login Successfull! Logging in...");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Username or Password");
            exit();
        }
    } else {
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

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> <?php echo $_GET['error']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="success">
                <strong>Success!</strong> <?php echo $_GET['success']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>

            <div class="log_cont">
                <center><img src="media/login.png" class="login_img"></center>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                        <input type="text" name="username" class="form-control userid" placeholder="Username">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                        <input type="password" name="password" class="form-control password" placeholder="Password" id="password">
                        <span class="input-group-text" id="eyeicon" onclick="password_show_hide();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
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
            <center><a href="signup.php"><button class="regiester_btn"> Click to Register </button></center>
            </div>
        </div>
    </div>

        <script>
            function password_show_hide() {
                var x = document.getElementById("password");
                var show_eye = document.getElementById("show_eye");
                var hide_eye = document.getElementById("hide_eye");
                hide_eye.classList.remove("d-none");
                if (x.type === "password") {
                    x.type = "text";
                    show_eye.style.display = "none";
                    hide_eye.style.display = "block";
                } else {
                    x.type = "password";
                    show_eye.style.display = "block";
                    hide_eye.style.display = "none";
                }
            }
        </script>

    </body>
</html>

<?php
include("scripts.php");
?>
</html>
