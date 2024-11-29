<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $FRD_HURL");

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);//CONVERT JSON DATA TO ARRAY
extract($FRc_ARR);
if(isset($em)){ $em = hash('sha256', $em); }
if(isset($ph)){ $ph = hash('sha256', $ph); }
if(isset($fn)){ $fn = hash('sha256', $fn); }
if(isset($ln)){ $ln = hash('sha256', $ln); }


$FR_OUTPUT = [];

//FRD_VC___________ALL REQUIRED DATA FILED:-
if($event_name != ""){ $FR_VC_ARF = 1; }else{ $FR_OUTPUT['FRA'] = 2; $FR_OUTPUT['FRM'] = "Need All Required Field"; goto THIS_LAST; }


$FRQ = $FR_CONN->query("SELECT * FROM frd_capi WHERE fr_capi_id = 1");
extract($FRQ->fetch());



if($FR_VC_ARF == 1){
        if(isset($fr_capi_ds_id)){
        if(strlen($fr_capi_ds_id) > 10){

            if($event_name == "PageView"){
                $dataArray = array(
                    "data" => array(
                        array(
                            "event_name" => "PageView",
                            "event_time" => $FR_NOW_TIME,
                            "event_id" => "pv$event_id",
                            "event_source_url" => "$event_source_url",
                            "action_source" => "website",
                            "user_data" => array(
                                "client_ip_address" => "$client_ip_address",
                                "client_user_agent" => "$client_user_agent",
                                "external_id" => "$external_id",
                                "fbc" => "$FRc_fbc",
                                "fbp" => "$FRc_fbp"
                            ),
                            "custom_data" => array(
                                "user_role" => "$user_role",
                                "user_id" => "$FRc_USER_UID",
                                "country" => "BD",
                                "domain" => "$FRD_HURL",
                                "page_title" => "$page_title",
                                "event_url" => "$event_url",
                                "event_source_url" => "$event_url",
                                "event_day" => "$FR_NOW_DAY_F",
                                "event_month" => "$FR_NOW_MONTH_F",
                                "event_time" => "$FR_NOW_TIME",
                                "plugin" => "CAPISetupBySpider"
                            ),
                            "opt_out" => false
                        )
                        ),
                        "test_event_code" => "$fr_capi_test_event_code"
                );
            }


            if($event_name == "ViewContent"){
                $dataArray = array(
                    "data" => array(
                        array(
                            "event_name" => "ViewContent",
                            "event_time" => $FR_NOW_TIME,
                            "event_id" => "vc$event_id",
                            "event_source_url" => "$event_source_url",
                            "action_source" => "website",
                            "user_data" => array(
                                "client_ip_address" => "$client_ip_address",
                                "client_user_agent" => "$client_user_agent",
                                "external_id" => "$external_id",
                                "fbc" => "$FRc_fbc",
                                "fbp" => "$FRc_fbp"
                            ),
                            "custom_data" => array(
                                "currency" => "BDT",
                                "value" => $value,
                                "content_type" => "$content_type",
                                "content_ids" => array($content_ids),
                                "content_name" => "$content_name",
                                "content_category" => "$content_category",
                                "user_role" => "$user_role",
                                "user_id" => "$FRc_USER_UID",
                                "country" => "BD",
                                "domain" => "$FRD_HURL",
                                "page_title" => "$page_title",
                                "event_url" => "$event_url",
                                "event_source_url" => "$event_url",
                                "event_day" => "$FR_NOW_DAY_F",
                                "event_month" => "$FR_NOW_MONTH_F",
                                "event_time" => "$FR_NOW_TIME",
                                "plugin" => "CAPISetupBySpider"
                            ),
                            "opt_out" => false
                        )
                        ),
                        "test_event_code" => "$fr_capi_test_event_code"
                );
            }


            if($event_name == "AddToCart"){
                $dataArray = array(
                    "data" => array(
                        array(
                            "event_name" => "AddToCart",
                            "event_time" => $FR_NOW_TIME,
                            "event_id" => "atc$event_id",
                            "action_source" => "website",
                            "user_data" => array(
                                "client_ip_address" => "$client_ip_address",
                                "client_user_agent" => "$client_user_agent",
                                "external_id" => "$external_id",
                                "fbc" => "$FRc_fbc",
                                "fbp" => "$FRc_fbp"
                            ),
                            "custom_data" => array(
                                "currency" => "BDT",
                                "value" => $value,
                                "content_type" => "$content_type",
                                "content_ids" => array($content_ids),
                                "content_name" => "$content_name",
                                "content_category" => "$content_category",
                                "num_items" => "$num_items",
                                "quantity" => "$quantity",
                                "user_role" => "$user_role",
                                "user_id" => "$FRc_USER_UID",
                                "country" => "BD",
                                "domain" => "$FRD_HURL",
                                "page_title" => "$page_title",
                                "event_url" => "$event_url",
                                "event_source_url" => "$event_url",
                                "event_day" => "$FR_NOW_DAY_F",
                                "event_month" => "$FR_NOW_MONTH_F",
                                "event_time" => "$FR_NOW_TIME",
                                "plugin" => "CAPISetupBySpider"
                            ),
                            "opt_out" => false
                        )
                        ),
                        "test_event_code" => "$fr_capi_test_event_code"
                );
            }





            if($event_name == "InitiateCheckout"){
                $dataArray = array(
                    "data" => array(
                        array(
                            "event_name" => "InitiateCheckout",
                            "event_time" => $FR_NOW_TIME,
                            "event_id" => "ic$event_id",
                            "event_source_url" => "$event_source_url",
                            "action_source" => "website",
                            "user_data" => array(
                                "client_ip_address" => "$client_ip_address",
                                "client_user_agent" => "$client_user_agent",
                                "external_id" => "$external_id",
                                "fbc" => "$FRc_fbc",
                                "fbp" => "$FRc_fbp",
                                "em" => "$em"
                            ),
                            "custom_data" => array(
                                "currency" => "BDT",
                                "value" => $value,
                                "content_type" => "$content_type",
                                "content_ids" => "$content_ids",
                                "content_name" => "$content_name",
                                "content_category" => "$content_category",
                                "num_items" => "$num_items",
                                "user_role" => "$user_role",
                                "user_id" => "$FRc_USER_UID",
                                "country" => "BD",
                                "domain" => "$FRD_HURL",
                                "page_title" => "$page_title",
                                "event_url" => "$event_url",
                                "event_source_url" => "$event_url",
                                "event_day" => "$FR_NOW_DAY_F",
                                "event_month" => "$FR_NOW_MONTH_F",
                                "event_time" => "$FR_NOW_TIME",
                                "plugin" => "CAPISetupBySpider"
                            ),
                            "opt_out" => false
                        )
                        ),
                        "test_event_code" => "$fr_capi_test_event_code"
                );
            }



            /*
            "em" => "$em",
            */
            if($event_name == "Purchase"){
                $dataArray = array(
                    "data" => array(
                        array(
                            "event_name" => "Purchase",
                            "event_time" => $FR_NOW_TIME,
                            "event_id" => "p$event_id",
                            "event_source_url" => "$event_source_url",
                            "action_source" => "website",
                            "user_data" => array(
                                "client_ip_address" => "$client_ip_address",
                                "client_user_agent" => "$client_user_agent",
                                "external_id" => "$external_id",
                                "fbc" => "$FRc_fbc",
                                "fbp" => "$FRc_fbp",
                                "ph" => "$ph",
                                "fn" => "$fn",
                                "ln" => "$ln"
                            ),
                            "custom_data" => array(
                                "currency" => "BDT",
                                "value" => $value,
                                "content_type" => "$content_type",
                                "content_ids" => $content_ids,
                                "content_name" => "$content_name",
                                "content_category" => "$content_category",
                                "num_items" => "$num_items",
                                "order_id" => "$order_id",
                                "user_name" => "$user_name",
                                "user_mobile" => "$user_mobile",
                                "user_address" => "$user_address",
                                "user_role" => "$user_role",
                                "user_id" => "$FRc_USER_UID",
                                "country" => "BD",
                                "domain" => "$FRD_HURL",
                                "page_title" => "$page_title",
                                "event_url" => "$event_url",
                                "event_source_url" => "$event_url",
                                "event_day" => "$FR_NOW_DAY_F",
                                "event_month" => "$FR_NOW_MONTH_F",
                                "event_time" => "$FR_NOW_TIME",
                                "plugin" => "CAPISetupBySpider"
                            ),
                            "opt_out" => false
                        )
                        ),
                        "test_event_code" => "$fr_capi_test_event_code"
                );
            }


           
        
            // cURL initialization
            $FRc_HitAPI = "$fr_capi_base_url/$fr_capi_ds_id/events";
            $ch = curl_init($FRc_HitAPI);
            // Additional headers
            $headers = array(
                'Content-Type: application/json',
                "Authorization: Bearer $fr_capi_accesstoken", // Include any authorization headers if needed
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

                if(isset($FRc_RespArr['events_received'])){
                    $events_received = $FRc_RespArr['events_received'];
                    $messages = $FRc_RespArr['messages'];
                    $fbtrace_id = $FRc_RespArr['fbtrace_id'];
                    $FR_OUTPUT['FRA'] = 1; 
                    $FR_OUTPUT['FRM'] =  "Event Received: $events_received | FB Track ID: $fbtrace_id";
                }else{
                    $FR_OUTPUT['FRA'] = 2; 
                    $FR_OUTPUT['FRM_RowResponse'] =  "$response";
                }

            } else {
                $FR_OUTPUT['FRA'] = 2; 
                $FR_OUTPUT['FRM'] =  "Error: No response received.";
            }

        }}
}

THIS_LAST:
echo json_encode($FR_OUTPUT);