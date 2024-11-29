<?php 
$Callingg_2 = "SoftwareUpdate";
require_once('frd1_whoami.php');
$FR_ptitle="Checking Update";//PAGE TITLE
$p="SoftwareUpdate";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Checking Update </h2>
<h4 class="text-center"> <?php echo "Current Website Version: 3.$FR_SOFT_VERSION";?> </h4>
<hr>



<!-- 1 SCRIPT S -->
<section>
<?php

if(isset($_POST['FRTRIG_SITE_UPDATE'])){
    $dataArray = array(
        "A" => "0",
        "B" => "0",
        "FRd_LATEST_R_VERSION" => 0
    );
    $ch = curl_init("$FRD_HURL/frd-api/SoftUp");
    $headers = array(
        'Content-Type: application/json'
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataArray));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo "CURL ERROR: $error_msg";
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode == 404) {
            echo "Error: API URL not found (404)";
        } elseif ($httpCode >= 400) {
            echo "Error: HTTP error $httpCode occurred";
        } elseif ($response === false) {
            echo "Error: No response received";
        } else {
            $FRc_RespArr = json_decode($response, true);
            PR($FRc_RespArr);
            extract($FRc_RespArr);
            if($FRA == 1){
                FR_SWAL($FRM,"","success");
                FR_GO("$FR_THIS_PAGE","2");
                exit;
            }else{
                FR_SWAL($FRM,"","error");
            }
        }
    }
    curl_close($ch);

}








$FRc_NEXT_VALID_UPDATE_VERSION = $FR_SOFT_VERSION + 1;
$FR_VC_ZIP_FILE_EXIST = "";
//FRD ZIP FILE URL CONFIGAR:-
    $remoteZipFileURL = "https://spiderecommerce.com/ahost/released-version/V-3-$FRc_NEXT_VALID_UPDATE_VERSION-SPIDER_ECOMMERCE.zip";
    // Local path where you want to save the downloaded file
    $localZipFile = $FR_PATH_HD."/V-3-$FRc_NEXT_VALID_UPDATE_VERSION-SPIDER_ECOMMERCE.zip";



//FRD CHACKING ZIP FILE EXISTENCE:-
    $ch = curl_init($remoteZipFileURL);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $FRARR_curl_getinfo = curl_getinfo($ch);
    if ($FRARR_curl_getinfo['http_code'] == 200 AND $FRARR_curl_getinfo['content_type'] == "application/zip") {
        $FR_VC_ZIP_FILE_EXIST = 1;
        // ECHO_4("Remote ZIP file exists and can be downloaded.","text-success");
    } else {
        // ECHO_4("Remote ZIP file not exists and can not be downloaded.","text-danger");
    }
    curl_close($ch);
//END>>



?>
</section>
<!-- 1 SCRIPT E -->  




<section>
   <div class="container">
    <div class="col-md-11">
 
        <?php if($FR_VC_ZIP_FILE_EXIST == 1){ ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><?php echo "Website version <b>3.$FRc_NEXT_VALID_UPDATE_VERSION </b> is ready to update";?></h3>
                <form action="" method="post">
                    <button type="submit" name="FRTRIG_SITE_UPDATE" class="btn btn-success">Update Now</button>
                </form>
            </div>
        </div>
        <?php } ?>


        <?php if($FR_VC_ZIP_FILE_EXIST == ""){ ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><?php echo "Dear Boss $UsrName! <br> Latest Website Version <b>3.$FR_SOFT_VERSION </b> Running on Your eCommerce Website";?></h3>
            </div>
        </div>
        <?php } ?>

    </div>
   </div>
</section>






<?php require_once('frd1_footer.php'); ?>