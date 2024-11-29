<?php
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$FRc_PAGE_TITEL = "Checkout Complete - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
    <meta name='keywords' content='$fr_cmetatag'>
    <meta name='author' content='$fr_cname'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_cname'>
    <meta name='description' content='$fr_cmetades'>
    <meta name='page-topic' content='Ecommerce'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";

//FRD_VC_____________________________________:-
if (!isset($_SESSION['FRs_LastOrderEncId'])) {
    FR_GO("$FRD_HURL?FRH=HDYEYDNDUNDMNDUX", 1);
    FR_SWAL("ACCESS DENIED", "", "error");
    echo "ACCESS DENIED";
    exit;
}


require_once("frd-public/theme/frd-header.php");
?>

<!-- 1 scripts s-->
<section>
    <?php
    $FRs_LastOrderEncId = $_SESSION['FRs_LastOrderEncId'];
    unset($_SESSION['FRs_LastOrderEncId']);

    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_enc_id = '$FRs_LastOrderEncId' AND fr_stat != 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
        $FRc_Invoice_Id_x = $id;
    } else {
        ECHO_4($FRR['FRM']);
        exit;
    }





    //FRD CONVERTION TRACK DATA CUSTOMIZE START:-
    $FR_CT_USR_EMAIL = $fr_cust_mob1;
    $FR_CT_USR_PHON = $fr_cust_mob1;
    $FR_CT_USR_FULL_NAME = $fr_cust_name;
    $FRc_CT_ItemSealPrice = $fr_pro_total;
    $FRc_CT_ORDER_ID = $FRc_Invoice_Id_x;
    $FRc_CT_USR_ADDRESS = $fr_cust_addres;
    $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x", "ALL");
    if ($FRR['FRA'] == 1) {
        $FRc_CT_CartItems_C = count($FRR['FRD']);//ARRAY COUNT
        $FRc_Coma = ",";
        $FRc_CT_ItemId = "";
        $FRc_CT_ItemName = "";
        $FRc_CT_ItemCatName = "";
        $FRc_SL = 1;
        foreach ($FRR['FRD'] as $FR_ITEM) {
            extract($FR_ITEM);
            extract(FRF_CATT_NAME($r_cat_1));
            $fr_pro_title = preg_replace("/'/","",$fr_pro_title);
            $FRc_CATT_NAME = preg_replace("/'/","",$FRc_CATT_NAME);

            if ($FRc_SL == $FRc_CT_CartItems_C) {
                $FRc_Coma = "";
            }

            if($FRc_CT_CartItems_C > 1 ){
                $FRc_CT_ItemId .="$fr_pro_id$FRc_Coma";
                $FRc_CT_ItemName .="$fr_pro_title$FRc_Coma";
                $FRc_CT_ItemCatName .="$FRc_CATT_NAME$FRc_Coma";
            }else{
                $FRc_CT_ItemId ="$fr_pro_id";
                $FRc_CT_ItemName ="$fr_pro_title";
                $FRc_CT_ItemCatName ="$FRc_CATT_NAME";
            }

            $FRc_SL = ($FRc_SL + 1);
        }

        if($FRc_CT_CartItems_C > 1 ){
            $FRc_CT_ItemId = json_encode(explode(',',$FRc_CT_ItemId));
            $FRc_CT_ItemName = json_encode(explode(',',$FRc_CT_ItemName));
            $FRc_CT_ItemCatName = json_encode(explode(',',$FRc_CT_ItemCatName));
        }
    }
    //FRD CONVERTION TRACK DATA CUSTOMIZE END>>
    ?>
</section>
<!-- 1 scripts e-->


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo "
                  <div class='text-center'>
                    <img src='$FRD_HURL/frd-src/img/gif/frd-thank-you-1.gif' alt='#' style='width:300px;height:auto;margin:auto;'>
                    <br>
                    <a href='$FRD_HURL/track/$FRs_LastOrderEncId'> >>> Track Your Order </a>
                    </div>
                ";
                if (!isset($_SESSION['FRs_PixelSetupMode'])) {
                    FR_GO("$FRD_HURL/track/$FRs_LastOrderEncId", 2);
                }
                ?>
            </div>
        </div>
    </div>
</section>




<br>
<br>
<br>
<br>

