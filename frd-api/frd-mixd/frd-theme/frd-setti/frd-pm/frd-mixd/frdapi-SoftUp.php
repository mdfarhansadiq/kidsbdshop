<?php
header('Content-Type: application/json');

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);
extract($FRc_ARR);
$FR_OUTPUT = [];


$FRc_NEXT_VALID_UPDATE_VERSION = $FR_SOFT_VERSION + 1;

$FRc_FRA = 2;
$FRc_RuningVersion = $FR_SOFT_VERSION;
$FRc_Message = "";
$FRc_MMessage_TABLEUPDATE = "";

//FRD VC NEED:-
    $FR_VC_LATEST_R_VERSION = "NO";//LATEST RELIESED VERSION RUNNUNG OR NOT
    $FR_VC_ZIP_FILE_EXIST = "";
    $FR_VC_ZIP_FILE_DOWNLOAD = "";
    $FR_VC_FILE_VERSION = "";
    $FR_VC_ZIP_FILE_EXTRACT = "";
    $FR_VC_TABLE_UPDATE = "";



//FRD_VC_________________ LATEST RELIESED VERSION:-
    if($FRd_LATEST_R_VERSION == $FR_SOFT_VERSION){
        $FR_VC_LATEST_R_VERSION = "YES";
        $FRc_FRA = 2;
        $FRc_Message .= "LATEST VERSION $FR_SOFT_VERSION RUNNING ON $FRD_HURL";
    }






if($FR_VC_LATEST_R_VERSION == "NO"){
   //FRD ZIP FILE URL CONFIGAR:-
    $remoteZipFileURL = "https://spiderecommerce.com/ahost/released-version/V-3-$FRc_NEXT_VALID_UPDATE_VERSION-SPIDER_ECOMMERCE.zip";
    //Local path where you want to save the downloaded file
    $localZipFile = $FR_PATH_HD."V-3-$FRc_NEXT_VALID_UPDATE_VERSION-SPIDER_ECOMMERCE.zip";

    //FRD CHACKING ZIP FILE EXISTENCE:-
        $ch = curl_init($remoteZipFileURL);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $FRARR_curl_getinfo = curl_getinfo($ch);
        if ($FRARR_curl_getinfo['http_code'] == 200 AND $FRARR_curl_getinfo['content_type'] == "application/zip") {
            $FR_VC_ZIP_FILE_EXIST = 1;
            $FRc_Message .= "Remote ZIP file exists and can be downloaded \n";
        } else {
            $FRc_Message .= " + Error: Remote ZIP file not exists \n";
            $FRc_Message .= " + Error: RUNNING VERSION $FR_SOFT_VERSION \n";
        }
        curl_close($ch);
    //END>>
}



//FRD DOWNLODEING AND SAVING ZIP FILE IN THIS SERVER:-
    if($FR_VC_ZIP_FILE_EXIST == 1){
        // Use file_get_contents() to download the remote file
        $zipContents = file_get_contents($remoteZipFileURL);
        if ($zipContents === false) {
            $FR_OUTPUT['FRM_ZipFileDownlode'] =  "ERROR: Failed to download the remote file";
        } else {
            // Use file_put_contents() to save the file locally
            if (file_put_contents($localZipFile, $zipContents) !== false) {
                $FR_VC_ZIP_FILE_DOWNLOAD = 1;
                $FRc_Message .= " + Zip File downloaded and saved successfully. \n";
            } else {
                $FRc_Message .= " + ERROR: Zip File saved failed. \n";
            }
        }
    }
//END>>





//FRD VERSION VALIDATION CHACKING:-
if($FR_VC_ZIP_FILE_DOWNLOAD == 1){
    if(file_exists($localZipFile)){
        $fileName = basename($localZipFile); // Get the file name
        $ARR = explode("-",$fileName);
        $FRc_File_Version = $ARR[2];
    
        //FRD_VC___________________________________________VERSION:-
        if ($FRc_File_Version == $FRc_NEXT_VALID_UPDATE_VERSION) {
            $FR_VC_FILE_VERSION = 1;
            $FRc_Message .= " + NEXT VERSION VALID \n";
        } else {
            $FRc_Message .= " + ERROR: NEXT VERSION NOT VALID \n";
        }
    }else{
        $FRc_Message .= " + ERROR: ZIP FILE NOT FOUND \n";
    }
}
//END>>




//FRD ZIP FILE UNZIPING:-
    if($FR_VC_FILE_VERSION == 1) {
        $unzip = new ZipArchive();
        $out = $unzip->open($localZipFile);
        if ($out === TRUE) {
            $unzip->extractTo("$FR_PATH_HD");
            $unzip->close();
            $FR_VC_ZIP_FILE_EXTRACT = 1;
            $FRc_Message .= " + ZIP FILE EXTRACT COMPLITED \n";
        } else {
            $FRc_Message .= " + ERROR: ZIP FILE EXTRACT FAILED \n";
        }
    }
