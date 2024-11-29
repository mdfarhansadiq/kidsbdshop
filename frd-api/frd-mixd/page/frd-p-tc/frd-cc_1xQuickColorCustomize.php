<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Quick Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Chat Option Button Color Customize </h2> -->
 

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD THEME LEFT SIDE NAVE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['f_color_1'])){
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
        if(isset($f_color_1)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_color_1 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }





        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themecolor SET 
            fr_cc_qft_c1 = '$f_color_1',
            fr_cc_qft_c2 = '$f_color_2',
            fr_cc_qft_c3 = '$f_color_3',
            fr_cc_qft_proboxshado = '$fr_cc_qft_proboxshado',
            fr_cc_qft_proboxborder = '$fr_cc_qft_proboxborder',
            fr_cc_qft_proboxbg = '$fr_cc_qft_proboxbg',
            fr_cc_qft_hederbg = '$fr_cc_qft_hederbg',
            fr_cc_qft_hederboxshado = '$fr_cc_qft_hederboxshado',
            fr_cc_qft_footerbg = '$fr_cc_qft_footerbg',
            fr_cc_qft_footerboxshado = '$fr_cc_qft_footerboxshado',
            fr_cc_qft_leftsidenavbg = '$fr_cc_qft_leftsidenavbg',
            fr_cc_qft_leftsidenavboxshado = '$fr_cc_qft_leftsidenavboxshado',
            fr_cc_qft_cartbg = '$fr_cc_qft_cartbg',
            fr_cc_qft_cartboxshado = '$fr_cc_qft_cartboxshado',
            fr_cc_qft_bodysectionbg = '$fr_cc_qft_bodysectionbg',
            fr_cc_qft_bodysectionboxshado = '$fr_cc_qft_bodysectionboxshado',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE fr_cc_id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){


            
$FRc_CC_CSS_CODE = "/*
FILE TYPE: QUICK FULL THEME COLOR CUSTOMIZATION
AUTHOR: FAZLE RABBI DHALI
FILE VERSION: 1.1
*/

body{
    background: #FFF !important;
}

/*******************************************************/
/* ALL BUTTON TEXT COLOR */
/*******************************************************/
.FrHeader4_PC .searchButton,.FrHeader4_Mob .input-group-addon, .xs.frs_headline table td.td1, .sidenav_right .btn_cartclose, .frcart1 .btn_chackout, .frs_sn1 div.snsl a:hover, .frs_sn1 .frclosebtn, .frbtn_vp_atc, button.frsendmeotp, button.frloginconfirm, .fdeliAadd button, .hp_super_secfrd a.frs_moreseebtn, .frs_subcat button, .brand_marque_sec button, .sp_addtocart_btn, .sp_frdbtn_ordernow, .sp_frdbtn_co, .sp_frdbtn_co a, .FRsSearchoverlay button, footer#fr_foot1 .appdownlodebtn, #myScrollTopBtn, .FrBtn_ChatOptionShow, div.trackp_OorderSumerydiv .frbtn_InvoDownlode, button.frbtn_InvoPrint_OrdTrackP {
    color: $f_color_2 !important;
}

/*******************************************************/
/* THIS ACTIVE THEME SUPER BUTTON STYELE OVERWRITE */
/*******************************************************/
button.frsty_theme_super_btn{
    color: $f_color_2 !important;
    background: $f_color_1 !important;
}
";