<script>
    const FR_CT_USR_EMAILL = '<?php echo "$FR_CT_USR_EMAIL";?>';
    const FR_CT_USR_PHONN = '<?php echo "$FR_CT_USR_PHON";?>';
    const FR_CT_USR_FULL_NAMEE = '<?php echo "$FR_CT_USR_FULL_NAME";?>';
    const FRc_CT_ItemSealPricee = '<?php echo "$FRc_CT_ItemSealPrice";?>';
    const FRc_CT_ItemIdd = '<?php echo "$FRc_CT_ItemId"; ?>';
    const FRc_CT_ItemNamee = '<?php echo "$FRc_CT_ItemName"; ?>';
    const FRc_CT_ItemCatNamee = '<?php echo "$FRc_CT_ItemCatName"; ?>';
    const FRc_CT_CartItems_CC = '<?php echo "$FRc_CT_CartItems_C"; ?>';
    const FRc_CT_ORDER_IDD = '<?php echo "$FRc_CT_ORDER_ID"; ?>';
    const FRc_CT_USR_ADDRESSS = '<?php echo "$FRc_CT_USR_ADDRESS"; ?>';
</script>




<?php if($frtex_PixelTrack == 1){ ?>
<script>
    $(document).ready(function() {
        if (typeof fbq === "function") {
            fbq('track', 'Purchase', {
                plugin: 'SpiderEcommerceFBPixel'
            });
        }
   });
</script>
<?php } ?>


<?php if($frtex_PixelTrack == 2){ ?>
<script>
    $(document).ready(function() {
    if (typeof fbq === "function") {
        fbq('track', 'Purchase', {
            currency: 'BDT',
            value: <?php echo "$fr_pro_total";?>,
            total: <?php echo "$fr_pro_total";?>,
            contents: [
            <?php
                $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x", "ALL");
                if ($FRR['FRA'] == 1) {
                    $FRc_Items_C = count($FRR['FRD']);//ARRAY COUNT
                    $FRc_Coma = ",";
                    $FRc_content_ids = "";
                    $FRc_content_name = "";
                    $FRc_content_category = "";
                    $FRc_SL = 1;
                    foreach ($FRR['FRD'] as $FR_ITEM) {
                        extract($FR_ITEM);
                        if ($FRc_SL == $FRc_Items_C) {
                            $FRc_Coma = "";
                        }
                         extract(FRF_CATT_NAME($r_cat_1));
                         $fr_pro_title = preg_replace("/'/","",$fr_pro_title);
                         $FRc_CATT_NAME = preg_replace("/'/","",$FRc_CATT_NAME);

                        echo "
                        {
                            id: '$fr_pro_id',
                            quantity: $fr_qty,
                            name: '$fr_pro_title'
                        }$FRc_Coma
                        ";

                        if($FRc_Items_C > 1 ){
                            $FRc_content_ids .="\"$fr_pro_id\"$FRc_Coma";
                            $FRc_content_name .="\"$fr_pro_title\"$FRc_Coma";
                            $FRc_content_category .="\"$FRc_CATT_NAME\"$FRc_Coma";
                        }else{
                            $FRc_content_ids .="$fr_pro_id";
                            $FRc_content_name .="$fr_pro_title";
                            $FRc_content_category .="$FRc_CATT_NAME";
                        }

                        $FRc_SL = ($FRc_SL + 1);
                    }

                    if($FRc_Items_C > 1 ){
                        $FRc_content_ids ="[$FRc_content_ids]";
                        $FRc_content_name ="[$FRc_content_name]";
                        $FRc_content_category ="[$FRc_content_category]";
                    }
                }
            ?>
            ],
            content_type: 'product',
            content_category: '<?php echo "$FRc_content_category";?>',
            num_items: <?php echo "$FRc_Items_C";?>,
            content_name: '<?php echo "$FRc_content_name";?>',
            content_ids: '<?php echo "$FRc_content_ids";?>',
            coupon_used: 'no',
            user_role: 'guest',
            domain: '<?php echo "$FRD_HURL";?>',
            page_title: '<?php echo "$FRc_PAGE_TITEL";?>',
            event_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
            event_source_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
            event_day: '<?php echo "$FR_NOW_DAY_F";?>',
            event_month: '<?php echo "$FR_NOW_MONTH_F";?>',
            event_time: '<?php echo "$FR_NOW_TIME";?>',
            fbc: '<?php echo "$FRc_fbc";?>',
            fbp: '<?php echo "$FRc_fbp";?>',
            plugin: 'PixelYourSiteBySpider'
        },
        {
             event_id: "p"+FRc_EVENT_IDD
        }
        );
    }
   });

   
</script>
<?php } ?>




