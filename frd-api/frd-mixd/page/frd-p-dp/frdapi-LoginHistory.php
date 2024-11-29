<?php
if(!isset($_POST['f_spiderecommerce'])){echo "<h6>Access Denied!!!</h6>"; exit;}

$FR_PATH_HD = "../../../../";
require_once($FR_PATH_HD."frd-src/abc/frd-config.php");//FRD CONFIG
require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");//FRD SPIDER FUN PHP
require_once($FR_PATH_HD."frd-src/abc/frd-this-function.php");

header("Access-Control-Allow-Origin: $FRD_HURL");



 $FR_OP_HTML = "";

 $FR_VC_SESSION = "";
 $FR_VC_POST = "";
 

//FRD VC________
    if(isset($_SESSION['sUsrId'])){ 
        extract($_SESSION); $FR_VC_SESSION = 1;
    } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }


//FRD VC________
    if(isset($_POST['f_filt_asc_desc'])){
         $FRs_ASC_DESC = $_POST['f_filt_asc_desc'];
         $FRc_Limit = $_POST['f_filt_limit'];
         $FR_VC_POST = 1; 
    }

    
//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){

        //FRD QUERY MAKING:-
         $FRQ = "SELECT * FROM frd_login_h WHERE fr_log_usr_type = 'Admin' AND fr_log_usr_id = $sUsrId";
         $FRQ .= " ORDER BY fr_log_time $FRs_ASC_DESC LIMIT 0,$FRc_Limit";

        try {
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->execute();
            $Rows = $FRQ->rowCount();
            $ResultArr = $FRQ->fetchAll();
        } catch(PDOException $e){
            ECHO_4($e->getMessage(),"text-center alert alert-danger");
            goto THIS_LAST;
        }


         $FR_OP_HTML .="
        <div class=''>
        <div class='table-responsive'>
            <table class='t_print'>
                    <tr class='alert alert-success boldd'>
                        <td>SL</td>
                        <td>Login ID</td>
                        <td>User ID</td>
                        <td>Type</td>
                        <td>Name</td>
                        <td>IP</td>
                        <td>UID</td>
                        <td>Browser</td>
                        <td>Time</td>
                    </tr>
                <tbody>
                 ";

                if ($Rows > 0) {
                    $FRc_SL = 1;
                    foreach($ResultArr as $FR_ITEM){
                        extract($FR_ITEM);

                        $FR_OP_HTML .= "
                                <tr>
                                    <td>$FRc_SL</td>
                                    <td>$fr_log_id</td>
                                    <td>$fr_log_id</td>
                                    <td>$fr_log_usr_type</td>
                                    <td>$fr_log_usr_name</td>
                                    <td>$fr_log_usr_ip</td>
                                    <td>$fr_log_usr_uid</td>
                                    <td>$fr_log_usr_browser</td>
                                    <td>".date("d-M-Y h:i A",$fr_log_time)."</td>
                                </tr>
                        ";

                        $FRc_SL = ($FRc_SL + 1);
                    }
                }else{
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <tr>
                        <td colspan='9' class='text-center text-danger'>
                           No Login History Found
                        </td>
                    </tr>
                    ";
                }

          $FR_OP_HTML .="
                </tbody>
            </table>
          </div>
        </div>
        ";
     }


THIS_LAST:
echo $FR_OP_HTML;