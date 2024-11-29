<?php
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$FRc_PAGE_TITEL = "Checkout - $fr_cmetatitle";
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
require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> Checkout Add Ship Address </h2>-->
<style type="text/css">
    /* FRD OVERWRITE FRO THIS PSGE FORM MOBILE DEVICE */
    @media (max-width: 768px) {
        body {
            margin-right: 0px !important;
        }
    }

    table.ordersum1 {
        width: 100%;
        font-weight: 800;
    }

    table.ordersum1 tr td {
        border: 1px solid #ddd;
        padding: 3px;
    }
</style>



<!-- 1 scripts s-->
<section>
    <?php
    //FRD_VC______________________________________________________:-
    if (!isset($_SESSION['FRs_Invo_Token'])) {
        FR_GO("$FR_THISHURL?FRH=fc162811bs");
        exit;
    } else {
        $FRs_Invo_Token = $_SESSION['FRs_Invo_Token'];
        $FRc_Invoice_Id_x = $FRs_Invo_Token;
        $FRs_Invo_EncId = $_SESSION['FRs_Invo_EncId'];
    }
    //++
    //FRD_VC_________________________________________________________:-
    if (!isset($_SESSION['s_cust_id'])) {
        if ($frd_gom == "frd_off") {
            header("location:$FRD_HURL/login?next_destination=$FRD_HURL/checkout");
        }
    }




    //----------------------------------------------------------------
    //FRD PRODUCT DELIVERY CHARGE TYPE FINDER:-
    //----------------------------------------------------------------
    $FRc_DeliChargeTyp = 0;
    $FRR = FR_QSEL("SELECT COUNT(id) AS FRc_DeliChargeTyp FROM frd_order_items WHERE deli_crg_typ = 2 AND fr_invo_id = $FRs_Invo_Token", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        ECHO_4($FRR['FRM']);
    }
    //++++
    //++++
    //FRD ORDER AMOUNT BASE DELIVERY CHARGE FREE:-
    $_SESSION['cart_price'];
    if($frtc_dcf_oab_amount > 0){
        if($_SESSION['cart_price'] >= $frtc_dcf_oab_amount){
            $FRc_DeliChargeTyp = 2;
        }
    }




    //FRD CUSTOMER DATA MAKING:-
    if (isset($_SESSION['s_cust_pemail'])) {
        $FRc_CustomerIdx = $_SESSION['s_cust_id'];

        $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE id = $FRc_CustomerIdx AND typee = 'cu' AND statuss = 1", "");
        if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
        } else {
            ECHO_4($FRR['FRM']);
        }
        if ($typee != 'cu') {
            header("location:$FRD_HURL/logout?hc1573935");
        } //FRD VC

        $FRc_CustomerId = $id;
        $FRc_CustomerType = 1; //[1 = REGISTER CUSTOMER]
        $FRc_CustomerName = "$namee";
        $FRc_CustomerMobile = "$email1";
        $FRc_CustomerAddress = "$addresss";
    } else {
        $FRc_CustomerId = 1; //[1=GUEST CUSTOMER]
        $FRc_CustomerType = 2; //[2=GUEST CUSTOMERS]
        $FRc_CustomerName = "";
        $FRc_CustomerMobile = "";
        $FRc_CustomerAddress = "";
    }

    $FRc_OrderNote = "";
    if (isset($_SESSION['FRs_ItmePlusMinus_Note'])) {
        $FRc_OrderNote = $_SESSION['FRs_ItmePlusMinus_Note'];
    }

    $FRc_ShipCost = "";
    if (isset($_SESSION['FRs_ItmePlusMinus_DeliCharge'])) {
        $FRc_ShipCost = $_SESSION['FRs_ItmePlusMinus_DeliCharge'];
    }

    //END>>



    ///////////////////////////////////////////////////////////////
    // FRD CART SUMMERY FINDER
    ///////////////////////////////////////////////////////////////
    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = $FRs_Invo_Token AND fr_stat = 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        ECHO_4("NO INVOICE DATA FOUND", "alert alert-danger text-center");
    }

    $FRR = FR_QSEL("SELECT COUNT(id) AS FRc_Invoice_Tot_Items, SUM(fr_qty) AS FRc_Invoice_Tot_Qty, SUM(fr_t_price) AS FRc_InvoiceItems_Tot_Price FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Token AND fr_stat = 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        ECHO_4($FRR['FRM']);
    }



    

    //FRD CONVERTION TRACK DATA CUSTOMIZE START:-
    $FRc_CT_ItemSealPrice = $_SESSION['cart_price'];
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



            

