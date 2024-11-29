<?php
if(isset($_POST["query"])){
$Callingg="FRD";// File access Validaion O Step
require_once('../frd_lconfig.php'); //DB Connaction  
//echo "Search valu: $search_val ";    
 
$frd_search_text=$_POST['query'];    


$start=0;  
$limit=21;

echo "<h5 class='TAC'>You are searching for: <b> $frd_search_text<b></h5>";  

                       $q_frd="select * from frd_brandss WHERE en_name LIKE '%$frd_search_text%' OR bn_name LIKE '%$frd_search_text%' LIMIT $start,$limit";
                        require("$rtd_path/1_frd.php"); 
                        for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
                        require("$rtd_path/brands_t_frd.php");
                        echo "
                         <form action='' method='post'>
                           <input type='hidden' name='brand_info' value='$brand_id/$brand_bn_name' >
                           <button type='submit' class='btn btn-success btn-block'>$brand_bn_name</button>
                           <br>
                         </form>
                          ";
                        }//For Loop E  
    
    
if($rowsnum_frd==0){
    echo "<h4 class='TAC alertt r'> Did not match anything</h4>";
}    

}else{
    echo "<h3 class='TAC alertt'>No Searching.... </h3>";
}