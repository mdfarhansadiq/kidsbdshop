<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Home Page Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Home Page Color Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD HOME PAGE 1 STYLE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_hp_1'])){
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
        if(isset($fr_ow_hp_1)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_hp_1 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_hp_1 = '$fr_ow_hp_1',
            fr_ow_hp_2 = '$fr_ow_hp_2',
            fr_ow_hp_3 = '$fr_ow_hp_3',
            fr_ow_hp_4 = '$fr_ow_hp_4',
            fr_ow_hp_5 = '$fr_ow_hp_5',
            fr_ow_hp_6 = '$fr_ow_hp_6',
            fr_ow_hp_7 = '$fr_ow_hp_7',
            fr_ow_hp_8 = '$fr_ow_hp_8',
            fr_ow_hp_9 = '$fr_ow_hp_9',
            fr_ow_hp_10 = '$fr_ow_hp_10',
            fr_ow_hp_11 = '$fr_ow_hp_11',
            fr_ow_hp_12 = '$fr_ow_hp_12',
            fr_ow_hp_13 = '$fr_ow_hp_13',
            fr_ow_hp_14 = '$fr_ow_hp_14',
            fr_ow_hp_15 = '$fr_ow_hp_15',
            fr_ow_hp_16 = '$fr_ow_hp_16',
            fr_ow_hp_18 = '$fr_ow_hp_18',
            fr_ow_hp_19 = '$fr_ow_hp_19',
            fr_ow_hp_20 = '$fr_ow_hp_20',
            fr_ow_hp_21 = '$fr_ow_hp_21',
            fr_ow_hp_22 = '$fr_ow_hp_22',
            fr_ow_hp_23 = '$fr_ow_hp_23',
            fr_ow_hp_24 = '$fr_ow_hp_24',
            fr_ow_hp_25 = '$fr_ow_hp_25',
            fr_ow_hp_26 = '$fr_ow_hp_26',
            fr_ow_hp_27 = '$fr_ow_hp_27',
            fr_ow_hp_28 = '$fr_ow_hp_28',
            fr_ow_hp_29 = '$fr_ow_hp_29',
            fr_ow_hp_30 = '$fr_ow_hp_30',
            fr_ow_hp_31 = '$fr_ow_hp_31',
            fr_ow_hp_32 = '$fr_ow_hp_32',
            fr_ow_hp_33 = '$fr_ow_hp_33',
            fr_ow_hp_34 = '$fr_ow_hp_34',
            fr_ow_hp_35 = '$fr_ow_hp_35',
            fr_ow_hp_36 = '$fr_ow_hp_36',
            fr_ow_hp_37 = '$fr_ow_hp_37',
            fr_ow_hp_38 = '$fr_ow_hp_38',
            fr_ow_hp_39 = '$fr_ow_hp_39',
            fr_ow_hp_40 = '$fr_ow_hp_40',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/**********************************************/
/* FRD TOP SECTION */
/**********************************************/
#top_secfrd {
    background: $fr_ow_hp_1 !important;
}

/***************************************************/
/* FRD CATEGORY CAROSOL SECTION */
/************************************************ ***/
.popo_cat_crosol_secfrd {
    background: $fr_ow_hp_2 !important;
}
.popo_cat_crosol_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_3 !important;
}
.popo_cat_crosol_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_4 !important;
}
.popo_cat_crosol_secfrd .cat_name {
    color: $fr_ow_hp_5 !important;
}

/***************************************************/
/* FRD NEW PRODUCT SECTION */
/************************************************ ***/
.new_arrivel_secfrd {
    background: $fr_ow_hp_6 !important;
}
.new_arrivel_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_7 !important;
}
.new_arrivel_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_8 !important;
}

/***************************************************/
/* FRD TOP SELLS SECTION */
/************************************************ ***/
.topsells_secfrd {
    background: $fr_ow_hp_9 !important;
}
.topsells_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_10 !important;
}
.topsells_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_11 !important;
}

/***************************************************/
/* FRD CATEGORY BASE LAST PRODUCT SECTION */
/************************************************ ***/
.catbaselastpro_secfrd {
    background: $fr_ow_hp_12 !important;
}
.catbaselastpro_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_13 !important;
}
.catbaselastpro_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_14 !important;
}
.frs_subcat a {
    color: $fr_ow_hp_15 !important;
}
.frs_subcat button {
    background: $fr_ow_hp_16 !important;
}

