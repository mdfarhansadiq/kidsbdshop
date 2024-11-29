<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Flash Sales";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Flash Sales </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

//--------------------------------------------------------
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


?>   
</section>
<!-- 1 SCRIPT END -->    

   




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


<?php require_once('frd1_footer.php'); ?> 