$FRc_CC_CSS_CODE .= "
    /********************************************************************/
    /* FRD HEADER 1 PC */
    /********************************************************************/
    #FRtopFnav_3 {
        background: #FFFFFF !important;
    }
    #FRtopFnav_3 .frsec_1 {
        background: #FFFFFF !important;
    }
    #FRtopFnav_3 .frsec_1 a{
    color: #222222 !important;
    }

    #FRtopFnav_3 .fricon_sn1_showAhied span{
        color: $f_color_1 !important;
    }

    #FRtopFnav_3 .frLogoTagline{
        color: #222222 !important;
    }

    #FRtopFnav_3 .searchTerm {
        color: black;
        border: 2px solid $f_color_1 !important;
    }
    #FRtopFnav_3 .searchTerm:focus {
        color: #222222;
    }
    #FRtopFnav_3 .searchButton {
        border: 1px solid $f_color_1 !important;
        background: $f_color_1 !important;
        color: $f_color_2 !important;
    }


    #FRtopFnav_3 .frs_trigusrpic button.fricon_user{
        color: $f_color_1 !important;
    }
    #FRtopFnav_3 .frtnminicart .c_item, #FRtopFnav_3 .frtnminicart .c_icon{
        color: $f_color_1 !important;
    }
    #FRtopFnav_3 .fr_tn_spilink a,#FRtopFnav_3 .fr_tn_spilink .dropdown{
        color: #222222 !important;
    }
    #FRtopFnav_3 .fr_tn_spilink .dropdown-menu{
        background: #FFFFFF !important;
    }
    #FRtopFnav_3 .fr_tn_spilink a:hover,#FRtopFnav_3 .fr_tn_spilink .dropdown:hover{
        border-bottom: none !important;
        background: $f_color_1;
        color: $f_color_2 !important;
    }

    /***********************************************************/
    /* HEADER 1 MOBILE */
    /***********************************************************/
    #FR_HS_1.navbar{
        background: #FFFFFF !important;
    }
    #FR_HS_1 .fricon_sn1_showAhied span, #FR_HS_1 .frtnminicart .c_item, #FR_HS_1 .frs_os_btn, #FR_HS_1 .c_icon{
        color: $f_color_1 !important;
    }
";



$FRc_CC_CSS_CODE .= "
    /*******************************************************/
    /* FRD HEADER 4 STYLE  OW  FOR PC DEVICE*/
    /*******************************************************/
    .FrHeader4_PC {
        background: #FFFFFF !important;
    }
    .FrHeader4_PC .searchTerm {
        border: 2px solid $f_color_1 !important;
    }
    .FrHeader4_PC .searchButton {
        border: 2px solid $f_color_1 !important;
        background: $f_color_1 !important;
    }

    .FrHeader4_PC .fricon_cart{
    color: $f_color_1 !important;
    }

    .FrHeader4_PC .fricon_user{
        color: $f_color_1 !important;
    }

    .FrHeader4_PC .fricon_home{
        color: $f_color_1 !important;
    }

    .FrHeader4_PC .fricon_sn1_showAhied span{
        color: $f_color_1 !important;
    }
    /*******************************************************/
    /* FRD HEADER 4 STYLE  OW  FOR MOBILE DEVICE*/
    /*******************************************************/
    .FrHeader4_Mob{
        background: #FFFFFF !important;
    }
    .FrHeader4_Mob .frbtn_sidenaveopen{
    color: $f_color_1 !important;
    }
    .FrHeader4_Mob .fricon_user{
    color: $f_color_1 !important;
    }
    .FrHeader4_Mob input {
        border: 2px solid $f_color_1 !important;
    }
    .FrHeader4_Mob input:focus {
        border: 2px solid $f_color_1 !important;
    }
    .FrHeader4_Mob .input-group-addon {
        border: 1px solid $f_color_1 !important;
        background: $f_color_1 !important;
    }
";





$FRc_CC_CSS_CODE .= "
/*******************************************************/
/* FRD HEADLINE OW */
/*******************************************************/
.xs.frs_headline table td.td1 {
    background: $f_color_1 !important;
}
.xs.frs_headline table {
    border: 1px solid $f_color_1 !important;
}




