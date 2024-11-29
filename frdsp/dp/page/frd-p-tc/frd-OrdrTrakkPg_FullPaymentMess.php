<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Full Payment Message";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Full Payment Message </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

if(isset($_POST['frtc_full_pay'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_full_pay = :frtc_full_pay
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_full_pay', $frtc_full_pay, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}

?>   
</section>
<!-- 1 SCRIPT END -->    

   


<!-- <br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

            
                <form class="" id="" action="" method="post">

                  <div class="jumbotron">

                        <span>Full Payment  </span><br>
                        <input type="radio" name="frtc_full_pay" value="1" <?php if ($frtc_full_pay == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="frtc_full_pay" value="0" <?php if ($frtc_full_pay == "0") { echo "checked";} ?> required> No


                        <br>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                        </div>
                
                  </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</section> -->



<?php if(!isset($_GET['iamfrd'])){ FR_COMMING_SOON(); } ?>




<?php require_once('frd1_footer.php'); ?>   