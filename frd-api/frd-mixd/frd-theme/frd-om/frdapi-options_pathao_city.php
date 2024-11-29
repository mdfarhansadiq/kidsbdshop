<?php 
$FR_OP_HTML = "";

//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<option value=''>Access Denied 1  </option>"; goto THIS_LAST; }
//FRD VC________
    if( isset($_POST['spider_eCommerce'])){
         $FR_VC_POST = 1; 
    }

   
//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){

        //FRD TDR:-
        $FRR = FR_QSEL("SELECT fr_pat_base_url FROM frd_qapi_pathao WHERE fr_pat_id = 1","");
        if($FRR['FRA']==1){ 
          extract($FRR['FRD']);
        } else{ ECHO_4($FRR['FRM']); }
        //END>>
        extract(FRF_PATHAO_ATOKEN());
        if($FRA == 2){ PR("PATHAO ACCESS TOKEN FAILED"); PR($FRM); }

           //CITY LIST:-
           // Set the request URL
           $request_url = "$fr_pat_base_url/aladdin/api/v1/countries/1/city-list";
           // Set the request headers
           $headers = array(
               "Authorization: Bearer $FRc_PATHAO_ATOKEN",
               'Content-Type: application/json',
               'Accept: application/json'
           );
           // Initialize cURL session
           $ch = curl_init($request_url);
           // Set cURL options
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_HTTPGET, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           // Execute cURL session
           $response = curl_exec($ch);
           // Check for cURL errors
           if (curl_errno($ch)) {
            //    echo 'Curl error: ' . curl_error($ch);
               $FR_OP_HTML .= "<option value=''>CURL ERROR</option>";
           }
           // Close cURL session
           curl_close($ch);
           
            //FRD HENDEL THE RESPONSE START:-
            $FRR =  json_decode($response, true);
            if(isset($FRR["code"])){
                if($FRR["code"] == 200){
                    $FRc_DATA = $FRR["data"]["data"];//CITY LIST
                    $FR_OP_HTML .= "<option value=''>Select City</option>";
                    foreach($FRc_DATA AS $city){
                        extract($city);
                        $FR_OP_HTML .= "<option value='$city_id/$city_name'>$city_name</option>";
                    }
                }else{
                    //ERROR
                    // PR($FRR);
                    $FR_OP_HTML .= "<option value='ERROR'>ERROR</option>";
                }
            }else{
                $FR_OP_HTML .= "<option value='ERROR'>".$response = curl_exec($ch)."</option>";
            }
           //FRD HENDEL THE RESPONSE END>>
    
    }else{
        $FR_OP_HTML .= "<option value=''>VA Failed</option>";
    }
//FRD OPARATION END>>
THIS_LAST:
echo $FR_OP_HTML;
