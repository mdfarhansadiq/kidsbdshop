<?php 
require_once('frd1_whoami.php');
$FR_ptitle="SMS Services Provider Config";//PAGE TITLE
$p="SMSspLIST";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> SMS Services Provider Config </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
 
?>   
</section>
<!-- 1 SCRIPT END -->    





<!-- 1 SCRIPT START -->
<section>
    <?php

    //FRD_VC____________________________________:-
    if (!isset($FRurl[1]) or $FRurl[1] == "") {
        header("location:$FR_THISHURL/dashboard/?FRH=gsgsrbx");
    }
    $FRc_SMS_SP_IDx = $FRurl[1]; //SMS SP ID
    $FR_THIS_PAGE = "$FR_THISHURL/smss-SMSspEdit/$FRc_SMS_SP_IDx";







//---------------------------------------------------------
//FRD  UPDATE DATA:-
//---------------------------------------------------------
if(isset($_POST['fr_sms_sp_name'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
    //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $keys = array_keys($_POST);
        foreach($keys as $key){
            $$key = $_POST["$key"];
            //echo "$key <br>";
        }
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($fr_sms_sp_name)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_sms_sp_name != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

        if(!isset($fr_sms_sp_panel_userid)){$fr_sms_sp_panel_userid = NULL;}
        if(!isset($fr_sms_sp_panel_userpsw)){$fr_sms_sp_panel_userpsw = NULL;}



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){

            $FRQ = "UPDATE frd_sms_sp SET 
            fr_sms_sp_panel_userid = '$fr_sms_sp_panel_userid',
            fr_sms_sp_panel_userpsw = '$fr_sms_sp_panel_userpsw',
            fr_sms_sender_num = '$fr_sms_sender_num',
            fr_sms_api_key = '$fr_sms_api_key',
            fr_sms_sp_stat = $fr_sms_sp_stat
            WHERE id = $FRc_SMS_SP_IDx";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName!","Update Done 1","success");

                //FRD DATA UPDATE S:-
                    try{
                        if($fr_sms_sp_stat == 1){$frd_smsapi_ex = "onn";}else{$frd_smsapi_ex = "off";}
                        $FRQ = "UPDATE frd_themeconfig SET 
                        frd_smsapi_ex = :frd_smsapi_ex 
                        WHERE id = 1";
                        $FRQ = $FR_CONN->prepare("$FRQ");
                        $FRQ->bindParam(':frd_smsapi_ex', $frd_smsapi_ex, PDO::PARAM_STR);
                        $FRQ->execute();
                        FR_SWAL("Dear Boss $UsrName!","Update Done","success");
                        FR_GO("$FR_THIS_PAGE","1");
                        exit;
                    }catch(PDOException $e){
                        FR_SWAL("Dear Boss $UsrName!","Update Failed!","error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                //END>>

            }else{
                FR_SWAL("Dear Boss $UsrName!","Update Failed!","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }
        }
    

}
//END>>




//FRD TABLE DATA  READ :-
$FRR = FR_QSEL("SELECT * FROM frd_sms_sp WHERE id = $FRc_SMS_SP_IDx","");
if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
        
        if($fr_sms_sp_stat == 0){$fr_sms_sp_stat_M = "DEACTIVATED";}
        if($fr_sms_sp_stat == 1){$fr_sms_sp_stat_M = "ACTIVATED";}

    } else{ ECHO_4($FRR['FRM']); }
//END>>

    ?>
</section>
<!-- 1 SCRIPT END -->









<section>
    <div class="container">
    <div class="col-md-11">
    
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">

                    <h3 class="text-center text-info boldd"><?php echo "$fr_sms_sp_name"; ?></h3>

                    <input class="form-control" type="hidden" name="fr_sms_sp_name" value="<?php echo "$fr_sms_sp_name"; ?>" >


                    <br>
                    <span>SMS Sender Number *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_sms_sender_num" value="<?php echo "$fr_sms_sender_num"; ?>">

                    <br>
                    <span title="<?php echo "$fr_sms_hit_api";?>">SMS API KEY *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_sms_api_key" value="<?php echo "$fr_sms_api_key";?>">

    
                    <?php if($FRc_SMS_SP_IDx == 3){ ?>
                    <br>
                    <span>SMS Services Provider Panel Login Id </span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_sms_sp_panel_userid" value="<?php echo "$fr_sms_sp_panel_userid"; ?>">
                    <br>
                    <span>SMS Services Provider Panel Login Password </span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_sms_sp_panel_userpsw" value="<?php echo "$fr_sms_sp_panel_userpsw"; ?>">
                    <?php } ?>


                    <br>
                    <span>STATUS *</span>
                    <select class='form-control' name='fr_sms_sp_stat' id='' required>
                        <?php
                            echo "<option value='$fr_sms_sp_stat'>$fr_sms_sp_stat_M</option>";
                            echo "<option value='1'>ACTIVATED</option>";
                            echo "<option value='0'>DEACTIVATED</option>";
                        ?>
                    </select>

        


                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit" name="UserInfoUpdate_SUB"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>




            </div>
            <div class="col-md-2"></div>
        </div>


        


    </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>