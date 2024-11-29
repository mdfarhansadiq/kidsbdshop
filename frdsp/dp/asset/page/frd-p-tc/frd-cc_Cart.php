<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Cart Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Color Customize </h2> -->



<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD THEME CART CC UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_22'])){
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
        if(isset($fr_ow_22)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_22 != ""){ $FR_VC_ARF = 1; }else{ FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_22 = '$fr_ow_22',
            fr_ow_22_1 = '$fr_ow_22_1',
            fr_ow_23 = '$fr_ow_23',
            fr_ow_24 = '$fr_ow_24',
            fr_ow_25 = '$fr_ow_25',
            fr_ow_26 = '$fr_ow_26',
            fr_ow_27 = '$fr_ow_27',
            fr_ow_28 = '$fr_ow_28',
            fr_ow_29 = '$fr_ow_29',
            fr_ow_30 = '$fr_ow_30',
            fr_ow_31_1 = '$fr_ow_31_1',
            fr_ow_31_2 = '$fr_ow_31_2',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/**************************************************************/
/* RIGHT SIDENAV CART | FRD SHOPPING CART | CART-CART-1 */
/**************************************************************/
#mySidenav_right,.frcart1 .cart_items{
    background: $fr_ow_22 !important;
}
.frcart1 .frlogo_div{
    background: $fr_ow_22_1 !important;
}
.sidenav_right .cart_title, .sidenav_right .cart_title small{
    color: $fr_ow_23 !important;
}
.sidenav_right .btn_cartclose {
    background: $fr_ow_24 !important;
    color: $fr_ow_25 !important;
}
.btn_chackout {
    background: $fr_ow_26 !important;
    color: $fr_ow_27 !important
}
.frcart1 .item_title{
    color: $fr_ow_28 !important;
}
.frcart1 .price{
    color: $fr_ow_29 !important;
}
.frcart1 .cpro_qty{
    color: $fr_ow_30 !important;
}
.pro_qtyup_btn,
.pro_qtydown_btn {
    color: $fr_ow_31_1 !important;
}
.t_cartt .btn_proremove {
    color: $fr_ow_31_2 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_cart = '$FRc_CC_CSS_CODE', 
                    fr_cc_cart_id = 1  
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


<!--  -->
<div class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-primary">Cart</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Cart Background Color</td>
                    <td><input type="color" name="fr_ow_22" value="<?php echo "$fr_ow_22"?>"></td>
                </tr>
                <tr>
                    <td>Cart Logo Background Color</td>
                    <td><input type="color" name="fr_ow_22_1" value="<?php echo "$fr_ow_22_1"?>"></td>
                </tr>
                <tr>
                    <td>Cart Title Text Color</td>
                    <td><input type="color" name="fr_ow_23" value="<?php echo "$fr_ow_23"?>"></td>
                </tr>
                <tr>
                    <td>Cart Close Button Background</td>
                    <td><input type="color" name="fr_ow_24" value="<?php echo "$fr_ow_24"?>"></td>
                </tr>
                <tr>
                    <td>Cart Close Button text</td>
                    <td><input type="color" name="fr_ow_25" value="<?php echo "$fr_ow_25"?>"></td>
                </tr>
                <tr>
                    <td>Checkout Button Background</td>
                    <td><input type="color" name="fr_ow_26" value="<?php echo "$fr_ow_26"?>"></td>
                </tr>
                <tr>
                    <td>Checkout Button text</td>
                    <td><input type="color" name="fr_ow_27" value="<?php echo "$fr_ow_27"?>"></td>
                </tr>
                <tr>
                    <td>Item Title Color</td>
                    <td><input type="color" name="fr_ow_28" value="<?php echo "$fr_ow_28"?>"></td>
                </tr>
                <tr>
                    <td>Item Price Color</td>
                    <td><input type="color" name="fr_ow_29" value="<?php echo "$fr_ow_29"?>"></td>
                </tr>
                <tr>
                    <td>Item Qty Color</td>
                    <td><input type="color" name="fr_ow_30" value="<?php echo "$fr_ow_30"?>"></td>
                </tr>
                <tr>
                    <td>Qty Up/Down Button Color</td>
                    <td><input type="color" name="fr_ow_31_1" value="<?php echo "$fr_ow_31_1"?>"></td>
                </tr>
                <tr>
                    <td>Item Remove Button Color</td>
                    <td><input type="color" name="fr_ow_31_2" value="<?php echo "$fr_ow_31_2"?>"></td>
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