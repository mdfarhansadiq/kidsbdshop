<style>
 body {
        margin-top: 100px !important;
    }

    @media (max-width: 768px) {
        body {
            margin-top: 60px !important;
        }
    }
/***********************************************************/
/* HEADER 1 MOBILE */
/***********************************************************/
@media only screen and (min-width: 991px){
	#FrMobTopNav{
        display: none;
    }
}

#FR_HS_1.navbar{
    background: #D5D0CD;
    border: none !important;
    height: 60px;
}

#FR_HS_1 .fricon_sn1_showAhied span{
    color: #111111;
    text-align: right;
    font-size: 20px;
    cursor: pointer;
    display: inline-block;
 }
 #FR_HS_1 .fricon_sn1_showAhied span:hover{
     transform: scale(1.1);
 }

@keyframes open_sidenavex{
    50%{
        transform: rotate(360deg);
    }
}

#FR_HS_1 img#brandlogu{
    position: relative;
    width: auto;
    height: 60px;
}
/*OPEN SERCH BTN:-*/
#FR_HS_1 .frs_os_btn button{
    background: none;
    border: none;
    padding: 6px;
    font-weight: bold;
    font-size: 2em;
    text-align: center !important;
    animation: frs_os_btnx 6s infinite;
}
@keyframes frs_os_btnx{
    50%{
        transform: rotate(30deg);
    }
    90%{
        transform: scale(1.2);
    }
}



#FR_HS_1 button.frloginbtn{
    border: none;
}

/*FRD USER TRIGER IMG AFTER LOGIN :-*/
#FR_HS_1 .frs_trigusrpic img#custpic{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    text-align: center;
    margin: auto !important;
    display: block;
}

/*MINI CART:-*/
#FR_HS_1 .frtnminicart{
    text-align: center;
    padding: 0px;
    cursor: pointer;
}

#FR_HS_1 .frtnminicart .c_icon{
    font-size: 1.5em;
    
}
#FR_HS_1 .frtnminicart .c_item{
    margin-left: 30px;
    margin-top: 5px;
    color: #111;
    display: inline-block;
    font-weight: bolder;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: pip_pip 1s 6;
}

</style>

<div id="FrMobTopNav" class="container frdiv_print_time_hied">
    <!-- MOB HEADER -->
    <div class="row">
        <div class="col-md-12">
            <nav id="FR_HS_1" class="navbar navbar-fixed-top text-center">
                <table width="100%">
                    <tr>
                        <td width="20%">
                            <div class="fricon_sn1_showAhied text-right">
                                <span class="navbar-brand"> 
                                    <b class="frtrig_sn1_show glyphicon glyphicon-align-justify"></b>  
                                    <b class="frtrig_sn1_hide glyphicon glyphicon-remove frd_dn"></b> 
                                </span>
                            </div>
                        </td>
                        <td width="40%">
                            <a href="<?php echo $FRD_HURL ?>">
                                <img title=" হোম পেজে যান" id="brandlogu" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="<?php echo "$fr_cname,$fr_cmetatag,$FRD_HURL";?>" class="img-responsive">
                            </a>

                        </td>

                        <td width="20%">
                            <div class="frs_os_btn TAC">
                                <button onclick="fr_openSearch()"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </td>

                            <!-- <td width="30%">
                                <div class="frs_trigusrpic">
                                    <?php
                                    // if (isset($_SESSION['customer_pic_path'])) {
                                    //     echo "
                                    //     <img id='custpic' src='" . $_SESSION['customer_pic_path'] . "' alt='' class='FrTrig_CustomerAllPages'>
                                    // ";
                                    // } else {
                                    //     echo "
                                    //     <div class='TAC'>
                                    //         <a href='$FRD_HURL/login'>
                                    //         <button class='btn btn-default frloginbtn'><span class='glyphicon glyphicon-user'></span></button>
                                    //         </a>
                                    //     </div>
                                    //     ";
                                    // }
                                    ?>
                                </div>
                            </td> -->


                        <td width="20%">
                            <div class="frtnminicart view_cart_trig slideInRight">
                                <div class="c_item">
                                    <span class="cart_itemss"></span>
                                </div>
                                <div class="c_icon">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </nav>
    </div>
</div>
</div>









<style>
/***********************************************************/
/* TOP-FIX-NAV PC | PC-TOP-NAV | PC TOP NAV */
/***********************************************************/
@media only screen and (max-width: 991px){
	#FRtopFnav_3{
        display: none;
    }
}

#FRtopFnav_3 {
    height: 100px;
    background: #D5D0CD;
}
/*FRD SECTION 1*/
#FRtopFnav_3 .frsec_1 {
    height: 20px;
    background: #D5D0CD;
    color: #FFF;
    font-weight: bold;
    padding-top: 2px;
    padding-bottom: 1px;
}
#FRtopFnav_3 .frsec_1 a{
   text-decoration: none;
   color: #111;
}

