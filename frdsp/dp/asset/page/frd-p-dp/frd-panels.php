<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Panels";//PAGE TITLE
$p="panel";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> ALL PANELS </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
 if($UsrType == "pdm"){ FR_GO("$FR_SP_HURL_DP/parcel-home"); }    
?>   
</section>
<!-- 1 SCRIPT END -->    

   


<section> 
    <div class="container">
        <div class="col-md-11">
          
            <div class="row">

                <div class="text-center">
                    <img id="nav2_brandlogu" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"?>" alt="" height="60px" width="auto" class="">
                </div>
                
                     <?php 
                             foreach($fr_uapp_ARR AS $uap_ap_id){
                                if($uap_ap_id==1){$uap_ap_id_m="[DP] Home"; $FRc_UAP_ICON_IMG = "icon-product-mng.webp"; continue; }
                                if($uap_ap_id==2){$uap_ap_id_m="Product Manager"; $FRc_UAP_ICON_IMG = "icon-product-mng.webp"; }
                                if($uap_ap_id==3){$uap_ap_id_m="Page Manager"; $FRc_UAP_ICON_IMG = "icon-pages-mng.webp"; }
                                if($uap_ap_id==6){$uap_ap_id_m="Order Manager"; $FRc_UAP_ICON_IMG = "icon-order-mangment.png"; }
                                if($uap_ap_id==9){$uap_ap_id_m="Category Manager"; $FRc_UAP_ICON_IMG = "icon-cat-mng.png"; }
                                if($uap_ap_id==16){$uap_ap_id_m="Software Update"; $FRc_UAP_ICON_IMG = "icon-software-update.png";}
                                if($uap_ap_id==17){$uap_ap_id_m="Insert Header & Footer"; $FRc_UAP_ICON_IMG = "icon-insert-heade-and-footer.png";}
                                if($uap_ap_id==19){$uap_ap_id_m="Settings"; $FRc_UAP_ICON_IMG = "icon-setting.png";}
                                if($uap_ap_id==21){$uap_ap_id_m="Delivery Partner Manager"; $FRc_UAP_ICON_IMG = "icon-delivery-partners.jpg";}
                                if($uap_ap_id==22){$uap_ap_id_m="Product Brand Manager"; $FRc_UAP_ICON_IMG = "icon-brand-m-panel.png";}
                                if($uap_ap_id==23){$uap_ap_id_m="Book Writer Manager"; $FRc_UAP_ICON_IMG = "icon-writers-m-panel.png";}
                                if($uap_ap_id==24){$uap_ap_id_m="Product Color Manager"; $FRc_UAP_ICON_IMG = "icon-color-m-panel.jpg";}
                                if($uap_ap_id==26){$uap_ap_id_m="Theme Customizer"; $FRc_UAP_ICON_IMG = "icon-theme-customization.png";}


                                if($uap_ap_id==20){$uap_ap_id_m="[PD] PARCELS DELIVERY"; $FRc_UAP_ICON_IMG = "icon-parcel-delivery.png";}


                                if($uap_ap_id==4){$uap_ap_id_m="Rating Review Manager"; $FRc_UAP_ICON_IMG = "icon-rating-review.webp"; }
                                if($uap_ap_id==5){$uap_ap_id_m="Multi User Manager"; $FRc_UAP_ICON_IMG = "icon-user-mangment.png"; }
                                if($uap_ap_id==7){$uap_ap_id_m="Cost Manager"; $FRc_UAP_ICON_IMG = "icon-cost.png"; }
                                if($uap_ap_id==8){$uap_ap_id_m="Accounting Manager"; $FRc_UAP_ICON_IMG = "icon-accounting.png"; }
                                if($uap_ap_id==10){$uap_ap_id_m="Sales Report Manager"; $FRc_UAP_ICON_IMG = "icon-sells-reports.jpg"; }
                                if($uap_ap_id==11){$uap_ap_id_m="Investor Manager"; $FRc_UAP_ICON_IMG = "icon-investor-2.webp"; }
                                if($uap_ap_id==12){$uap_ap_id_m="Suppliers Manager"; $FRc_UAP_ICON_IMG = "icon-suppliers.png"; }
                                if($uap_ap_id==14){$uap_ap_id_m="Profit & Loss Report Manager"; $FRc_UAP_ICON_IMG = "icon-profit-and-loss.png";}
                                if($uap_ap_id==15){$uap_ap_id_m="Customer Manager"; $FRc_UAP_ICON_IMG = "icon-customers.png";}
                                if($uap_ap_id==18){$uap_ap_id_m="Product Return Back Manager"; $FRc_UAP_ICON_IMG = "icon-parcial-product-return-back.webp";}
                                if($uap_ap_id==25){$uap_ap_id_m="SMS Services"; $FRc_UAP_ICON_IMG = "icon-sms-services-m-panel.png";}
                                if($uap_ap_id==27){$uap_ap_id_m="SteadFast Order Status Auto Update"; $FRc_UAP_ICON_IMG = "icon-SteadFast-Order-Status-Auto-Update.jpg";}
                                if($uap_ap_id==28){$uap_ap_id_m="SMS Marketing - OSB"; $FRc_UAP_ICON_IMG = "icon-Bulk-SMS-Marketing-OSB.jpg";}
                                if($uap_ap_id==29){$uap_ap_id_m="Facebook Dynamic Catalog"; $FRc_UAP_ICON_IMG = "Facebook-Dynamic-Catalog-Manager.png";}
                                if($uap_ap_id==30){$uap_ap_id_m="Due Manager"; $FRc_UAP_ICON_IMG = "due-manager.png";}
                                if($uap_ap_id==31){$uap_ap_id_m="Popup Offer Manager"; $FRc_UAP_ICON_IMG = "popup-offer-manager.png";}
                                if($uap_ap_id==32){$uap_ap_id_m="Search History Manager"; $FRc_UAP_ICON_IMG = "search-history-manager.png";}
                                if($uap_ap_id==33){$uap_ap_id_m="Coupon Manager"; $FRc_UAP_ICON_IMG = "coupon-manager.png";}
                                if($uap_ap_id==34){$uap_ap_id_m="Fake Order Solution Manager"; $FRc_UAP_ICON_IMG = "fake-order-solution-manager.png";}
                                if($uap_ap_id==35){$uap_ap_id_m="Customer Download Manager"; $FRc_UAP_ICON_IMG = "Customer-Download-Manager.png";}

                                
                                if($uap_ap_id==301){$uap_ap_id_m="Site Data"; $FRc_UAP_ICON_IMG = "icon-site-data.png";}

                                echo " 
                                <div class='col-md-2'>
                                    <div class='frd-card-2' style='width:auto;height:150px;'>
                                            <a class='frd_tdn' href='$FR_THISHURL/dp-PanelChanger/$uap_ap_id'>
                                            <br>
                                            <img src='$FRD_HURL/frd-public/theme/img/icon/$FRc_UAP_ICON_IMG' alt='' width='auto' height='60px'><br>
                                            $uap_ap_id_m
                                            <br><br>
                                            <br>
                                            </a>
                                    </div> 
                                </div>
                               ";
                             }
                          ?>
            </div>
            
           
                
            
        </div>
    </div>
</section>




<br><br><br>
<section>
    <div class="container">
    <div class="col-md-11">

        <div class="row">
            <hr>

            <div class="col-md-12 text-center">
              <a href="<?php echo "$FR_SP_HURL_DP/dp-logout"?>" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </div>
            
            <div class="col-md-12">
                <h6 class="text-center text-success"><?php echo "SPIDER ECOMMERCE VERSION: $FR_SOFT_VERSION";?></h6>
                <h6 class="text-center text-success"><?php echo "SERVER PHP VERSION: ".phpversion()."";?></h6>
            </div>
        </div>

    </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   