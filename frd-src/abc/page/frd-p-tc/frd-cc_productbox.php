<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product Box Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Product Box Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD PRODUCT BOX 1 STYLE  UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_122'])){
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
        if(isset($fr_ow_122)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_122 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

        $fr_ow_123 = "$f_border_px $f_border_type $f_border_color";
        $fr_ow_124 = "none";

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_122 = '$fr_ow_122',
            fr_ow_123 = '$fr_ow_123',
            fr_ow_124 = '$fr_ow_124',
            fr_ow_125 = '$fr_ow_125',
            fr_ow_126 = '$fr_ow_126',
            fr_ow_127 = '$fr_ow_127',
            fr_ow_128 = '$fr_ow_128',
            fr_ow_129 = '$fr_ow_129',
            fr_ow_130 = '$fr_ow_130',
            fr_ow_131 = '$fr_ow_131',
            fr_ow_132 = '$fr_ow_132',
            fr_ow_133 = '$fr_ow_133',
            fr_ow_134 = '$fr_ow_134',
            fr_ow_135 = '$fr_ow_135',
            fr_ow_136 = '$fr_ow_136',
            fr_ow_137 = '$fr_ow_137',
            fr_ow_138 = '$fr_ow_138',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_Style_OW_CSS = "
/*****************************************************************/
/* FRD PRODUCT BOX 1  */
/*****************************************************************/
.frs_pbox_1 {
    background: $fr_ow_122 !important;
    border: $fr_ow_123 !important;
    box-shadow: $fr_ow_124;
}

.frs_pbox_1 .frs_dcb{
    background: $fr_ow_125 !important;
    color: $fr_ow_126 !important;
}

.frs_pbox_1 .stock_out_alert{
    background: $fr_ow_127 !important;
    color: $fr_ow_128 !important;
}

.frs_pbox_1 .fr_c1 .pprice .markprice{
    color: $fr_ow_129 !important;
}
.frs_pbox_1 .fr_c1 .pprice{
    color: $fr_ow_130 !important;
}
.frs_pbox_1 .fr_c1 .ptitel{
    color: $fr_ow_131 !important;
}

.frs_pbox_1 .frcontent {
    background: $fr_ow_132 !important;      
}

.frs_pbox_1 button.on{
    background: $fr_ow_133 !important;
    color: $fr_ow_134 !important;
}

.frs_pbox_1 button.atc{
    background: $fr_ow_135 !important;
    color: $fr_ow_136 !important;
}

.frs_pbox_1 button.vd{
    background: $fr_ow_137 !important;
    color: $fr_ow_138 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_productbox = '$FRc_CC_CSS_CODE', 
                    fr_cc_productbox_id = 1  
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




//---------------------------------------------------------
//FRD PRODUCT BOX 2 STYLE  UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_102'])){
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
        if(isset($fr_ow_102)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_102 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }


        $fr_ow_104 = "$f_border_px $f_border_type $f_border_color";
        $fr_ow_103 = "none";


        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_102 = '$fr_ow_102',
            fr_ow_103 = '$fr_ow_103',
            fr_ow_104 = '$fr_ow_104',
            fr_ow_105 = '$fr_ow_105',
            fr_ow_106 = '$fr_ow_106',
            fr_ow_107 = '$fr_ow_107',
            fr_ow_108 = '$fr_ow_108',
            fr_ow_109 = '$fr_ow_109',
            fr_ow_111 = '$fr_ow_111',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/*****************************************************************/
/* FRD PRODUCT BOX 2  */
/*****************************************************************/
.frs_pbox_2 {
    background: $fr_ow_102 !important;
    box-shadow: $fr_ow_103;
    border: $fr_ow_104 !important;
}

.frs_pbox_2 .frs_dcb{
    background: $fr_ow_105 !important;
    color: $fr_ow_106 !important;
}

.frs_pbox_2 .stock_out_alert{
        background: $fr_ow_107 !important;
        color: $fr_ow_108 !important;
}

.frs_pbox_2 .fr_c1 .pprice .markprice{
    color: $fr_ow_109 !important;
}
.frs_pbox_2 .fr_c1 .pprice{
    color: $fr_ow_110 !important;
}
.frs_pbox_2 .fr_c1 .ptitel{
    color: $fr_ow_111 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_productbox = '$FRc_CC_CSS_CODE', 
                    fr_cc_productbox_id = 1  
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




//---------------------------------------------------------
//FRD PRODUCT BOX 3 STYLE  UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_112'])){
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
        if(isset($fr_ow_112)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_112 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

        $fr_ow_113 = "$f_border_px $f_border_type $f_border_color";
        $fr_ow_114 = "none";

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_112 = '$fr_ow_112',
            fr_ow_113 = '$fr_ow_113',
            fr_ow_114 = '$fr_ow_114',
            fr_ow_115 = '$fr_ow_115',
            fr_ow_116 = '$fr_ow_116',
            fr_ow_117 = '$fr_ow_117',
            fr_ow_118 = '$fr_ow_118',
            fr_ow_119 = '$fr_ow_119',
            fr_ow_120 = '$fr_ow_120',
            fr_ow_121 = '$fr_ow_121',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/*****************************************************************/
/* FRD PRODUCT BOX 3 */
/*****************************************************************/
.fr_pbox_3 {
    background: $fr_ow_112 !important;
    border: $fr_ow_113 !important;
    box-shadow: $fr_ow_114;
}
.fr_pbox_3 .frs_discount{
        background: $fr_ow_115 !important;
        color: $fr_ow_116 !important;
}
.fr_pbox_3 .stock_out_alert{
        background: $fr_ow_117 !important;
        color: $fr_ow_118 !important;
}
.fr_pbox_3 .frinfo .ptitel{
    color: $fr_ow_119 !important;
}
.fr_pbox_3 .frinfo .pprice .markprice{
    color: $fr_ow_120 !important;
}
.fr_pbox_3 .frinfo .pprice{
    color: $fr_ow_121 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_productbox = '$FRc_CC_CSS_CODE', 
                    fr_cc_productbox_id = 1  
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




//---------------------------------------------------------
//FRD PRODUCT BOX 4 STYLE  UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_47'])){
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
        if(isset($fr_ow_47)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_47 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }


        

        $fr_ow_41 = "$f_border_px $f_border_type $f_border_color";
        $fr_ow_40 = "none";



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_40 = '$fr_ow_40',
            fr_ow_41 = '$fr_ow_41',
            fr_ow_41_1 = '$fr_ow_41_1',
            fr_ow_42 = '$fr_ow_42',
            fr_ow_43 = '$fr_ow_43',
            fr_ow_46 = '$fr_ow_46',
            fr_ow_47 = '$fr_ow_47',
            fr_ow_48 = '$fr_ow_48',
            fr_ow_49 = '$fr_ow_49',
            fr_ow_50 = '$fr_ow_50',
            fr_ow_51 = '$fr_ow_51',
            fr_ow_52 = '$fr_ow_52',
            fr_ow_53 = '$fr_ow_53',
            fr_ow_54 = '$fr_ow_54',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/*****************************************************************/
/* FRD PRODUCT BOX 4 */
/*****************************************************************/
.fr_pbox_4 {
    box-shadow: $fr_ow_40;
    border: $fr_ow_41 !important;
    background: $fr_ow_41_1 !important;
}

.fr_pbox_4 .frs_discount{
        background: $fr_ow_42  !important;
        color: $fr_ow_43 !important;
}

.fr_pbox_4 .stock_out_alert{
        background: $fr_ow_46 !important;
        color: $fr_ow_47 !important;
}

.fr_pbox_4 .frinfo .ptitel{
    color: $fr_ow_48 !important;
}

.fr_pbox_4 .frinfo .pprice .markprice{
    color: $fr_ow_49 !important;
}
.fr_pbox_4 .frinfo .pprice{
    color: $fr_ow_50 !important;
}

.fr_pbox_4 .pbtn button.frbtn_ordernow{
    background: $fr_ow_51 !important;
    color: $fr_ow_52 !important;
}
.fr_pbox_4 .pbtn button.frbtn_ordernow:hover{
    background: $fr_ow_53 !important;
    color: $fr_ow_54 !important;
}
";

               try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_productbox = '$FRc_CC_CSS_CODE', 
                    fr_cc_productbox_id = 1  
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



<?php if($FRcf_ProBoxNum == 1){
 $fr_ow_123_arr = explode(" ",$fr_ow_123);
?>
<!--FRD PRODUCT BOX 1 -->
<div id="ow_product_box" class="row">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Product Box #$FRcf_ProBoxNum";?>">Product Box Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Box Background Color</td>
                    <td><input type="color" name="fr_ow_122" value="<?php echo "$fr_ow_122"?>"></td>
                </tr>
                <tr>
                    <td>Border</td>
                    <td>
                        <select class='form-control' name='f_border_px' required>
                            <option value='<?php echo $fr_ow_123_arr[0];?>'><?php echo $fr_ow_123_arr[0];?></option>
                            <option value='1px'>1px</option>
                            <option value='2px'>2px</option>
                            <option value='3px'>3px</option>
                            <option value='4px'>4px</option>
                            <option value='5px'>5px</option>
                        </select>
                        <select class='form-control' name='f_border_type' id='' required>
                            <option value='<?php echo $fr_ow_123_arr[1];?>'><?php echo $fr_ow_123_arr[1];?></option>
                            <option value='solid'>Solid</option>
                            <option value='solid'>Solid</option>
                            <option value='dashed'>Dashed</option>
                            <option value='dotted'>Dotted </option>
                            <option value='double'>Double </option>
                            <option value='none'>None </option>
                        </select>
                        <input class="form-control" type="color" name="f_border_color" value="<?php echo $fr_ow_123_arr[2];?>">
                    </td>
                </tr>
                <tr>
                    <td>Discount Background Color</td>
                    <td><input type="color" name="fr_ow_125" value="<?php echo "$fr_ow_125"?>"></td>
                </tr>
                <tr>
                    <td>Discount Text Color</td>
                    <td><input type="color" name="fr_ow_126" value="<?php echo "$fr_ow_126"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Background Color</td>
                    <td><input type="color" name="fr_ow_127" value="<?php echo "$fr_ow_127"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Text Color</td>
                    <td><input type="color" name="fr_ow_128" value="<?php echo "$fr_ow_128"?>"></td>
                </tr>
                <tr>
                    <td>Product Title Text Color</td>
                    <td><input type="color" name="fr_ow_131" value="<?php echo "$fr_ow_131"?>"></td>
                </tr>
                <tr>
                    <td>Market Price Text Color</td>
                    <td><input type="color" name="fr_ow_129" value="<?php echo "$fr_ow_129"?>"></td>
                </tr>
                <tr>
                    <td>Sells Price Text Color</td>
                    <td><input type="color" name="fr_ow_130" value="<?php echo "$fr_ow_130"?>"></td>
                </tr>

                <tr>
                    <td>Overlay Background Color</td>
                    <td><input type="color" name="fr_ow_132" value="<?php echo "$fr_ow_132"?>"></td>
                </tr>
                <tr>
                    <td>View Details Button Background Color</td>
                    <td><input type="color" name="fr_ow_137" value="<?php echo "$fr_ow_137"?>"></td>
                </tr>
                <tr>
                    <td>View Details Button Text Color</td>
                    <td><input type="color" name="fr_ow_138" value="<?php echo "$fr_ow_138"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Background Color</td>
                    <td><input type="color" name="fr_ow_133" value="<?php echo "$fr_ow_133"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Text Color</td>
                    <td><input type="color" name="fr_ow_134" value="<?php echo "$fr_ow_134"?>"></td>
                </tr>
                <tr>
                    <td>Add To Cart Button Background Color</td>
                    <td><input type="color" name="fr_ow_135" value="<?php echo "$fr_ow_135"?>"></td>
                </tr>
                <tr>
                    <td>Add To Cart Button Text Color</td>
                    <td><input type="color" name="fr_ow_136" value="<?php echo "$fr_ow_136"?>"></td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Product Box Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?>




<?php if($FRcf_ProBoxNum == 2){
 $fr_ow_104_arr = explode(" ",$fr_ow_104);
?>
<!--FRD PRODUCT BOX 2 -->
<div id="ow_product_box" class="row">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Product Box #$FRcf_ProBoxNum";?>">Product Box Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Box Background Color</td>
                    <td><input type="color" name="fr_ow_102" value="<?php echo "$fr_ow_102"?>"></td>
                </tr>
                <tr>
                    <td>Border</td>
                    <td>
                        <select class='form-control' name='f_border_px' required>
                            <option value='<?php echo $fr_ow_104_arr[0];?>'><?php echo $fr_ow_104_arr[0];?></option>
                            <option value='1px'>1px</option>
                            <option value='2px'>2px</option>
                            <option value='3px'>3px</option>
                            <option value='4px'>4px</option>
                            <option value='5px'>5px</option>
                        </select>
                        <select class='form-control' name='f_border_type' id='' required>
                            <option value='<?php echo $fr_ow_104_arr[1];?>'><?php echo $fr_ow_104_arr[1];?></option>
                            <option value='solid'>Solid</option>
                            <option value='solid'>Solid</option>
                            <option value='dashed'>Dashed</option>
                            <option value='dotted'>Dotted </option>
                            <option value='double'>Double </option>
                            <option value='none'>None </option>
                        </select>
                        <input class="form-control" type="color" name="f_border_color" value="<?php echo $fr_ow_104_arr[2];?>">
                    </td>
                </tr>
                <tr>
                    <td>Discount Background Color</td>
                    <td><input type="color" name="fr_ow_105" value="<?php echo "$fr_ow_105"?>"></td>
                </tr>
                <tr>
                    <td>Discount Text Color</td>
                    <td><input type="color" name="fr_ow_106" value="<?php echo "$fr_ow_106"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Background Color</td>
                    <td><input type="color" name="fr_ow_107" value="<?php echo "$fr_ow_107"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Text Color</td>
                    <td><input type="color" name="fr_ow_108" value="<?php echo "$fr_ow_108"?>"></td>
                </tr>
                <tr>
                    <td>Product Title Text Color</td>
                    <td><input type="color" name="fr_ow_111" value="<?php echo "$fr_ow_111"?>"></td>
                </tr>
                <tr>
                    <td>Market Price Text Color</td>
                    <td><input type="color" name="fr_ow_109" value="<?php echo "$fr_ow_109"?>"></td>
                </tr>
                <tr>
                    <td>Sells Price Text Color</td>
                    <td><input type="color" name="fr_ow_110" value="<?php echo "$fr_ow_110"?>"></td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Product Box Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?>






<?php if($FRcf_ProBoxNum == 3){
 $fr_ow_113_arr = explode(" ",$fr_ow_113);
?>
<!--FRD PRODUCT BOX 3 -->
<div id="ow_product_box" class="row">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Product Box #$FRcf_ProBoxNum";?>">Product Box Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Box Background Color</td>
                    <td><input type="color" name="fr_ow_112" value="<?php echo "$fr_ow_112"?>"></td>
                </tr>
                <tr>
                    <td>Border</td>
                    <td>
                        <select class='form-control' name='f_border_px' required>
                            <option value='<?php echo $fr_ow_113_arr[0];?>'><?php echo $fr_ow_113_arr[0];?></option>
                            <option value='1px'>1px</option>
                            <option value='2px'>2px</option>
                            <option value='3px'>3px</option>
                            <option value='4px'>4px</option>
                            <option value='5px'>5px</option>
                        </select>
                        <select class='form-control' name='f_border_type' id='' required>
                            <option value='<?php echo $fr_ow_113_arr[1];?>'><?php echo $fr_ow_113_arr[1];?></option>
                            <option value='solid'>Solid</option>
                            <option value='solid'>Solid</option>
                            <option value='dashed'>Dashed</option>
                            <option value='dotted'>Dotted </option>
                            <option value='double'>Double </option>
                            <option value='none'>None </option>
                        </select>
                        <input class="form-control" type="color" name="f_border_color" value="<?php echo $fr_ow_113_arr[2];?>">
                    </td>
                </tr>
                <tr>
                    <td>Discount Background Color</td>
                    <td><input type="color" name="fr_ow_115" value="<?php echo "$fr_ow_115"?>"></td>
                </tr>
                <tr>
                    <td>Discount Text Color</td>
                    <td><input type="color" name="fr_ow_116" value="<?php echo "$fr_ow_116"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Background Color</td>
                    <td><input type="color" name="fr_ow_117" value="<?php echo "$fr_ow_117"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Text Color</td>
                    <td><input type="color" name="fr_ow_118" value="<?php echo "$fr_ow_118"?>"></td>
                </tr>
                <tr>
                    <td>Product Title Text Color</td>
                    <td><input type="color" name="fr_ow_119" value="<?php echo "$fr_ow_119"?>"></td>
                </tr>
                <tr>
                    <td>Market Price Text Color</td>
                    <td><input type="color" name="fr_ow_120" value="<?php echo "$fr_ow_120"?>"></td>
                </tr>
                <tr>
                    <td>Sells Price Text Color</td>
                    <td><input type="color" name="fr_ow_121" value="<?php echo "$fr_ow_121"?>"></td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Product Box Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?>







<?php if($FRcf_ProBoxNum == 4){
 $fr_ow_41_arr = explode(" ",$fr_ow_41);
?>
<!--FRD PRODUCT BOX 4 -->
<div id="ow_product_box" class="row">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "PRODUCT BOX #$FRcf_ProBoxNum";?>">PRODUCT BOX Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Box Background Color</td>
                    <td><input type="color" name="fr_ow_41_1" value="<?php echo "$fr_ow_41_1"?>"></td>
                </tr>
                <tr>
                    <td>Border</td>
                    <td>
                        <select class='form-control' name='f_border_px' required>
                            <option value='<?php echo $fr_ow_41_arr[0];?>'><?php echo $fr_ow_41_arr[0];?></option>
                            <option value='1px'>1px</option>
                            <option value='2px'>2px</option>
                            <option value='3px'>3px</option>
                            <option value='4px'>4px</option>
                            <option value='5px'>5px</option>
                        </select>
                        <select class='form-control' name='f_border_type' id='' required>
                            <option value='<?php echo $fr_ow_41_arr[1];?>'><?php echo $fr_ow_41_arr[1];?></option>
                            <option value='solid'>Solid</option>
                            <option value='solid'>Solid</option>
                            <option value='dashed'>Dashed</option>
                            <option value='dotted'>Dotted </option>
                            <option value='double'>Double </option>
                            <option value='none'>None </option>
                        </select>
                        <input class="form-control" type="color" name="f_border_color" value="<?php echo $fr_ow_41_arr[2];?>">
                    </td>
                </tr>
                <tr>
                    <td>Discount Background Color</td>
                    <td><input type="color" name="fr_ow_42" value="<?php echo "$fr_ow_42"?>"></td>
                </tr>
                <tr>
                    <td>Discount Text Color</td>
                    <td><input type="color" name="fr_ow_43" value="<?php echo "$fr_ow_43"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Background Color</td>
                    <td><input type="color" name="fr_ow_46" value="<?php echo "$fr_ow_46"?>"></td>
                </tr>
                <tr>
                    <td>StockOut Text Color</td>
                    <td><input type="color" name="fr_ow_47" value="<?php echo "$fr_ow_47"?>"></td>
                </tr>
                <tr>
                    <td>Product Title Text Color</td>
                    <td><input type="color" name="fr_ow_48" value="<?php echo "$fr_ow_48"?>"></td>
                </tr>
                <tr>
                    <td>Market Price Text Color</td>
                    <td><input type="color" name="fr_ow_49" value="<?php echo "$fr_ow_49"?>"></td>
                </tr>
                <tr>
                    <td>Sells Price Text Color</td>
                    <td><input type="color" name="fr_ow_50" value="<?php echo "$fr_ow_50"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Background Color</td>
                    <td><input type="color" name="fr_ow_51" value="<?php echo "$fr_ow_51"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Text Color</td>
                    <td><input type="color" name="fr_ow_52" value="<?php echo "$fr_ow_52"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Background Color (Hover)</td>
                    <td><input type="color" name="fr_ow_53" value="<?php echo "$fr_ow_53"?>"></td>
                </tr>
                <tr>
                    <td>Order Now Button Text Color (Hover)</td>
                    <td><input type="color" name="fr_ow_54" value="<?php echo "$fr_ow_54"?>"></td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Product Box Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?>



</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>  