#FRtopFnav_3 .fricon_sn1_showAhied span{
    color: #111111;
    text-align: right;
    font-size: 23px;
    cursor: pointer;
    display: inline-block;
    overflow: hidden !important;
}
#FRtopFnav_3 .fricon_sn1_showAhied span:hover{
     transform: scale(1.1);
}

/*BREND LOGU:- */
#FRtopFnav_3 .frblogu_div {
     margin-top: -15px;
     width: 100% !important;
     position: absolute !important;
     text-align: center !important;
     overflow: hidden !important;
     display: inline-block !important;
}
#FRtopFnav_3 img#frBlogu{
     width: auto;
     height: 75px;
     position: relative !important;
    width: auto !important;
    height: 75px !important;
    margin: auto !important;
    display: inline-block !important;
    text-align: center;
}
#FRtopFnav_3 img#frBlogu:hover{
    transform: rotate(3deg);
}
#FRtopFnav_3 .frLogoTagline{
     display: block;
     color: #111;
     font-size: 12px;
}



/*PRODUCT SEARCH FROM:- */
#FRtopFnav_3 .search {
    width: 100%;
    position: relative;
    display: flex;
    margin-top: 9px;
}
#FRtopFnav_3 .searchTerm {
    width: 100%;
    border: none;
    border-right: none;
    padding: 5px;
    height: 36px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: black;
}
#FRtopFnav_3 .searchTerm:focus {
    color: #222;
}
#FRtopFnav_3 .searchButton {
    width: 40px;
    height: 36px;
    border: 1px solid black;
    background: black;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
}
/*FRD USER TRIGER IMG AFTER LOGIN :-*/
.frs_trigusrpic img#custpic{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    text-align: center;
    margin: auto !important;
    display: block;
}
.frs_trigusrpic .dropdown-menu{
    margin-top: 46px;
}

#FRtopFnav_3 .frs_trigusrpic button.fricon_user{
    border: none !important;
    background: none !important;
    transform: scale(1.5);
    margin-top: 10px;
}
#FRtopFnav_3 .frs_trigusrpic button.fricon_user:hover{
    transform: scale(1.9);
}


/*MINI CART:-*/
#FRtopFnav_3 .frtnminicart{
    text-align: center;
    padding: 0px;
    cursor: pointer;
}

#FRtopFnav_3 .frtnminicart .c_icon{
    font-size: 1.5em;
}
#FRtopFnav_3 .frtnminicart .c_icon:hover{
    transform: scale(1.5);
}

#FRtopFnav_3 .frtnminicart .c_item{
    margin-left: 30px;
    margin-top: 5px;
    color: #111;
    display: inline-block;
    font-weight: bolder;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: pip_pip 1s infinite;
}