/**************************************************************/
/* RIGHT SIDENAV CART | FRD SHOPPING CART | CART-CART-1 */
/**************************************************************/
#mySidenav_right{
    background: #FFFFFF !important;
}
.frcart1 .cart_items{
    background: #FFFFFF !important;
}
.frcart1 .frlogo_div{
    background: #FFFFFF !important;
}
.sidenav_right .cart_title, .sidenav_right .cart_title small{
    color: $f_color_1 !important;
}
.sidenav_right .btn_cartclose {
    background: $f_color_1 !important;
}
.frcart1 .btn_chackout {
    background: $f_color_1 !important;
}
.frcart1 .item_title{
    color: #111111 !important;
}
.frcart1 .price{
    color: $f_color_1 !important;
}
.frcart1 .cpro_qty{
    color: #111111 !important;
}
.pro_qtyup_btn,
.pro_qtydown_btn {
    color: $f_color_1 !important;
}
.t_cartt .btn_proremove {
    color: $f_color_1 !important;
}



/*******************************************************/
/* FRD LEFT SIDE NAVE OW */
/*******************************************************/
.frLeftSideNaveMob {
    background-color: #FFFFFF !important;
}
.frs_sn1 a.logolink{
    background: #FFFFFF !important;
}
.frs_sn1 div.snsl a:hover {
    background: $f_color_1 !important;
}
.frs_sn1 .frclosebtn{
    background: $f_color_1 !important; 
}



/*****************************************************************/
/* FRD POPUP VARIARION PRODUCT ADD TO CART BUTTON */
/*****************************************************************/
.frbtn_vp_atc{
    background: $f_color_1 !important;
}




/*************************************************/
/* FRD PRODUCT BOX 2 */
/*************************************************/
.frs_pbox_2 {
    background: #FFFFFF !important;
}

.frs_pbox_2 .frs_dcb{
        background: $f_color_1 !important;
        color: $f_color_2 !important;
}

.frs_pbox_2 .stock_out_alert{
        background: rgba(229, 36, 36, 0.767);
        color: #FFFFFF !important;
}

.frs_pbox_2 .fr_c1 .pprice .markprice{
    color: #333333 !important;
}
.frs_pbox_2 .fr_c1 .pprice{
    color: $f_color_1 !important;
}
.frs_pbox_2 .fr_c1 .ptitel{
    color: #111111 !important;
}


/*************************************************************************/
/* LOGIN REGISTRATION FORM  OW | LOGIN FORM */
/*************************************************************************/
div.loginformdiv{
  background: #FFFFFF !important;
}

div.frotpinputformdiv{
  background: #FFFFFF !important;
}
button.frsendmeotp{
  background: $f_color_1 !important;
}
button.frloginconfirm{
  background: $f_color_1 !important;
}




/*************************************************************************/
/* FRD CHECKOUT FORM  OW */
/*************************************************************************/
.OrderSummerysec h4{
    color: $f_color_1 !important;
}
.OrderSummerysec{
    background: #FFFFFF !important;
}
.fdeliAadd h4{
    color: $f_color_1 !important;
}
form.fdeliAadd {
    background: #FFFFFF !important;
    box-shadow: none;
}
.fdeliAadd button {
    background: $f_color_1 !important;
}


/*************************************************************************/
/* FRD HOME PAGE STYLE OW */
/*************************************************************************/
.hp_super_secfrd{
    background: #FFF !important;
}

.hp_sectitlefrd {
    color: $f_color_1 !important;
}
.hp_super_secfrd a.frs_moreseebtn{
    background: $f_color_1 !important; 
}
.frs_subcat button{
    background: none !important;
    color: $f_color_1 !important;
}

.brand_marque_sec button {
    border: none !important;
    background: #FFF !important;
}



/*******************************************************/
/*FRD SINGLE PRODUCT PAGE OW*/
/*******************************************************/
.left_side{
    border: none !important;
}
.left_side .sp_addtocart_btn {
    background: $f_color_1 !important;
}
.left_side .sp_frdbtn_ordernow {
    background: $f_color_1 !important;
}
.left_side .sp_frdbtn_co{
    background: $f_color_1 !important;
}
.sells_price{
    color: $f_color_1 !important;
}

