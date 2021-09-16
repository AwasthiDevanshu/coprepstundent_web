<?php

require_once("assets/phpclasses/callApi.php");
require_once("Constant.php");
require_once("Url.php");

$url =  Url::LOGOUT_URL;
$data = [];
$callApi = new CallApi();
$response = $callApi->call($url, $data);
$response = json_decode($response, true);

if($response)
{
    header("Location: login.php");
    exit();
}


// session_start();
// unset($_SESSION["authtoken"]);
// header("Location: login.php");