<?php

session_start();
unset($_SESSION["authtoken"]);
header("Location: login.php");

?>