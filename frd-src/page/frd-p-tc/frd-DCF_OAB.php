<?php 
require_once('frd1_whoami.php');
$FR_ptitle="DCF OAB";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT">Delivery Charge Free Order Amount Based </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php   

//FRD PARCIAL PAYMENT MESSAGE DATA UPDATE:-
if(isset($_POST['frtc_dcf_oab_amount'])){
   extract($_POST);
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_dcf_oab_amount = :frtc_dcf_oab_amount
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_dcf_oab_amount', $frtc_dcf_oab_amount, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Update Done","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
//END>>



?>   
</section>
<!-- 1 SCRIPT END -->    





    <br>
    <section>
        <div class="container">
            <div class="col-md-11">

                <div class="row">
                <div class="col-md-12 jumbotron">

                <h3 class="text-center text-success boldd">Delivery Charge Free Order Amount Based</h3>

                <form id="" class="pageditform" action="" method="post">

                     <?php 
                      if($frtc_dcf_oab_amount > 0 ){
                        echo "<span class='label label-success'>Active This feature right now </span>";
                      }
                      if($frtc_dcf_oab_amount == 0 ){
                        echo "<span class='label label-danger'>Off This feature right now </span>";
                      }
                     ?>
                        
                
                    <br><br>
                    <span>Delivery Charge Free For This Amount *</span>
                    <input class="form-control" type="number" placeholder="লিখুন *" name="frtc_dcf_oab_amount" value="<?php echo "$frtc_dcf_oab_amount"; ?>" required>

 
                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  

                </form>

                </div> 
                </div>


            </div>
        </div>
    </section>

   


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




<!-- <br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="" id="" action="" method="post">

                  <div class="jumbotron">
                        <span>Any Payment  </span><br>
                        <input type="radio" name="frtc_any_pay" value="1" <?php if ($frtc_any_pay == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
                        <input type="radio" name="frtc_any_pay" value="0" <?php if ($frtc_any_pay == "0") { echo "checked";} ?> required> No

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





<?php require_once('frd1_footer.php'); ?>   