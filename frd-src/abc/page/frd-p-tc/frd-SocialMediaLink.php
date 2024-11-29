<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Social Media Link";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Social Media Link </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD COMPANY TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['frf_fb_page_link'])){

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
        if(isset($frf_fb_page_link)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($frf_fb_page_link != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

    
        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_cprofile SET 
            fr_cfb_pg = '$frf_fb_page_link',
            fr_whatsapp = '$fr_whatsapp',
            fr_cyoutube = '$fr_cyoutube',
            fr_cinstagram = '$fr_cinstagram',
            fr_ctwitter = '$fr_ctwitter',
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
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    
}
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   



<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <form class="jumbotron" id="" action="" method="post">
                    <span>Facebook Page Link *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_fb_page_link" value="<?php echo "$fr_cfb_pg"; ?>" >


                    <br>
                    <span>WhatsApp Number</span> <br>
                    <small>[ Ex: 8801688200472 ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_whatsapp" value="<?php echo "$fr_whatsapp"; ?>">

                    <br>
                    <span>Youtube Chanel Link *</span><br>
                    <small>[ Ex: https://youtube.com/channel/UCYyY1A-cEfribUcdw_lBcuw ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_cyoutube" value="<?php echo "$fr_cyoutube"; ?>" >

                    <br>
                    <span>Instagram Link *</span><br>
                    <small>[ Ex: https://linkedin.com/in/FazleRabbiDhali ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_cinstagram" value="<?php echo "$fr_cinstagram"; ?>">

                    <br>
                    <span>Twitter Link *</span><br>
                    <small>[ Ex: https://twitter.com/SpiderSoftBD ]</small>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_ctwitter" value="<?php echo "$fr_ctwitter"; ?>">




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






<?php require_once('frd1_footer.php'); ?>   