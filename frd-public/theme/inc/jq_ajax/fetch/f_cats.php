<?php
if(isset($_POST["limit"], $_POST["start"])){
    require_once("../1frl_head.php");
   

  
   
////////////////////////////////////////////////////////////////////////////////////
////////////////// FRD MAIN SCRIPT FOR TDR & OUTPUT MAKING
////////////////////////////////////////////////////////////////////////////////////

    $q_allclildcatsshow="SELECT * FROM frd_categoriess WHERE cat_type = 1 AND statuss = 1";
    $q_allclildcatsshow .=" LIMIT $FR_start,$limit";
            $FRQ = $FR_CONN->query("$q_allclildcatsshow");
            $FRc_RowsNum = $FRQ->rowCount();
            for($i=1;$i<=$FRc_RowsNum;$i++){//for loop start
              $row = $FRQ->fetch();
              $cildcatt_id = $row['id'];  
              $cildcatt_en_name=$row['en_name'];  
              $cildcatt_bn_name=$row['bn_name'];  
              $cildcatt_slugg=$row['slugg'];  
              $cildcatt_thumbpicc=$row['thumb_picc'];
             $cildcatt_thumbpiccpath="$FRD_HURL/frd-data/img/cat_thum/$cildcatt_thumbpicc";
                
             // CATEGORY BASE PRODUCT COUNT ALSO    
             $q_totmatched_c="SELECT COUNT(id) FROM frd_products WHERE statuss = 1 AND r_cat_1 = $cildcatt_id OR r_cat_2 = $cildcatt_id OR r_cat_3 = $cildcatt_id OR r_cat_4 = $cildcatt_id";
            $FRQ2 = $FR_CONN->query("$q_totmatched_c");
            $row_totmatched_c = $FRQ2->fetch();
            $TotalProductCount=$row_totmatched_c['COUNT(id)'];       

                
                 echo "
                   <div class='col-xs-6 col-sm-3 col-md-2'>
                   <div class='frs_catbox_1'>
                     <a href='$fr_cat_bpro_url/$cildcatt_slugg'>
                       <img src='$cildcatt_thumbpiccpath' alt='' class='img-responsive' style=''>
                       <h4 class='title'>$cildcatt_bn_name <br> <small class='procount'> [ $TotalProductCount ]</small></h4>
                      </a>
                   </div>
                   </div>
                 ";
                
           }//for loop end
    


    
require_once("../1frl_foot.php");
    
}