/* FRD TOP NAV ADITIONAL LINK:- */
#FRtopFnav_3 .fr_tn_spilink{
    color: #222;
    cursor: pointer;
}
#FRtopFnav_3 .fr_tn_spilink a,#FRtopFnav_3 .fr_tn_spilink .dropdown{
    color: #222;
    text-decoration: none;
    padding: 5px;
}
#FRtopFnav_3 .fr_tn_spilink a:hover,#FRtopFnav_3 .fr_tn_spilink .dropdown:hover{
     color: green;
     border-bottom: 4px solid green;
    font-weight: bold;
}
</style>
<!-- FRD PC TOP NAV s -->
<nav id="FRtopFnav_3" class="navbar navbar-fixed-top frdiv_print_time_hied">
    <section class="frsec_1">
        <table width="100%">
            <tr>
                <td width="40%">

                </td>
                <td width="60%">
                    <span><a href="<?php echo "$pageview_frd/contact" ?>"><span class="glyphicon glyphicon-phone-alt"></span> <?php echo "$fr_tn_helpline_txt: $fr_cmobile_1"; ?></a></span>


                    <?php

                    echo "&#160;&#160;&#160; <span> <a href='$FRD_HURL/offers'><span class='glyphicon glyphicon-volume-up'></span> $fr_tn_offer_txt </a> </span>";

                    if (isset($_SESSION['sUsrId'])) {
                        echo "&#160;&#160;&#160; <span class='label label-danger pip_pip_1s'>" . $_SESSION['sUsrName'] . " You Ar Using Customer Panel</span>";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </section>

    <section class="frsec_2">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-md-1">
                    
                </div> -->
                <div class="col-md-4">
                    <div class="navbar-header">
                        <div class="fricon_sn1_showAhied text-right">
                            <span class="navbar-brand"> 
                                <b class="frtrig_sn1_show glyphicon glyphicon-align-justify"></b>  
                                <b class="frtrig_sn1_hide glyphicon glyphicon-remove frd_dn"></b> 
                            </span>
                        </div>
                        <div class="frblogu_div">
                            <a href="<?php echo $FRD_HURL ?>">
                                <img id="frBlogu" title=" হোম পেজে যান" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="<?php echo "$fr_cname,$fr_cmetatag,$FRD_HURL";?>" class="img-responsive">
                            </a>
                            <span class="frLogoTagline"><i><?php echo "$fr_ctagline"; ?></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <table width="100%">
                        <tr>
                            <td width="70%">
                                <form id="frd_prosearchform" action="<?php echo "$FRD_HURL/search" ?>" method="GET">
                                    <div class="search">
                                        <input type="text" class="searchTerm" id="f_pro_name" name="productname" placeholder="<?php echo "$fr_tn_pro_search_placeh_txt"; ?>" autocomplete="off" required>
                                        <button type="submit" class="searchButton">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                    <div class="fr_searchsug_sty1" id="fr_pro_ss"></div>
                                </form>
                            </td>
                            <td width="20%">
                                <div class="frs_trigusrpic">
                                    <?php
                                    if (isset($_SESSION['customer_pic_path'])) {
                                        echo "
                                        <div class='TAC FrTrig_CustomerAllPages' role='button'>
                                            <img id='custpic' src='" . $_SESSION['customer_pic_path'] . "' alt='' class=''><span class='frcustname'>" . $_SESSION['s_cust_Name'] . " <b class='glyphicon glyphicon-triangle-bottom alertt'></b> </span>
                                        </div>
                                         ";
                                    } else {
                                        echo "
                                        <div class='TAC'>
                                            <a href='$FRD_HURL/login'>
                                            <button class='btn btn-default frloginbtn fricon_user'><span class='glyphicon glyphicon-user'></span> </button>
                                            </a>
                                        </div>
                                        ";
                                    }
                                    ?>


                                </div>
                            </td>
                            <td width="10%" class="">
                                <div class="frtnminicart view_cart_trig animated slideInRight">
                                    <div class="c_item">
                                        <span class='cart_itemss'></span>
                                    </div>
                                    <div class="c_icon">
                                        <span class="frcarticon glyphicon glyphicon-shopping-cart"></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- TOP NAV SPACIAL LINK S -->
                    <div class="fr_tn_spilink">

                        <span><a href="<?php echo "$FRD_HURL/categories"; ?>"> <?php echo "$fr_tn_cat_boxview_txt"; ?> </a></span>

                        <?php if ($FR_FLASH_SELLS_MODE == "FRON") { ?>
                            <span><a href="<?php echo "$FRD_HURL/flash-sales"; ?>"> <i class="glyphicon glyphicon-flash pip_pip_1s"></i><?php echo "$fr_tn_flash_sales_txt"; ?> </a></span>
                        <?php } ?>

                        <span><a href="<?php echo "$FRD_HURL/products"; ?>"> <?php echo "$fr_tn_new_product_txt"; ?> </a></span>
                        <span><a href="<?php echo "$FRD_HURL/offers"; ?>"> <?php echo "$fr_tn_offers_txt"; ?> </a></span>
                        <span><a href="<?php echo "$FRD_HURL/brands"; ?>"> <?php echo "$fr_tn_allbrand_txt"; ?> </a></span>



                        &#160;
                        <span class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php echo "$fr_tn_others_txt"; ?>
                                <span class="caret"></span>
                            </span>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <!-- <li role="separator" class="divider"></li> -->
                                <li> <a href="<?php echo " $pageview_frd/contact "; ?>"> <?php echo "$fr_vp_contact_txt"; ?> </a></li>
                                <li> <a href="<?php echo " $pageview_frd/vision "; ?>"><?php echo "$fr_vp_vision_txt"; ?></a></li>
                                <li> <a href="<?php echo " $pageview_frd/mission "; ?>"><?php echo "$fr_vp_mission_txt"; ?></a></li>
                                <li> <a href="<?php echo " $pageview_frd/privacy-policy "; ?>"><?php echo "$fr_vp_privacypolicy_txt"; ?></a></li>
                                <li> <a href="<?php echo " $pageview_frd/delivery-policy "; ?>"><?php echo "$fr_vp_deliverypolicy_txt"; ?></a></li>
                                <li> <a href="<?php echo " $pageview_frd/terms-and-conditions "; ?>"><?php echo "$fr_vp_tramsandcondition_txt"; ?></a></li>
                                <li> <a href="<?php echo " $FRD_HURL/categories_list"; ?>"> <?php echo "$fr_tn_cat_listmap_txt"; ?> </a></li>
                                <li></li>
                            </div>
                        </span>



                        <?php if ($FRcf_ParcelBooki == "1") { ?>
                            <span><a href="<?php echo "$FRD_HURL/parcels_delivery"; ?>"> পার্সেল ডেলিভারি বুকিং </a></span>
                        <?php } ?>

                    </div>
                    <!-- TOP NAV SPACIAL LINK E-->

                </div>
            </div>
        </div>
    </section>
</nav>