/***************************************************/
/* FRD OFFERS SECTION */
/***************************************************/
.offers_secfrd {
    background: $fr_ow_hp_18 !important;
}
.offers_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_19 !important;
}
.offers_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_20 !important;
}

/********************************************************************/
/* FRD FLASH SEALS  */
/********************************************************************/
#FRcountDownSEC {
    background: $fr_ow_hp_21 !important;
}

#FRcountDownSEC h2.frtitle{
    color: $fr_ow_hp_22 !important;
}
#FRcountDownSEC .frcountdownnum{
    color: $fr_ow_hp_23 !important;
}

.frbtb_seemore_flashsales {
    background: $fr_ow_hp_24 !important;
}
.frbtb_seemore_flashsales a {
    color: $fr_ow_hp_25 !important;
}

/***************************************************/
/* FRD WRITERS SECTION */
/***************************************************/
.writers_crosol_secfrd {
    background: $fr_ow_hp_26 !important;
}
.writers_crosol_secfrd .hp_sectitlefrd{
    color: $fr_ow_hp_27 !important;
}
.writers_crosol_secfrd a.frs_moreseebtn {
    color: $fr_ow_hp_28 !important;
}
.writers_crosol_secfrd .writername {
    color: $fr_ow_hp_29 !important;
}


/***************************************************/
/* GAIN CUST TRUST SEC SECTION */
/************************************************ ***/
.gain_cust_trust_sec {
    background: $fr_ow_hp_30 !important;
}
.gain_cust_trust_sec .frtitle {
    color: $fr_ow_hp_31 !important;
}
.gain_cust_trust_sec .frshortdesc {
    color: $fr_ow_hp_32 !important;
}

/***************************************************/
/* HAPPY CUSTOMER COUNT SECTION */
/************************************************ ***/
.happy_cust_count_sec {
    background: $fr_ow_hp_33 !important;
    color: $fr_ow_hp_34 !important;
}
.happy_cust_count_sec table img {
    background: $fr_ow_hp_35 !important;
}

/**********************************************/
/* BRAND MARQUEE SECTION */
/**********************************************/
.brand_marque_sec {
background: $fr_ow_hp_36 !important;
}
.brand_marque_sec .hp_sectitlefrd{
    color: $fr_ow_hp_37 !important;
}
.brand_marque_sec a.frs_moreseebtn {
    color: $fr_ow_hp_38 !important;
}

