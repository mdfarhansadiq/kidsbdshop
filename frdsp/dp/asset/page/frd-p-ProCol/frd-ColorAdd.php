<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Color Add";//PAGE TITLE
$p="ColorAdd";//PAGE NAME
$inn="";
$FRc_THIS_P_ID = 24;//THIS PANEL ID [24=COLOR MANEGMENT PANEL]
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Color Add </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    

   
<!-- <h2 class = "PT"> Add colors </h2> -->

<!-- 1 scripts-->
<section>
<?php
/////////////////////////////////////////////////////
///////////////////                  ///////////////
////////////////////////////////////////////////////
if(isset($_POST['add_new_color_sub'])){
$color_en_name=$_POST['f_color_name'];
$FRc_Status = 1;

$f_slug_name_strtolower=strtolower("$color_en_name");
$f_slug_name_mody=preg_replace("/ /","-",$f_slug_name_strtolower);   

        //FRD DATA INSERT S:-
        try{
            $FRQ = "INSERT INTO frd_colorr 
            (en_name, slugg, statuss, byy, datee, timee) 
            VALUES 
            (:en_name, :slugg, :statuss, :byy, :datee, :timee)";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':en_name', $color_en_name, PDO::PARAM_STR);
            $FRQ->bindParam(':slugg', $f_slug_name_mody, PDO::PARAM_STR);
            $FRQ->bindParam(':statuss', $FRc_Status, PDO::PARAM_STR);
            $FRQ->bindParam(':byy', $UsrId, PDO::PARAM_STR);
            $FRQ->bindParam(':datee', $FR_NOW_DATE, PDO::PARAM_STR);
            $FRQ->bindParam(':timee', $FR_NOW_TIME, PDO::PARAM_STR);
            $FRQ->execute();
            $last_insert_id = $FR_CONN->lastInsertId();
            FR_SWAL("COLOR ADD DONE","","success");
        }catch(PDOException $e){
            FR_SWAL("COLOR ADD FAILED","","error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
        }
        //END>>

}
    
?>
</section>  
   





<div class="container">
<div class="col-md-11">


    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="jumbotron"  id="" action="" method="post">
                 <input class="form-control" type="text"  name="f_color_name" placeholder="Input color name" required>
                 <br>
                 <div class="text-right">
                     <input class="btn btn-success" type="submit" name="add_new_color_sub" value="Confirm & add">
                 </div>
            </form>  
        </div>
        <div class="col-md-4"></div>
    </div>




    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="TRetINFO table table-bordered">
                <tr class="TH">
                    <td>ID</td>
                    <td>Color Name</td>
                    <td>Time</td>
                </tr> 
                
                   <?php 
                      $q_frd="SELECT * from frd_colorr where statuss=1 ORDER BY id DESC";
                      require_once("$rtd_path/1_frd.php");
                      if($rowsnum_frd>0){
                      for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
                      require("$rtd_path/color_t_frd.php"); 
                          
                        echo "
                         <tr>
                            <td> $Color_ID </td>
                            <td> $color_en_name </td>
                            <td>".date('d-M-Y h:i:s a',$color_time)."</td>
                        </tr>
                        ";
                      }//For Loop E    
                      }else{
                        $alert_frd_r="Have Not been Found Any Color!";  
                      }
                      ?>
                
            </table>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>
</div>







<?php require_once('frd1_footer.php'); ?>   