div .CallForOrderDiv{
    background: #FFFFFF !important;
}
div .CallForOrderDiv .textt, div .CallForOrderDiv a{
    color: $f_color_1;
}

div.insidedhakadcdiv{
    background: #FFFFFF !important;
}
div.outsidedhakadcdiv{
    background: #FFFFFF !important;
}
div.ppp_note_sec{
    background: #FFFFFF !important;
}



/*********************************************************/
/*FRD CATEGORY BOX 1 STYLE S*/
/*********************************************************/
.frs_catbox_1{
    box-shadow: 0px 0px 5px 0px $f_color_1 !important;
    border: 2px solid $f_color_1 !important;
}
.frs_catbox_1 a{
    color: $f_color_1;
}
.frs_catbox_1 .procount{
    color: #111111;
}

/********************************************************/
/*FRD CATEGORY LIST STYLE S*/
/********************************************************/
.catlistdiv{
    background: #FFFFFF !important;
    box-shadow: 0px 0px 10px 0px $f_color_1 !important;
}
.catlistdiv a:hover{
    color: $f_color_1 !important;
}



/******************************************************************/
/*FRD BRAND BOX 1 STYLE S*/
/******************************************************************/
.frs_brandbox_1 {
    box-shadow: 0px 0px 10px 0px $f_color_1 !important;
}
.frs_brandbox_1 a {
    color: $f_color_1 !important;
}



/*******************************************************/
/* ORDER TRACK PAGE */
/*******************************************************/
div.parcialpainfodiv{
    background: #FFFFFF !important;
}
div.trackp_OorderSumerydiv{
    background: #FFFFFF !important;
}
div.trackp_OorderSumerydiv .frbtn_InvoDownlode{
    background: $f_color_1 !important;
}
div.trackp_notediv{
    background: #FFFFFF !important;
}

button.frbtn_InvoPrint_OrdTrackP{
    background: $f_color_1 !important;
}



/*******************************************************/
/*FRD SCROLL TO TOP BUTTON OW*/
/*******************************************************/
#myScrollTopBtn{
    background: $f_color_1 !important;
}


/*********************************************/
/* FRD CHAT OPTION OPEN CSS START OW*/
/*********************************************/
.FrBtn_ChatOptionShow {
    background-color: $f_color_1 !important;
}


/***************************************************************/
/* FRD OVERLAY SEARCE */
/***************************************************************/
.FRsSearchoverlay button {
    background: $f_color_1;
}
";








$FRc_CC_CSS_CODE .="
/*************************************************/
/* FRD PRODUCT BOX 4 */
/************************************************/
.fr_pbox_4 .frs_discount{
    background: $f_color_1  !important;
}
.fr_pbox_4 .frinfo .pprice{
color: $f_color_1 !important;
}

.fr_pbox_4 .pbtn button.frbtn_ordernow{
background: $f_color_1 !important;
}

.fr_pbox_4 .frs_discount, .fr_pbox_4 .pbtn button.frbtn_ordernow{
color: $f_color_2 !important;
}
";
if($fr_cc_qft_proboxshado == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_4 {
        box-shadow: 0px 0px 5px 0px $f_color_1;
    }
    ";
}
if($fr_cc_qft_proboxborder == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_4 {
        border: 1px solid $f_color_1;
     }
    ";
}
if($fr_cc_qft_proboxbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .fr_pbox_4{
        background: $f_color_3  !important;
    }
    ";  
}




$FRc_CC_CSS_CODE .="
/*************************************************/
/* FRD PRODUCT BOX 5 */
/************************************************/
.fr_pbox_5 .frs_discount{
        background: $f_color_1  !important;
}
.fr_pbox_5 .frinfo .pprice{
    color: $f_color_1 !important;
}