.brand_marque_sec .brand_name{
    color: $fr_ow_hp_39 !important;
}
.brand_marque_sec button {
    background: $fr_ow_hp_40 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_homepage = '$FRc_CC_CSS_CODE', 
                    fr_cc_homepage_id = 1  
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

<!--FRD HOME  PAGE 1 -->
<div id="ow_home_page" class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Home Page #";?>">Home Page Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">

                <tr class="text-danger boldd text-center"><td colspan="2">HP Top Slider Section</td></tr>
                <tr>
                    <td>Slider Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_1" value="<?php echo "$fr_ow_hp_1"?>"></td>
                </tr>



                <tr class="text-danger boldd text-center"><td colspan="2">HP Category Carosol Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_2" value="<?php echo "$fr_ow_hp_2"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_3" value="<?php echo "$fr_ow_hp_3"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_4" value="<?php echo "$fr_ow_hp_4"?>"></td>
                </tr>
                <tr>
                    <td> Category Name Text Color</td>
                    <td><input type="color" name="fr_ow_hp_5" value="<?php echo "$fr_ow_hp_5"?>"></td>
                </tr>



                <tr class="text-danger boldd text-center"><td colspan="2">HP New Product Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_6" value="<?php echo "$fr_ow_hp_6"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_7" value="<?php echo "$fr_ow_hp_7"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_8" value="<?php echo "$fr_ow_hp_8"?>"></td>
                </tr>



                <tr class="text-danger boldd text-center"><td colspan="2">HP Top Sells Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_9" value="<?php echo "$fr_ow_hp_9"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_10" value="<?php echo "$fr_ow_hp_10"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_11" value="<?php echo "$fr_ow_hp_11"?>"></td>
                </tr>



                <tr class="text-danger boldd text-center"><td colspan="2">HP Category Base Last Product Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_12" value="<?php echo "$fr_ow_hp_12"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_13" value="<?php echo "$fr_ow_hp_13"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_14" value="<?php echo "$fr_ow_hp_14"?>"></td>
                </tr>
                <tr>
                    <td> Sub Category Button Background Color</td>
                    <td><input type="color" name="fr_ow_hp_16" value="<?php echo "$fr_ow_hp_16"?>"></td>
                </tr>
                <tr>
                    <td> Sub Category Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_15" value="<?php echo "$fr_ow_hp_15"?>"></td>
                </tr>




                <tr class="text-danger boldd text-center"><td colspan="2">HP Offers Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_18" value="<?php echo "$fr_ow_hp_18"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_19" value="<?php echo "$fr_ow_hp_19"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_20" value="<?php echo "$fr_ow_hp_20"?>"></td>
                </tr>




                <tr class="text-danger boldd text-center"><td colspan="2">HP Flash Sales Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_21" value="<?php echo "$fr_ow_hp_21"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_22" value="<?php echo "$fr_ow_hp_22"?>"></td>
                </tr>
                <tr>
                    <td> Count Down Text Color</td>
                    <td><input type="color" name="fr_ow_hp_23" value="<?php echo "$fr_ow_hp_23"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Background Color</td>
                    <td><input type="color" name="fr_ow_hp_24" value="<?php echo "$fr_ow_hp_24"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_25" value="<?php echo "$fr_ow_hp_25"?>"></td>
                </tr>




                <tr class="text-danger boldd text-center"><td colspan="2">HP Writers Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_26" value="<?php echo "$fr_ow_hp_26"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Color</td>
                    <td><input type="color" name="fr_ow_hp_27" value="<?php echo "$fr_ow_hp_27"?>"></td>
                </tr>
                <tr>
                    <td> See More Button Text Color</td>
                    <td><input type="color" name="fr_ow_hp_28" value="<?php echo "$fr_ow_hp_28"?>"></td>
                </tr>
                <tr>
                    <td> Writers Name Text Color</td>
                    <td><input type="color" name="fr_ow_hp_29" value="<?php echo "$fr_ow_hp_29"?>"></td>
                </tr>


                <tr class="text-danger boldd text-center"><td colspan="2">HP Happy Customer Count Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_33" value="<?php echo "$fr_ow_hp_33"?>"></td>
                </tr>
                <tr>
                    <td> Text Color</td>
                    <td><input type="color" name="fr_ow_hp_34" value="<?php echo "$fr_ow_hp_34"?>"></td>
                </tr>
                <tr>
                    <td> Image Background Color</td>
                    <td><input type="color" name="fr_ow_hp_35" value="<?php echo "$fr_ow_hp_35"?>"></td>
                </tr>



                <tr class="text-danger boldd text-center"><td colspan="2">HP Populer Brand Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_36" value="<?php echo "$fr_ow_hp_36"?>"></td>
                </tr>
                <tr>
                    <td> Section Title Text Color</td>
                    <td><input type="color" name="fr_ow_hp_37" value="<?php echo "$fr_ow_hp_37"?>"></td>
                </tr>
                <tr>
                    <td> See More Link Text Color</td>
                    <td><input type="color" name="fr_ow_hp_38" value="<?php echo "$fr_ow_hp_38"?>"></td>
                </tr>
                <tr>
                    <td> Brand Name Text Color</td>
                    <td><input type="color" name="fr_ow_hp_39" value="<?php echo "$fr_ow_hp_39"?>"></td>
                </tr>
                <tr>
                    <td> Brand Img Background Color</td>
                    <td><input type="color" name="fr_ow_hp_40" value="<?php echo "$fr_ow_hp_40"?>"></td>
                </tr>


                <tr class="text-danger boldd text-center"><td colspan="2">HP GCT Section</td></tr>
                <tr>
                    <td> Section Background Color</td>
                    <td><input type="color" name="fr_ow_hp_30" value="<?php echo "$fr_ow_hp_30"?>"></td>
                </tr>
                <tr>
                    <td> Title Color</td>
                    <td><input type="color" name="fr_ow_hp_31" value="<?php echo "$fr_ow_hp_31"?>"></td>
                </tr>
                <tr>
                    <td> Text Color</td>
                    <td><input type="color" name="fr_ow_hp_32" value="<?php echo "$fr_ow_hp_32"?>"></td>
                </tr>


            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Home Page Color</button>
		    </div>
         </form>
    </div>
</div>


</div>
</div>
</section>









<?php require_once('frd1_footer.php'); ?>  