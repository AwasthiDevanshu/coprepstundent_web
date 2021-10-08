<?php 


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
            
            if(!empty($response["data"]["authToken"]))
            {
                $_SESSION["authtoken"] = $response["data"]["authToken"];
            }
?>