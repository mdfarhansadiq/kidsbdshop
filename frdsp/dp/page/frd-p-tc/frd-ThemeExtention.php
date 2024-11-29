<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Extentions";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Extensions </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frtc_wpo_btn_dp'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_wpo_btn_dp = :frtc_wpo_btn_dp
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_wpo_btn_dp', $frtc_wpo_btn_dp, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}



if(isset($_POST['frtcplug_GTMdataLayer'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtcplug_GTMdataLayer = :frtcplug_GTMdataLayer
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtcplug_GTMdataLayer', $frtcplug_GTMdataLayer, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}





if(isset($_POST['frtc_chatoption'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_chatoption = :frtc_chatoption
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_chatoption', $frtc_chatoption, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
//++++
//++++
//++++
//++++
//---------------------------------------------------------
//FRD COMPANY TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_whatsapp_link'])){

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
        if(isset($fr_whatsapp_link)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_whatsapp_link != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

    
    
        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_cprofile SET 
            fr_whatsapp_link = '$fr_whatsapp_link',
            fr_messenger_link = '$fr_messenger_link',
            dumytxt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("Dear Boss $UsrName!","Update Done! 1","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("Dear Boss $UsrName!","Message Update Failed! 1","error");
                // FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    
}
//END>>






//---------------------------------------------------------
//FRD FLASH SALES DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['f_FR_FLASH_SELLS_MODE'])){

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
        if(isset($f_FR_FLASH_SELLS_MODE)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_FR_FLASH_SELLS_MODE != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }
        
    

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themeconfig SET 
            FR_FLASH_SELLS_MODE = '$f_FR_FLASH_SELLS_MODE',
            FR_FLASH_SELLS_TIME = '$f_FR_FLASH_SELLS_TIME',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                if($f_FR_FLASH_SELLS_MODE == "FRON"){
                    $FR_CONN->exec("UPDATE frd_hpserial SET fr_hp_sec_stat = 1 WHERE fr_hp_sec_name = 'frd-hp-FlashSales'");
                }else{
                    $FR_CONN->exec("UPDATE frd_hpserial SET fr_hp_sec_stat = 0 WHERE fr_hp_sec_name = 'frd-hp-FlashSales'");
                }

                FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ","","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("$UsrName তথ্য আপডেট হয়নি ","","error");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    

}
//END>>



//FRD PARCIAL PAYMENT MESSAGE DATA UPDATE:-
if(isset($_POST['f_pagebody'])){
    $f_pagebody = $_POST['f_pagebody'];
    $frtc_parti_pay = $_POST['frtc_parti_pay'];
    $frtc_parti_pay_tk = $_POST['frtc_parti_pay_tk'];
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_parti_pay = :frtc_parti_pay, 
                frtc_parti_pay_tk = :frtc_parti_pay_tk 
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_parti_pay', $frtc_parti_pay, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_parti_pay_tk', $frtc_parti_pay_tk, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Update Done","success");

                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 19";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");

                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
//END>>


?>   
</section>
<!-- 1 SCRIPT END -->    

   





<?php if($frtex_sLiveChat == 1){ ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="jumbotron" id="" action="" method="post">

                <h3 class="text-center text-success boldd">Social Live Chat</h3>

                <span>Social Live Chat Plugin </span><br>
                <input type="radio" name="frtc_chatoption" value="1" <?php if ($frtc_chatoption == "1") { echo "checked";} ?> required> Activated &#160; &#160;&#160;
                <input type="radio" name="frtc_chatoption" value="0" <?php if ($frtc_chatoption == "0") { echo "checked";} ?> required> Deactivated


                    <br><br>
                    <span>WhatsApp Number </span> <br>
                    <small>[ Ex: https://wa.me/8801688200472 ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_whatsapp_link" value="<?php echo "$fr_whatsapp_link"; ?>">

                    <br>
                    <span>Messenger Chat link </span><br>
                    <small>[ Ex: https://m.me/SpiderSoftware ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_messenger_link" value="<?php echo "$fr_messenger_link"; ?>">

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>





<?php if($frtex_WAordBtn == 1){ ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="jumbotron" id="" action="" method="post">
                <h3 class="text-center text-success boldd">Whatsapp Order</h3>

                        <span>Whatsapp Order Button </span><br>
                        <input type="radio" name="frtc_wpo_btn_dp" value="1" <?php if ($frtc_wpo_btn_dp == "1") { echo "checked";} ?> required> Activated &#160; &#160;&#160;
                        <input type="radio" name="frtc_wpo_btn_dp" value="0" <?php if ($frtc_wpo_btn_dp == "0") { echo "checked";} ?> required> Deactivated

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>






<?php if($frtex_FlashSale == 1){ ?>
    <section>
    <div class="container">
        <div class="row mt-10">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h3 class="text-center text-success boldd">Flash Sales</h3>
            
                <form class="" id="" action="" method="post">
                    
                        <span>Flash Sales Section *</span><br>
                        <input type="radio" name="f_FR_FLASH_SELLS_MODE" value="FRON" <?php if ($FR_FLASH_SELLS_MODE == "FRON") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="f_FR_FLASH_SELLS_MODE" value="FROFF" <?php if ($FR_FLASH_SELLS_MODE == "FROFF") { echo "checked";} ?> required> Hied


                        <br><br>
                        <span>Flash Sales End Time * [Ex: Sep 16, 2022 10:20:00 PM]</span>
                        <input class="form-control" type="text" placeholder="লিখুন *" name="f_FR_FLASH_SELLS_TIME" value="<?php echo "$FR_FLASH_SELLS_TIME"; ?>" required>


                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>




<?php if($frtex_GTM4DL == 1){ ?>
    <section>
    <div class="container">
        <div class="row mt-10">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h3 class="text-center text-success boldd">GTM4 Data Layer</h3>
            
                <form class="" id="" action="" method="post">

                    <span>GTM Data Layer Plugin </span><br>
                    <input type="radio" name="frtcplug_GTMdataLayer" value="1" <?php if ($frtcplug_GTMdataLayer == "1") { echo "checked";} ?> required> Activated &#160; &#160;&#160;
                    <input type="radio" name="frtcplug_GTMdataLayer" value="0" <?php if ($frtcplug_GTMdataLayer == "0") { echo "checked";} ?> required> Deactivated


                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>




    <?php if($frtex_PrPayMess == 1){ ?>
    <section>
        <?php
        //FRD PAGE TABLE DATA READ:-
        $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 19","");
        if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
        } else{ ECHO_4($FRR['FRM']); }
        //END>>
        ?>
        <div class="container">
            <div class="col-md-11">

                <div class="row">
                <div class="col-md-12 jumbotron">

                <h3 class="text-center text-success boldd">Partial Payment Message</h3>

                <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >

                    <span>Partial Payment Message </span><br>
                    <input type="radio" name="frtc_parti_pay" value="1" <?php if ($frtc_parti_pay == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                    <input type="radio" name="frtc_parti_pay" value="0" <?php if ($frtc_parti_pay == "0") { echo "checked";} ?> required> Hide

                    
                    <br><br>
                    <span>Partial Payment Amount *</span>
                    <input class="form-control" type="number" placeholder="লিখুন *" name="frtc_parti_pay_tk" value="<?php echo "$frtc_parti_pay_tk"; ?>" required>

                    <br>
                    <span>Partial Payment Message *</span>
                    <textarea class="form-control" name="f_pagebody" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>

                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  

                </form>

                </div> 
                </div>


            </div>
        </div>
    </section>
    <?php } ?>




    <?php 
    if($frtex_sLiveChat == 0 && $frtex_WAordBtn == 0 && $frtex_FlashSale == 0 && $frtex_GTM4DL == 0 && $frtex_PrPayMess == 0){
        FR_COMMING_SOON(); 
    }
    ?>






<?php require_once('frd1_footer.php'); ?> 