<!-- GTM Purchase EVENT FIRE | FRD GTM EVERNT -->
<?php if ($frtcplug_GTMdataLayer == 1) { ?>
    <script>
        dataLayer.push({
            ecommerce: null
        }); // Clear the previous ecommerce object.
        dataLayer.push({
            event: "purchase",
            client_id: "<?php echo "$FRc_USER_AGENT";?>",
            ip_override: "<?php echo "$FRc_USER_IP";?>",
            user_id: "<?php echo "$FRc_USER_UID";?>",
            plugin: "SpiderEcommerceGTM4DL",
            ecommerce: {
                currency: "BDT",
                value: <?php echo "$fr_pro_total";?>,
                transaction_id: "<?php echo "$FRc_Invoice_Id_x";?>",
                affiliation: "<?php echo "$fr_cname"; ?>",
                tax: 0.00,
                shipping: <?php echo "$fr_ship_cost"; ?>,
                coupon: "NA",
                items: [

                    <?php
                    $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x ", "ALL");
                    if ($FRR['FRA'] == 1) {

                        $FRc_ArrayC = count($FRR['FRD']);

                        $FRc_Coma = ",";
                        $FRc_SL = 1;
                        foreach ($FRR['FRD'] as $FR_ITEM) {
                            extract($FR_ITEM);

                            if ($FRc_SL == $FRc_ArrayC) {
                                $FRc_Coma = "";
                            }

                            extract(FRF_BRAND_NAME($r_brand));
                            $pro_r_brand_name = $FRc_BRAND_NAME;

                            extract(FRF_COLOR_NAME($r_color));
                            $FRsd_ProColorName = $FRc_COLOR_NAME;

                            //FRD ITEM CATEGORY NAME FINDER:-
                            $pro_catt1_name_bn = "N/A";
                            $pro_catt2_name_bn = "N/A";
                            $pro_catt3_name_bn = "N/A";
                            $pro_catt4_name_bn = "N/A";

                            extract(FRF_CATT_NAME($r_cat_1));
                            $pro_catt1_name_bn = $FRc_CATT_NAME;

                            if ($r_cat_2 > 0) {
                                extract(FRF_CATT_NAME($r_cat_2));
                                $pro_catt2_name_bn = $FRc_CATT_NAME;
                            }
                            if ($r_cat_3 > 0) {
                                extract(FRF_CATT_NAME($r_cat_3));
                                $pro_catt3_name_bn = $FRc_CATT_NAME;
                            }
                            if ($r_cat_4 > 0) {
                                extract(FRF_CATT_NAME($r_cat_4));
                                $pro_catt4_name_bn = $FRc_CATT_NAME;
                            }
                            //END>> 

                            echo "
                            {
                                item_id: '$fr_pro_id',
                                item_name: '$fr_pro_title',
                                affiliation: '$fr_cname',
                                coupon: 'NA',
                                currency: 'BDT',
                                discount: 'NA',
                                index: 0,
                                item_brand: '$pro_r_brand_name',
                                item_category: '$pro_catt1_name_bn',
                                item_category2: '$pro_catt2_name_bn',
                                item_category3: '$pro_catt3_name_bn',
                                item_category4: '$pro_catt4_name_bn',
                                item_list_id: 'NA',
                                item_list_name: 'NA',
                                item_variant: '$FRsd_ProColorName $fr_size_name',
                                location_id: 'NA',
                                price: $fr_t_price,
                                quantity: $fr_qty
                            }$FRc_Coma
                            ";

                            $FRc_SL = ($FRc_SL + 1);
                        }
                    }
                    ?>
                ]
            },
            customer_data: {
                full_name: "<?php echo "$FR_CT_USR_FULL_NAME";?>",
                phone: "<?php echo "+88$FR_CT_USR_PHON";?>",
                address: "<?php echo "$FRc_CT_USR_ADDRESS";?>"
            }
        });
    </script>
<?php } ?>



<?php require_once("frd-public/theme/frd-footer.php");
ob_end_flush();  
?>