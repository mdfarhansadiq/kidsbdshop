<?php
if(isset($_POST["limit"], $_POST["start"])){

    $FR_PATH_HD = "../../../../../../";
    $rtd_path = $FR_PATH_HD."rtd";
    require_once($FR_PATH_HD."/frd-src/abc/frd-config.php");
    require_once($FR_PATH_HD."/frd-src/abc/frd-spider-function.php");
    $FR_HURL_AT = "$FRD_HURL/frd-public/theme";

    $FRQ = $FR_CONN->query("SELECT FRcf_ProBoxNum,frtc_on_btn_trig  FROM frd_themeconfig WHERE id = 1");
    extract($FRQ->fetch());
    
    $FRQ = $FR_CONN->query("SELECT frtc_off_txt,stockout_frd,frd_ordernow_txt,addtocart_frd,frlc_no_product_found_txt,frlc_call_for_help_txt,FRgtd_Fdetails FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
    extract($FRQ->fetch());


    $FRc_ASC_DESC = "DESC";

    if(isset($_POST["start"])){
        $FR_start = $_POST["start"];
        $limit = $_POST["limit"];
    }
    if(isset($_POST["brand_id"])){
        $FR_brand_id = $_POST["brand_id"];
    }
    if(isset($_POST["writer_id"])){
        $FR_writer_id = $_POST["writer_id"];
    }
    if(isset($_POST["catt_id"])){ $FR_catt_id = $_POST["catt_id"]; }
    if(isset($_POST["featureproduct"])){ $FR_featureproduct = "SET";}
    if(isset($_POST["doffer"])){ $FR_doffer = "SET";}
    if(isset($_POST["f_flash_sales"])){ $f_flash_sales = "SET";}
    if(isset($_POST["fr_search_text"])){ 
        $FRc_SearchText = $_POST["fr_search_text"];
     }


     $FRc_Status = 1;
     $FRc_pro_typ = 1;
     $FRc_qty = 0;
    

            // $FRc_PFQ = "SELECT * FROM frd_products WHERE statuss = 1 AND pro_typ = 1 AND qtyy >= 0";

            $FRc_PFQ = "SELECT * FROM frd_products WHERE statuss = :statuss AND pro_typ = :pro_typ AND qtyy >= :qtyy";

            // if(isset($FR_brand_id)){ 
            //     $FRc_PFQ .=" AND r_brand = $FR_brand_id";
            // }
            // if(isset($FR_writer_id)){ 
            //     $FRc_PFQ .=" AND r_writer = $FR_writer_id"; 
            // }
            // if(isset($FR_catt_id)){
            //     $FRc_PFQ .=" AND (r_cat_1 = $FR_catt_id OR r_cat_2 = $FR_catt_id OR r_cat_3 = $FR_catt_id OR r_cat_4 = $FR_catt_id OR m_cat_1 = $FR_catt_id OR m_cat_2=$FR_catt_id OR m_cat_3=$FR_catt_id OR m_cat_4=$FR_catt_id)";
            // }
            // if(isset($FR_featureproduct)){ $FRc_PFQ .=" AND frpro_featurepro = 1"; }
            // if(isset($FR_doffer)){ $FRc_PFQ .=" AND ofer_status = 1"; }
            // if(isset($f_flash_sales)){ $FRc_PFQ .=" AND fr_flash_sale = 1"; }


            if(isset($FRc_SearchText)){ 
                $FRc_PFQ .=" AND (tagg LIKE '%,:tagg,%')"; 
                // $FRc_PFQ .=" AND (tagg LIKE '%,:tagg,%' OR bn_name LIKE '%:bn_name%' OR detailess LIKE '%:detailess%' OR sells_pri = :sells_pri OR id = :id OR skuu = :skuu')"; 
            }
            if(isset($_POST["f_filt_rand"])){
               $FRc_PFQ .=" ORDER BY RAND() LIMIT $FR_start,$limit";
            }else{
                $FRc_PFQ .=" ORDER BY frpro_priority $FRc_ASC_DESC LIMIT $FR_start,$limit";
            }
        

           echo " $FRc_PFQ ";

        try {
            $FRQ = $FR_CONN->prepare("$FRc_PFQ");

            $FRQ->bindParam(':statuss', $FRc_Status, PDO::PARAM_INT);
            $FRQ->bindParam(':pro_typ', $FRc_pro_typ, PDO::PARAM_INT);
            $FRQ->bindParam(':qtyy', $FRc_qty, PDO::PARAM_INT);

            $FRQ->bindParam(':tagg', $FRc_SearchText, PDO::PARAM_STR);
            // $FRQ->bindParam(':bn_name', $FRc_SearchText, PDO::PARAM_STR);
            // $FRQ->bindParam(':detailess', $FRc_SearchText, PDO::PARAM_STR);
            // $FRQ->bindParam(':sells_pri', $FRc_SearchText, PDO::PARAM_STR);
            // $FRQ->bindParam(':id', $FRc_SearchText, PDO::PARAM_STR);
            // $FRQ->bindParam(':skuu', $FRc_SearchText, PDO::PARAM_STR);
          
            $FRQ->execute();
            $ResultArr = $FRQ->fetchAll();

            foreach($ResultArr as $FR_ITEM){
                extract($FR_ITEM);
                require("frd-product-box-$FRcf_ProBoxNum.php");
            }
            
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();

            if(isset($FRc_SearchText)){

                //FRD  DATA:-
                $FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1","");
                if($FRR['FRA']==1){ 
                  extract($FRR['FRD']);
                } else{ ECHO_4($FRR['FRM']); }
                //END>>
                echo "
                <div class='container'>
                <div class='row'>
                <div class='col-md-12'>
                   <h3 class='alert alert-danger text-center jumbotron'> <b>[$FRc_SearchText]</b> <br> $frlc_no_product_found_txt <br><br> $frlc_call_for_help_txt <br>  <a href='tel:$fr_cmobile_1'>$fr_cmobile_1</a> </h3> 
                </div>
                </div>
                </div>
                ";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            }
        }


     $FR_CONN = NULL;
    
}
?>
<script type="text/javascript">
FrFunAddToCartManger();
</script>