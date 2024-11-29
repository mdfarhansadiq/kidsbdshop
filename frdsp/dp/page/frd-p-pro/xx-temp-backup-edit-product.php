<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Product";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
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
    //FFFF    
    // PRODUCT SHOART INFO UPDATE START
    // PRODUCT PRICE UPDATE START 
    // FRD PRODUCT IMAGES CHANGE INNI

    //FRD_VC____ PRODUCT PSW:-    


    //FRD_VC____ 1 :-
    if (!isset($FRurl[1])) {
        header("location:$FR_THISHURL/dashboard/?FRH=PRODUCT ID NEED");
        exit;
    }

    $FRc_EditProductIdx = $FRurl[1];
    $FR_THIS_PAGE = "$FR_THIS_PAGE/$FRc_EditProductIdx";


    // PRODUCT DETAILS UPDATE MODE ENABLE
    if (isset($_POST['frddo_enable_editProDetails'])) {
        $_SESSION['s_frd_editProDetails'] = 'frdyes';
    }
    // PRODUCT DETAILS UPDATE MODE Disable
    if (isset($_POST['frddo_stop_editProDetails'])) {
        unset($_SESSION['s_frd_editProDetails']);
    }











    /////////////////////////////////////////////////////////////
    // MAKE THIS COLOR VARIATION PRODUCT 
    /////////////////////////////////////////////////////////////
    if (isset($_POST['frddo_makethis_colorvariation_pro'])) {
        //**
        $cus_vry_typ = 2; //[2=color variation product]

            $R = FR_DATA_UP("UPDATE frd_products SET v_mp_id = $FRc_EditProductIdx, vry_typ = $cus_vry_typ WHERE id = $FRc_EditProductIdx");
            if($R['FRA']==1){
                FR_SWAL("Color Variation Product Make Done","","success");
            }else{
                FR_SWAL("Color Variation Product Make Failed","","success");
            }
    }

    /////////////////////////////////////////////////////////////
    // MAKE THIS COLOR VARIATION PRODUCT
    /////////////////////////////////////////////////////////////
    if (isset($_POST['frddo_makethis_sizevariation_pro'])) {
        //**
        $cus_vry_typ = 3; //[3=size variation product]

            $R = FR_DATA_UP("UPDATE frd_products SET v_mp_id = $FRc_EditProductIdx, vry_typ = $cus_vry_typ WHERE id = $FRc_EditProductIdx");
            if($R['FRA']==1){
                FR_SWAL("Size Variation Product Make Done","","success");
            }else{
                FR_SWAL("Size Variation Product Make Failed","","success");
            }
    }



    /////////////////////////////////////////////////////////////
    ///////////////// COLOR VARIATION PRODUCT ADDING ////////////
    /////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_add_color_vriation_pro'])) {
        $f_vp_color_id = $_POST['f_vp_color_id'];
        $f_vp_market_price = $_POST['f_vp_market_price'];
        $f_vp_discount = $_POST['f_vp_discount'];
        $f_vp_sku = $_POST['f_vp_sku'];
        //##FRD PRODUCT TABLE DATA FETCHING:-
        $q_frd = "SELECT * FROM frd_products WHERE id=$FRc_EditProductIdx";
        require("$rtd_path/1_frd.php");
        require("$rtd_path/productss_t_frd.php");

        //***CUSTOM SELLS PRICE
        $cus_vp_sellls_price = ($f_vp_market_price - $f_vp_discount);
        //***CUSTOM DISTOUNT PESCENT CATCULATE  
        $cus_discount_persent = number_format(($f_vp_discount / $f_vp_market_price * 100));

        //FRD CUSTOM VATUE MAKER
        $FRc_v_mp_id = $FRc_EditProductIdx;
        $FRc_pro_typ = 2; //[2=CHIELD PRODUCT]
        $FRc_vry_typ = 2; //[2=COLOR VARIATION PRODUCT]
        $cus_qty = '0';
        //**


                   $FRc_stat = 1;

                    $ARR = [];
                    $ARR['r_color'] = "$f_vp_color_id";
                    $ARR['market_pri'] = "$f_vp_market_price";
                    $ARR['discount_pri'] = "$f_vp_discount";
                    $ARR['dis_persent'] = "$cus_discount_persent";
                    $ARR['sells_pri'] = "$cus_vp_sellls_price";
                    $ARR['qtyy'] = "$cus_qty";
                    $ARR['skuu'] = "$f_vp_sku";
                    $ARR['v_mp_id'] = "$FRc_v_mp_id";
                    $ARR['pro_typ'] = "$FRc_pro_typ";
                    $ARR['vry_typ'] = "$FRc_vry_typ";
                    $ARR['statuss'] = "$FRc_stat";
                    $ARR['byy'] = "$UsrId";
                    $ARR['datee'] = "$FR_NOW_DATE";
                    $ARR['timee'] = "$FR_NOW_TIME";
                    $FRR = FR_DATA_IN_2("frd_products",$ARR);
                    if($FRR['FRA']==1){
                        FR_SWAL("$UsrName", "COLOR VARIATION ADD DONE", "success");
                    }else{
                        FR_SWAL("$UsrName", "COLOR VARIATION ADD FAILED", "error");
                    }
    }




    /////////////////////////////////////////////////////////////
    //SIZE VARIATION PRODUCT ADDING:-
    /////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_add_size_vriation_pro'])) {
        //FRD FROM DATA MAKING:-
        $f_vp_size_name = $_POST['f_vp_size_name'];
        $f_vp_market_price = $_POST['f_vp_market_price'];
        $f_vp_discount = $_POST['f_vp_discount'];
        $f_vp_sku = $_POST['f_vp_sku'];
        //##FRD PRODUCT TABLE DATA FETCHING:-
        $q_frd = "select * from frd_products where id=$FRc_EditProductIdx";
        require("$rtd_path/1_frd.php");
        require("$rtd_path/productss_t_frd.php");

        //***CUSTOM SELLS PRICE
        $cus_vp_sellls_price = ($f_vp_market_price - $f_vp_discount);
        //***CUSTOM DISTOUNT PESCENT CATCULATE  
        $cus_discount_persent = number_format(($f_vp_discount / $f_vp_market_price * 100));

        //FRD CUSTOM VATUE MAKER
        $FRc_ProTyp = 2; //[2=CLIEND PRODUCT]
        $FRc_VryTyp = 3; //[3=SIZE VALIATION PRODUCT]
        $FRc_v_mp_id = $FRc_EditProductIdx;
        $FRc_rcolor = 1; //[1=N/A]
        $FRc_qty = 0;
        $FRc_Stat = 1;


                    $ARR = [];
                    $ARR['siz_name'] = "$f_vp_size_name";
                    $ARR['market_pri'] = "$f_vp_market_price";
                    $ARR['discount_pri'] = "$f_vp_discount";
                    $ARR['dis_persent'] = "$cus_discount_persent";
                    $ARR['sells_pri'] = "$cus_vp_sellls_price";
                    $ARR['qtyy'] = "$FRc_qty";
                    $ARR['skuu'] = "$f_vp_sku";
                    $ARR['v_mp_id'] = "$FRc_v_mp_id";
                    $ARR['pro_typ'] = "$FRc_ProTyp";
                    $ARR['vry_typ'] = "$FRc_VryTyp";
                    $ARR['r_color'] = "$FRc_rcolor";
                    $ARR['statuss'] = "$FRc_Stat";
                    $ARR['byy'] = "$UsrId";
                    $ARR['datee'] = "$FR_NOW_DATE";
                    $ARR['timee'] = "$FR_NOW_TIME";
                    $FRR = FR_DATA_IN_2("frd_products",$ARR);
                    if($FRR['FRA']==1){
                        FR_SWAL("Size Variation Product Add Done!","","success");
                    }else{
                        FR_SWAL("Size Variation Product Add Failed!","","error");
                    }
    }
