<?php
require_once('../dbconpath_l.php');
if(isset($_POST['catt_id'])){
    $cattid_loc = $_POST['catt_id'];
    echo "$cattid_loc";      
       
    $q_frd="select * from frd_categoriess where cat_father=$cattid_loc";
    require("$rtd_path/1_frd.php"); 
    for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S 
         require("$rtd_path/catt_t_frd.php");
         echo "$catt_name <br>";
         echo "<div id='$cattid_loc'> </div>";
    }

    if($rowsnum_frd==0){
        echo "not matched";
    }
    
}
?>
<h2>llllllllll</h2>