<!-- ### -->
<section>
    <div class="container">

        <div class="row fr-mt-10">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

                <!-- CHECKOUT-FORM -->
                <form class="fdeliAadd fcheckout" action="" method="post" autocomplete="on">

                    <h4 class="text-center boldd"><span class="glyphicon glyphicon-send"></span> <?php echo "$frlc_give_delivery_info_txt";?></h4>
                    <table class="t_deliform" width="100%">
                        <tr>
                            <td>
                                <small><?php echo "$frlc_full_name_txt";?></small>
                                <input class="form-control" type="text" name="" id="f_customer_name" placeholder="<?php echo "$frlc_full_name_txt"; ?>" value="<?php echo "$FRc_CustomerName" ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="boldd">
                                <small><?php echo "$frlc_mobile_number_txt";?></small>
                                <input class="form-control" type="text" name="" id="f_customer_mobile" placeholder="<?php echo "$frlc_mobile_number_txt"; ?>" value="<?php echo "$FRc_CustomerMobile" ?>" minlength="11" maxlength="17" required>
                            </td>
                        </tr>



                        <?php if($frtc_cf_divdistha == 1){ ?>
                        <div class='div_dis_tha_sec'>
                            <tr>
                                <td>
                                    <select class="form-control mt-10" id="f_devision" name="">
                                            <option value=''>Select Division </option>
                                            <option value="Barishal">Barishal</option>
                                            <option value="Chittagong">Chittagong</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Khulna">Khulna</option>
                                            <option value="Mymensingh">Mymensingh</option>
                                            <option value="Rajshahi">Rajshahi</option>
                                            <option value="Rangpur">Rangpur</option>
                                            <option value="Sylhet">Sylhet</option>
                                        </select>
                                </td>
                            </tr>
                            
                            <tr id="f_district_sec" style="display: none;">
                                <td>
                                    <select class='form-control mt-10' id='f_district' name=''>
                                       
                                    </select> 
                                </td>
                            </tr>
                            <tr id="f_thana_sec" style="display: none;">
                            <td>
                                <select class='form-control mt-10' id='f_thana' name=''>
                                      
                                </select>  
                            </td>
                            </tr>
                        </div>
                        <?php } ?>



                        <tr>
                            <td>
                                <small class=""><?php echo "$frlc_delivery_address_txt";?> <?php if ($frtc_cf_fildadress_r == 1) {
                                                                                                echo "*";
                                                                                            } ?></small>
                        <textarea class="form-control" name="" id="f_customer_address" cols="20" rows="2" placeholder="<?php echo "$frlc_delivery_address_txt"; ?>"><?php echo "$FRc_CustomerAddress";?></textarea>
                         <input type="hidden" id="f_customer_address_r" value="<?php echo "$frtc_cf_fildadress_r";?>">
                            </td>
                        </tr>

                        <?php if ($FR_Dfild_Note == "YES") { ?>
                            <tr>
                                <td>
                                    <small class=""><?php echo "$frlc_note_txt"; ?> </small>
                                    <textarea class="form-control" name="" id="f_delivery_note" cols="20" rows="2" placeholder="<?php echo "$frlc_note_txt"; ?>"><?php echo "$FRc_OrderNote"; ?></textarea>
                                </td>
                            </tr>
                        <?php } ?>


                        <tr id="frf_delizoneSec">
                            <td>
                                <div class="fr-mt-10"></div>
                                <small class="boldd"><?php echo "$frlc_select_delivery_zone_txt";?></small><br>

                                <?php
                                //FRD:--
                                if ($FRc_DeliChargeTyp == 0) {
                                    $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE fr_sz_name !='' ORDER BY id ASC", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        $FRc_Checked = "";
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);

                                            if ($fr_sz_shipcost == $FRc_ShipCost) {
                                                $FRc_Checked = "checked";
                                            }

                                            echo "&#160; <input type='radio' name='f_delivery_zone_id' class='f_delivery_zone_id' id='dz_radio_btn_$id' value='$id' deliverycharge='$fr_sz_shipcost' $FRc_Checked> 
                                            <span class='dz_radio_btn_text' id='$id' role='button' deliverycharge='$fr_sz_shipcost'> $fr_sz_name [ $fr_sz_shipcost $frlc_tksymbol_txt ] </span> <br> ";
                                        }
                                    } else {
                                        echo "<div class='text-center alert alert-danger'>No Spip Zone Found</div>";
                                    }
                                }

                                //FRD:--
                                elseif ($FRc_DeliChargeTyp > 0) {
                                    echo "&#160; <input type='radio' name='f_delivery_zone_id' id='' value='0' checked required> $frlc_delivery_charge_free_txt ";
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div id="FF_DATA_CART_ITEMLIST_2"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <?php if ($frtc_OrdrTimeIagree == 'YES') { ?>
                                    <hr>
                                    <input type="checkbox" required>
                                    <span><?php echo "$frlc_iagree_txt"; ?><u class='cfrd_qv_tramsccondi pointer' id='terms-and-conditions'><i> <?php echo "$fr_vp_tramsandcondition_txt"; ?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='privacy-policy'><i><?php echo "$fr_vp_privacypolicy_txt"; ?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='refund-policy'><i><?php echo "$fr_vp_returnpolicy_txt"; ?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='delivery-policy'><i><?php echo "$fr_vp_deliverypolicy_txt"; ?> </i></u> </span>
                                <?php }; ?>

                                <br /><br />


                                <?php
                                if ($FRc_InvoiceItems_Tot_Price >= $frd_order_mintk) {
                                ?>
                                    <button class="btn btn-success btn-block FrOrderPlaceBtnCF FrTrig_OrderPlace" type="submit" ><?php echo "$frd_placeorder_btn_txt";?> ৳ <span class="FR_CHECKOUT_T_BILL_DATA"><?php echo number_format($_SESSION['cart_price']);?></span>   <span class="glyphicon glyphicon-arrow-right alertt"></span></button>
                                    <div id="OrderProcessinAlert"></div>
                                <?php
                                } else {
                                    echo "<h4 class='alert alert-danger'> সর্বনিম্ন <i class='alertt'> $frd_order_mintk </i> টাকার শপিং করতে হবে,<br>  প্রয়োজনে পন্যের পরিমান বাড়িয়ে দিন অথবা অন্যান্য পন্য কার্টে যুক্ত করুন। </h4>";
                                }
                                ?>

                            </td>
                        </tr>

                    </table>

                    <input type="hidden" id="f_product_id" value="NA">
                    <input type="hidden" id="f_CHECKOUT_T_BILLL" value="<?php echo $_SESSION['cart_price'];?>">
                </form>


                <br><br>
                <?php
                if ($frd_gom == "frd_on") {
                    if (!isset($_SESSION['s_cust_pemail'])) {
                ?>
                        <form action="<?php echo "$FRD_HURL/login"; ?>" method="post">
                            <button type="submit" class="btn btn-default btn-block btn-sm FRorderWithloginSingupBtn_hycx"><span class="glyphicon glyphicon-arrow-left alertt"></span><?php echo " $frlc_orderwihtlogin_txt"; ?></button>
                        </form>
                <?php }
                } ?>
                <br><br>

            </div>
            <div class="col-md-4">



            </div>
        </div>



    </div>
    <?php //} 
    ?>
</section>






<script type="text/javascript">

    const FRc_CT_ItemSealPricee = '<?php echo "$FRc_CT_ItemSealPrice"; ?>';
    const FRc_CT_ItemIdd = '<?php echo "$FRc_CT_ItemId"; ?>';
    const FRc_CT_ItemNamee = '<?php echo "$FRc_CT_ItemName"; ?>';
    const FRc_CT_ItemCatNamee = '<?php echo "$FRc_CT_ItemCatName"; ?>';
    const FRc_CT_CartItems_CC = '<?php echo "$FRc_CT_CartItems_C"; ?>';

    $(document).ready(function() {

        //FRD CART ITEMS 2 CALL:-
        $.ajax({
            url: FR_HURL_APII + '/CartItems2',
            method: "post",
            data: {
                a: 'a'
            },
            success: function(data) {
                $('#FF_DATA_CART_ITEMLIST_2').html(data);
            }
        });


        //FRD DIVISION, DISTRICT, THANA START:-
        $("#f_devision").unbind().change(function () {
                   var FR_SelectDivis = $(this).val();
                         $.ajax({
                            url: FRD_HURLL + '/frd-src/inc/php/frd-options-district.php',
                            method:"POST",
                            data:{FR_SelectDivis:FR_SelectDivis},  
                            success:function(data){ 
                                 $('#f_district_sec').show();
                                 $('#f_district').html(data);
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                        });
                   $('#f_district_sec').hide();
                   $('#f_thana_sec').hide();
        });
       $("#f_district").unbind().change(function () {
                   var FR_SelectDistrick = $(this).val();
                         $.ajax({
                            url: FRD_HURLL + '/frd-src/inc/php/frd-options-thana.php',
                            method:"POST",
                            data:{FR_SelectDistrick:FR_SelectDistrick},  
                            success:function(data){
                                $('#f_thana_sec').show();
                                 $('#f_thana').html(data);
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                       });
        });
        //DIVISION, DISTRICT, THANA END>>


        //FRD QUICK VIEW  TRAMS & CONDITION AND  DELEVERY POLICY:-
        $('.cfrd_qv_tramsccondi').click(function() {
            var frd_page_slug = $(this).attr("id");
            //alert(frd_page_slug);
            $.ajax({
                url: "<?php echo "$FR_HURL_API/PageQuickView"; ?>",
                method: "post",
                data: {
                    frd_page_slug: frd_page_slug
                },
                success: function(data) {
                    $('#model_masterpis_data').html(data);
                    $('#model_masterpis').modal("show");
                }
            });
        });

    });
</script>


<script src="<?php echo "$FRD_HURL/frd-src/inc/js/frd-LPinstantCheckout.js?v=$FR_SOFT_VERSION"?>"></script>





<?php if($frtex_PixelTrack == 1){ ?>
<script>
    $(document).ready(function() {
    if (typeof fbq === "function") {
        fbq('track', 'InitiateCheckout', {
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
        fbq('track', 'InitiateCheckout', {
            currency: 'BDT',
            value: <?php echo $_SESSION['cart_price']; ?>,
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
             event_id: "ic"+FRc_EVENT_IDD
        }
        );
    }
    });

</script>
<?php } ?>




<?php if ($frtcplug_GTMdataLayer == 1) { ?>
    <!-- FRD GTM begin_checkout FIRE | FRD GTM EVERNT -->
    <script>
        $(document).ready(function() {
            dataLayer.push({
                ecommerce: null
            }); // Clear the previous ecommerce object.
            dataLayer.push({
                event: "begin_checkout",
                client_id: "<?php echo "$FRc_USER_AGENT";?>",
                ip_override: "<?php echo "$FRc_USER_IP";?>",
                user_id: "<?php echo "$FRc_USER_UID";?>",
                plugin: "SpiderEcommerceGTM4DL",
                ecommerce: {
                    currency: "BDT",
                    value: <?php echo $_SESSION['cart_price'];?>,
                    affiliation: "<?php echo "$fr_cname"; ?>",
                    coupon: "N/A",
                    items: [

                        <?php
                        $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Token", "ALL");
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
                                $pro_catt1_name_bn = "NA";
                                $pro_catt2_name_bn = "NA";
                                $pro_catt3_name_bn = "NA";
                                $pro_catt4_name_bn = "NA";

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
                    price: $fr_t_price,
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
                    quantity: $fr_qty
                  }$FRc_Coma
                   ";

                                $FRc_SL = ($FRc_SL + 1);
                            }
                        }
                        ?>

                    ]
                }
            });
        });
    </script>
<?php } ?>



<?php require_once("frd-public/theme/frd-footer.php");?>


<!-- THIS SCRIPT MUST HAVE  UNDER FOOTER -->
<script>
    setTimeout(function () {
        FRfun_CartHeid();
    }, 27000);
</script>
<?php ob_end_flush();  ?>