//END>>







    //////////////////////////////////////////////////////////////
    ////////// PRODUCT SHOART INFO UPDATE START //////////////////
    /////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_update_pro_short_info'])) {
        //FRD VALIDATION NEED:-

        //FRD:---
        $f_vp_sku = $_POST['f_vp_sku'];
        $f_vp_pro_color = $_POST['f_vp_pro_color'];
        $f_vp_id = $_POST['f_vp_id'];
        if (isset($_POST['f_vp_sizename'])) {
            $f_vp_sizename = $_POST['f_vp_sizename'];
        } else {
            $f_vp_sizename = '';
        }

                    $FRR = FR_DATA_UP("UPDATE frd_products SET
                    skuu = '$f_vp_sku',
                    siz_name = '$f_vp_sizename',
                    r_color = $f_vp_pro_color
                    WHERE id = $f_vp_id");
                    if($FRR['FRA']==1){
                        FR_SWAL("SHORT INFO UPDATE DONE", "", "success");
                    }else{
                        FR_SWAL("SHORT INFO UPDATE FAILED", "", "success");
                    }

    }



    //////////////////////////////////////////////////////////////
    ////////// PRODUCT QTY UPDATE START /////////////////////////
    /////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_update_pro_qty'])) {
        //FRD VALIDATION NEED:-
        $FR_VC_MinusQty = "";
        //FRD:---
        $f_vp_id = $_POST['f_vp_id'];
        $f_vp_qty = $_POST['f_vp_qty'];
        //FRD_VC___ QTY MINUS VALU CHACKING:-
        if($f_vp_qty >= 0) {
            $FR_VC_MinusQty = "VALID";
        }

        //FRD VALIDATION CHACKING ALERT:-
        if($FR_VC_MinusQty == "") {
            FR_SWAL("$UsrName", "QTY NOT VALID", "error");
        }

            
        //Update data S
        if ($FR_VC_MinusQty == "VALID") {
            $R = FR_DATA_UP("UPDATE frd_products SET
            qtyy = $f_vp_qty
            WHERE id = $f_vp_id");
            if($R['FRA']==1){
                FR_SWAL("QTY UPDATE DONE", "", "success");
            }else{
                FR_SWAL("QTY UPDATE FAILED", "", "error");
            }
        }
        //Update data E


    }




    //////////////////////////////////////////////////////////////
    ////////// PRODUCT PRICE UPDATE START ///////////////////////
    /////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_update_pro_price'])) {

        //FRD FORM DATA RECIVEING:-
        $f_buy_price = $_POST['f_buy_price'];
        $f_vp_market_price = $_POST['f_vp_market_price'];
        $f_vp_discount = $_POST['f_vp_discount'];
        $f_vp_id = $_POST['f_vp_id'];
        //***CUSTOM SELLS PRICE
        $cus_vp_sellls_price = ($f_vp_market_price - $f_vp_discount);
        //***CUSTOM DISTOUNT PESCENT CATCULATE  
        $cus_discount_persent = number_format(($f_vp_discount / $f_vp_market_price * 100));
        //
        $FRc_v_mp_id = $FRc_EditProductIdx;

        //FRD_VC___________________________________________:-
        if($cus_vp_sellls_price < 0) {
            FR_SWAL("Sells Price Not Valid", "", "warning");
            FR_GO("$FR_THIS_PAGE", 2);
            exit;
        }

        if ($f_buy_price < 0 OR $f_buy_price == "") {
            $f_buy_price = 0;
        }
    
            $R = FR_DATA_UP("UPDATE frd_products SET
            buy_pri = $f_buy_price,
            market_pri = $f_vp_market_price,
            discount_pri = $f_vp_discount,
            dis_persent = $cus_discount_persent,
            sells_pri = $cus_vp_sellls_price
            WHERE id = $f_vp_id");
            if($R['FRA']==1){
                FR_SWAL("PRICE UPDATE DONE", "", "success");
            }else{
                FR_SWAL("PRICE UPDATE FAILED", "", "error");
            }


    }








    ///////////////////////////////////////////////////////////////
    //PRODUCT DETAILS UPDATE
    //FRD-UPDATE
    ///////////////////////////////////////////////////////////////
    if (isset($_POST['dofrd_update_pro_details_info'])) {

        $bn_title = $_POST['bn_title'];
    
        $descriptionn = $_POST['descriptionn'];
        $tagg = $_POST['tagg'];
        $f_offermode = $_POST['f_offermode'];
        $f_falsh_sales_mode = $_POST['f_falsh_sales_mode'];
        $f_yt_video_id = $_POST['f_yt_video_id'];
        $f_delivery_charge_type = $_POST['f_delivery_charge_type'];
        $f_status = $_POST['f_status'];

        $fh_pro_pic_1 = $_POST['fh_pro_pic_1'];
        $fh_pro_pic_2 = $_POST['fh_pro_pic_2'];
        $fh_pro_pic_3 = $_POST['fh_pro_pic_3'];
        $fh_pro_pic_4 = $_POST['fh_pro_pic_4'];

        $f_writers_id = $_POST['f_writers_id'];

        $f_meta_title = $_POST['f_meta_title'];
        $f_meta_desc = $_POST['f_meta_desc'];
        $f_slug = $_POST['f_slug'];

        $f_short_desc = $_POST['f_short_desc'];
        $f_g_cat_id = $_POST['f_g_cat_id'];

        //##PRODUCT TABLE DATA FETCH
        $q_frd = "SELECT * from frd_products where id=$FRc_EditProductIdx";
        require("$rtd_path/1_frd.php");
        require("$rtd_path/productss_t_frd.php");



        //MULTI CATEGORIES
        if (isset($_POST['f_multi_catts'])) {
            $f_multi_catts = $_POST['f_multi_catts'];
            $f_multi_catts_exploed = explode('/', $f_multi_catts);
            $f_multi_catt_1 = $f_multi_catts_exploed[0];
            $f_multi_catt_2 = $f_multi_catts_exploed[1];
            $f_multi_catt_3 = $f_multi_catts_exploed[2];
            $f_multi_catt_4 = $f_multi_catts_exploed[3];
        } else {
            $f_multi_catt_1 = $pro_m_cat_1;
            $f_multi_catt_2 = $pro_m_cat_2;
            $f_multi_catt_3 = $pro_m_cat_3;
            $f_multi_catt_4 = $pro_m_cat_4;
        }
        //BRAND
        if (isset($_POST['f_brand'])) {
            $f_brand = $_POST['f_brand'];
        } else {
            $f_brand = $pro_r_brand;
        }


        $FRc_Slug = preg_replace("/ /","-",$f_slug);
        $FRc_Slug = preg_replace("/%/","percent",$FRc_Slug);
        $FRc_Slug = strtolower("$FRc_Slug");

        $f_meta_desc = preg_replace("/'/","\'",$f_meta_desc);

    
        $FRQ = "UPDATE frd_products SET 
        bn_name='$bn_title',
        fr_short_desc = '$f_short_desc',
        detailess='$descriptionn',
        fr_meta_title='$f_meta_title',
        fr_meta_desc='$f_meta_desc',
        fr_slug='$FRc_Slug',
        tagg='$tagg',
        ofer_status=$f_offermode,
        fr_flash_sale=$f_falsh_sales_mode,
        videoo='$f_yt_video_id',
        g_cat_id = '$f_g_cat_id',
        r_cat_1=$pro_r_cat_1,
        r_cat_2=$pro_r_cat_2,
        r_cat_3=$pro_r_cat_3,
        r_cat_4=$pro_r_cat_4,
        m_cat_1=$f_multi_catt_1,
        m_cat_2=$f_multi_catt_2,
        m_cat_3=$f_multi_catt_3,
        m_cat_4=$f_multi_catt_4,
        r_brand=$f_brand,
        r_writer=$f_writers_id,
        deli_crg_typ=$f_delivery_charge_type,
        statuss=$f_status
        WHERE id=$FRc_EditProductIdx OR v_mp_id = $FRc_EditProductIdx
        ";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("$UsrName", "Product Details Update Done", "success");
                if($frsc_fb_feed_xml == 1){ FRF_FBProFeedXmlData($FR_PATH_HD); }
            }else{
                FR_SWAL("$UsrName", "Product Details Update Failed", "error");
            }


        // SIZE VARIATION PRODUCT MAGIC INAGES CONFIGER
        // ADD PARENT PRO IMG TO ALL CHILD PRODUCT
        if ($pro_vry_type == 3) {
            $FRQ = "UPDATE frd_products SET 
             pic_1='$fh_pro_pic_1',
             pic_2='$fh_pro_pic_2',
             pic_3='$fh_pro_pic_3',
             pic_4='$fh_pro_pic_4'
             WHERE v_mp_id = $FRc_EditProductIdx
             ";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("Size Variation Images Update Done","","success");
            }else{
                FR_SWAL("Size Variation Images Update Failed","","error");
            }
        }
    }







    ///////////////////////////////////////////////////////////////
    /////////// PRODUCT CATEGORY  UPDATE START
    ///////////////////////////////////////////////////////////////
    if (isset($_POST['DoFRD_ChangeCategory'])) {
        //FRD VALIDATION CHECK NEED:-
        $FR_VC_CatSesion = "";

        $f_main_catt_1 = $_SESSION['father_catid'];
        $f_main_catt_2 = $_SESSION['son_catid'];
        $f_main_catt_3 = $_SESSION['grandson_catid'];
        $f_main_catt_4 = $_SESSION['grandsonchild_catid'];

        //FRD_VC_________
        if (isset($_SESSION['father_catid']) and isset($_SESSION['grandsonchild_catid'])) {
            $FR_VC_CatSesion = "VALID";
        }




        //##PRODUCT TABLE DATA FETCH
        $q_frd = "SELECT * FROM frd_products WHERE id = $FRc_EditProductIdx";
        require("$rtd_path/1_frd.php");
        require("$rtd_path/productss_t_frd.php");


        //Update data S
        if ($FR_VC_CatSesion == "VALID") {
            $FRQ = "UPDATE frd_products SET 
                 r_cat_1=$f_main_catt_1,
                 r_cat_2=$f_main_catt_2,
                 r_cat_3=$f_main_catt_3,
                 r_cat_4=$f_main_catt_4,
                 statuss=1
                 WHERE id=$FRc_EditProductIdx OR v_mp_id=$FRc_EditProductIdx
                 ";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("Product Category Update Done","","success");
                unset_selected_cat_ses();
            }else{
                FR_SWAL("Product Category Update Failed","","error");
            }
        }
        //Update data E
    }







    ////////////////////////////////////////////////////////////////
    ////////////// FRD PRODUCT IMAGES CHANGE INNI //////////////////
    ////////////////////////////////////////////////////////////////
    if (isset($_POST['frddo_update_proimg_inni'])) {
        $f_vp_id = $_POST['f_vp_id'];

        // FRD PAST SESSION UNSET:-
        // if(isset($_SESSION['FRs_ImgUpProId'])){
        //     unset($_SESSION['FRs_ImgUpProId']);
        // }
        // $_SESSION['FRs_ImgUpProId']=$f_vp_id; 
        header("location:$FR_SP_HURL_DP/pro-EditProductImg/" . base64_encode($f_vp_id) . "");
        exit;
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
            } else {
                FR_TAL("Read A Little PDF File Update Failed", "error");
            }
        }
        //END>>

    }
    //END>>








    ///////////////////////////////////////////////////
    //Product Table data fetching:-
    ///////////////////////////////////////////////////
    $q_frd = "SELECT * from frd_products where id = '$FRc_EditProductIdx' AND pro_typ = 1";
    require("$rtd_path/1_frd.php");
    require("$rtd_path/productss_t_frd.php");

    //FRD_VC_______________________________________
    if ($rowsnum_frd == 0) {
        header("location:$FR_THISHURL/ProductList/?FRH=PRODUCT ID NOT VALID");
        exit;
    }

    ///***      
    $pro_detailes_mody = preg_replace("/<br \/>/", "\n", $pro_detailes); //
    $pro_detailes_mody = preg_replace("/<br>/", "\n", $pro_detailes_mody); //
    //**
    $pro_market_explod = explode('.', $pro_market_price);
    $pro_market_explod_0 = $pro_market_explod[0];

    $pro_discount_amount_explod = explode('.', $pro_discount_amount);
    $pro_discount_amount_explod_0 = $pro_discount_amount_explod[0];

    //$f_slug_name_strtolower=strtolower("$f_slug_name");
    //$f_slug_name_mody=preg_replace("/ /","-",$f_slug_name_strtolower);//      

    if($pro_status == 1){ $statuss_M = "Published";}
    if($pro_status == 2){ $statuss_M = "Unlisted";}
    if($pro_status == 3){ $statuss_M = "Private";}
    if($pro_status == 4){ $statuss_M = "Trashed";}

    //**FRD BRAND NAME FINDER
    $FRQ = $FR_CONN->query("SELECT bn_name FROM frd_brandss WHERE id = $pro_r_brand");
    $row_bnf_jx = $FRQ->fetch();
    $FRc_ProBrandId = $pro_r_brand;
    $FRc_ProBrandName = $row_bnf_jx['bn_name'];

    //**FRD WRITER NAME FINDER
    //FRD WRITER TABLE  READ :-
    $FRR = FR_QSEL("SELECT * FROM frd_writers WHERE id = $pro_r_writer", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
        $FRc_WriterId = $pro_r_writer;
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
    if($pro_r_cat_1 > 0){
        $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $pro_r_cat_1");
        $row_cat1_name = $FRQ->fetch();
        $pro_catt1_name = $row_cat1_name['bn_name'];
        $pro_catt1_slug = $row_cat1_name['slugg'];
        $pro_catt1_path = "$FRD_HURL/category/$pro_catt1_slug";
        $pro_catt1_modyfecho = "<a href='$pro_catt1_path' target='_blank'>$pro_catt1_name</a>";
    
        if ($pro_r_cat_2 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $pro_r_cat_2");
            $row_cat2_name = $FRQ->fetch();
            $pro_catt2_name = $row_cat2_name['bn_name'];
            $pro_catt2_slug = $row_cat2_name['slugg'];
            $pro_catt2_path = "$FRD_HURL/category/$pro_catt2_slug";
            $pro_catt2_modyfecho = "<a href='$pro_catt2_path' target='_blank'> / $pro_catt2_name</a>";
        }
        if ($pro_r_cat_3 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $pro_r_cat_3");
            $row_cat3_name = $FRQ->fetch();
            $pro_catt3_name = $row_cat3_name['bn_name'];
            $pro_catt3_slug = $row_cat3_name['slugg'];
            $pro_catt3_path = "$FRD_HURL/category/$pro_catt3_slug";
            $pro_catt3_modyfecho = "<a href='$pro_catt3_path' target='_blank'> / $pro_catt3_name</a>";
        }
        if ($pro_r_cat_4 > 0) {
            $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $pro_r_cat_4");
            $row_cat4_name = $FRQ->fetch();
            $pro_catt4_name = $row_cat4_name['bn_name'];
            $pro_catt4_slug = $row_cat4_name['slugg'];
            $pro_catt4_path = "$FRD_HURL/category/$pro_catt4_slug";
            $pro_catt4_modyfecho = "<a href='$pro_catt4_path' target='_blank'> / $pro_catt4_name</a>";
        }
    }   
    ///product relational catt name/ rcat path fetcher e



    ///***product multi catt name fetcher s      
    if ($pro_m_cat_1 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $pro_m_cat_1");
        $row_mulicat1_name = $FRQ->fetch();
        $pro_multicatt1_name = $row_mulicat1_name['en_name'];
    } else {
        $pro_multicatt1_name = "N/A";
    }

    if ($pro_m_cat_2 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $pro_m_cat_2");
        $row_mulicat2_name = $FRQ->fetch();
        $pro_multicatt2_name = " <b class='r'>&</b> " . $row_mulicat2_name['en_name'];
    } else {
        $pro_multicatt2_name = "";
    }

    if ($pro_m_cat_3 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $pro_m_cat_3");
        $row_mulicat3_name = $FRQ->fetch();
        $pro_multicatt3_name = " <b class='r'>&</b> " . $row_mulicat3_name['en_name'];
    } else {
        $pro_multicatt3_name = "";
    }

    if ($pro_m_cat_4 > 0) {
        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_categoriess WHERE id = $pro_m_cat_4");
        $row_mulicat4_name = $FRQ->fetch();
        $pro_multicatt4_name = " <b class='r'>&</b> " . $row_mulicat4_name['en_name'];
    } else {
        $pro_multicatt4_name = "";
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



    ?>
</section>
<!-- 1script e-->


<!-- PAREST PRODUCT INFORMATION SECTION -->
<section>
    <div class="container">
        <div class="col-md-11">

            <div class="row mt-10">
                <div class="col-md-12 jumbotron">
                    <h4>
                        <b>Product Id: </b> <?php echo "#$FRc_EditProductIdx" ?> <br>
                        <b>Product Title: </b> <?php echo "$pro_bn_name" ?> <br>
                        <b>Main Categories: </b><?php echo " <span class='rcsp_1'> $pro_catt1_modyfecho </span> <span class='rcsp_2'> $pro_catt2_modyfecho </span> <span class='rcsp_3'> $pro_catt3_modyfecho </span> <span class='rcsp_4'> $pro_catt4_modyfecho </span> "; ?>
                        <br>
                        <b>Multi Categories: </b><?php echo " $pro_multicatt1_name $pro_multicatt2_name $pro_multicatt3_name $pro_multicatt4_name"; ?>
                        <br>
                        <b>Brand: </b><span title="<?php echo "#$pro_r_brand"; ?>"><?php echo "$FRc_ProBrandName"; ?> </span>
                        <br>
                        <b>Product Variation Type: </b><?php echo " $pro_vry_type_mody"; ?>
                        <br>
                        <b>Status: </b><?php echo " $pro_status_M"; ?>
                    </h4>
                    <?php 
                        echo "
                        <a href='$FRD_HURL/product/$FRc_EditProductIdx/$fr_slug' target='_blank' class='table-link'>
                            <span class='btn btn-sm btn-success'> 
                               Visit Product Landing Page <i class='glyphicon glyphicon-new-window'></i> 
                            </span>
                        </a>
                        ";
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>








<!-- FORM-PRODUCT-EDIT -->
<section>
    <?php if (isset($_SESSION['s_frd_editProDetails'])) { ?>

    <!-- SECTION PRODUCT CATEGORY CHANGE START -->
    <div class="container">
        <div class="col-md-11 jumbotron">

           

                <!-- SELECTED CATEGORIES  -->
                <div class="row">
                    <div class="col-md-2">
                        <?php
                        ////////unset selected catts btn ////////     
                        if (isset($_SESSION['father_catid'])) {
                            echo "
                    <form action='' method='post'>
                    <input class='btn btn-warning' type='submit' name='do_unset_selacted_cats_sub' value='Cancel categories'>
                    </form>
                    ";
                        }
                        ?>
                    </div>
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
                </div>


                <!-- CATEGORY CHANGE CONFARMATION FORM -->
                <div class="row">
                    <div class="col-md-11">
                        <?php
                        if (isset($_SESSION['grandsonchild_catid'])) {
                            echo "
                    <form action='' method='post'>
                        <br><button class='btn btn-success btn-block' type='submit' name='DoFRD_ChangeCategory'><span class='glyphicon glyphicon-save'></span> Confirm & Change Category</button>
                    </form>
                    ";
                        }
                        ?>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-11">
                        <div class="col-md-4"></div>

                        <div class="col-md-4">


                            <?php if (!isset($_SESSION['father_catid'])) { ?>
                                <form action="" method="post">
                                    <select name="father_catinfo" id="" class="chosen" onchange="this.form.submit()">
                                        <option value="">Change father category</option>
                                        <?php
                                        $q_frd = "select * from frd_categoriess WHERE cat_type=1";
                                        require("$rtd_path/1_frd.php");
                                        for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                                            require("$rtd_path/catt_t_frd.php");
                                            echo "
                                <option value='$catt_id/$catt_name_bn'>$catt_name_bn</option>
                                ";
                                        } //For Loop E  
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
                                        $q_frd = "select * from frd_categoriess WHERE cat_type=2 and cat_father=" . $_SESSION['father_catid'] . "";
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
                                        $q_frd = "select * from frd_categoriess WHERE cat_type=3 and cat_father=" . $_SESSION['son_catid'] . "";
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
                                        $q_frd = "select * from frd_categoriess WHERE cat_type=4 and cat_father=" . $_SESSION['grandson_catid'] . "";
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

                        <div class="col-md-4"></div>
                    </div>
                </div>



        </div>
    </div>
<!-- SECTION PRODUCT CATEGORY CHANGE END -->




        <div class="container">
        <div class="col-md-11">
          
         <div class="col-md-2"></div>
          

            <div class="col-md-8">
                <div class="row">
                    <form id="" class="f_ProDetailsUpdate" action="" method="post" enctype="multipart/form-data">

                       
                       <div class="jumbotron">
                            <span>Product Title *</span>
                            <input class="form-control" type="text" name="bn_title" value="<?php echo "$pro_bn_name" ?>" required>

                            <br>
                            <span> Short Description</span>
                            
                            <textarea class="form-control" name="f_short_desc"  placeholder="Product Short Description" rows="4"><?php echo "$fr_short_desc" ?></textarea>


                            <br>
                            <span>Long Description * </span>
                            <textarea class="form-control" name="descriptionn" id="summernote" style="height:400px;" placeholder="Product description *"><?php echo "$pro_detailes_mody" ?></textarea>

                       </div>

            

                       <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> SEO Fields </h3>

                            <span>Google Product Category Id *</span> <small><a href="https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt" target="_blank"> Click To Find Id => </a></small>
                            <input class="form-control" type="number" name="f_g_cat_id" value="<?php echo "$g_cat_id" ?>" required>

                            <br>
                            <span>Meta Title *</span>
                            <input class="form-control" type="text" name="f_meta_title" value="<?php echo "$fr_meta_title" ?>" required>

                            <br>
                            <span> Meta Description * </span>
                            <textarea class="form-control" name="f_meta_desc" id="" cols="30" rows="3" required><?php echo "$fr_meta_desc"?></textarea>

                            <br>
                            <span> Meta Tag * </span>
                            <textarea class="form-control" name="tagg" id="" cols="30" rows="3" required><?php echo "$pro_tag"?></textarea>

                            <br>
                            <span>Slug *</span>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon xs_disp_none"><?php echo "$FRD_HURL/product/$FRc_EditProductIdx/";?></div>
                                    <input type="text" class="form-control" name="f_slug" placeholder="Input Slug" value="<?php echo "$fr_slug"?>" required>
                                </div>
                            </div>
                       </div>




                        <br>
                        <div class="jumbotron">
                            <h3 class="text-center text-primary boldd"> Others Fields <small>Optional</small></h3>
                            <br>


                        
    
                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <span>Youtube Video ID (optional)</span><br>
                                    <input class="form-control" type="text" name="f_yt_video_id" value="<?php echo $pro_video ?>">
                                </div>
                            </div>


                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <span>Delivery Charge Type *</span> <br>
                                    <select class="form-control" name="f_delivery_charge_type" id="" required>
                                        <option value="<?php echo "$deli_crg_typ"; ?>"><?php echo "$deli_crg_typ_M"; ?></option>
                                        <option value="1">From Shipping Zone</option>
                                        <option value="2">Delivery Charge Free</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mt-10">
                                <div class="col-md-12">
                                <span>Change Status </span> <br>
                                    <select class='form-control' id="f_status" name='f_status'>
                                        <option value="<?php echo "$pro_status";?>"><?php echo "$statuss_M";?></option>
                                        <option value='1'>Published</option>
                                        <option value='2'>Unlisted</option>
                                        <option value='3'>Private</option>
                                    </select>
                                </div>
                            </div>



                            <br>
                            <div class="row">
                                <div class="col-md-12">
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


                                <div class="col-md-12">
                                    <br>
                                    <span>Read A Little PDF </span>
                                    <?php
                                    if ($fr_read_a_little != "") {
                                        echo "<span> <a href='$FRD_HURL/frd-data/pdf/read-a-little/$fr_read_a_little' target='_blank'> Open PDF File</a></span>";
                                    }
                                    ?>

                                    <br>
                                    <input type="file" class="form-control" name="f_read_a_little_pdf">
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Brand </span> <br>
                                    <?php
                                    $FRR = FR_QSEL("SELECT * FROM frd_brandss WHERE statuss = 1 ORDER BY id DESC", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        echo "<select class='form-control chosen' name='f_brand' id=''>";
                                        echo "<option value='$FRc_ProBrandId'>$FRc_ProBrandName</option>";
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


  


                            <div class="row">
                                <div class="col-md-12">
                                    <br><span> Multi categories </span>
                                    <input class="form-control" type="text" name="f_multi_catts" value="<?php echo "$pro_m_cat_1/$pro_m_cat_2/$pro_m_cat_3/$pro_m_cat_4" ?>" placeholder="Example 3/6/9">
                                </div>
                            </div>



     
                            

                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Offers Mode *</span><br>
                                    <input type="radio" name="f_offermode" value="1" <?php if ($pro_ofer_status == 1) {
                                                                                            echo "checked";
                                                                                        } ?> required> Active &#160; &#160;&#160;
                                    <input type="radio" name="f_offermode" value="0" <?php if ($pro_ofer_status == 0) {
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


                            <input type="hidden" name="fh_pro_pic_1" value="<?php echo "$pro_pic_1"; ?>">
                            <input type="hidden" name="fh_pro_pic_2" value="<?php echo "$pro_pic_2"; ?>">
                            <input type="hidden" name="fh_pro_pic_3" value="<?php echo "$pro_pic_3"; ?>">
                            <input type="hidden" name="fh_pro_pic_4" value="<?php echo "$pro_pic_4"; ?>">


                            <br><br>
                            <div class="text-right">
                                <button type="submit" name="dofrd_update_pro_details_info" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Confirm & Update Product Details </button>
                            </div>
                    </div>

                    </form>
                </div>  
            </div>

           <div class="col-md-2"></div>

        </div>
        </div>
    <?php } ?>
</section>




<div class="container">
<div class="col-md-11">
<div class="row">
                <div class="col-md-12">
                    <?php
                    if (!isset($_SESSION['s_frd_editProDetails'])) {
                        echo "
                    <form action='' method='post'>
                      <button class='btn btn-default btn-block' type='submit' name='frddo_enable_editProDetails'> <span class='glyphicon glyphicon-menu-up'></span> Enabale Update Product Details Mode</button>
                    </form>
                    ";
                    }
                    if (isset($_SESSION['s_frd_editProDetails'])) {
                        echo "
                    <form action='' method='post'>
                      <button class='btn btn-danger btn-block' type='submit' name='frddo_stop_editProDetails'> <span class='glyphicon glyphicon-menu-down'></span> Stop Update Product Details Mode</button>
                    </form>
                    ";
                    }
                    ?>
                </div>
            </div>
</div>
</div>





<!--  PRODUCT SHOART INFO EDIT FROM -->
<?php if (!isset($_SESSION['s_frd_editProDetails'])) { ?>
<section>
    <br>
    <div class="container">
        <div class="col-md-11 jumbotron">
            <!--  -->
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $cus_td_sizename = "";

                    if ($pro_vry_type == 1) {
                        $q_frd = "select * from frd_products where id=$pro_id";
                    }
                    if ($pro_vry_type == 2) {
                        $q_frd = "select * from frd_products where v_mp_id=$pro_v_mp_id and vry_typ=2";
                    }
                    if ($pro_vry_type == 3) {
                        $q_frd = "select * from frd_products where v_mp_id=$pro_v_mp_id and vry_typ=3";
                        $cus_td_sizename = "
                           <td width='15%'>
                                          <small>SizeName</small>
                                          <input class='form-control' type='text' name='f_vp_sizename' value='$pro_size_name'>
                                         </td>
                          ";
                    }
                    require("$rtd_path/1_frd.php");
                    for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                        require("$rtd_path/productss_t_frd.php");
                        //**
                        $pro_market_explod = explode('.', $pro_market_price);
                        $pro_market_explod_0 = $pro_market_explod[0];
                        //**
                        $pro_discount_amount_explod = explode('.', $pro_discount_amount);
                        $pro_discount_amount_explod_0 = $pro_discount_amount_explod[0];
                        //**
                        $pro_sells_price_explod = explode('.', $pro_sells_price);
                        $pro_sells_price_explod_0 = $pro_sells_price_explod[0];

                        //** COLOR NAME FINDER
                        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $pro_r_color");
                        $row_frd_cnf = $FRQ->fetch();
                        $color_en_name = $row_frd_cnf['en_name'];
                        //echo " <h4><b>Color:</b> $color_en_name</h4>";  

                        if ($pro_vry_type == 3) {
                            $cus_td_sizename = "<b>SizeName:</b> $pro_size_name <br/>";
                        }

                        if ($pro_bn_name == "") {
                            echo "<h6 class='pip_pip_1s r alert alert-danger'>IMPORTANT -> Please Update Product Details</h6>";
                        }
                        //-EDIT PRICE BUTTON TRIGER CONFIG:-
                        $FRc_EditPriceFormTrig = "<button type='button' class='btn btn-success gfujqajx_vppup' id='$pro_id'><i class='glyphicon glyphicon-fullscreen'></i> EditPrice</button>";
                        //-EDIT QTY  BUTTON TRIGER CONFIG:-
                        $FRc_EditQtyFormTrig = "<button type='button' class='btn btn-success btn-block fsfsthwwy_pqtyef' id='$pro_id'><i class='glyphicon glyphicon-fullscreen'></i> Edit-Info</button>";


                        echo "
                                    <div class='table-responsive'>
                                    <table  class='table table-bordered'>
                                     <form action='' method='post'>
                                      <tr>
                                         <td>
                                           <button title='Change Image' type='submit' class='text-center' name='frddo_update_proimg_inni'>
                                           <img src='$pro_pic_1_path' alt='' class='' width='50px' height='50px'><br>
                                           <h6 class='label label-danger'> Change Image </h6>
                                           </button>
                                         </td>
                                         
                                         <td>
                                          <h5>
                                           <b>Market Price:</b> $pro_market_explod_0 <br/> 
                                           <b>Discount:</b> $pro_discount_amount_explod_0 <br/> 
                                           <b>Discount Percent:</b> $pro_discount_persent % <br/> 
                                           <b>Sells Price:</b> $pro_sells_price_explod_0 <br/> 
                                          </h5>
                                          $FRc_EditPriceFormTrig
                                         </td>
                                         
                                         <td>
                                          <h5> <b>Qty:</b> $pro_qtyy </h5>
                                           <br><br>
                                           $FRc_EditQtyFormTrig
                                         </td>
                                         
                                         
                                         
                                         <td>
                                         <h5>
                                           <b>Color:</b> $color_en_name <br/>
                                           $cus_td_sizename
                                           <b>Status:</b> $pro_status_M <br/>
                                           <b>SKU:</b> $pro_skuu <br/> 
                                         </h5>
                                             <button type='button' class='btn btn-success btn-block gfujqajx_vpuf' id='$pro_id'><i class='glyphicon glyphicon-fullscreen'></i> Edit-Info</button>
                                         </td>
                                     </tr> 
                                        <input type='hidden' name='f_vp_id' value='$pro_id'>
                                     </form>
                                    </table> 
                                    </div>
                                    ";
                    } //For Loop E  
                    ?>

                </div>
            </div>



            <!-- MORE MORE COLOR VARIATION PRODUCT MODEL TRIGER AND FORM S -->
            <?php if ($pro_vry_type == 2) { ?>
                <div class="row">
                    <hr>
                    <div class="col-md-12">
                        <!-- MODEL_TRIGGER ADD MODEL COLOR   -->
                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal_G_f_add_color_vari_pro"> <i class="glyphicon glyphicon-plus"></i> More Color </button>
                    </div>

                    <div class="modal fade" id="myModal_G_f_add_color_vari_pro" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="" action="" method="post">

                                                <span>Select Color *** </span>
                                                <select class='form-control' name="f_vp_color_id" id="" class="chosen" required>
                                                    <option value="">Select Color</option>
                                                    <?php
                                                    $FRQ = $FR_CONN->query("SELECT * FROM frd_colorr");
                                                    $rowsnum2_frd = $FRQ->rowCount();
                                                    for ($i = 1; $i <= $rowsnum2_frd; $i++) { //For Loop S
                                                        $row2frd = $FRQ->fetch();
                                                        $Color_ID = $row2frd['id'];
                                                        $color_en_name = $row2frd['en_name'];
                                                        echo "
                                                        <option value='$Color_ID'>$color_en_name</option>
                                                    ";
                                                    } //For Loop E  
                                                    ?>
                                                </select> <br>


                                                
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <span> Market Price *</span>
                                                        <input class='form-control' type="number" name="f_vp_market_price" id="f_vp_market_price" required>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <span>Discount *</span>
                                                        <input class='form-control' type="number" name="f_vp_discount" id="f_vp_discount"  required>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4">
                                                        <span>Sells Price *</span>
                                                        <input class='form-control' type="number" name="f_sellls_price" id="f_sellls_price" required disabled>
                                                    </div>
                                                </div>

    


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <span> SKU (optional) </span>
                                                        <input class='form-control' type="text" name="f_vp_sku" value="<?php echo "" ?>">
                                                    </div>
                                                </div>

                                                <br />
                                                <input class="btn btn-danger btn-block" type="submit" name="dofrd_add_color_vriation_pro" value="Confirm & Add Color">
                                            </form>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>



            <!-- MORE MORE SIZE VARIATION PRODUCT MODEL TRIGER AND FORM S -->
            <?php
            if ($pro_vry_type == 3) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- MODEL_TRIGGER ADD MODEL SIZE   -->
                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal_G_f_add_size_vari_pro"> <i class="glyphicon glyphicon-plus"></i> More Size </button>
                    </div>

                    <div class="modal fade" id="myModal_G_f_add_size_vari_pro" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <form id="" action="" method="post">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <span>Size Name * <small>Hinks: Small/Mediam/Large/XL/XXL etc</small></span><br>
                                                        <input class="form-control" type="text" name="f_vp_size_name" placeholder="Input Others Size Name *" required>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4">
                                                        <span> Market Price *</span>
                                                        <input class='form-control' type="number" name="f_vp_market_price" id="f_vp_market_price" required>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4">
                                                        <span>Discount *</span>
                                                        <input class='form-control' type="number" name="f_vp_discount" id="f_vp_discount" required>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4">
                                                        <span>Sells Price *</span>
                                                        <input class='form-control' type="number" name="f_sellls_price" id="f_sellls_price" required disabled>
                                                    </div>
                                                </div>

                            
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <span> SKU (optional) </span>
                                                        <input class='form-control' type="text" name="f_vp_sku" value="<?php echo "" ?>">

                                                        <br>
                                                        <input class="btn btn-danger btn-block" type="submit" name="dofrd_add_size_vriation_pro" value="Confirm & Add Size">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>






            <!-- MAKE CHANGINGING PRODUCT VARIATION MOOD S-->
            <div class="row">
                <?php if ($pro_vry_type == 1) { ?>
                    <br><br>
                    <div class="col-md-12">
                        <!-- MODEL_TRIGGER ADD MODEL SIZE   -->
                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal_G_f_make_change_pro_veri"> <i class="glyphicon glyphicon-fullscreen"></i> </button>
                    </div>

                    <div class="modal fade" id="myModal_G_f_make_change_pro_veri" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                                </div>
                                <div class="modal-body">

                                    <form action="" method="post">
                                        <input type="checkbox" required> I have a more colors of this product! <br>
                                        <input type="checkbox" required> I Am Sure! <br>
                                        <input type="checkbox" required> I Know About Color Variation Product! <br>
                                        <input type="checkbox" required> I Know that i will not back from color varitaion product!
                                        <button type="submit" class="btn btn-danger btn-block" name="frddo_makethis_colorvariation_pro"> <span class="glyphicon glyphicon-flash"></span> Make It Color Variation Product</button>
                                    </form>

                                    <br><hr>
                                    <form action="" method="post">
                                        <input type="checkbox" required> I have a more Size of this product! <br>
                                        <input type="checkbox" required> I Am Sure! <br>
                                        <input type="checkbox" required> I Know About Size Variation Product! <br>
                                        <input type="checkbox" required> I Know that i will not back from size varitaion product!
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
            </div>


        </div>
    </div>
</section>
<?php } ?>



<?php require_once('frd1_footer.php'); ?>   



<script type="text/javascript">
    //
    $(document).ready(function() {

        /////////////////////////////////////////////////////////////////
        ///////// FRD VARIATION PRODUCT SHOART INFO EDIT FORM //////////
        ////////////////////////////////////////////////////////////////       
        $('.gfujqajx_vpuf').click(function() {
            var v_pro_id = $(this).attr("id");
            //alert(pro_id);
            $.ajax({
                url: "<?php echo "$FR_THISHURL/page/frd-p-pro/inc/jq_ajx/ro/vry_pro_edit_form_frd.php"; ?>",
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


        ///////////////////////////////////////////////////////////////////////
        //////////// PRODUCT PRICE EIDT FORM /////////////////////////////////
        //////////////////////////////////////////////////////////////////////
        $('.gfujqajx_vppup').click(function() {
            var v_pro_id = $(this).attr("id");
            //alert(pro_id);
            $.ajax({
                url: "<?php echo "$FR_THISHURL/page/frd-p-pro/inc/jq_ajx/ro/pro_price_edit_form_frd.php"; ?>",
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

        ///////////////////////////////////////////////////////////////////////
        //////////// PRODUCT QTY EIDT FORM ///////////////////////////////////
        //////////////////////////////////////////////////////////////////////
        $('.fsfsthwwy_pqtyef').click(function() {
            var v_pro_id = $(this).attr("id");
            //alert(pro_id);
            $.ajax({
                url: "<?php echo "$FR_THISHURL/page/frd-p-pro/inc/jq_ajx/ro/pro_qty_edit_form_frd.php"; ?>",
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

        //$('f_ProDetailsUpdate').submit();  


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


<script>
                        $(document).ready(function(){
                    
                            $('#f_vp_market_price,#f_vp_discount').keyup(function(){
                            let f_vp_market_price = $('#f_vp_market_price').val();
                            let f_vp_discount = $('#f_vp_discount').val();
                            let f_sellls_price = (f_vp_market_price - f_vp_discount);
                            $('#f_sellls_price').val(f_sellls_price);
                        
                            if(f_sellls_price < 0){
                                swal('Sells Price Not Valid', '', 'warning');
                            }
                            });
                                    
                                    
                        });   
                    </script>