.fr_pbox_5 .pbtn button.frbtn_ordernow{
    background: $f_color_1 !important;
}

.fr_pbox_5 .frs_discount, .fr_pbox_5 .pbtn button.frbtn_ordernow{
    color: $f_color_2 !important;
}
";
if($fr_cc_qft_proboxshado == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_5 {
        box-shadow: 0px 0px 5px 0px $f_color_1;
    }
    ";
}
if($fr_cc_qft_proboxborder == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_5 {
        border: 1px solid $f_color_1;
     }
    ";
}
if($fr_cc_qft_proboxbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .fr_pbox_5{
        background: $f_color_3  !important;
    }
    ";  
}



$FRc_CC_CSS_CODE .="
/*************************************************/
/* FRD PRODUCT BOX 8 */
/************************************************/
.fr_pbox_8 .frs_discount{
    background: $f_color_1  !important;
    color: $f_color_2 !important;
}
.fr_pbox_8 .frinfo .pprice{
  color: $f_color_1 !important;
}

.fr_pbox_8 .buttons .frbtn_ordernow{
  background: $f_color_1 !important;
  color: $f_color_2 !important;
}
.fr_pbox_8 .buttons .frbtn_addtocart{
    background: $f_color_2 !important;
    color: $f_color_1 !important;
}
";
if($fr_cc_qft_proboxshado == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_8 {
        box-shadow: 0px 0px 5px 0px $f_color_1;
    }
    ";
}
if($fr_cc_qft_proboxborder == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .fr_pbox_8 {
        border: 1px solid $f_color_1;
     }
    ";
}
if($fr_cc_qft_proboxbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .fr_pbox_8{
        background: $f_color_3  !important;
    }
    ";  
}




$FRc_CC_CSS_CODE .="
/*******************************************************/
/*FRD FOOTER 1 CUSTOMIZE OW*/
/*******************************************************/
section.frfoot1, footer#fr_foot1, footer#fr_foot1 .frs_faddress {
    background: #FFFFFF !important;
}
footer#fr_foot1 .frFooterMobile h4 a, footer#fr_foot1 .frFooterEmail h4 a, footer#fr_foot1 .frs_faddress{
    color: $f_color_1 !important;
}
footer#fr_foot1 .appdownlodebtn {
    background: $f_color_1 !important;
 }
footer#fr_foot1 hr {
    border-top: 1px solid $f_color_1 !important;
}
footer#fr_foot1 .frs_copyw, footer#fr_foot1 .frs_copyw a, div.frdcredits span, div.frdcredits a {
    color: $f_color_1 !important;
}
";
if($fr_cc_qft_footerbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    section.frfoot1, footer#fr_foot1, footer#fr_foot1 .frs_faddress {
        background: $f_color_3 !important;
    }
    ";
}
if($fr_cc_qft_footerboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    section.frfoot1{
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }
    ";
}





$FRc_CC_CSS_CODE .="
/*******************************************************/
/*FRD FOOTER 2 CUSTOMIZE OW*/
/*******************************************************/
.footer-3 h2, .footer-3 span i, .footer-3 span.glyphicon{
    color: $f_color_1 !important;
}
.footer-3 p, .footer-3 li, .footer-3 a, .footer3-container .copyright p, .footer3-container .copyright a, .footer3-container div.frdcredits span, .footer3-container div.frdcredits a{
    color: #111111 !important;
}
.footer-3 a:hover{
    color: $f_color_1 !important;
}
.footer3-container hr{
    border-top: 1px solid $f_color_1 !important;
}
";
if($fr_cc_qft_footerbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .footer3-container {
        background: $f_color_3 !important;
    }
    ";
}
if($fr_cc_qft_footerboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    .footer3-container{
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }
    ";
}



