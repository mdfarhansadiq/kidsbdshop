<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $FRD_HURL");

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);
extract($FRc_ARR);

$FR_OUTPUT = [];

            $dataArray = array(
                    "FRD_HURL" => "$FRD_HURL",
                    "FR_L" => "$FR_L"
            );
            // cURL initialization
            $FRc_HitAPI = base64_decode(base64_decode("YUhSMGNITTZMeTl6Y0dsa1pYSmxZMjl0YldWeVkyVXVZMjl0TDJGb2IzTjBMM053Y0M5emFXUXZhWEl1Y0dodw=="));
            $ch = curl_init($FRc_HitAPI);
            // Additional headers
            $headers = array(
                'Content-Type: application/json'
            );
            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string instead of outputting it
            curl_setopt($ch, CURLOPT_POST, true);            // Set the request type to POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataArray)); // Set the POST data as JSON
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Set the headers
            // Execute cURL session and get the response
            $response = curl_exec($ch);
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            // Close cURL session
            curl_close($ch);
            // Process the response
            if ($response) {
                $FRc_RespArr = json_decode($response, true);
            } else {
                $FR_OUTPUT['FRA'] = 2; 
                $FR_OUTPUT['FRM'] =  "Error: No response received.";
            }


THIS_LAST:
// echo json_encode($FR_OUTPUT);