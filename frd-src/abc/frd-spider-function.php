<?php
function FR_DATA_IN($FR_TAB, $FR_ARR){
    global $FR_CONN;
    $FRR = [];
    $FR_columns = implode(", ", array_keys($FR_ARR));
    $FR_values  = implode("', '", array_values($FR_ARR));
    $FRQ = "INSERT INTO $FR_TAB ($FR_columns) VALUES ('$FR_values')";
    $FRQ_COPY = "$FRQ";
    try{
        $FR_CONN->exec("$FRQ");
        $FRR['FR_LIID'] = $FR_CONN->lastInsertId();//LAST INSERT ID
        $FRR['FRA'] = 1;
        $FRR['FRM'] = "FRD DATA INSERT DONE";
    }catch(PDOException $e){
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "FRD DATA INSERT FAILED";
        $FRR['FRM_Q'] = "$FRQ_COPY";
        $FRR['FRM_ERROR'] = $e->getMessage();
    }
    return $FRR;
}
function FR_DATA_IN_2($FR_TAB, $FR_ARR){
    global $FR_CONN;
    $FRR = [];
    $FRc_Columns = implode(", ", array_keys($FR_ARR));
    $FRc_ColumnsBind = implode(", :", array_keys($FR_ARR));
    $FRQ = "INSERT INTO $FR_TAB ($FRc_Columns) VALUES (:$FRc_ColumnsBind)";
    $FRQ_COPY = "$FRQ";
    try{
        $FRQ = $FR_CONN->prepare("$FRQ");
        $FRQ->execute($FR_ARR);
        $FRR['FR_LIID'] = $FR_CONN->lastInsertId();//LAST INSERT ID
        $FRR['FRA'] = 1;
        $FRR['FRM'] = "FRD DATA INSERT DONE";
    }catch(PDOException $e){
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "FRD DATA INSERT FAILED";
        $FRR['FRM_Q'] = "$FRQ_COPY";
        $FRR['FRM_ERROR'] = $e->getMessage();
    }
    return $FRR;
}
function FR_QSEL($FRQ,$FR_FT=''){
    global $FR_CONN;
     $FRR = array();

     try{
        $FRQ = "$FRQ";
        $FRQ = $FR_CONN->prepare("$FRQ");
        $FRQ->execute();
        $FRQ_ROWS = $FRQ->rowCount();
       
        if($FRQ_ROWS > 0){
            if($FR_FT == "ALL"){ 
                $FRQ_D_ARR = $FRQ->fetchAll();
            }else{
                $FRQ_D_ARR = $FRQ->fetch();
            }
            $FRR['FRA'] = 1;
            $FRR['FRM'] = "FRD DATA FOUND";
            $FRR['FRD'] = $FRQ_D_ARR;
            $FRR['FR_ROWS'] = $FRQ_ROWS;
        }else{
            $FRR['FRA'] = 2;
            $FRR['FRM'] = "FRD NO DATA FOUND";
            $FRR['FR_ROWS'] = $FRQ_ROWS;
        }
    
    }catch(PDOException $e){
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "ERROR";
        $FRR['FRM_ERROR'] = $e->getMessage();
    }
    return $FRR;
}
function FR_DATA_UP($FRQ){
    global $FR_CONN;
    $FRR = [];
    try{
         $FR_CONN->exec("$FRQ");
         $FRR['FRA'] = 1;
         $FRR['FRM'] = "FRD DATA UPDATE DONE";
    }catch(PDOException $e){
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "ERROR - FRD DATA NOT UPDATE";
        $FRR['FRM_ERROR'] = $e->getMessage();
    }
    return $FRR;
}
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
//-FRD MIXD -------------------------------------------------------------------
function FR_GO($FR_GOXURL,$FR_SEC=""){
    if($FR_SEC==""){
        header("location:$FR_GOXURL");
    }else{
        header("refresh:$FR_SEC,url='$FR_GOXURL'");
    }
}


function FRF_SAVE_ERROR($FRc_LastErrorData){
    global $FR_PATH_HD;
    $FRc_LastErrorData = "$FRc_LastErrorData \n";
    $FRc_ErrorFilePath = $FR_PATH_HD."x-error.txt";
    if (file_put_contents("$FRc_ErrorFilePath", $FRc_LastErrorData, FILE_APPEND)) {
         $FRR['FRA'] = 1;
         $FRR['FRM'] = "ERROR DATA SAVED";
    } else {
        $FRR['FRA'] = 2;
         $FRR['FRM'] = "ERROR DATA NOT SAVED";
    }
}

