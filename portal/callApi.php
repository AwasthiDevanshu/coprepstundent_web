<?php

function callApi($url, $data)
{
    $curl = curl_init();
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $requestBody["data"] = $data;
    $requestBody["token"] = $_SESSION["authtoken"] ?? "";
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('body' => json_encode($requestBody)),
    ));

    $response = curl_exec($curl);
    return $response;
}


