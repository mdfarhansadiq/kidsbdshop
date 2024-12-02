<?php
require_once("frd-this-config.php");
header("Content-Type: text/html");
header("Access-Control-Allow-Origin: $FRD_HURL");


if( isset($_POST['f_product_id'])){
    $FRc_product_id = $_POST['f_product_id'];
    $FRc_product_quantity = $_POST['quantity_' . $FRc_product_id];
    $FR_VC_POST = 1;
}

$FRQ = $FR_CONN->query("SELECT pic_1,bn_name,sells_pri,deli_crg_typ FROM frd_products WHERE id = $FRc_product_id");
extract($FRQ->fetch());

$FRQ = $FR_CONN->query("SELECT frtc_lang,frtc_cf_fildadress_r,FR_Dfild_Note FROM frd_themeconfig WHERE id = 1");
extract($FRQ->fetch());

$FRQ = $FR_CONN->query("SELECT * FROM frd_themelan WHERE frlc_lang = '$frtc_lang'");
extract($FRQ->fetch());
?>

<style>
        /*************************************************************************/
        /* FRD CHECKOUT FORM */
        /*************************************************************************/
        form.popupcheckoutf {
            box-shadow: 0px 0px 10px 0px #016f32;
            padding-top: 40px;
            padding-bottom: 40px;
            padding-left: 15px;
            padding-right: 15px;
            overflow: hidden;
        }

        form.popupcheckoutf {
            background: #ddd;
        }

        form.popupcheckoutf .titlee {
            font-weight: 900;
            font-size: 15px;
        }

        form.popupcheckoutf button {
            border: none;
            font-weight: 900;
            font-size: 1.3em;
            border: none;
            background: #016f32;
            width: 100%;
        }

        form.popupcheckoutf button:hover {
            transform: scale(1.1);
        }
    </style>


             <div class="row">
                <div class="col-md-12">

                    <!-- CHECKOUT-FORM -->
                    <form class="popupcheckoutf" action="" method="post" autocomplete="on">
                        <h4 class="text-center titlee"><span class="glyphicon glyphicon-send"></span> <?php echo "$frlc_give_delivery_info_txt";?> </h4>

                        <small><?php echo "$frlc_full_name_txt";?></small>
                        <input class="form-control" type="text" id="f_customer_name" placeholder="<?php echo "$frlc_full_name_txt";?>" required>

                        <small><?php echo "$frlc_mobile_number_txt";?></small>
                        <input class="form-control" type="text" id="f_customer_mobile" minlength="11" maxlength="17" placeholder="<?php echo "$frlc_mobile_number_txt";?>" required>


                        <small class=""><?php echo "$frlc_delivery_address_txt";?> <?php if ($frtc_cf_fildadress_r == 1) {echo "*";}?></small>
                        <textarea class="form-control" id="f_customer_address" cols="20" rows="2" placeholder="<?php echo "$frlc_delivery_address_txt";?>" <?php if ($frtc_cf_fildadress_r == 1) {echo "required";} ?>></textarea>
                        <input type="hidden" id="f_customer_address_r" value="<?php echo "$frtc_cf_fildadress_r";?>">


                        <?php if ($FR_Dfild_Note == "YES") { ?>
                            <small class=""><?php echo "$frlc_note_txt"; ?> </small>
                            <textarea class="form-control" name="" id="f_delivery_note" cols="20" rows="2" placeholder="<?php echo "$frlc_note_txt"; ?>"></textarea>
                        <?php } ?>


                        <small class="boldd"><?php echo "$frlc_select_delivery_zone_txt";?></small><br>
                        <div class="frf_delizoneSec">
                        <?php
                        if ($deli_crg_typ == 1) {
                            $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE fr_sz_name !='' ORDER BY id ASC", "ALL");
                            if ($FRR['FRA'] == 1) {
                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                    extract($FR_ITEM);
                                    echo "&#160; <input type='radio' name='f_delivery_zone_id' class='f_delivery_zone_id form-check-input' id='dz_radio_btn_$id' value='$id' deliverycharge='$fr_sz_shipcost'> <span class='dz_radio_btn_text' id='$id' role='button' deliverycharge='$fr_sz_shipcost'> $fr_sz_name [$fr_sz_shipcost TK]</span> <br> ";
                                }
                            } else {
                                echo "<div class='text-center alert alert-danger'>No Delivery Zone Found</div>";
                            }
                        }
                        //FRD:--
                        elseif ($deli_crg_typ == 2) {
                            echo "&#160; <input class='form-check-input' type='radio' name='f_delivery_zone_id' id value='0' checked required> $frlc_delivery_charge_free_txt ";
                        }
                        ?>
                        </div>
                        
                        <input type="hidden" class='f_product_id' id="f_product_id" value="<?php echo "$FRc_product_id";?>">
                        <input type="hidden" class="f_CHECKOUT_T_BILLL" id="f_CHECKOUT_T_BILLL" value="<?php echo "$sells_pri";?>">

                    
                        <br>
                        <button class="btn btn-success btn-block frsty_theme_super_btn FrTrig_OrderPlace" type="submit"> <?php echo "$frd_placeorder_btn_txt";?> ৳ <span class="FR_CHECKOUT_T_BILL_DATA" id="FR_CHECKOUT_T_BILL_DATA"><?php echo number_format($sells_pri * $FRc_product_quantity, 2);?></span>  <span class="glyphicon glyphicon-arrow-right alertt"></span></button>
                        <div id="OrderProcessinAlert"></div>
 
                        <br>
                        <div class="text-center">
                           <img class="" src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" alt="#" height="60px" width="auto">
                           <h6><?php echo "$bn_name";?></h6>
                        </div>
                    </form>

                </div>
            </div>

<script src="<?php echo "$FRD_HURL/frd-src/inc/js/frd-LPinstantCheckout.js?v=$FR_SOFT_VERSION"?>"></script>