if($fr_cc_qft_proboxshado == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .frs_pbox_2 {
        box-shadow: 0px 0px 5px 0px $f_color_1;
    }
    ";
}
if($fr_cc_qft_proboxborder == "Yes"){
    $FRc_CC_CSS_CODE .= "
    .frs_pbox_2 {
        border: 1px solid $f_color_1;
    }
    ";
}
if($fr_cc_qft_proboxbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .frs_pbox_2 {
        background: $f_color_3  !important;
    }
    ";  
}

if($fr_cc_qft_hederbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    #FRtopFnav_3, #FRtopFnav_3 .frsec_1, #FRtopFnav_3 .fr_tn_spilink .dropdown-menu, #FR_HS_1.navbar {
        background: $f_color_3 !important;
    }

    nav.FrHeader2{
        background: $f_color_3 !important;
    }

    .FrHeader4_PC, .FrHeader4_Mob {
        background: $f_color_3 !important;
    }
    ";  
}
if($fr_cc_qft_hederboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    #FRtopFnav_3 {
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }

    nav.FrHeader2{
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }

    .FrHeader4_PC, .FrHeader4_Mob {
        box-shadow: 0px 0px 10px 0px $f_color_1;
     }
    ";  
}


if($fr_cc_qft_leftsidenavbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    .frLeftSideNaveMob, .frs_sn1 a.logolink {
        background-color: $f_color_3 !important;
    }
    ";
}
if($fr_cc_qft_leftsidenavboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    .frLeftSideNaveMob {
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }
    ";
}

if($fr_cc_qft_cartbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    #mySidenav_right, .frcart1 .cart_items, .frcart1 .frlogo_div{
        background: $f_color_3 !important;
    }
    ";
}
if($fr_cc_qft_cartboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    #mySidenav_right{
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }
    ";
}






if($fr_cc_qft_bodysectionbg == "Yes"){
    $FRc_CC_CSS_CODE .="
    div.parcialpainfodiv, div.trackp_OorderSumerydiv, div.trackp_notediv, div.insidedhakadcdiv, div.outsidedhakadcdiv, div.ppp_note_sec, div.loginformdiv, div.frotpinputformdiv, .OrderSummerysec, form.fdeliAadd{
        background: $f_color_3 !important;
    }
    ";
}
if($fr_cc_qft_bodysectionboxshado == "Yes"){
    $FRc_CC_CSS_CODE .="
    div.insidedhakadcdiv, div.outsidedhakadcdiv, div.ppp_note_sec, div.parcialpainfodiv, div.trackp_OorderSumerydiv, div.trackp_notediv, div.loginformdiv, div.frotpinputformdiv, .OrderSummerysec, form.fdeliAadd{
        box-shadow: 0px 0px 10px 0px $f_color_1;
    }
    ";
}

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_qft_csscode = '$FRc_CC_CSS_CODE', 
                    fr_cc_body_id = 1  
                    WHERE fr_cc_id = 1");
                    FRF_QUICK_FULL_THEME_CC_FILE_UP($FR_PATH_HD);
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



