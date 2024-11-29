<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Home Page Section Show Hied"; //PAGE TITLE
$p = "HomePageConfig"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Home Page Config </h2> -->
<br>

<!-- 1 SCRIPT START -->
<section>
<?php

if(isset($_POST['FRTRIG_SecSHowHiedSave'])){
    extract($_POST);
    $FRc_SL = 1;
    $FRc_ARRCOUNT = count($_POST);
    foreach($_POST AS $FR_KEY => $FR_VAL){
        try{
            $FR_CONN->exec("UPDATE frd_hpserial SET fr_hp_sec_stat = '$FR_VAL' WHERE fr_hp_sec_name = '$FR_KEY'");
            if($FRc_SL == $FRc_ARRCOUNT){ FR_SWAL("Dear Boss $UsrName!","Update Done","success"); }
        }catch(PDOException $e){
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            FR_SWAL("Dear Boss $UsrName!"," Update Failed","error");
        }
        $FRc_SL = ($FRc_SL + 1);
    }
       
}


//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_hpconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>


//FRD  DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themeconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

?>
</section>
<!-- 1 SCRIPT END -->



<section>
<div class="container">

   <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 jumbotron">
        <form action="" method="POST">
            <h3 class="text-center text-primary boldd">Home Page Section Show / Hied</h3>
            <?php
            $FRR = FR_QSEL("SELECT * FROM frd_hpserial WHERE fr_hp_sec_stat IN(1,2) ORDER BY fr_hp_sec_serial ASC","ALL");
            if($FRR['FRA']==1){ 
                    echo "<table id='#' class='table table-bordered table-striped'>";
                    echo "
                    <thead>
                        <tr class='h4 alert alert-success'>
                            <td>Section Name</td>
                            <td>Show</td>
                            <td>Hied</td>
                        </tr>
                    </thead>
                    <tbody class='row_position'>
                    ";
            
                            $FRc_SL = 1;
                            foreach($FRR['FRD'] as $FR_ITEM){
                                extract($FR_ITEM);

                                $FRc_Chacked_Show = "";
                                $FRc_Chacked_Hide = "";
                                if ($fr_hp_sec_stat == '1') { $FRc_Chacked_Show = 'checked';}
                                if ($fr_hp_sec_stat == '2') { $FRc_Chacked_Hide = 'checked';}

                                    echo "
                                        <tr>
                                            <td>$fr_hp_sec_dp_name</td>
                                            <td>
                                            <input type='radio' name='$fr_hp_sec_name' value='1' $FRc_Chacked_Show required>
                                            </td>
                                            <td>
                                            <input type='radio' name='$fr_hp_sec_name' value='2' $FRc_Chacked_Hide required>
                                            </td>
                                        </tr> 
                                    ";
                                    
                                    
                                $FRc_SL = ($FRc_SL + 1);
                            }
                    
                    echo "</tbody> </table>";
            } else{ 
            //   PR($FRR);
            echo "<div class='text-center alert alert-danger'>  NO DATA FOUND  </div>";
            }
            ?>

        <div class="text-right">
            <input class="btn btn-success" type="submit" value="Confirm & Update" name="FRTRIG_SecSHowHiedSave">
        </div>
    </form>
    </div>
    <div class="col-md-3"></div>
   </div>

</div>
</section>






<script>
    	$(document).ready(function() {

		});

</script>




<?php require_once('frd1_footer.php'); ?>