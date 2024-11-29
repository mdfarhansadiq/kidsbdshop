<?php
$FR_PATH_HD = "../";
require_once($FR_PATH_HD."frd-src/abc/frd-config.php");//FRD CONFIG
require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");//FRD SPIDER FUN PHP
require_once($FR_PATH_HD."frd-src/abc/frd-this-function.php");
$FRQ = $FR_CONN->query("SELECT * FROM frd_soft_config WHERE id = 1");
extract($FRQ->fetch());

if( isset($_GET['fraurl']) ){
    $fraurl=explode('/',$_GET['fraurl']);
    //echo "<pre>"; print_r($fraurl); echo "</pre>";

    $FRRP=$fraurl[0];

    //FRD MIXD:--
    if($FRRP=="FrYTVideoEmbed"){$FRRPL="frd-mixd/frd-$FRRP.php";}
    elseif($FRRP=="DownlodeFileXLS"){$FRRPL="frd-mixd/frd-$FRRP.php";}
    elseif($FRRP=="Writers"){$FRRPL="frd-mixd/frd-$FRRP.php";}
    elseif($FRRP=="CatAddForm"){$FRRPL="frd-mixd/frd-$FRRP.php";}
    elseif($FRRP=="NewOrderPlace"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="IniCAPI"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="sid"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="mcs"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="SoftUp"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="PluginUp"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="SoftVersion"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}
    elseif($FRRP=="test"){$FRRPL="frd-mixd/frdapi-$FRRP.php";}

    elseif($FRRP=="CustomerList"){$FRRPL="frd-cm/frd-$FRRP.php";}

    //FRD SETTING:-
    elseif($FRRP=="Api_HpSecSerialize"){$FRRPL="frd-setti/frd-$FRRP.php";}

    //FRD SETTING:-
    elseif($FRRP=="NewOrderPlaceSMS"){$FRRPL="frd-sms/frdapi-$FRRP.php";}
    
    //FRD FRONT THEME:-
    elseif($FRRP=="CartItems2"){$FRRPL="frd-theme/frdapi-$FRRP.php";}
    elseif($FRRP=="CartQtyUp"){$FRRPL="frd-theme/frdapi-$FRRP.php";}
    elseif($FRRP=="CartQtyDown"){$FRRPL="frd-theme/frdapi-$FRRP.php";}
    elseif($FRRP=="CartItemRemove"){$FRRPL="frd-theme/frdapi-$FRRP.php";}
    elseif($FRRP=="writers_list"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="PageQuickView"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="ItemSizeVariaShow"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="ItemColorVariaShow"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="CustomerAllPages"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="SeeMoreRatingR"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="PdfFileView"){$FRRPL="frd-theme/frd-$FRRP.php";}
    elseif($FRRP=="IPI_PopUp"){$FRRPL="frd-theme/frdapi-$FRRP.php";}
    elseif($FRRP=="LeftSideNave"){$FRRPL="frd-theme/frdapi-$FRRP.php";}

    //FRD PARCEL DELIVERY:-
    elseif($FRRP=="PD_OrderThankYouSMS"){$FRRPL="frd-pd/frd-$FRRP.php";}
    elseif($FRRP=="PD_OrderList"){$FRRPL="frd-pd/frd-$FRRP.php";}

    //FRD ORDER MANAGMENT
    elseif($FRRP=="InvoiceList"){$FRRPL="frd-om/frd-$FRRP.php";}
    elseif($FRRP=="ProductCollectionChecklist"){$FRRPL="frd-om/frdapi-$FRRP.php";}
    elseif($FRRP=="ProductCollectionChecklistSB"){$FRRPL="frd-om/frdapi-$FRRP.php";}
    elseif($FRRP=="options_pathao_city"){$FRRPL="frd-om/frdapi-$FRRP.php";}
    elseif($FRRP=="options_pathao_zone"){$FRRPL="frd-om/frdapi-$FRRP.php";}
    elseif($FRRP=="options_pathao_area"){$FRRPL="frd-om/frdapi-$FRRP.php";}

    elseif($FRRP=="ProductListAPI"){$FRRPL="frd-pm/frd-$FRRP.php";}
    elseif($FRRP=="ProductListAPI2"){$FRRPL="frd-pm/frd-$FRRP.php";}
    elseif($FRRP=="ProImgUp"){$FRRPL="frd-pm/frdapi-$FRRP.php";}
    elseif($FRRP=="ProImgRemove"){$FRRPL="frd-pm/frdapi-$FRRP.php";}

    elseif($FRRP=="SellsReportsDB"){$FRRPL="frd-sr/frdapi-SellsReportsDB.php";}
    elseif($FRRP=="SellsReportsPB"){$FRRPL="frd-sr/frdapi-SellsReportsPB.php";}
    elseif($FRRP=="SellsReportsCB"){$FRRPL="frd-sr/frdapi-SellsReportsCB.php";}
    elseif($FRRP=="PayReceivInvoBased"){$FRRPL="frd-sr/frdapi-PayReceivInvoBased.php";}

    elseif($FRRP=="ProfitAddToInvoiceList"){$FRRPL="frd-pal/frdapi-ProfitAddToInvoiceList.php";}
    elseif($FRRP=="SalesProfitReport_PB_OSB"){$FRRPL="frd-pal/frdapi-SalesProfitReport_PB_OSB.php";}
    elseif($FRRP=="SalesProfitReport_CB_OSB"){$FRRPL="frd-pal/frdapi-SalesProfitReport_CB_OSB.php";}
    elseif($FRRP=="NetProfitReport_IB"){$FRRPL="frd-pal/frdapi-NetProfitReport_IB.php";}
    elseif($FRRP=="PaLReportsPB"){$FRRPL="frd-pal/frdapi-PaLReportsPB.php";}
    elseif($FRRP=="PaLReportsIB"){$FRRPL="frd-pal/frdapi-PaLReportsIB.php";}
    elseif($FRRP=="PaLReportsDB"){$FRRPL="frd-pal/frdapi-PaLReportsDB.php";}
    elseif($FRRP=="PaLREportsCB"){$FRRPL="frd-pal/frdapi-PaLREportsCB.php";}
    elseif($FRRP=="NetPaLReportsDB"){$FRRPL="frd-pal/frdapi-NetPaLReportsDB.php";}

    elseif($FRRP=="PPRCommingBack"){$FRRPL="frd-ppr/frdapi-PPRCommingBack.php";}
    elseif($FRRP=="PPRReceivedStatmentIB"){$FRRPL="frd-ppr/frdapi-PPRReceivedStatmentIB.php";}
    elseif($FRRP=="PPRReceivedStatmentDB"){$FRRPL="frd-ppr/frdapi-PPRReceivedStatmentDB.php";}
    elseif($FRRP=="PPRreceivedStatmentPB"){$FRRPL="frd-ppr/frdapi-PPRreceivedStatmentPB.php";}
    

    if(isset($FRRPL)){ 
        require_once("$FRRPL");
        exit;
    }else{
         $FR_OUTPUT = [];
         $FR_OUTPUT['FRA'] = 2;
         $FR_OUTPUT['FRM'] = "API NOT FOUND";
         echo json_encode($FR_OUTPUT);
         exit;
    } 
}