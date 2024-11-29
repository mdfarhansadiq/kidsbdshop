<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Social Live Chat";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Social Live Chat </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 



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


?>   
</section>
<!-- 1 SCRIPT END -->    

   






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







<?php require_once('frd1_footer.php'); ?> 