//END>>>




//FRD TABLE UPDATE INITIALIZING:-
    if ($FR_VC_ZIP_FILE_EXTRACT == 1) {
        if (file_exists($FR_PATH_HD."frd-src/frd-alter-table.php")) {
            require_once($FR_PATH_HD."frd-src/frd-alter-table.php");
            $FR_VC_TABLE_UPDATE = 1;
            $FRc_Message .= " + TABLE UPDATE COMPLETED \n";
        } else {
            $FRc_Message .= " + ERROR: TABLE UPDATE FAILED \n";
        }
    }
//END>>




//FRD TABLE UPDATE FILE DELETING:-
if ($FR_VC_TABLE_UPDATE == 1) {
        //FRD TABLE UPDATE FILE DELETE:-
            if(file_exists($FR_PATH_HD."frd-src/frd-alter-table.php")){
                    unlink("$FR_PATH_HD/frd-src/frd-alter-table.php");
                        if (!file_exists($FR_PATH_HD."frd-src/frd-alter-table.php")) {
                            $FRc_Message .= " + TABLE UPDATE FILE DELETE COMPLETED \n";
                        }
            }else {
                $FRc_Message .= " + ERROR: TABLE UPDATE FILE NOT EXIST \n";
            }
        //END>>


        //FRD ZIP FILE DELETING:-
            if(file_exists("$localZipFile")){
                unlink("$localZipFile");
                    if (!file_exists("$localZipFile")) {
                        $FRc_Message .= " + ZIP FILE DELETE COMPLETED \n";
                    }
            } else {
                $FRc_Message .= " + ERROR: ZIP FILE NOT EXIST FOR DELETE \n";
            }
        //END>>


        //FRD DELETE ALL ADVANCE PANEL & EXTENTION FOLDER AND FILE:-
            if($frsc_sells_reports == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-sr");}
            if($frsc_sells_reports == 0){ FRF_DeleteFolder($FR_PATH_HD."frd-api/frd-sr"); }

            if($frsc_profit_reports == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-pal");}
            if($frsc_profit_reports == 0){ FRF_DeleteFolder($FR_PATH_HD."frd-api/frd-pal"); }

            if($frsc_ppr_panel == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-ppr"); }
            if($frsc_ppr_panel == 0){ FRF_DeleteFolder($FR_PATH_HD."frd-api/frd-ppr"); }

            if($frsc_usr_m_panel == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-usr"); }
            if($frsc_cust_m_panel == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-crm"); }
            if($frplug_RatingRev == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-rr"); }

            if($frplug_SMSs == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-smss");}
            if($frplug_SMSs == 0){ FRF_DeleteFolder($FR_PATH_HD."frd-api/frd-sms"); }

            if($frplug_sms_m_osb == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-smsMosb"); }
            if($frplug_SFC_OSAU == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-SFCosau"); }
            if($frsc_fb_feed_xml == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-fbcat"); }
            if($frplug_suppliers == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-supp"); }
            if($frplug_cost == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-cost"); }
            if($frplug_ac_m == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-acc"); }
            if($frplug_inv_m == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-inv");}
            if($frplug_due_m == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-due");}

            if($frplug_sitedata == 0){ FRF_DeleteFolder($FR_PATH_HD."frdsp/dp/page/frd-p-sitedata");}
            if($frplug_sitedata == 0){ FRF_DeleteFolder($FR_PATH_HD."frd-api/frd-sitedata");}
            //+
            //+
            if($frplug_api_steadfast == 0){ unlink($FR_PATH_HD."frdsp/dp/page/frd-p-om/frd-BookingApi_SteadFast.php"); }
            if($frplug_api_pathao == 0){ unlink($FR_PATH_HD."frdsp/dp/page/frd-p-om/frd-BookingApi_Pathao.php"); }
            if($frplug_capi == 0){ unlink($FR_PATH_HD."frd-api/frd-mixd/frdapi-IniCAPI.php"); }
        //END>>

        $FRc_FRA = 1;
        $FRc_RuningVersion = $FRc_NEXT_VALID_UPDATE_VERSION;
        $FRc_Message .= " + Dear Boss  Your eCommerce Website [$FRD_HURL] Update Completed Version $FRc_NEXT_VALID_UPDATE_VERSION!";
}
//END>>


$FR_OUTPUT['FRA'] =  $FRc_FRA;
$FR_OUTPUT['FRM'] =  "$FRc_Message";
$FR_OUTPUT['FRM_ATERTABLE'] =  "$FRc_MMessage_TABLEUPDATE";
$FR_OUTPUT['FRrd_RunningVersion'] = $FRc_RuningVersion;
$FR_OUTPUT['FRrd_BACK'] =  $FRc_ARR;



THIS_LAST:
echo json_encode($FR_OUTPUT);