<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Edit Product"; //PAGE TITLE
$p = "$FR_RP"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Update Product </h2> -->
<style>
    img.proEditPrivImg {
        width: auto;
        height: 100px;
    }

    /* */
    .rcsp_1 a {
        font-size: 18px;
        color: deeppink;
    }

    .rcsp_2 a {
        font-size: 16px;
        color: forestgreen;
    }

    .rcsp_3 a {
        font-size: 12px;
        color: red;
    }

    .rcsp_4 a {
        font-size: 10px;
        color: orange;
    }
</style>

<!-- 1 FUNCTIONS START -->
<div class="section">
    <?php
    /////////////////////////////////////////////////////
    //////// FUNCTION SELECTED CAT SESSION UNSET ////////
    /////////////////////////////////////////////////////
    function unset_selected_cat_ses()
    {
        unset($_SESSION['father_catid']);
        unset($_SESSION['father_catname']);

        unset($_SESSION['son_catid']);
        unset($_SESSION['son_catname']);

        unset($_SESSION['grandson_catid']);
        unset($_SESSION['grandson_catname']);

        unset($_SESSION['grandsonchild_catid']);
        unset($_SESSION['grandsonchild_catname']);
    }
    ?>
</div>
<!-- 1 FUNCTIONS END -->


<!-- 1script s-->
<section>
    <?php
    //FRD UPDATE PRODUCT DETAILES:-
    //FRD VARIATION PRODUCT PARTICULER INFORMATION UPDATE:-
    //FRD COLOR VARIATION PRODUCT MAKING:-
    //FRD SIZE VARIATION PRODUCT MAKING:-
    //FRD COLOR AND SIZE VARIATION PRODUCT ADDING:-
    //FRD IMAGE STOR TYPE CONFIGER:-

    //FRD PRODUCT PRIORITY UPDATE:-
    //FRD FEATURE PRODUCT DESIDER:-
    //FRD PRODUCT LANDING PAGE STYLE UPDATE:-
    //FRD PRODUCT STATUS UPDATE:-

    //FRD DELETE PRODUCT PARMANENTLY || DELETE PRODUCT VARIATION:-


    $FR_NOW_YEARMONTH = date('m');
    //FRD_VC____ 1:-
    if (!isset($FRurl[1])) {
        header("location:$FR_THISHURL/dashboard/?FRH=PRODUCT ID NEED");
        exit;
    }

    $FRc_EditProductIdx = $FRurl[1];
    $FR_THIS_PAGE = "$FR_THIS_PAGE/$FRc_EditProductIdx";


    ///////////////////////////////////////////////////
    // Product Table data fetching:-
    ///////////////////////////////////////////////////
    $FRQ = $FR_CONN->prepare("SELECT * from frd_products where id = :id AND pro_typ = 1");
    $FRQ->bindParam(':id', $FRc_EditProductIdx, PDO::PARAM_INT);
    $FRQ->execute();
    $Rows = $FRQ->rowCount();
    extract($FRQ->fetch());
    //FRD_VC_______________________________________
    if ($Rows == 0) {
        header("location:$FR_THISHURL/ProductList/?FRH=PRODUCT ID NOT VALID");
        exit;
    }

 
     $FRc_ProductName = $bn_name;

    ///***      
    $FRc_ProLongDescription = preg_replace("/<br \/>/", "\n", $detailess); //
    $FRc_ProLongDescription = preg_replace("/<br>/", "\n", $FRc_ProLongDescription); //
    //**
    $market_exp = explode('.', $market_pri);
    $market_exp_0 = $market_exp[0];

    $discount_pri_exp = explode('.', $discount_pri);
    $discount_pri_exp_0 = $discount_pri_exp[0];


    if ($statuss == 1) { $statuss_M = "Published"; }
    if ($statuss == 2) { $statuss_M = "Unlisted"; }
    if ($statuss == 3) { $statuss_M = "Private"; }
    if ($statuss == 4) { $statuss_M = "Trashed"; }


    if($vry_typ==1){$vry_typ_mody="General";}
    if($vry_typ==2){$vry_typ_mody="Color Variation";}
    if($vry_typ==3){$vry_typ_mody="Size Variation";}

    $FRc_BrandId = $r_brand;
    extract(FRF_BRAND_NAME($FRc_BrandId));

    $FRc_ColorId = $r_color;
    extract(FRF_COLOR_NAME($FRc_ColorId));

    extract(FRF_NAME_SUPPLIER($r_supplier));

    //FRD WRITER TABLE  READ :-
        $FRR = FR_QSEL("SELECT * FROM frd_writers WHERE id = $r_writer", "");
        if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
            $FRc_WriterId = $r_writer;
            $FRc_WriterName = $fr_writer_name;
        } else {
            //  ECHO_4($FRR['FRM']); 
            $FRc_WriterId = 0;
            $FRc_WriterName = "NA";
        }
    //END>> 


    if ($deli_crg_typ == 1) {
        $deli_crg_typ_M = "From Shipping Zone";
    } elseif ($deli_crg_typ == 2) {
        $deli_crg_typ_M = "Delivery Charge Free";
    }


    ///***product relational catt name/ rcat path fetcher s  
    $pro_catt1_modyfecho = "Uncategorized";
    $pro_catt2_modyfecho = "";
    $pro_catt3_modyfecho = "";
    $pro_catt4_modyfecho = "";
    if ($r_cat_1 > 0) {
        $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $r_cat_1");
        $row_cat1_name = $FRQ->fetch();
        $pro_catt1_name = $row_cat1_name['bn_name'];
        $pro_catt1_slug = $row_cat1_name['slugg'];
        $pro_catt1_path = "$FRD_HURL/category/$pro_catt1_slug";
        $pro_catt1_modyfecho = "<a href='$pro_catt1_path' target='_blank'>$pro_catt1_name</a>";

        if ($r_cat_2 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $r_cat_2");
            $row_cat2_name = $FRQ->fetch();
            $pro_catt2_name = $row_cat2_name['bn_name'];
            $pro_catt2_slug = $row_cat2_name['slugg'];
            $pro_catt2_path = "$FRD_HURL/category/$pro_catt2_slug";
            $pro_catt2_modyfecho = "<a href='$pro_catt2_path' target='_blank'> / $pro_catt2_name</a>";
        }
        if ($r_cat_3 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $r_cat_3");
            $row_cat3_name = $FRQ->fetch();
            $pro_catt3_name = $row_cat3_name['bn_name'];
            $pro_catt3_slug = $row_cat3_name['slugg'];
            $pro_catt3_path = "$FRD_HURL/category/$pro_catt3_slug";
            $pro_catt3_modyfecho = "<a href='$pro_catt3_path' target='_blank'> / $pro_catt3_name</a>";
        }
        if ($r_cat_4 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $r_cat_4");
            $row_cat4_name = $FRQ->fetch();
            $pro_catt4_name = $row_cat4_name['bn_name'];
            $pro_catt4_slug = $row_cat4_name['slugg'];
            $pro_catt4_path = "$FRD_HURL/category/$pro_catt4_slug";
            $pro_catt4_modyfecho = "<a href='$pro_catt4_path' target='_blank'> / $pro_catt4_name</a>";
        }
    }
    ///product relational catt name/ rcat path fetcher e



    ///***product multi catt name fetcher s      
    if ($m_cat_1 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $m_cat_1");
        $row_mulicat1_name = $FRQ->fetch();
        $pro_multicatt1_name = $row_mulicat1_name['en_name'];
    } else {
        $pro_multicatt1_name = "N/A";
    }

    if ($m_cat_2 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $m_cat_2");
        $row_mulicat2_name = $FRQ->fetch();
        $pro_multicatt2_name = " <b class='r'>&</b> " . $row_mulicat2_name['en_name'];
    } else {
        $pro_multicatt2_name = "";
    }

    if ($m_cat_3 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $m_cat_3");
        $row_mulicat3_name = $FRQ->fetch();
        $pro_multicatt3_name = " <b class='r'>&</b> " . $row_mulicat3_name['en_name'];
    } else {
        $pro_multicatt3_name = "";
    }

    if ($m_cat_4 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $m_cat_4");
        $row_mulicat4_name = $FRQ->fetch();
        $pro_multicatt4_name = " <b class='r'>&</b> " . $row_mulicat4_name['en_name'];
    } else {
        $pro_multicatt4_name = "";
    }
 





    ///////////////////////////////////////////////////////////////
    //FRD UPDATE PRODUCT DETAILES:-
    ///////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_update_pro_details_info'])) {
        // PR($_POST); exit;

        $f_buy_price = $buy_pri;

        if (isset($_POST['f_buy_price'])) {
            $f_buy_price = $_POST['f_buy_price'];
        }
        $bn_title = $_POST['bn_title'];
        $market_price = $_POST['market_price'];
        $discount_amount = $_POST['discount_amount'];
        $cus_discount_persent = ($discount_amount / $market_price * 100);
        $sellls_price = ($market_price - $discount_amount);


        if ($f_buy_price < 0) {
            $f_buy_price = 0;
        }
        if ($sellls_price < 0) {
            FR_SWAL("Sells Amount Not Valid", "", "error");
            FR_GO("$FR_THIS_PAGE", 2);
            exit;
        }

        $descriptionn = $_POST['descriptionn'];
        $f_offermode = $_POST['f_offermode'];
        $f_falsh_sales_mode = $_POST['f_falsh_sales_mode'];
        $f_yt_video_id = $_POST['f_yt_video_id'];
        $f_delivery_charge_type = $_POST['f_delivery_charge_type'];
        $f_supplier_id = $_POST['f_supplier_id'];
        $f_writers_id = $_POST['f_writers_id'];
        $f_meta_title = $_POST['f_meta_title'];
        $f_meta_desc = $_POST['f_meta_desc'];
        $f_tagg = $_POST['tagg'];
        $f_slug = $_POST['f_slug'];
        $f_short_desc = $_POST['f_short_desc'];
        $f_g_cat_id = $_POST['f_g_cat_id'];
        $f_pro_sku = $_POST['f_pro_sku'];
        $f_pro_color_id = $_POST['f_pro_color'];

        $f_stock_type = $_POST['f_stock_type'];
        $f_stock_unit = $_POST['f_stock_unit'];
        $f_p_note = $_POST['fr_p_note'];

        $f_pro_qty = $_POST['f_pro_qty'];
        if ($f_stock_type == 0) {
            $f_pro_qty = 99999;
        }

        //PRODUCT TDR:-
        $FRQ = $FR_CONN->prepare("SELECT * from frd_products where id = :id");
        $FRQ->bindParam(':id', $FRc_EditProductIdx, PDO::PARAM_INT);
        $FRQ->execute();
        extract($FRQ->fetch());


        //MULTI CATEGORIES
        if (isset($_POST['f_multi_catts'])) {
            $f_multi_catts = $_POST['f_multi_catts'];
            $f_multi_catts_exploed = explode('/', $f_multi_catts);
            $f_multi_catt_1 = $f_multi_catts_exploed[0];
            $f_multi_catt_2 = $f_multi_catts_exploed[1];
            $f_multi_catt_3 = $f_multi_catts_exploed[2];
            $f_multi_catt_4 = $f_multi_catts_exploed[3];
        } else {
            $f_multi_catt_1 = $m_cat_1;
            $f_multi_catt_2 = $m_cat_2;
            $f_multi_catt_3 = $m_cat_3;
            $f_multi_catt_4 = $m_cat_4;
        }
        //BRAND
        if (isset($_POST['f_brand'])) {
            $f_brand = $_POST['f_brand'];
        } else {
            $f_brand = $r_brand;
        }

        settype($bn_title, "string");

        $FRc_Slug = preg_replace("/ /", "-", $f_slug);
        $FRc_Slug = preg_replace("/%/", "percent", $FRc_Slug);
        $FRc_Slug = strtolower("$FRc_Slug");
        $FRc_Slug = preg_replace("/'/", "", $FRc_Slug);


        //FRD DATA UPDATE S:-
        try {
            $FRQ = "UPDATE frd_products SET 
                buy_pri = :buy_pri,
                market_pri = :market_pri,
                discount_pri = :discount_pri,
                dis_persent = :dis_persent,
                sells_pri = :sells_pri,

                fr_stock_typ = :fr_stock_typ,
                fr_stock_unit = :fr_stock_unit,
                qtyy = :qtyy,

                skuu = :skuu,
                r_color = :r_color,
                bn_name = :bn_name,
                fr_short_desc = :fr_short_desc,
                detailess = :detailess,
                fr_meta_title = :fr_meta_title,
                fr_meta_desc = :fr_meta_desc,
                fr_slug = :fr_slug,
                tagg = :tagg,
                ofer_status = :ofer_status,
                fr_flash_sale = :fr_flash_sale,
                videoo = :videoo,
                g_cat_id = :g_cat_id,
                r_cat_1 = :r_cat_1,
                r_cat_2 = :r_cat_2,
                r_cat_3 = :r_cat_3,
                r_cat_4 = :r_cat_4,
                m_cat_1 = :m_cat_1,
                m_cat_2 = :m_cat_2,
                m_cat_3 = :m_cat_3,
                m_cat_4 = :m_cat_4,
                r_brand = :r_brand,
                r_writer = :r_writer,
                r_supplier = :r_supplier,
                deli_crg_typ = :deli_crg_typ,
                fr_p_note = :fr_p_note
                WHERE id = $FRc_EditProductIdx";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':buy_pri', $f_buy_price, PDO::PARAM_STR);
                $FRQ->bindParam(':market_pri', $market_price, PDO::PARAM_STR);
                $FRQ->bindParam(':discount_pri', $discount_amount, PDO::PARAM_STR);
                $FRQ->bindParam(':dis_persent', $cus_discount_persent, PDO::PARAM_STR);
                $FRQ->bindParam(':sells_pri', $sellls_price, PDO::PARAM_STR);

                $FRQ->bindParam(':fr_stock_typ', $f_stock_type, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_stock_unit', $f_stock_unit, PDO::PARAM_STR);
                $FRQ->bindParam(':qtyy', $f_pro_qty, PDO::PARAM_INT);

                $FRQ->bindParam(':skuu', $f_pro_sku, PDO::PARAM_STR);
                $FRQ->bindParam(':r_color', $f_pro_color_id, PDO::PARAM_INT);
                $FRQ->bindParam(':bn_name', $bn_title, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_short_desc', $f_short_desc, PDO::PARAM_STR);
                $FRQ->bindParam(':detailess', $descriptionn, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_meta_title', $f_meta_title, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_meta_desc', $f_meta_desc, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_slug', $FRc_Slug, PDO::PARAM_STR);
                $FRQ->bindParam(':tagg', $f_tagg, PDO::PARAM_STR);
                $FRQ->bindParam(':ofer_status', $f_offermode, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_flash_sale', $f_falsh_sales_mode, PDO::PARAM_INT);
                $FRQ->bindParam(':videoo', $f_yt_video_id, PDO::PARAM_STR);
                $FRQ->bindParam(':g_cat_id', $f_g_cat_id, PDO::PARAM_INT);
                $FRQ->bindParam(':r_cat_1', $r_cat_1, PDO::PARAM_INT);
                $FRQ->bindParam(':r_cat_2', $r_cat_2, PDO::PARAM_INT);
                $FRQ->bindParam(':r_cat_3', $r_cat_3, PDO::PARAM_INT);
                $FRQ->bindParam(':r_cat_4', $r_cat_4, PDO::PARAM_INT);
                $FRQ->bindParam(':m_cat_1', $f_multi_catt_1, PDO::PARAM_INT);
                $FRQ->bindParam(':m_cat_2', $f_multi_catt_2, PDO::PARAM_INT);
                $FRQ->bindParam(':m_cat_3', $f_multi_catt_3, PDO::PARAM_INT);
                $FRQ->bindParam(':m_cat_4', $f_multi_catt_4, PDO::PARAM_INT);
                $FRQ->bindParam(':r_brand', $f_brand, PDO::PARAM_INT);
                $FRQ->bindParam(':r_writer', $f_writers_id, PDO::PARAM_INT);
                $FRQ->bindParam(':r_supplier', $f_supplier_id, PDO::PARAM_INT);
                $FRQ->bindParam(':deli_crg_typ', $f_delivery_charge_type, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_p_note', $f_p_note, PDO::PARAM_STR);
                $FRQ->execute();
               // FR_SWAL("Dear Boss $UsrName!"," Update Done","success");

             //FRD VARIATION PRODUCT COMMON DATA UPDATE:-
             if ($vry_typ == 2 || $vry_typ == 3) {
                //PRODUCT TDR:-
                    $FRQ = $FR_CONN->prepare("SELECT * from frd_products where id = :id");
                    $FRQ->bindParam(':id', $FRc_EditProductIdx, PDO::PARAM_INT);
                    $FRQ->execute();
                    extract($FRQ->fetch());

                try {
                    $FRQ = "UPDATE frd_products SET 
                                bn_name = :bn_name,
                                fr_short_desc = :fr_short_desc,
                                detailess = :detailess,
                                fr_meta_title = :fr_meta_title,
                                fr_meta_desc = :fr_meta_desc,
                                fr_slug = :fr_slug,
                                tagg = :tagg,
                                ofer_status = :ofer_status,
                                fr_flash_sale = :fr_flash_sale,
                                videoo = :videoo,
                                g_cat_id = :g_cat_id,
                                r_cat_1 = :r_cat_1,
                                r_cat_2 = :r_cat_2,
                                r_cat_3 = :r_cat_3,
                                r_cat_4 = :r_cat_4,
                                m_cat_1 = :m_cat_1,
                                m_cat_2 = :m_cat_2,
                                m_cat_3 = :m_cat_3,
                                m_cat_4 = :m_cat_4,
                                r_brand = :r_brand,
                                r_writer = :r_writer,
                                r_supplier = :r_supplier,
                                deli_crg_typ = :deli_crg_typ
                                WHERE v_mp_id = $FRc_EditProductIdx";

                    $FRQ = $FR_CONN->prepare("$FRQ");
                    $FRQ->bindParam(':bn_name', $bn_name, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_short_desc', $fr_short_desc, PDO::PARAM_STR);
                    $FRQ->bindParam(':detailess', $detailess, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_meta_title', $fr_meta_title, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_meta_desc', $fr_meta_desc, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_slug', $fr_slug, PDO::PARAM_STR);
                    $FRQ->bindParam(':tagg', $tagg, PDO::PARAM_STR);
                    $FRQ->bindParam(':ofer_status', $ofer_status, PDO::PARAM_INT);
                    $FRQ->bindParam(':fr_flash_sale', $fr_flash_sale, PDO::PARAM_INT);
                    $FRQ->bindParam(':videoo', $videoo, PDO::PARAM_STR);
                    $FRQ->bindParam(':g_cat_id', $g_cat_id, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_cat_1', $r_cat_1, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_cat_2', $r_cat_2, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_cat_3', $r_cat_3, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_cat_4', $r_cat_4, PDO::PARAM_INT);
                    $FRQ->bindParam(':m_cat_1', $m_cat_1, PDO::PARAM_INT);
                    $FRQ->bindParam(':m_cat_2', $m_cat_2, PDO::PARAM_INT);
                    $FRQ->bindParam(':m_cat_3', $m_cat_3, PDO::PARAM_INT);
                    $FRQ->bindParam(':m_cat_4', $m_cat_4, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_brand', $r_brand, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_writer', $r_writer, PDO::PARAM_INT);
                    $FRQ->bindParam(':r_supplier', $r_supplier, PDO::PARAM_INT);
                    $FRQ->bindParam(':deli_crg_typ', $deli_crg_typ, PDO::PARAM_STR);
                    $FRQ->execute();
                    FR_TAL("VP Common Info Update Done", "success");
                } catch (PDOException $e) {
                    FR_TAL("VP Common Info Update Failed", "error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                }
            }
            //END>>

            if ($frsc_fb_feed_xml == 1) {
                FRF_FBProFeedXmlData($FR_PATH_HD);
            }
            FR_SWAL("Dear Boss $UsrName", "Product Details Update Done", "success");

            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        } catch (PDOException $e) {
            FR_SWAL("$UsrName Update Failed", "", "error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
        }
        //END>>

    }
    //END>>



    //FRD PRODUCT STATUS UPDATE:-
    if (isset($_POST['f_pro_status'])) {
        $f_pro_status = $_POST['f_pro_status'];

        $FRQ = "UPDATE frd_products SET 
        statuss = $f_pro_status
        WHERE id = $FRc_EditProductIdx
        ";
        $R = FR_DATA_UP("$FRQ");
        if ($R['FRA'] == 1) {

            if($vry_typ > 1){
                try{
                    $FR_CONN->exec("UPDATE frd_products SET statuss = $f_pro_status WHERE v_mp_id = $FRc_EditProductIdx");
                    FR_SWAL("Dear Boss $UsrName", "Update Done WITH VP", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                }catch(PDOException $e){
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    FR_SWAL("$UsrName", "Update Failed WITH VP", "error");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                }
            }else{
                FR_SWAL("Dear Boss $UsrName", "Update Done", "success");
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            }

            
        } else {
            FR_SWAL("$UsrName", "Update Failed", "error");
        }
    }
    //END>>


    //FRD PRODUCT PRIORITY UPDATE:-
    if (isset($_POST['f_frpro_priority'])) {
        extract($_POST);

        if ($f_frpro_priority == "General") {
            $FRc_frpro_priority = $FRc_EditProductIdx;
        } else {
            $FRc_frpro_priority = (300000 + $f_frpro_priority);
        }

        //FRD DATA UPDATE S:-
        try {
            $FRQ = "UPDATE frd_products SET 
                    frpro_priority = :frpro_priority
                    WHERE id = $FRc_EditProductIdx";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':frpro_priority', $FRc_frpro_priority, PDO::PARAM_INT);
            $FRQ->execute();
            FR_SWAL("Dear Boss $UsrName!", "Priority Update Completed", "success");
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        } catch (PDOException $e) {
            FR_SWAL("Dear Boss $UsrName!", "Update Failed", "error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        }
        //END>>
    }
    //END>>


    //FRD FEATURE PRODUCT DESIDER:-
    if (isset($_POST['frpro_featurepro'])) {
        extract($_POST);
        //FRD DATA UPDATE S:-
        try {
            $FRQ = "UPDATE frd_products SET 
                    frpro_featurepro = :frpro_featurepro
                    WHERE id = $FRc_EditProductIdx";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':frpro_featurepro', $frpro_featurepro, PDO::PARAM_INT);
            $FRQ->execute();
            FR_SWAL("Dear Boss $UsrName!", "Feature Product Update Completed", "success");
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        } catch (PDOException $e) {
            FR_SWAL("Dear Boss $UsrName!", "Feature Product Update Failed", "error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        }
        //END>>
    }
    //END>>


    //FRD PRODUCT LANDING PAGE STYLE UPDATE:-
    if (isset($_POST['fr_p_lps'])) {
        extract($_POST);
        //FRD DATA UPDATE S:-
        try {
            $FRQ = "UPDATE frd_products SET 
                    fr_p_lps = :fr_p_lps
                    WHERE id = $FRc_EditProductIdx OR v_mp_id = $FRc_EditProductIdx";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':fr_p_lps', $fr_p_lps, PDO::PARAM_INT);
            $FRQ->execute();
            FR_SWAL("Dear Boss $UsrName!", "Product Langing Page Update Completed", "success");
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        } catch (PDOException $e) {
            FR_SWAL("Dear Boss $UsrName!", "Product Langing Page Update Failed", "error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            FR_GO("$FR_THIS_PAGE", "1");
            exit;
        }
        //END>>
    }
    //END>>







    //////////////////////////////////////////////////////////////
    //FRD VARIATION PRODUCT PARTICULER INFORMATION UPDATE:-
    /////////////////////////////////////////////////////////////
    if (isset($_POST['DoFrd_VariationProInfoUpdate'])) {

        //FRD PRODUCT TDR:-
        $FRR = FR_QSEL("SELECT * FROM frd_products WHERE id = $FRc_EditProductIdx", "");
        if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
        } else {
            ECHO_4($FRR['FRM']);
        }
        //END>>

        $f_buy_price = $buy_pri;

        if (isset($_POST['f_buy_price'])) {
            $f_buy_price = $_POST['f_buy_price'];
        }
        $f_vp_id = $_POST['f_vp_id'];
        $f_vp_qty = $_POST['f_vp_qty'];
        $f_vp_sku = $_POST['f_vp_sku'];
        $f_vp_market_price = $_POST['f_vp_market_price'];
        $f_vp_discount = $_POST['f_vp_discount'];
        $f_vp_sizename = "NA";
        $f_vp_colorId = $r_color;


        if (isset($_POST['f_vp_sizename'])) {
            $f_vp_sizename = $_POST['f_vp_sizename'];
        }

        if (isset($_POST['f_vp_colorId'])) {
            $f_vp_colorId = $_POST['f_vp_colorId'];
        }

        $cus_discount_persent = number_format(($f_vp_discount / $f_vp_market_price * 100));
        $cus_vp_sellls_price = ($f_vp_market_price - $f_vp_discount);

        //FRD_VC___________________________________________:-
        if ($cus_vp_sellls_price < 0) {
            FR_SWAL("Sells Price Not Valid", "", "warning");
            FR_GO("$FR_THIS_PAGE", 2);
            exit;
        }

        if ($f_buy_price < 0 or $f_buy_price == "") {
            $f_buy_price = 0;
        }

        if ($f_vp_qty < 0) {
            $f_vp_qty = 0;
        }

        $R = FR_DATA_UP("UPDATE frd_products SET
            r_color = '$f_vp_colorId',
            siz_name = '$f_vp_sizename',
            buy_pri = $f_buy_price,
            market_pri = $f_vp_market_price,
            discount_pri = $f_vp_discount,
            dis_persent = $cus_discount_persent,
            sells_pri = $cus_vp_sellls_price,
            qtyy = '$f_vp_qty',
            skuu = '$f_vp_sku'
            WHERE id = $f_vp_id");
        if ($R['FRA'] == 1) {
            FR_SWAL("Dear Boss $UsrName!", "Information Update Done", "success");
        } else {
            FR_SWAL("Dear Boss $UsrName!", "Information Update Failed", "error");
        }


        if (isset($_POST['f_vp_quick_img_add'])) {
            if ($_POST['f_vp_quick_img_add'] == "on") {
                $FRQ = "UPDATE frd_products SET 
                    pic_1='$pic_1',
                    pic_2='$pic_2',
                    pic_3='$pic_3',
                    pic_4='$pic_4'
                    WHERE id = $f_vp_id
                    ";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {
                    FR_TAL("Quick Images Update Done", "success");
                } else {
                    FR_TAL("Quick Images Update Done Failed", "error");
                }
            }
        }


        FR_GO("$FR_THIS_PAGE?#VariationProSec", 1);
        exit;
    }
    //END>>



    /////////////////////////////////////////////////////////////
    //FRD COLOR AND SIZE VARIATION PRODUCT ADDING:-
    /////////////////////////////////////////////////////////////
    if (isset($_POST['DoFrd_VariationProductAdd'])) {

        $FRR = FR_QSEL("SELECT * FROM frd_products WHERE id = $FRc_EditProductIdx", "");
        if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
        } else {
            ECHO_4($FRR['FRM']);
        }

        $FRQ = $FR_CONN->query("SELECT COUNT(id) AS FRc_ProVariCount FROM frd_products WHERE v_mp_id = $FRc_EditProductIdx AND pro_typ = 2");
        extract($FRQ->fetch());

        $FRc_ProTyp = 2; //[2=CLIEND PRODUCT]
        $FRc_v_mp_id = $FRc_EditProductIdx;

        $f_vp_colorId = $r_color;


        if (isset($_POST['f_vp_all_size_name'])) {
            $FRc_SizeNameArr = explode(',', $_POST['f_vp_all_size_name']);

            foreach ($FRc_SizeNameArr as $FR_ITEM) {
                if ($FR_ITEM != "") {

                    if ($FRc_ProVariCount == "0") {
                        try {
                            $FR_CONN->exec("UPDATE frd_products SET siz_name= '$FR_ITEM' WHERE id = $FRc_v_mp_id");
                        } catch (PDOException $e) {
                            echo "ERROR:" . $e->getMessage() . "<br>";
                            FR_GO("$FR_THIS_PAGE", "1");
                            exit;
                        }
                        $FRc_ProVariCount = 1;
                    } else {
                        $ARR = [];
                        $ARR['r_color'] = "$f_vp_colorId";
                        $ARR['siz_name'] = "$FR_ITEM";
                        $ARR['buy_pri'] = "$buy_pri";
                        $ARR['market_pri'] = "$market_pri";
                        $ARR['discount_pri'] = "$discount_pri";
                        $ARR['dis_persent'] = "$dis_persent";
                        $ARR['sells_pri'] = "$sells_pri";
                        $ARR['qtyy'] = "$qtyy";
                        $ARR['skuu'] = "$skuu";
                        $ARR['v_mp_id'] = "$FRc_v_mp_id";
                        $ARR['pro_typ'] = "$FRc_ProTyp";
                        $ARR['vry_typ'] = "$vry_typ";
                        $ARR['statuss'] = "1";
                        $ARR['byy'] = "$UsrId";
                        $ARR['datee'] = "$FR_NOW_DATE";
                        $ARR['timee'] = "$FR_NOW_TIME";

                        $ARR['pic_1'] = "$pic_1";
                        $ARR['pic_2'] = "$pic_2";
                        $ARR['pic_3'] = "$pic_3";
                        $ARR['pic_4'] = "$pic_4";
                        $FRR = FR_DATA_IN_2("frd_products", $ARR);
                        if ($FRR['FRA'] == 1) {
                            $FR_LIID = $FRR['FR_LIID'];
                            FR_TAL("Dear Boss $UsrName Size Variation Product Add Done!", "success");
                        } else {
                            FR_TAL("Dear Boss $UsrName Size Variation Product Add Failed!", "success");
                        }
                    }
                }
            }
        }


        if (isset($_POST['f_vp_total_item_add'])) {
            $FRc_TotalVariProItems = $_POST['f_vp_total_item_add'];

            for ($i = 1; $i <= $FRc_TotalVariProItems; $i++) { //FOR_LOOP_START 
                $ARR = [];
                $ARR['r_color'] = "$f_vp_colorId";
                $ARR['siz_name'] = "";
                $ARR['buy_pri'] = "$buy_pri";
                $ARR['market_pri'] = "$market_pri";
                $ARR['discount_pri'] = "$discount_pri";
                $ARR['dis_persent'] = "$dis_persent";
                $ARR['sells_pri'] = "$sells_pri";
                $ARR['qtyy'] = "$qtyy";
                $ARR['skuu'] = "$skuu";
                $ARR['v_mp_id'] = "$FRc_v_mp_id";
                $ARR['pro_typ'] = "$FRc_ProTyp";
                $ARR['vry_typ'] = "$vry_typ";
                $ARR['statuss'] = "1";
                $ARR['byy'] = "$UsrId";
                $ARR['datee'] = "$FR_NOW_DATE";
                $ARR['timee'] = "$FR_NOW_TIME";
                $FRR = FR_DATA_IN_2("frd_products", $ARR);
                if ($FRR['FRA'] == 1) {
                    $FR_LIID = $FRR['FR_LIID'];
                    FR_TAL("Dear Boss $UsrName Color Variation Product Add Done!", "success");
                } else {
                    FR_TAL("Dear Boss $UsrName Color Variation Product Add Failed!", "success");
                }
            } //FOR_LOOP_END

        }


        echo "
        <script>
        $(document).ready(function() { 
            setTimeout(function() {
                $('#FrProEditForm').attr('action', '?#VariationProSec');
                $('#FrProEditFormSubBtn').click();
            }, 1000);
        });       
        </script>
        ";
    }
    //END>>





    /////////////////////////////////////////////////////////////
    //FRD COLOR VARIATION PRODUCT MAKING:-
    /////////////////////////////////////////////////////////////
    if (isset($_POST['frddo_makethis_colorvariation_pro'])) {
        $cus_vry_typ = 2; //[2=color variation product]
        $R = FR_DATA_UP("UPDATE frd_products SET v_mp_id = $FRc_EditProductIdx, vry_typ = $cus_vry_typ WHERE id = $FRc_EditProductIdx");
        if ($R['FRA'] == 1) {
            FR_SWAL("Dear Boss $UsrName", "Color Variation Product Make Done", "success");
            FR_GO("$FR_THIS_PAGE?#VariationProSec", 1);
            exit;
        } else {
            FR_SWAL("Dear Boss $UsrName", "Color Variation Product Make Failed", "error");
        }
    }
    /////////////////////////////////////////////////////////////
    //FRD SIZE VARIATION PRODUCT MAKING:-
    /////////////////////////////////////////////////////////////
    if (isset($_POST['frddo_makethis_sizevariation_pro'])) {
        $cus_vry_typ = 3;
        $R = FR_DATA_UP("UPDATE frd_products SET v_mp_id = $FRc_EditProductIdx, vry_typ = $cus_vry_typ WHERE id = $FRc_EditProductIdx");
        if ($R['FRA'] == 1) {
            FR_SWAL("Dear Boss $UsrName", "Size Variation Product Make Done", "success");
            FR_GO("$FR_THIS_PAGE?#VariationProSec", 1);
            exit;
        } else {
            FR_SWAL("Dear Boss $UsrName", "Size Variation Product Make Failed", "error");
        }
    }
    //END>>








    ///////////////////////////////////////////////////////////////
    /////////// PRODUCT CATEGORY  UPDATE START
    ///////////////////////////////////////////////////////////////
    if (isset($_POST['DoFRD_ChangeCategory'])) {
        //FRD VALIDATION CHECK NEED:-
        $FR_VC_CatSesion = "";

        $f_main_catt_1 = 0;
        $f_main_catt_2 = 0;
        $f_main_catt_3 = 0;
        $f_main_catt_4 = 0;

        if (isset($_SESSION['father_catid'])) {
            $f_main_catt_1 = $_SESSION['father_catid'];
        }
        if (isset($_SESSION['son_catid'])) {
            $f_main_catt_2 = $_SESSION['son_catid'];
        }
        if (isset($_SESSION['grandson_catid'])) {
            $f_main_catt_3 = $_SESSION['grandson_catid'];
        }
        if (isset($_SESSION['grandsonchild_catid'])) {
            $f_main_catt_4 = $_SESSION['grandsonchild_catid'];
        }



        //FRD_VC_________
        if (isset($_SESSION['father_catid'])) {
            $FR_VC_CatSesion = "VALID";
        }

        //Update data S
        if ($FR_VC_CatSesion == "VALID") {
            $FRQ = "UPDATE frd_products SET 
                 r_cat_1=$f_main_catt_1,
                 r_cat_2=$f_main_catt_2,
                 r_cat_3=$f_main_catt_3,
                 r_cat_4=$f_main_catt_4,
                 statuss = 1
                 WHERE id = $FRc_EditProductIdx OR v_mp_id = $FRc_EditProductIdx
                 ";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {
                FR_SWAL("Product Category Update Done", "", "success");
                unset_selected_cat_ses();
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            } else {
                FR_SWAL("Product Category Update Failed", "", "error");
            }
        }
        //Update data E
    }




    //-------------------------------------------------------------------
    //FRD READ A LITTLE PDF FILE UPLODE:-
    //-------------------------------------------------------------------
    if (!empty($_FILES['f_read_a_little_pdf']['name'])) {
        //PR($_FILES['FRD_IMG']);

        //FRD VC NEED:-
        $FR_VC_FILE_EXTENTION = "";
        $FR_VC_FILE_MAX_SIZE = "";
        $FR_VC_FILE_STORE_DONE = "";


        //FRD UPLODE IMG CONFIG:-
        $FRc_File_MaxSize_KB = 2000;
        $FRc_File_MaxSize_Dis = "2 MB";


        $FRc_File_Name = $_FILES['f_read_a_little_pdf']['name'];
        $FRc_File_Templocalion = $_FILES['f_read_a_little_pdf']['tmp_name'];
        $FRc_File_Size = $_FILES['f_read_a_little_pdf']['size']; //BYTE FORMET
        $FRc_File_Size_kbf = round($FRc_File_Size / 1000); //KB FORMET
        //+
        $FRc_Img_ExtentionExplor = explode('.', $FRc_File_Name);
        $FRc_File_Extention = strtolower(end($FRc_Img_ExtentionExplor));
        //+ 
        $FRc_File_StoreName = "$FR_NOW_TIME" . "_$FRc_EditProductIdx" . "_frd" . ".$FRc_File_Extention";
        $FRc_File_StoreLocation = "$FR_PATH_HD" . "frd-data/pdf/read-a-little/$FRc_File_StoreName";

        //FRD_VC_______________________________________________FILE EXTENTION:-
        if ($FRc_File_Extention == 'pdf') {
            $FR_VC_FILE_EXTENTION = 1;
        } else {
            FR_TAL("You Can Upload Only PDF File For Read A Little ", "error");
        }

        //FRD_VC_______________________________________________FILE SIZE:-
        if ($FRc_File_Size_kbf <= $FRc_File_MaxSize_KB) {
            $FR_VC_FILE_MAX_SIZE = 1;
        } else {
            FR_TAL("Maximum $FRc_File_MaxSize_Dis PDF file you can uplode!", "error");
        }




        //FRD IMAGE STORE START :--
        if ($FR_VC_FILE_EXTENTION == 1 and $FR_VC_FILE_MAX_SIZE == 1) {

            if (move_uploaded_file($FRc_File_Templocalion, $FRc_File_StoreLocation) == 1) {
                $FR_VC_FILE_STORE_DONE = 1;
            } else {
                FR_TAL("Image Store Failed", "error");
            }
        }
        //END>>>


        //FRD IMAGE STORE NAME SAVE IN DB:-
        if ($FR_VC_FILE_STORE_DONE == 1) {
            $FRQ = "UPDATE frd_products SET fr_read_a_little = '$FRc_File_StoreName' WHERE id = $FRc_EditProductIdx";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {
                FR_TAL("Read A Little PDF File Update Done", "success");
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            } else {
                FR_TAL("Read A Little PDF File Update Failed", "error");
            }
        }
        //END>>

    }
    //END>>



    //FRD IMAGE STOR TYPE CONFIGER:-
    if (!isset($_SESSION['FRs_Img_StoreType'])) {
        $_SESSION['FRs_Img_StoreType'] = "create";
    }
    if (isset($_POST['f_Img_StoreType'])) {
        $_SESSION['FRs_Img_StoreType'] = $_POST['f_Img_StoreType'];
    }
    //END>>
    //FRD IMAGE COMPRESS QUALITY CONFIGER:-
    if (!isset($_SESSION['FRs_ImgCompQuality'])) {
        $_SESSION['FRs_ImgCompQuality'] = 50;
    }
    if (isset($_POST['f_Img_Quality'])) {
        $_SESSION['FRs_ImgCompQuality'] = $_POST['f_Img_Quality'];
    }
    //END>>




    ////////////////////////////////////////////////////////////////      
    ///////////// Unset Selected categories ////////////////////////
    ////////////////////////////////////////////////////////////////
    if (isset($_POST['do_unset_selacted_cats_sub'])) {
        unset_selected_cat_ses();
    }
    //++
    //++   
    //////////////////////////////////////////////////////////////    
    ////////////////  All Catt Id And name session start /////////    
    //////////////////////////////////////////////////////////////    
    if (isset($_POST['father_catinfo'])) {
        $father_catinfo = explode('/', $_POST['father_catinfo']);
        $_SESSION['father_catid'] = $father_catinfo[0]; //father_catid_start
        $_SESSION['father_catname'] = $father_catinfo[1]; //father_catname_start
    }
    if (isset($_POST['son_catinfo'])) {
        $son_catinfo = explode('/', $_POST['son_catinfo']);
        $_SESSION['son_catid'] = $son_catinfo[0]; //son_catid_start
        $_SESSION['son_catname'] = $son_catinfo[1]; //son_catname_start
    }
    if (isset($_POST['grandson_catinfo'])) {
        $grandson_catinfo = explode('/', $_POST['grandson_catinfo']);
        $_SESSION['grandson_catid'] = $grandson_catinfo[0]; //grandson_catid_start
        $_SESSION['grandson_catname'] = $grandson_catinfo[1]; //grandson_catname_start
    }
    if (isset($_POST['grandsonchild_catinfo'])) {
        $grandsonchild_catinfo = explode('/', $_POST['grandsonchild_catinfo']);
        //grandsonchild_catid_start    
        $_SESSION['grandsonchild_catid'] = $grandsonchild_catinfo[0];
        //grandsonchild_catname_start
        $_SESSION['grandsonchild_catname'] = $grandsonchild_catinfo[1];
    }







    //------------------------------------------------------------
    //FRD DELETE PRODUCT PARMANENTLY || DELETE PRODUCT VARIATION:-
    //-----------------------------------------------------------
    if (isset($_POST['FRTIGT_DELETE_PRODUCT_VARI'])) {
        extract($_POST);
        //FRD VC NEED:-
        $FR_VC_ADMIN = "";

        //FRD_VC___________:-
        if ($UsrType == "ad") {
            $FR_VC_ADMIN = 1;
        } else {
            FR_SWAL("Only Admin Can Do This!", "", "error");
        }


        if ($FR_VC_ADMIN == 1) {


            // VARIATION PRODUCT DELETE:-
            $FRQ = "DELETE FROM frd_products WHERE id = :id AND pro_typ = 2";
            $FRQ = $FR_CONN->prepare($FRQ);
            $FRQ->bindParam(':id', $FRTIGT_DELETE_PRODUCT_VARI, PDO::PARAM_INT);
            $FRQ->execute();
            $rowCount = $FRQ->rowCount();
            if ($rowCount > 0) {

                //PRODUCT TYPE TAKE BACK TO REQULER PRODUCT START:-
                $FRQ = $FR_CONN->query("SELECT COUNT(id) AS FRc_ProVariCount FROM frd_products WHERE v_mp_id = $FRc_EditProductIdx AND pro_typ = 2");
                extract($FRQ->fetch());
                if ($FRc_ProVariCount == 0) {
                    try {
                        
                        $FRc_v_mp_id = '';
                        $FRc_pro_typ = 1;
                        $FRc_vry_typ = 1;

                        $FRQ = "UPDATE frd_products SET 
                        v_mp_id = :v_mp_id,
                        pro_typ = :pro_typ,
                        vry_typ = :vry_typ
                        WHERE id = $FRc_EditProductIdx";
                        $FRQ = $FR_CONN->prepare("$FRQ");
                        $FRQ->bindParam(':v_mp_id', $FRc_v_mp_id, PDO::PARAM_INT);
                        $FRQ->bindParam(':pro_typ', $FRc_pro_typ, PDO::PARAM_INT);
                        $FRQ->bindParam(':vry_typ', $FRc_vry_typ, PDO::PARAM_INT);
                        $FRQ->execute();

                    } catch (PDOException $e) {
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                }
                //PRODUCT TYPE TAKE BACK TO REQULER PRODUCT END>>


                FR_SWAL("Dear Boss $UsrName", "Deleted", "success");
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            } else {
                FR_SWAL("Dear Boss $UsrName", "Deleted Failed", "error");
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            }
            // END>>

        }
    }
    //END>> 



    ?>
</section>
<!-- 1script e-->




<br>
<!-- FORM-PRODUCT-EDIT -->
<section>
    <div class="container">
        <div class="col-md-11">


            <div class="col-md-4">

                <h6>
                    <b>Product Id: </b> <?php echo "#$FRc_EditProductIdx" ?> <br>
                    <b>Product Title: </b> <?php echo "$bn_name" ?> <br>
                    <b>Product Type: </b><?php echo " $vry_typ_mody"; ?>
                    <span class="btn btn-default btn-xs FrTrig_ProTypeChanger frd_dn"> <i class="glyphicon glyphicon-edit"></i> </span><br>

                    <b>Brand: </b><?php echo "$FRc_BRAND_NAME"; ?></span><br>
                    <b>Status: </b><?php echo " $statuss_M"; ?><br>

                    <b>Multi Categories: </b><?php echo " $pro_multicatt1_name $pro_multicatt2_name $pro_multicatt3_name $pro_multicatt4_name"; ?><br>
                </h6>

                <?php
                echo "
                    <a href='$FRD_HURL/product/$FRc_EditProductIdx/$fr_slug' target='_blank' class='table-link'>
                        <span class='btn btn-sm btn-success btn-block'> 
                            Visit Product Landing Page <i class='glyphicon glyphicon-new-window'></i> 
                        </span>
                    </a>
                    ";
                ?>

                <br>
                <form action="" method="post">
                    <select class='form-control' name='f_Img_StoreType' id='' onchange="this.form.submit()" required>
                        <?php
                        if ($_SESSION['FRs_Img_StoreType'] == "create") {
                            echo "<option value='create'>Img Auto Compress On</option>";
                        } elseif ($_SESSION['FRs_Img_StoreType'] == "move") {
                            echo "<option value='move'>Img Auto Compress Off</option>";
                        }

                        echo "<option value='create'>Img Auto Compress On</option>";
                        echo "<option value='move'>Img Auto Compress Off</option>";
                        ?>
                    </select>
                </form>

                <?php if ($_SESSION['FRs_Img_StoreType'] == "create") { ?>
                <form action="" method="post">
                    <select class='form-control' name='f_Img_Quality' id='' onchange="this.form.submit()" required>
                        <?php
                        echo "<option value='".$_SESSION['FRs_ImgCompQuality']."'> Compress Image Quality ".$_SESSION['FRs_ImgCompQuality']."%</option>";
                        echo "<option value='50'> Compress Image Quality 50%</option>";
                        echo "<option value='60'> Compress Image Quality 60%</option>";
                        echo "<option value='70'> Compress Image Quality 70%</option>";
                        echo "<option value='80'> Compress Image Quality 80%</option>";
                        echo "<option value='90'> Compress Image Quality 90%</option>";
                        ?>
                    </select>
                </form>
                <?php } ?>


                <form action="" method="post">
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <select class='form-control' id="f_pro_status" name='f_pro_status' onchange="this.form.submit()">
                                <option value="<?php echo "$statuss"; ?>"><?php echo "$statuss_M"; ?></option>
                                <option value='1'>Published</option>
                                <option value='2'>Unlisted</option>
                                <option value='3'>Private</option>
                            </select>
                        </div>
                    </div>
                </form>


                <form action="" method="post">
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <select class='form-control' name='f_frpro_priority' onchange="this.form.submit()">
                                <?php
                                $FRc_PriorityActiveOptionVal = "General";
                                if ($frpro_priority > 300000) {
                                    $FRc_PriorityActiveOptionVal = ($frpro_priority - 300000);
                                }
                                ?>
                                <option value="<?php echo "$FRc_PriorityActiveOptionVal"; ?>"><?php echo "Display Priority $FRc_PriorityActiveOptionVal";; ?></option>
                                <option value='General'>Display Priority General</option>
                                <option value='1'>Display Priority 1</option>
                                <option value='2'>Display Priority 2</option>
                                <option value='3'>Display Priority 3</option>
                                <option value='4'>Display Priority 4</option>
                                <option value='5'>Display Priority 5</option>
                                <option value='6'>Display Priority 6</option>
                                <option value='7'>Display Priority 7</option>
                                <option value='8'>Display Priority 8</option>
                                <option value='9'>Display Priority 9</option>
                                <option value='10'>Display Priority 10</option>
                            </select>
                        </div>
                    </div>
                </form>

                <form action="" method="post">
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <select class='form-control' id="frpro_featurepro" name='frpro_featurepro' onchange="this.form.submit()">
                                <?php
                                if ($frpro_featurepro == 1) {
                                    echo "<option value='1'>Feature Product => Yes </option>";
                                } else {
                                    echo "<option value='0'>Feature Product => No </option>";
                                }
                                ?>
                                <option value='1'>Main Product => Yes </option>
                                <option value='0'>Main Product => No </option>
                            </select>
                        </div>
                    </div>
                </form>


                <form action="" method="post">
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <select class='form-control' id="fr_p_lps" name='fr_p_lps' onchange="this.form.submit()">
                                <?php
                                echo "<option value='$fr_p_lps'>Landing Page Style => $fr_p_lps </option>";
                         
                            
                                ?>
                                <option value='1'>Landing Page Style => 1 </option>
                                <option value='2'>Landing Page Style => 2 </option>
                                <option value='3'>Landing Page Style => 3 </option>
                                <option value='4'>Landing Page Style => 4 </option>
                            </select>
                        </div>
                    </div>
                </form>


                <br>
                <div class='text-center jumbotron'>
                    <?php
                    echo "
                    <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                        <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='#' class='FrTrig_ImgEditIcon frdimg-$FRc_EditProductIdx-1' style='width:200px;height:200px;margin:auto;'>
                        <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                        <input type='hidden' name='f_pro_id' value='$FRc_EditProductIdx'>
                        <input type='hidden' name='f_img_num' value='1'>
                    </form>
                    ";
                    ?>
                </div>

                <div class="text-center jumbotron">
                    <?php
                    echo "
                        <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                            <img src='$FRD_HURL/frd-data/img/product/$pic_2' alt='#' class='FrTrig_ImgEditIcon frdimg-$FRc_EditProductIdx-2' style='width:200px;height:200px;margin:auto;'>
                            <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                            <input type='hidden' name='f_pro_id' value='$FRc_EditProductIdx'>
                            <input type='hidden' name='f_img_num' value='2'>
                        </form>
                        ";
                    ?>
                </div>

                <div class="text-center jumbotron">
                    <?php
                    echo "
                        <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                            <img src='$FRD_HURL/frd-data/img/product/$pic_3' alt='#' class='FrTrig_ImgEditIcon frdimg-$FRc_EditProductIdx-3' style='width:200px;height:200px;margin:auto;'>
                            <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                            <input type='hidden' name='f_pro_id' value='$FRc_EditProductIdx'>
                            <input type='hidden' name='f_img_num' value='3'>
                        </form>
                        ";
                    ?>
                </div>

                <div class="text-center jumbotron">
                    <?php
                    echo "
                        <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                            <img src='$FRD_HURL/frd-data/img/product/$pic_4' alt='#' class='FrTrig_ImgEditIcon frdimg-$FRc_EditProductIdx-4' style='width:200px;height:200px;margin:auto;'>
                            <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                            <input type='hidden' name='f_pro_id' value='$FRc_EditProductIdx'>
                            <input type='hidden' name='f_img_num' value='4'>
                        </form>
                        ";
                    ?>
                </div>

            </div>


            <div class="col-md-8">
                <div class="row">

                    <small>
                        <b>Main Categories: </b><?php echo " <span class='rcsp_1'> $pro_catt1_modyfecho </span> <span class='rcsp_2'> $pro_catt2_modyfecho </span> <span class='rcsp_3'> $pro_catt3_modyfecho </span> <span class='rcsp_4'> $pro_catt4_modyfecho </span> "; ?>
                    </small>
                    <!-- FRD PRODUCT CATEGORY CHANGER START  -->
                    <div class="row">
                        <div class="col-md-9">
                            <?php
                            if (isset($_SESSION['father_catid'])) {
                                echo "<span class='scs_1'>" . $_SESSION['father_catname'] . " => </span>";
                            }
                            if (isset($_SESSION['son_catid'])) {
                                echo "<span class='scs_2'>" . $_SESSION['son_catname'] . " => </span>";
                            }
                            if (isset($_SESSION['grandson_catid'])) {
                                echo "<span class='scs_3'>" . $_SESSION['grandson_catname'] . " => </span>";
                            }
                            if (isset($_SESSION['grandsonchild_catid'])) {
                                echo "<span class='scs_4'>" . $_SESSION['grandsonchild_catname'] . "</span>";
                            }
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?php
                            ////////unset selected catts btn ////////     
                            if (isset($_SESSION['father_catid'])) {
                                echo "
                                <form action='' method='post'>
                                <input class='btn btn-success btn-xs btn-block' type='submit' name='do_unset_selacted_cats_sub' value='Reset'>
                                </form>
                            ";
                            }
                            ?>
                        </div>

                        <div class="col-md-12">
                            <?php if (!isset($_SESSION['father_catid'])) { ?>
                                <form action="" method="post">
                                    <select name="father_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                        <option value="">Update Product Category</option>
                                        <?php
                                        $q_frd = "SELECT * from frd_categoriess WHERE cat_type = 1 AND statuss = 1";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/catt_t_frd.php");
                                            echo "
                                              <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                                            ";
                                        } //For Loop E  
                                        echo "<option value='0/Uncategorized' title='Uncategorized'> Uncategorized </option>";
                                        ?>
                                    </select>
                                </form>
                            <?php } ?>
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <?php if (!isset($_SESSION['son_catid']) and isset($_SESSION['father_catid'])) { ?>
                                <form action="" method="post">
                                    <select name="son_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                        <option value="">Select son category</option>
                                        <?php
                                        $q_frd = "SELECT * FROM frd_categoriess WHERE statuss = 1 AND cat_type=2 AND cat_father=" . $_SESSION['father_catid'] . "";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/catt_t_frd.php");
                                            echo "
                                            <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                                            ";
                                        } //For Loop E


                                        echo "<option value='0/No son category' title='No son category'>Go Next >></option>";

                                        ?>

                                    </select>
                                </form>
                            <?php } ?>
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <?php if (!isset($_SESSION['grandson_catid']) and isset($_SESSION['son_catid'])) { ?>
                                <form action="" method="post">
                                    <select name="grandson_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                        <option value="">Select grandson category</option>
                                        <?php
                                        $q_frd = "SELECT * FROM frd_categoriess WHERE cat_type = 3 AND statuss = 1 AND cat_father=" . $_SESSION['son_catid'] . "";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/catt_t_frd.php");
                                            echo "
                                <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                                ";
                                        } //For Loop E  
                                        ?>
                                        <option value="0/No grandson category" title="No grandson category">Go Next >> </option>
                                    </select>
                                </form>
                            <?php } ?>
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <!-- ++ -->
                            <?php if (!isset($_SESSION['grandsonchild_catid']) and isset($_SESSION['grandson_catid'])) { ?>
                                <form action="" method="post">
                                    <select name="grandsonchild_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                        <option value="">Select grandson child category</option>
                                        <?php
                                        $q_frd = "SELECT * FROM frd_categoriess WHERE statuss = 1 AND cat_type = 4 and cat_father=" . $_SESSION['grandson_catid'] . "";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/catt_t_frd.php");
                                            echo "
                                <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                                ";
                                        } //For Loop E  
                                        ?>
                                        <option value="0/No grandson child" title="No grandson child category">Go Next >> </option>
                                    </select>
                                </form>
                            <?php } ?>
                        </div>


                        <div class="col-md-12">
                            <?php
                            if (isset($_SESSION['father_catid'])) {
                                echo "
                                <form action='' method='post'>
                                    <br><button class='btn btn-success btn-block btn-xs' type='submit' name='DoFRD_ChangeCategory'><span class='glyphicon glyphicon-save'></span> Confirm & Update Category</button>
                                </form>
                                ";
                            }
                            ?>
                        </div>

                    </div>


                    <br>
                    <form id="FrProEditForm" class="f_ProDetailsUpdate" action="" method="post" enctype="multipart/form-data">
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Product General Information</h3>

                            <span>Product Title *</span>
                            <input class="form-control" type="text" name="bn_title" value="<?php echo "$bn_name" ?>" required>


                            <br>
                            <div class="row">
                                <div class="col-md-12 alert alert-success">

                                    <?php if ($UsrType == "ad" || $UsrType == "M") { ?>
                                        <div class="col-xs-12 mb-5">
                                            <span> Buy Price (Optional)</span>
                                            <input class='form-control' type="number" step=".02" name="f_buy_price" id="f_buy_price" placeholder="Input Buy Price" value="<?php echo "$buy_pri";?>">
                                        </div>
                                    <?php } ?>

                                    <div class="col-md-4">
                                        <span>Product Market Price *</span>
                                        <input class="form-control" type="number" name="market_price" id="market_price" placeholder="Market Price" value="<?php echo "$market_pri";?>" step=".02" required>
                                    </div>
                                    <div class="col-md-4">
                                        <span>Discount Amount *</span>
                                        <input class="form-control" type="number" name="discount_amount" id="discount_amount" placeholder="Discount Amount" value="<?php echo "$discount_pri";?>" step=".02" required>
                                    </div>
                                    <div class="col-md-4">
                                        <span>Product Sales Price</span>
                                        <input title="Not Need Input Anything! It Will be automatic" class="c_na form-control" type="number" id="sellls_price" name="sellls_price" placeholder="(Market Price-Discount)" value="<?php echo "$sells_pri"; ?>" disabled>
                                    </div>

                                </div>
                            </div>


                            <span>Product SKU</span>
                            <input class="form-control" type="text" name="f_pro_sku" value="<?php echo "$skuu" ?>">

                            <br>
                            <span>Product Langing Page Link</span>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon xs_disp_none"><?php echo "$FRD_HURL/product/$FRc_EditProductIdx/"; ?></div>
                                    <input type="text" class="form-control" name="f_slug" placeholder="Input Slug" value="<?php echo "$fr_slug" ?>" required>
                                </div>
                            </div>
                        </div>


                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Product Stock Management </h3>
                            <div class="row">
                                <div class="col-xs-12">
                                    <small>Product Stock Type *</small><br>
                                    <input type="radio" name="f_stock_type" value="1" <?php if ($fr_stock_typ == 1) {
                                                                                            echo "checked";
                                                                                        } ?> required> Limited Stock &#160; &#160;&#160;
                                    <input type="radio" name="f_stock_type" value="0" <?php if ($fr_stock_typ == 0) {
                                                                                            echo "checked";
                                                                                        } ?> required> Unlimited Stock
                                    <div class="frdiv_current_stock_fild frd_dn">
                                        <br>
                                        <table>
                                            <tr>
                                                <td>
                                                    <small>Current Stock </small>
                                                    <input class='form-control' type='number' name='f_pro_qty' value="<?php echo "$qtyy"; ?>">
                                                </td>
                                                <td>
                                                    <small>Stock Unit </small>
                                                    <select class='form-control' name="f_stock_unit" id="">
                                                        <option value="<?php echo "$fr_stock_unit" ?>"><?php echo "$fr_stock_unit" ?></option>
                                                        <option value="Pcs">Pcs</option>
                                                        <option value="KG">KG</option>
                                                        <option value="25KG Bag">25KG Bag</option>
                                                        <option value="Packate">Packate</option>
                                                        <option value="Liter">Liter</option>
                                                        <option value="Bags">Bags</option>
                                                        <option value="Dozen">Dozen</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Ton">Ton</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div>


                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Product Video</h3>
                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <span>Youtube Video ID</span><br>
                                    <input class="form-control" type="text" name="f_yt_video_id" value="<?php echo "$videoo" ?>">
                                </div>
                            </div>
                        </div>


                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Product Long Description </h3>
                            <textarea class="form-control" name="descriptionn" id="summernote" style="height:400px;" placeholder="Product description *"><?php echo "$FRc_ProLongDescription" ?></textarea>
                        </div>


                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Product Short Description </h3>
                            <textarea class="form-control" name="f_short_desc" placeholder="Product Short Description" rows="4"><?php echo "$fr_short_desc" ?></textarea>
                        </div>



                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Others Fields <small>Optional</small></h3>

                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <span>Product Color</span>
                                    <select name="f_pro_color" id="" class="chosen form-control">
                                        <option value="<?php echo "$FRc_ColorId" ?>"><?php echo "$FRc_COLOR_NAME" ?></option>
                                        <?php
                                        $q_frd = "SELECT * FROM frd_colorr";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/color_t_frd.php");
                                            echo "
                                            <option value='$Color_ID'>$color_en_name</option>
                                                ";
                                        } //For Loop E  
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Product Brand </span> <br>
                                    <?php
                                    $FRR = FR_QSEL("SELECT * FROM frd_brandss WHERE statuss = 1 ORDER BY id DESC", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        echo "<select class='form-control chosen' name='f_brand' id=''>";
                                        echo "<option value='$FRc_BrandId'>$FRc_BRAND_NAME</option>";
                                        $FRc_SL = 1;
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);
                                            echo "<option value='$id'>$bn_name</option>";
                                            $FRc_SL = ($FRc_SL + 1);
                                        }
                                        echo "</select>";
                                    } else {
                                        echo "<div class='text-center alert alert-danger'>No Brand Data Found</div>";
                                    }
                                    ?>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Delivery Charge Type </span> <br>
                                    <select class="form-control" name="f_delivery_charge_type" id="" required>
                                        <option value="<?php echo "$deli_crg_typ"; ?>"><?php echo "$deli_crg_typ_M"; ?></option>
                                        <option value="1">From Shipping Zone</option>
                                        <option value="2">Delivery Charge Free</option>
                                    </select>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Supplier </span> <br>
                                    <select class="form-control chosen" name="f_supplier_id">
                                        <?php echo "<option value='$r_supplier'>$FRc_NAME_SUPPLIER</option>"; ?>
                                        <?php echo FRF_OPTION_SUPPLIERS(); ?>
                                    </select>
                                </div>
                            </div>




                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Offers Mode *</span><br>
                                    <input type="radio" name="f_offermode" value="1" <?php if ($ofer_status == 1) {
                                                                                            echo "checked";
                                                                                        } ?> required> Active &#160; &#160;&#160;
                                    <input type="radio" name="f_offermode" value="0" <?php if ($ofer_status == 0) {
                                                                                            echo "checked";
                                                                                        } ?> required> Deactivate
                                </div>
                                <div class="col-md-6">
                                    <span>Flash Sales Mode *</span><br>
                                    <input type="radio" name="f_falsh_sales_mode" value="1" <?php if ($fr_flash_sale == 1) {
                                                                                                echo "checked";
                                                                                            } ?> required> Active &#160; &#160;&#160;
                                    <input type="radio" name="f_falsh_sales_mode" value="0" <?php if ($fr_flash_sale == 0) {
                                                                                                echo "checked";
                                                                                            } ?> required> Deactivate
                                </div>
                            </div>

        

                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Writer </span> <br>
                                    <?php
                                    $FRR = FR_QSEL("SELECT * FROM frd_writers WHERE fr_writer_stat = 1 AND fr_writer_visi = 1 ORDER BY id DESC", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        echo "<select class='form-control chosen' name='f_writers_id' id=''>";
                                        echo "<option value='$FRc_WriterId'>$FRc_WriterName</option>";
                                        $FRc_SL = 1;
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);
                                            echo "<option value='$id'>$fr_writer_name</option>";
                                            $FRc_SL = ($FRc_SL + 1);
                                        }
                                        echo "</select>";
                                    } else {
                                        //   PR($FRR);
                                        echo "<div class='text-center alert alert-danger'>No Data Found</div>";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <span>Read A Little PDF </span>
                                    <?php
                                    if ($fr_read_a_little != "") {
                                        echo "<span> <a href='$FRD_HURL/frd-data/pdf/read-a-little/$fr_read_a_little' target='_blank'> Open PDF File</a></span>";
                                    }
                                    ?>
                                    <input type="file" class="form-control" name="f_read_a_little_pdf">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <br><span> Multi categories </span>
                                    <input class="form-control" type="text" name="f_multi_catts" value="<?php echo "$m_cat_1/$m_cat_2/$m_cat_3/$m_cat_4" ?>" placeholder="Example 3/6/9">
                                </div>
                            </div>


                        </div>



                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> SEO Fields </h3>



                            <span>Google Product Category Id *</span> <small><br>

                                <a href="https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt" target="_blank"> <span class="glyphicon glyphicon-new-window"></span> Click To Find Your Id </a></small>

                            <input class="form-control" type="number" name="f_g_cat_id" value="<?php echo "$g_cat_id" ?>" required>

                            <br>
                            <span>Meta Title *</span>
                            <input class="form-control" type="text" name="f_meta_title" value="<?php echo "$fr_meta_title" ?>" required>

                            <br>
                            <span> Meta Description * </span>
                            <textarea class="form-control" name="f_meta_desc" id="" cols="30" rows="3" required><?php echo "$fr_meta_desc" ?></textarea>

                            <br>
                            <span> Meta Tag * </span>
                            <textarea class="form-control" name="tagg" id="" cols="30" rows="3" required><?php echo "$tagg" ?></textarea>

                        </div>




                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Extra </h3>
                            <span> Product Note - (For Admim) </span>
                            <textarea class="form-control" name="fr_p_note" id="" cols="30" rows="6" placeholder="Within 600 character"><?php echo "$fr_p_note" ?></textarea>
                        </div>




                        <div class="text-right">
                            <button id="FrProEditFormSubBtn" type="submit" name="dofrd_update_pro_details_info" class="btn btn-success btn-block"><span class="glyphicon glyphicon-save"></span> Confirm & Update Product Information </button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</section>





<section id="VariationProSec">
    <div class="container">
        <div class="col-md-11">

            <!--  VARIATION PRODUCT LIST -->
            <?php if ($vry_typ == 2 || $vry_typ == 3) { ?>
                <br><br>
                <div class="row jumbotron">
                    <div class="col-md-12">
                        <?php
                        if ($vry_typ == 2) {
                            $FRQ = $FR_CONN->query("SELECT * from frd_products where v_mp_id = $v_mp_id and vry_typ = 2");
                        }
                        if ($vry_typ == 3) {
                            $FRQ = $FR_CONN->query("SELECT * from frd_products where v_mp_id = $v_mp_id and vry_typ = 3");
                        }
                        echo "
                     <h4 class=' text-success boldd'>Product Variation:-</h4>
                     <div class='table-responsive'>
                        <table  class='table table-bordered'>
                            <tr class='boldd alert alert-success'>
                                <td>Image1</td>
                                <td>Image2</td>
                                <td>Image3</td>
                                <td>Image4</td>
                                <td>Size Name</td>
                                <td>Color</td>
                                <td class='text-right'>Sells Price</td>
                                <td class='text-center'>SKU</td>
                                <td class='text-center'>Stock</td>
                                <td class='text-right'>Action</td>
                                <td class='text-right'>D</td>
                            </tr> 
                    ";
                        foreach($FRQ->fetchAll() as $FR_ITEM){
                           extract($FR_ITEM);
                           //**
                           $pro_market_explod = explode('.', $market_pri);
                           $pro_market_explod_0 = $pro_market_explod[0];
                           //**
                           $pro_discount_amount_explod = explode('.', $discount_pri);
                           $pro_discount_amount_explod_0 = $pro_discount_amount_explod[0];
                           //**
                           $pro_sells_price_explod = explode('.', $sells_pri);
                           $pro_sells_price_explod_0 = $pro_sells_price_explod[0];

                           extract(FRF_COLOR_NAME($r_color));


                           if ($bn_name == "") {
                               echo "<h6 class='pip_pip_1s r alert alert-danger'>IMPORTANT -> Please Update Product Details</h6>";
                           }

                           echo "
                           <tr>
                               <td class='text-center'>
                                  <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                                       <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='#' class='FrTrig_ImgEditIcon frdimg-$id-1' style='width:50px;height:50px;margin:auto;'>
                                       <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                                       <input type='hidden' name='f_pro_id' value='$id'>
                                       <input type='hidden' name='f_img_num' value='1'>
                                   </form>
                               </td>
                               <td class='text-center'>
                                  <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                                       <img src='$FRD_HURL/frd-data/img/product/$pic_2' alt='#' class='FrTrig_ImgEditIcon frdimg-$id-2' style='width:50px;height:50px;margin:auto;'>
                                       <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                                       <input type='hidden' name='f_pro_id' value='$id'>
                                       <input type='hidden' name='f_img_num' value='2'>
                                   </form>
                               </td>
                               <td class='text-center'>
                                  <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                                       <img src='$FRD_HURL/frd-data/img/product/$pic_3' alt='#' class='FrTrig_ImgEditIcon frdimg-$id-3' style='width:50px;height:50px;margin:auto;'>
                                       <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                                       <input type='hidden' name='f_pro_id' value='$id'>
                                       <input type='hidden' name='f_img_num' value='3'>
                                   </form>
                               </td>
                               <td class='text-center'>
                                  <form class='FormProImgUp pointer' method='POST' enctype='multipart/form-data'>
                                       <img src='$FRD_HURL/frd-data/img/product/$pic_4' alt='#' class='FrTrig_ImgEditIcon frdimg-$id-4' style='width:50px;height:50px;margin:auto;'>
                                       <input type='file' name='FRD_IMG' class='form-control FRD_IMG' style='display:none;'>
                                       <input type='hidden' name='f_pro_id' value='$id'>
                                       <input type='hidden' name='f_img_num' value='4'>
                                   </form>
                               </td>
                               <td>$siz_name</td>
                               <td>$FRc_COLOR_NAME</td>
                               <td class='text-right'>$pro_sells_price_explod_0 ৳</td>
                               <td class='text-center'>$skuu</td>
                               <td class='text-center'>$qtyy</td>
                               <td class='text-right'>
                                <button type='button' class='btn btn-success btn-sm FrTrig_EditVariationPro' id='$id'><i class='glyphicon glyphicon-edit'></i> Edit</button>
                               </td>
                               <td class='text-right'>
                                   <form action='' method='POST'>
                                       <input type='checkbox' required>
                                       <button type='submit' class='btn btn-danger btn-xs' name='FRTIGT_DELETE_PRODUCT_VARI' value='$id'> <span class='glyphicon glyphicon-trash'></span></button>
                                   </form>
                               </td>
                           </tr> 
                           ";
                        }
                        echo "
                        </table> 
                    </div>
                    ";
                        ?>

                        <button id="<?php echo "$FRc_EditProductIdx"; ?>" type="button" class="btn btn-success pull-right btn-sm FrTrig_AddVariationPro"> <i class="glyphicon glyphicon-plus"></i> Add More Variation</button>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>





<?php if(isset($frp_pro_barcode)){ if($frp_pro_barcode == 1){ ?>
<!-- PRODUCT BARCODE PRINT  -->
<section>
 <div class="container">
 <div class="col-md-11">
    
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo "$FRD_HURL/frdsp/dp/pro-ProductBarcodePrint";?>" method="POST" target="_blank">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <input class="form-control" type="number" name="f_barcode_need" placeholder="Enter How Many Barcode Need?">
                            <input type="hidden" name="f_product_id" value="<?php echo "$FRc_EditProductIdx";?>">
                            <input type="hidden" name="f_product_titel" value="<?php echo "$FRc_ProductName";?>">
                            <input type="hidden" name="f_product_writer" value="<?php echo "$FRc_WriterName";?>">
                        </td>
                        <td>
                            <button class="btn btn-success btn-block" type="submit">Barcode Print</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


 </div>
 </div>
</section>
<?php }} ?>





<!-- ALL MODELS  -->
<section>


    <?php if ($vry_typ == 1) { ?>
        <div class="modal fade" id="myModal_G_f_make_change_pro_veri" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                    </div>
                    <div class="modal-body">

                        <form action="" method="post">
                            <input type="checkbox" required> I Am Sure! <br>
                            <button type="submit" class="btn btn-danger btn-block" name="frddo_makethis_colorvariation_pro"> <span class="glyphicon glyphicon-flash"></span> Make It Color Variation Product</button>
                        </form>

                        <br>
                        <hr>
                        <form action="" method="post">
                            <input type="checkbox" required> I Am Sure! <br>
                            <button type="submit" class="btn btn-info btn-block" name="frddo_makethis_sizevariation_pro"> <span class="glyphicon glyphicon-flash"></span> Make It Size Variation Product</button>
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</section>









<script>
    const vry_typp = '<?php echo "$vry_typ"; ?>';

    $(document).ready(function() {

        //FRD PRODCUT IMG UPDATE & REMOVE S:-
        $('.FrTrig_ImgEditIcon').click(function() {
            $(this).parent().find('.FRD_IMG').click();
        });
        $(document).on('change', '.FRD_IMG', function(e) {
            e.preventDefault();

            var form = $(this).closest('form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: FR_HURL_APII + "/ProImgUp",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    let o = JSON.parse(response);
                    if (o.FRA == 1) {
                        $("." + o.FRD_IMGID).attr("src", o.FRD_IMGLINK);
                        toastr.success(o.FRM);
                    } else if (o.FRA == 2) {
                        swal(o.FRM, "", "error");
                    } else {
                        alert(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
        $('.FrTrig_ImgEditIcon').on('contextmenu', function(e) {
            e.preventDefault();

            var f_proId = $(this).siblings('input[name="f_pro_id"]').val();
            var f_imgNum = $(this).siblings('input[name="f_img_num"]').val();

            $.ajax({
                url: FR_HURL_APII + "/ProImgRemove",
                method: "post",
                data: {
                    f_proId: f_proId,
                    f_imgNum: f_imgNum
                },
                success: function(data) {
                    console.log(data);

                    let o = JSON.parse(data);
                    if (o.FRA == 1) {
                        $("." + o.FRD_IMGID).attr("src", o.FRD_IMGLINK);
                        toastr.success(o.FRM);
                    } else if (o.FRA == 2) {
                        swal(o.FRM, "", "error");
                    } else {
                        console.log(data);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }

            });
        });
        //END>>





        if (vry_typp == 1) {
            $('.FrTrig_ProTypeChanger').show();
        }


        var f_stock_typee = $('input[name="f_stock_type"]:checked').val();
        if (f_stock_typee == 1) {
            $('.frdiv_current_stock_fild').show();
        }
        $('input[name=f_stock_type]').change(function() {
            var f_stock_typee = $(this).val();
            if (f_stock_typee == 0) {
                $('.frdiv_current_stock_fild').hide();
            }
            if (f_stock_typee == 1) {
                $('.frdiv_current_stock_fild').show();
            }
        });

    });
</script>



<?php require_once('frd1_footer.php'); ?>



<script type="text/javascript">
    //
    $(document).ready(function() {

        $('.FrTrig_EditVariationPro').click(function() {
            var v_pro_id = $(this).attr("id");
            //alert(pro_id);
            $.ajax({
                url: "<?php echo "$FR_THISHURL/page/frd-p-pro/inc/jq_ajx/ro/frd-variation-product-edit-form.php"; ?>",
                method: "post",
                data: {
                    v_pro_id: v_pro_id
                },
                success: function(data) {
                    $('#frd_spider_modal_data').html(data);
                    $('#frd_spider_modal').modal("show");
                }
            });
        });


        $('.FrTrig_AddVariationPro').click(function() {
            var v_pro_id = $(this).attr("id");
            //alert(pro_id);
            $.ajax({
                url: "<?php echo "$FR_THISHURL/page/frd-p-pro/inc/jq_ajx/ro/frd-variation-product-add-form.php"; ?>",
                method: "post",
                data: {
                    v_pro_id: v_pro_id
                },
                success: function(data) {
                    $('#frd_spider_modal_data').html(data);
                    $('#frd_spider_modal').modal("show");
                }
            });
        });


        $('#market_price,#discount_amount').keyup(function() {
            let market_price = $('#market_price').val();
            let discount_amount = $('#discount_amount').val();
            let sellls_price = (market_price - discount_amount);
            $('#sellls_price').val(sellls_price);

            if (sellls_price < 0) {
                swal('Sells Price Not Valid', '', 'warning');
            }
        });



        $(".FrTrig_ProTypeChanger").on("click", function() {
            $('#myModal_G_f_make_change_pro_veri').modal("show");
        });


    });
</script>