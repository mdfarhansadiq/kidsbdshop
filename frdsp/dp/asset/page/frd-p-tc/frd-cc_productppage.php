<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product Presentation Page Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT">Product Presentation Page Color Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

//---------------------------------------------------------
//FRD SINGLE PRODUCT PAGE 1 STYLE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_78'])){
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
        if(isset($fr_ow_78)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_78 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_78 = '$fr_ow_78',
            fr_ow_79 = '$fr_ow_79',
            fr_ow_80 = '$fr_ow_80',
            fr_ow_81 = '$fr_ow_81',
            fr_ow_82 = '$fr_ow_82',
            fr_ow_83 = '$fr_ow_83',
            fr_ow_84 = '$fr_ow_84',
            fr_ow_85 = '$fr_ow_85',
            fr_ow_86 = '$fr_ow_86',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = ".left_side .sp_addtocart_btn {
    background: $fr_ow_78 !important;
    color: $fr_ow_79 !important;
}

.left_side .sp_frdbtn_ordernow {
    background: $fr_ow_80 !important;
    color: $fr_ow_81 !important;
}

.left_side .sp_frdbtn_co, .left_side .sp_frdbtn_co a{
    background: $fr_ow_82 !important;
    color: $fr_ow_83 !important;
}

.left_side .sp_frdbtn_wao{
    background: $fr_ow_84 !important;
    color: $fr_ow_85 !important;
}

.sells_price{
    color: $fr_ow_86 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_productppage = '$FRc_CC_CSS_CODE', 
                    fr_cc_productppage_id = 1  
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
<div class="col-md-11 mt-10">


<!--FRD SINGLE PRODUCT PAGE 1 -->
<div id="ow_single_product_page" class="row">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "SingleProduct Page #";?>">Single Product Page Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Sells Price Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_86" value="<?php echo "$fr_ow_86"?>">
                    </td>
                </tr>
                <tr>
                    <td>Add To Cart Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_78" value="<?php echo "$fr_ow_78"?>">
                    </td>
                </tr>
                <tr>
                    <td>Add To Cart Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_79" value="<?php echo "$fr_ow_79"?>">
                    </td>
                </tr>
                <tr>
                    <td>Order Now Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_80" value="<?php echo "$fr_ow_80"?>">
                    </td>
                </tr>
                <tr>
                    <td>Order Now Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_81" value="<?php echo "$fr_ow_81"?>">
                    </td>
                </tr>
                <tr>
                    <td>Call Order Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_82" value="<?php echo "$fr_ow_82"?>">
                    </td>
                </tr>
                <tr>
                    <td>Call Order Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_83" value="<?php echo "$fr_ow_83"?>">
                    </td>
                </tr>
                <tr>
                    <td>WhatsApp Order Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_84" value="<?php echo "$fr_ow_84"?>">
                    </td>
                </tr>
                <tr>
                    <td>WhatsApp Order Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_85" value="<?php echo "$fr_ow_85"?>">
                    </td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Single Product Page Color</button>
		    </div>
         </form>
    </div>
</div>


</div>
</div>
</section>





<?php require_once('frd1_footer.php'); ?>  