<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Panel Changer";//PAGE TITLE
$p="#";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Panel Changer  </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//FRD_VC____________________________________:-
if (!isset($FRurl[1]) or $FRurl[1] == "") {
    header("location:$FR_THISHURL/panels/?FRH=HSYEYTHO0X");
}
$FRc_NextPanelId = $FRurl[1]; //WRITER ID
// echo "$FRc_NextPanelId";

if($FRc_NextPanelId==1){ FR_GO("$FR_SP_HURL_DP/dp-panels"); }
elseif($FRc_NextPanelId==9){ FR_GO("$FR_SP_HURL_DP/cm-CategoryAdd"); }
elseif($FRc_NextPanelId==22){ FR_GO("$FR_SP_HURL_DP/brand-BrandAdd"); }
elseif($FRc_NextPanelId==23){ FR_GO("$FR_SP_HURL_DP/Writers-Writers"); }
elseif($FRc_NextPanelId==3){ FR_GO("$FR_SP_HURL_DP/page-PageList"); }
elseif($FRc_NextPanelId==19){ FR_GO("$FR_SP_HURL_DP/setting-OrderManagerSetting"); }
elseif($FRc_NextPanelId==25){ FR_GO("$FR_SP_HURL_DP/smss-SMSspLIST"); }
elseif($FRc_NextPanelId==26){ FR_GO("$FR_SP_HURL_DP/tc-HeaderCustomizer"); }
elseif($FRc_NextPanelId==16){ FR_GO("$FR_SP_HURL_DP/SoftUp-CheckingUpdate"); }
elseif($FRc_NextPanelId==2){ FR_GO("$FR_SP_HURL_DP/pro-ProductList"); }
elseif($FRc_NextPanelId==6){ FR_GO("$FR_SP_HURL_DP/om-OPS1"); }
elseif($FRc_NextPanelId==24){FR_GO("$FR_SP_HURL_DP/ProCol-ColorAdd"); }
elseif($FRc_NextPanelId==21){ FR_GO("$FR_SP_HURL_DP/ProDP-ShippingPartners"); }
elseif($FRc_NextPanelId==17){ FR_GO("$FR_SP_HURL_DP/InHnF-InsertHeaderFooter"); }

elseif($FRc_NextPanelId==4){ FR_GO("$FR_SP_HURL_DP/rr-RatingReviewAprove"); }
elseif($FRc_NextPanelId==27){ FR_GO("$FR_SP_HURL_DP/SFCosau-SFCorderStatusAutoUp"); }

elseif($FRc_NextPanelId==15){ FR_GO("$FR_SP_HURL_DP/crm-CustomerList"); }
elseif($FRc_NextPanelId==5){ FR_GO("$FR_SP_HURL_DP/usr-SoftUsrList");}
elseif($FRc_NextPanelId==18){ FR_GO("$FR_SP_HURL_DP/ppr-PPRCommingBack"); }
elseif($FRc_NextPanelId==10){ FR_GO("$FR_SP_HURL_DP/sr-LiveOrdersSummery"); }
elseif($FRc_NextPanelId==14){ FR_GO("$FR_SP_HURL_DP/pal-ProfitAddToInvoiceList"); }

elseif($FRc_NextPanelId==7){ FR_GO("$FR_SP_HURL_DP/cost-AddCost");}
elseif($FRc_NextPanelId==8){ FR_GO("$FR_SP_HURL_DP/acc-BankAccountList");}
elseif($FRc_NextPanelId==11){ FR_GO("$FR_SP_HURL_DP/inv-InvestorList"); }
elseif($FRc_NextPanelId==12){ FR_GO("$FR_SP_HURL_DP/supp-SuppliersList"); }
elseif($FRc_NextPanelId==30){ FR_GO("$FR_SP_HURL_DP/due-CustomerDueInvoices"); }

elseif($FRc_NextPanelId==28){ FR_GO("$FR_SP_HURL_DP/smsMosb-SMSmarketingOSB"); }
elseif($FRc_NextPanelId==29){ FR_GO("$FR_SP_HURL_DP/fbcat-Feed"); }
elseif($FRc_NextPanelId==31){ FR_GO("$FR_SP_HURL_DP/popoffer-PopUpOffer"); }
elseif($FRc_NextPanelId==32){ FR_GO("$FR_SP_HURL_DP/SearchH-SearchHistory"); }
elseif($FRc_NextPanelId==33){ FR_GO("$FR_SP_HURL_DP/coupon-CouponList"); }
elseif($FRc_NextPanelId==34){ FR_GO("$FR_SP_HURL_DP/fos-BlockCustomers"); }
elseif($FRc_NextPanelId==35){ FR_GO("$FR_SP_HURL_DP/custxls-CustomerDownlode"); }

elseif($FRc_NextPanelId==20){ FR_GO("$FR_SP_HURL_DP/parcel-home"); }

elseif($FRc_NextPanelId==301){ FR_GO("$FR_SP_HURL_DP/sitedata-SiteList"); }
?>   
</section>
<!-- 1 SCRIPT END -->    






<?php require_once('frd1_footer.php'); ?>   