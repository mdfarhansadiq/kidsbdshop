<?php
//P:::PRODUCT SEARCH SAJATION FETCHING.
if(isset($_POST["fr_produ"])){

    $FR_PATH_HD = "../../../../../../";
    $rtd_path = $FR_PATH_HD."rtd";
    require_once($FR_PATH_HD."/frd-src/abc/frd-config.php");
    
$fr_produx = $_POST["fr_produ"];
$FR_t_1L = substr($fr_produx, 0, 1);// TAG 1ST LATER  
    
$q_1x = "SELECT distinct(tagg) FROM frd_products WHERE statuss = 1 AND pro_typ = 1 AND qtyy >= 0 AND tagg LIKE '%,$fr_produx%' LIMIT 0,100";
$FRQ = $FR_CONN->query("$q_1x");
$rowsnum_1x = $FRQ->rowCount();
$FR_output = "<ul>";
if($rowsnum_1x>0){
    for($i=1;$i<=$rowsnum_1x;$i++){//For Loop S
        $row_1x = $FRQ->fetch();
           $FR_ss_tag=$row_1x['tagg'];
           //FRD EXPLOED INNI:-
            $FR_ss_tag_explo=explode(',',$FR_ss_tag); 
            foreach ($FR_ss_tag_explo as $item) {
                //if($item != ""){
                   $FR_i_1L=substr($item, 0, 1);//ITEM 1ST LATER
                   if("$FR_i_1L"=="$FR_t_1L"){
                       $FR_output .= "<li>$item</li>";
                   }
                //}
            }
        
    }
}else{
    $FR_output .= "<li>No Tag Found</li>";
}

$FR_output .= "</ul>";
    
echo "$FR_output";    
    
}