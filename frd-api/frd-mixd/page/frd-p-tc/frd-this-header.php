<?php
$FRc_THIS_P_ID = 26;
$FR_PLUGIN_VERSION = 1;


function FRF_COLOR_CUSTOMIZE_FILE_UPDATE($FR_PATH_HD){
    global $FR_CONN,$FR_NOW_TIME;


    $FRR = FR_QSEL("SELECT * FROM frd_themecolor WHERE fr_cc_id = 1","");
    if($FRR['FRA']==1){ 
      extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }

    $FRc_DATA = "/*
    FILE TYPE: THEME COLOR Customization
    AUTHOR: FAZLE RABBI DHALI & Spider Ecommerce
    */

    $fr_cc_body
    $fr_cc_header
    $fr_cc_footer
    $fr_cc_botfixnav
    $fr_cc_homepage
    $fr_cc_productbox
    $fr_cc_productppage
    $fr_cc_leftsidenav
    $fr_cc_cart
    $fr_cc_popuporderbtn
    $fr_cc_chatoptbtn
    $fr_cc_loginform
    $fr_cc_checkoutform
    $fr_cc_headline
    $fr_cc_gototopbtn
    ";

    $FR_fh = fopen($FR_PATH_HD."frd-data/theme/frd-color-customize.css", "w" );
    $FR_fdata = "$FRc_DATA";
    if(fwrite( $FR_fh, $FR_fdata )){
            try{
                $FR_CONN->exec("UPDATE frd_themeconfig SET frtc_s_ow_v = frtc_s_ow_v+1 WHERE id = 1");
            }catch(PDOException $e){
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
            // FR_TAL("Style Update Done","success");
            FR_SWAL("Color Update Done","","success");

    }else{
        FR_TAL("Style Update Failed","success");
    }
    fclose( $FR_fh );

}



function FRF_QUICK_FULL_THEME_CC_FILE_UP($FR_PATH_HD){
    global $FR_CONN,$FR_NOW_TIME;


    $FRR = FR_QSEL("SELECT fr_cc_qft_csscode FROM frd_themecolor WHERE fr_cc_id = 1","");
    if($FRR['FRA']==1){ 
      extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }


    $FR_fh = fopen($FR_PATH_HD."frd-data/theme/frd-color-customize.css", "w" );
    $FR_fdata = "$fr_cc_qft_csscode";
    if(fwrite( $FR_fh, $FR_fdata )){
            try{
                $FR_CONN->exec("UPDATE frd_themeconfig SET frtc_s_ow_v = frtc_s_ow_v+1 WHERE id = 1");
            }catch(PDOException $e){
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
            // FR_TAL("Style Update Done","success");
            FR_SWAL("Color Update Done","","success");

    }else{
        FR_TAL("Style Update Failed","success");
    }
    fclose( $FR_fh );

}



//FRD STYLE OW TDR :-
$FRR = FR_QSEL("SELECT * FROM frd_themestyle_ow WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>