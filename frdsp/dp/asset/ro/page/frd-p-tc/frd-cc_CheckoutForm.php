<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Checkout Form Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Checkout Form Color Customize </h2> -->



<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD THEME LEFT SIDE NAVE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_68'])){
    // PR($_POST);

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
        if(isset($fr_ow_68)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_68 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_67 = '$fr_ow_67',
            fr_ow_68 = '$fr_ow_68',
            fr_ow_69 = '$fr_ow_69',
            fr_ow_70 = '$fr_ow_70',
            fr_ow_71 = '$fr_ow_71',
            fr_ow_72 = '$fr_ow_72',
            fr_ow_73 = '$fr_ow_73',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/************************************************************/
/* FRD CHECKOUT FORM  OW */
/***********************************************************/
.OrderSummerysec h4{
    color: $fr_ow_67 !important;
}
.OrderSummerysec{
    background: $fr_ow_68 !important;
}

.fdeliAadd h4{
    color: $fr_ow_69 !important;
}
form.fdeliAadd {
    background: $fr_ow_70 !important;
    border: 1px solid $fr_ow_71;
}

.fdeliAadd button {
    background: $fr_ow_72 !important;
    color: $fr_ow_73 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_checkoutform = '$FRc_CC_CSS_CODE', 
                    fr_cc_checkoutform_id = 1  
                    WHERE fr_cc_id = 1");
                    FRF_COLOR_CUSTOMIZE_FILE_UPDATE($FR_PATH_HD);
                }catch(PDOException $e){
                    FR_SWAL("$UsrName Theme Color Table Data Update Failed","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                }

            }else{
                FR_SWAL("$UsrName Update Failed","","error");
                FR_GO("$FR_THIS_PAGE","3");
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
<div class="col-md-11">


<!-- Mixd -->
<div class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-primary">Checkout Form</h4>
         <form action="" method="POST">
            <table class="table" width="100%">

                <tr>
                    <td>Order Summery Background Color</td>
                    <td><input type="color" name="fr_ow_68" value="<?php echo "$fr_ow_68"?>"></td>
                </tr>
                <tr>
                    <td>Order Summery Title Color</td>
                    <td><input type="color" name="fr_ow_67" value="<?php echo "$fr_ow_67"?>"></td>
                </tr>
                <tr>
                    <td>Order Form Background</td>
                    <td><input type="color" name="fr_ow_70" value="<?php echo "$fr_ow_70"?>"></td>
                </tr>
                <tr>
                    <td>Order Form Border</td>
                    <td><input type="color" name="fr_ow_71" value="<?php echo "$fr_ow_71"?>"></td>
                </tr>
                <tr>
                    <td>Order Form Title Color</td>
                    <td><input type="color" name="fr_ow_69" value="<?php echo "$fr_ow_69"?>"></td>
                </tr>
                <tr>
                    <td>Order Place Button Background</td>
                    <td><input type="color" name="fr_ow_72" value="<?php echo "$fr_ow_72"?>"></td>
                </tr>
                <tr>
                    <td>Order Place Button Text Color</td>
                    <td><input type="color" name="fr_ow_73" value="<?php echo "$fr_ow_73"?>"></td>
                </tr>

            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Update Color</button>
		    </div>
         </form>
    </div>
</div>


</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>   





