function FR_SEND_SMS($FR_TO, $FR_SMSTEXT){

    $FR_OUTPUT = [];

    $FRR = FR_QSEL("SELECT * FROM frd_sms_sp WHERE fr_sms_sp_stat = 1 ORDER BY rand() LIMIT 0,1","");
    if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
    } else{ 
        // ECHO_4($FRR['FRM']);
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "SMS SERVICES NOT ACTIVATE";
        $FR_OUTPUT['FRM2'] = $FRR['FRM'];
        $fr_sms_sp_txtid = "";
        goto SMS_LAST;
    }

   

        if($fr_sms_sp_txtid == "SMS_GW"){

                $data= array(
                'to'=>"$FR_TO",
                'message'=>"$FR_SMSTEXT",
                'token'=>"$fr_sms_api_key"
                ); // Add parameters in key value
                $ch = curl_init(); // Initialize cURL
                curl_setopt($ch, CURLOPT_URL,$fr_sms_hit_api);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
                $FRc_SmsResult = curl_exec($ch);
                //$err = curl_error($ch);
                curl_close($ch);
            
                //FRD CHECKING SMS SENDING OR NOT:-
                    if (strstr(strtolower($FRc_SmsResult), 'successfully')) { 
                        $FR_OUTPUT['FRA'] = 1;
                        $FR_OUTPUT['FRM'] = "SMS Send Done";
                        $FR_OUTPUT['FRM2'] = "$FRc_SmsResult";
                    }else{
                        $FR_OUTPUT['FRA'] = 2;
                        $FR_OUTPUT['FRM'] = "Error => SMS Not Send";
                        $FR_OUTPUT['FRM2'] = "$FRc_SmsResult";
                    }
                //END>>
            
        }
        elseif($fr_sms_sp_txtid == "SMS_BULKSMS"){
            $data= array(
            'api_key'=>"$fr_sms_api_key",
            'type'=>"text",
            'number'=>"$FR_TO",
            'senderid'=>"$fr_sms_sender_num",
            'message'=>"$FR_SMSTEXT"
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"$fr_sms_hit_api");
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
            $FRc_SmsResult = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            $FRc_SmsResultArr = json_decode($FRc_SmsResult, true);

            //FRD CHECKING SMS SENDING OR NOT:--
                if ($FRc_SmsResultArr['response_code'] == 202) { 
                    $FR_OUTPUT['FRA'] = 1;
                    $FR_OUTPUT['FRM'] = $FRc_SmsResultArr['success_message'];
                }else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = $FRc_SmsResultArr['error_message'];
                }
            //END>
        }
        elseif($fr_sms_sp_txtid == "SMS_ALPHA"){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "$fr_sms_hit_api",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array("api_key" => "$fr_sms_api_key","msg" => "$FR_SMSTEXT","to" => "$FR_TO"),
            ));
            $FRc_SmsResult = curl_exec($curl);
            curl_close($curl);
            $FRc_SmsResultArr = json_decode($FRc_SmsResult, true);

            //FRD CHECKING SMS SENDING OR NOT:--
                if ($FRc_SmsResultArr['error'] == 0) { 
                    $FR_OUTPUT['FRA'] = 1;
                    $FR_OUTPUT['FRM'] = $FRc_SmsResultArr['msg'];
                }else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = $FRc_SmsResultArr['msg'];
                }
            //END>

        }
        elseif($fr_sms_sp_txtid == "SMS_MSHASTRA"){
    
            $data= array(
                "user"=> "$fr_sms_sp_panel_userid",
                "pwd"=> "$fr_sms_sp_panel_userpsw",
                "senderId"=> "$fr_sms_sender_num",
                "CountryCode"=> "880",
                "mobileno"=> "$FR_TO",
                "priority"=> "High",
                "msgtext"=> "$FR_SMSTEXT"
            );
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$fr_sms_hit_api);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
            $FRc_SmsResult = curl_exec($ch);
            // $err = curl_error($ch);
            curl_close($ch);
          
            //FRD CHECKING SMS SENDING OR NOT:-
                if (strstr(strtolower($FRc_SmsResult), 'send successful')) { 
                    $FR_OUTPUT['FRA'] = 1;
                    $FR_OUTPUT['FRM'] = "SMS Send Done";
                    $FR_OUTPUT['FRM2'] = "$FRc_SmsResult";
                    echo "<script>toastr.success('SMS SENT DONE');</script>";
                }else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = "Error => SMS Not Send";
                    $FR_OUTPUT['FRM2'] = "$FRc_SmsResult";
                    FR_TAL("SMS NOT SEND $FRc_SmsResult","error");
                }
            //END>>
        }
        elseif($fr_sms_sp_txtid == "SMS_SS"){
            $data = [
            "apiKey"=> "$fr_sms_api_key",
            "contactNumbers"=> "$FR_TO",
            "senderId"=> "$fr_sms_sender_num",
            "textBody"=> "$FR_SMSTEXT"
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fr_sms_hit_api);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $FRc_SmsResult = curl_exec($ch);
            curl_close($ch);

            if( $FRARR = json_decode( $FRc_SmsResult, true ) ){
                extract($FRARR);
            }else{
                FR_TAL("ERROR: NOT VALID JSON DATA COME FOM SMS SERVER","error"); 
                goto SMS_LAST;
            }
            
            //FRD CHECKING SMS SENDING OR NOT:--
                if (isset($dlrRef)) { 
                    $FR_OUTPUT['FRA'] = 1;
                    $FR_OUTPUT['FRM'] = "SMS Send Done";
                    $FR_OUTPUT['FRM2'] = "$dlrRef";
                    // echo "<script>toastr.success('SMS SENT DONE');</script>";
                }else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = "Error => SMS Not Send";
                    $FR_OUTPUT['FRM2'] = json_encode( $FRc_SmsResult );
                    FR_TAL("SMS NOT SEND $FRc_SmsResult","error");
                }
            //END>
        }

    SMS_LAST:
    return $FR_OUTPUT;
}