//FRD STYLE OW DATA READ :-
$FRR = FR_QSEL("SELECT * FROM frd_themecolor WHERE fr_cc_id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
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
        <div class="text-center">
            <img src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"?>" alt="#" style='max-height:200px;width:auto;margin:auto;'>
        </div>
        <h4 class="text-center boldd text-primary">Quick Full Theme Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Color 1 <small><i>(Theme Color)</i></small></td>
                    <td><input type="color" name="f_color_1" value="<?php echo "$fr_cc_qft_c1"?>"></td>
                </tr>
                <tr>
                    <td>Color 2 <small><i>(All Button Text Color)</i></small> </td>
                    <td><input type="color" name="f_color_2" value="<?php echo "$fr_cc_qft_c2"?>"></td>
                </tr>
                <tr>
                    <td>Color 3  <small><i>(ALL Background Color)</i></small> </td>
                    <td>
                        <select class="form-control" name="f_color_3" id="">
                            <option value="<?php echo "$fr_cc_qft_c3";?>"><?php echo "$fr_cc_qft_c3";?></option>
                            <option value="#FFFFFF">#FFFFFF</option>
                            <option value="#D5D0CD">#D5D0CD</option>
                            <option value="#DDDDDD">#DDDDDD</option>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td> <br> Procut Box Shadow</td>
                    <td> <br>
                        <input type="radio" name="fr_cc_qft_proboxshado" value="Yes" <?php if ($fr_cc_qft_proboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_proboxshado" value="No" <?php if ($fr_cc_qft_proboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>Procut Box Border</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_proboxborder" value="Yes" <?php if ($fr_cc_qft_proboxborder == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_proboxborder" value="No" <?php if ($fr_cc_qft_proboxborder == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>Procut Box Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_proboxbg" value="Yes" <?php if ($fr_cc_qft_proboxbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_proboxbg" value="No" <?php if ($fr_cc_qft_proboxbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>



                <tr>
                    <td><br>  Header BoxShadow</td>
                    <td><br>
                        <input type="radio" name="fr_cc_qft_hederboxshado" value="Yes" <?php if ($fr_cc_qft_hederboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_hederboxshado" value="No" <?php if ($fr_cc_qft_hederboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>  Header Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_hederbg" value="Yes" <?php if ($fr_cc_qft_hederbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_hederbg" value="No" <?php if ($fr_cc_qft_hederbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>




                <tr>
                    <td><br> Footer Box Shadow</td>
                    <td><br>
                        <input type="radio" name="fr_cc_qft_footerboxshado" value="Yes" <?php if ($fr_cc_qft_footerboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_footerboxshado" value="No" <?php if ($fr_cc_qft_footerboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>Footer Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_footerbg" value="Yes" <?php if ($fr_cc_qft_footerbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_footerbg" value="No" <?php if ($fr_cc_qft_footerbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>



                <tr>
                    <td><br>  Left Side Nav Box Shadow</td>
                    <td><br>
                        <input type="radio" name="fr_cc_qft_leftsidenavboxshado" value="Yes" <?php if ($fr_cc_qft_leftsidenavboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_leftsidenavboxshado" value="No" <?php if ($fr_cc_qft_leftsidenavboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>Left Side Nav Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_leftsidenavbg" value="Yes" <?php if ($fr_cc_qft_leftsidenavbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_leftsidenavbg" value="No" <?php if ($fr_cc_qft_leftsidenavbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>



                <tr>
                    <td><br> Shopping Cart BoxShadow</td>
                    <td><br>
                        <input type="radio" name="fr_cc_qft_cartboxshado" value="Yes" <?php if ($fr_cc_qft_cartboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_cartboxshado" value="No" <?php if ($fr_cc_qft_cartboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>Sopping Cart Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_cartbg" value="Yes" <?php if ($fr_cc_qft_cartbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_cartbg" value="No" <?php if ($fr_cc_qft_cartbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>


                <tr>
                    <td><br> ALL Body's Card BoxShadow</td>
                    <td><br>
                        <input type="radio" name="fr_cc_qft_bodysectionboxshado" value="Yes" <?php if ($fr_cc_qft_bodysectionboxshado == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_bodysectionboxshado" value="No" <?php if ($fr_cc_qft_bodysectionboxshado == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>
                <tr>
                    <td>ALL Body's Card Background Color</td>
                    <td>
                        <input type="radio" name="fr_cc_qft_bodysectionbg" value="Yes" <?php if ($fr_cc_qft_bodysectionbg == "Yes") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="fr_cc_qft_bodysectionbg" value="No" <?php if ($fr_cc_qft_bodysectionbg == "No") { echo "checked";} ?> required> No
                    </td>
                </tr>

            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Update Full Theme Color</button>
		    </div>
         </form>
    </div>
</div>


</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>   