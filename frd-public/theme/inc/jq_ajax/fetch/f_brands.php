<?php
if(isset($_POST["limit"], $_POST["start"])){
  require_once("../1frl_head.php");
    
    
////////////////////////////////////////////////////////////////////////////////////
////////////////// FRD MAIN SCRIPT FOR TDR & OUTPUT MAKING
////////////////////////////////////////////////////////////////////////////////////
         $FR_OUTPUT_HTML = "";
    
              

                 try{

                  $q_allbrandsee="SELECT * FROM frd_brandss LIMIT $FR_start,$limit";
                  $FRQ = $FR_CONN->query("$q_allbrandsee");
                  $FRc_RowsNum = $FRQ->rowCount();
                  for($i=1;$i<=$FRc_RowsNum;$i++){//for loop start
                        $row_allbrandsee = $FRQ->fetch();
                        $bs_brand_en_name=$row_allbrandsee['en_name'];
                        $bs_brand_bn_name=$row_allbrandsee['bn_name'];
                        $bs_brand_slugg=$row_allbrandsee['slugg'];  
                        $bs_brand_thumbpicc=$row_allbrandsee['thumb_picc'];
                        $bs_brand_thumbpiccpath="$FRD_HURL/frd-data/img/brands_thum/$bs_brand_thumbpicc"; 

                        $FR_OUTPUT_HTML .="
                        <div class='col-xs-6 col-sm-3 col-md-2'>
                        <div class='frs_brandbox_1'>
                          <a href='$FRD_HURL/brand/$bs_brand_slugg'>
                            <img src='$bs_brand_thumbpiccpath' alt='' class='img-responsive' style=''>
                            <h4 class='title'>$bs_brand_bn_name</h4>
                            </a>
                        </div>
                        </div>
                      ";    
                      
                  }//for loop end
              
              }catch(PDOException $e){
                  echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                  echo "ERROR LINE: " .$e->getline() . "<br>";
                  echo "ERROR CODE: " .$e->getCode() . "<br>";
                  echo "ERROR FILE: " .$e->getFile() . "<br>";
              }
    
    
         echo "$FR_OUTPUT_HTML";



    



 require_once("../1frl_foot.php");
    
}    