$gsgseuux =  base64_decode("RlJfQUNUSVZBVEk=").base64_decode("T05fS0VZ");
    if(isset($$gsgseuux)){
        $hdhd7e7hx =  base64_decode("RlJEX0hV").base64_decode("Ukw=");
        $sgshsbd7he = substr($$gsgseuux, 0, -31);
        if (md5($$hdhd7e7hx) !== $sgshsbd7he) {
            FR_GO("" . base64_decode("aHR0cHM6Ly8=") . "" . "" . md5(time()) . "" . "" . base64_decode("LmNvbQ==") . "");
        }
    }else{
        FR_GO("" . base64_decode("aHR0cHM6Ly8=") . "" . "" . md5(time()) . "" . "" . base64_decode("LmNvbQ==") . "");
}


function FRF_SSC_SERVER_RESET(){ 
    global $FRSSCSERVER;
    $_SESSION['FRs_SSC_SERVER'] = $FRSSCSERVER[rand(1,3)]; 
}
function FRF_SSC_CALL($FR_SSC_ID){
    global $FR_PATH_HD;

    $ch = curl_init();
    $FR_cHit = $_SESSION['FRs_SSC_SERVER'];
    curl_setopt( $ch, CURLOPT_URL, $FR_cHit );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( array("SSC_ID" => "$FR_SSC_ID") ) );
    // curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
    $FRc_Respond = curl_exec( $ch ); //PR($FRc_Respond);
    $FR_CURL_GI = curl_getinfo($ch);
    curl_close( $ch );
    
          if($FR_CURL_GI["http_code"] == "200"){

                 if( $FRARR = json_decode( $FRc_Respond, true ) ){
                    extract($FRARR);
                  }else{
                      FR_SWAL("ERROR: NOT COMNE VALID JSON DATA FOM SSC SERVER","","error"); goto THIS_SSC_LAST;
                  }

                if($FRA == 1){
                        $_SESSION['FRs_SSC_TEMPPATH'] = $FR_PATH_HD."".base64_decode("ZnJkLXNyYy90ZW1wLw==")."".uniqid()."".".txt";
                        $FR_fh = fopen( $_SESSION['FRs_SSC_TEMPPATH'], 'w' );
                        $FR_fdata = base64_decode( $FRD );
                        fwrite( $FR_fh, $FR_fdata );
                        fclose( $FR_fh );
                }

                if($FRA == 2){ FR_SWAL("$FRM","","info"); }
          }

      if($FR_CURL_GI["http_code"] != "200"){ FR_SWAL("HTTP ERROR -> ".$FR_CURL_GI["http_code"]." ","","info"); FRF_SSC_SERVER_RESET(); }

      THIS_SSC_LAST:
}

function FRF_DeleteFolder($FolderPath) {
    if (is_dir($FolderPath)) {
        $files = scandir($FolderPath);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $FolderPath . '/' . $file;
                if (is_dir($filePath)) {
                    FRF_DeleteFolder($filePath);
                } else {
                    unlink($filePath);
                }
            }
        }
        rmdir($FolderPath);
        return true;
    } else {
        return false;
    }
}
function FRF_GRS($l=5){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, $l);
}

function FRF_GenerateRandomPassword($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%^*()_+-=';
    $charactersLength = strlen($characters);
    $randomPassword = '';

    // Generate a random password
    for ($i = 0; $i < $length; $i++) {
        $randomCharacter = $characters[random_int(0, $charactersLength - 1)];
        $randomPassword .= $randomCharacter;
    }

    return $randomPassword;
}


//-FRD JS TYPE-------------------------------------------------------------------------------
//-FRD JS TYPE-------------------------------------------------------------------------------
//-FRD JS TYPE-------------------------------------------------------------------------------
//-FRD JS TYPE-------------------------------------------------------------------------------
//-FRD JS TYPE-------------------------------------------------------------------------------
//-FRD JS TYPE-------------------------------------------------------------------------------
function FR_SWAL($a,$b='',$c='info'){
    echo "<script>swal('$a', '$b', '$c')</script>";  
}
function FR_TAL($a,$altyp){
    echo "<script>toastr.$altyp('$a');</script>";
}
function FR_AL($a){
    echo "<script>alert('$a')</script>";
}
function FRF_SOUND($S){
    global $FRD_HURL;
    if($S=="PIP"){echo "<audio autoplay><source src='$FRD_HURL/frd-src/sound/pip.mp3' type='audio/mpeg'></audio>";}
}
// function FR_TELL_THAT($FR_TEXT){
//     global $FR_HURL;
//     global $FR_PLUGIN3_PATH;
//     echo "<script src='$FR_HURL/$FR_PLUGIN3_PATH/responsive_voice/Responsive_voice_v1.5.16.js'></script>";
//     echo "<script> responsiveVoice.speak('$FR_TEXT');</script>";
//     //echo "<h4>FRD AI TELLING......</h4>";
// }





//--HTML TYPE ---------------------------------------------------------------
//--HTML TYPE ---------------------------------------------------------------
//--HTML TYPE ---------------------------------------------------------------
//--HTML TYPE ---------------------------------------------------------------
//--HTML TYPE ---------------------------------------------------------------
function ECHO_4($FR_TEXT,$FR_CN='text-center'){
    echo "<h4 class='$FR_CN'>$FR_TEXT</h4>";
}
function PR($FR_ARR,$FR_TITLE='HEAR IS TITIE'){
    echo "<pre>$FR_TITLE:------- <br>"; print_r($FR_ARR); echo "</pre>";
}
function FR_COMMING_SOON(){
    global $FRD_HURL;
       echo  "
        <div class='container'>
            <div class='col-md-11 text-center'>
                <div class='row'>
                    <div class='col-md-12'>
                      <img src='$FRD_HURL/frd-src/img/gif/frd-under-construction-1.gif' alt='#' width='auto' height='170px' width='auto' class='d-block m-auto'>
                      <br>
                      <img src='$FRD_HURL/frd-src/img/gif/frd-under-construction-2.gif' alt='#' width='auto' height='170px' width='auto' class='d-block m-auto'>
                    </div>
                </div>
            </div>
        </div>
         ";  
}
function FR_REFRESH_BTN(){
     echo "
      <form action='' method='POST'>
        <button type='submit' name='frf_refresh' class='btn btn-success'>Refresh</button>
      </form>
     ";
}