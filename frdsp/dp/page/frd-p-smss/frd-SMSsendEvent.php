<?php 
require_once('frd1_whoami.php');
$FR_ptitle="SMS Send Event Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> SMS Send Event Customize </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
 if(isset($_POST['frsmsc_sta_nopa'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_soft_config SET 
                frsmsc_stc_otl = :frsmsc_stc_otl,
                frsmsc_sta_nopa = :frsmsc_sta_nopa,
                frsmsc_stc_rrl = :frsmsc_stc_rrl,
                frsmsc_stc_nohold = :frsmsc_stc_nohold,
                frsmsc_stc_nopayp = :frsmsc_stc_nopayp,
                frsmsc_stc_nocan = :frsmsc_stc_nocan,
                frsmsc_stc_nocon = :frsmsc_stc_nocon,
                frsmsc_stc_nosip = :frsmsc_stc_nosip,
                frsmsc_stc_nodc = :frsmsc_stc_nodc,
                frsmsc_stc_npr = :frsmsc_stc_npr
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frsmsc_stc_otl', $frsmsc_stc_otl, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_sta_nopa', $frsmsc_sta_nopa, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_rrl', $frsmsc_stc_rrl, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nohold', $frsmsc_stc_nohold, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nopayp', $frsmsc_stc_nopayp, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nocan', $frsmsc_stc_nocan, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nocon', $frsmsc_stc_nocon, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nosip', $frsmsc_stc_nosip, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_nodc', $frsmsc_stc_nodc, PDO::PARAM_INT);
                $FRQ->bindParam(':frsmsc_stc_npr', $frsmsc_stc_npr, PDO::PARAM_INT);
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

   




<section>
    <div class="container">
    <div class="col-md-11">

      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 jumbotron">
          <form action="" method="POST">
              
              <span>Notify Customer => Order Tracking Link Send </span><br>
              <input type="radio" name="frsmsc_stc_otl" value="1" <?php if ($frsmsc_stc_otl == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_otl" value="0" <?php if ($frsmsc_stc_otl == "0") { echo "checked";} ?> required> No

              <br><br>
              <span>Notify Admin => New Order Placed </span><br>
              <input type="radio" name="frsmsc_sta_nopa" value="1" <?php if ($frsmsc_sta_nopa == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_sta_nopa" value="0" <?php if ($frsmsc_sta_nopa == "0") { echo "checked";} ?> required> No

              <br><br>
              <span> Notify Customer =>  payment received  </span><br>
              <input type="radio" name="frsmsc_stc_npr" value="1" <?php if ($frsmsc_stc_npr == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_npr" value="0" <?php if ($frsmsc_stc_npr == "0") { echo "checked";} ?> required> No

              <hr>

              <br><br>
              <span> Notify Customer =>  Order Hold  </span><br>
              <input type="radio" name="frsmsc_stc_nohold" value="1" <?php if ($frsmsc_stc_nohold == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nohold" value="0" <?php if ($frsmsc_stc_nohold == "0") { echo "checked";} ?> required> No

              <br><br>
              <span> Notify Customer =>  Order Payment Pending  </span><br>
              <input type="radio" name="frsmsc_stc_nopayp" value="1" <?php if ($frsmsc_stc_nopayp == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nopayp" value="0" <?php if ($frsmsc_stc_nopayp == "0") { echo "checked";} ?> required> No

              <br><br>
              <span> Notify Customer =>  Order Canceled  </span><br>
              <input type="radio" name="frsmsc_stc_nocan" value="1" <?php if ($frsmsc_stc_nocan == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nocan" value="0" <?php if ($frsmsc_stc_nocan == "0") { echo "checked";} ?> required> No


              <br><br>
              <span> Notify Customer =>  Order Confirmed  </span><br>
              <input type="radio" name="frsmsc_stc_nocon" value="1" <?php if ($frsmsc_stc_nocon == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nocon" value="0" <?php if ($frsmsc_stc_nocon == "0") { echo "checked";} ?> required> No

              <br><br>
              <span> Notify Customer =>  Order Shipped  </span><br>
              <input type="radio" name="frsmsc_stc_nosip" value="1" <?php if ($frsmsc_stc_nosip == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nosip" value="0" <?php if ($frsmsc_stc_nosip == "0") { echo "checked";} ?> required> No
        
              <br><br>
              <span> Notify Customer =>  Order Delivery Completed  </span><br>
              <input type="radio" name="frsmsc_stc_nodc" value="1" <?php if ($frsmsc_stc_nodc == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_nodc" value="0" <?php if ($frsmsc_stc_nodc == "0") { echo "checked";} ?> required> No



              <hr>
              
      
              <br><br>
              <span>Rating & Review Link Send To Customer </span><br>
              <input type="radio" name="frsmsc_stc_rrl" value="1" <?php if ($frsmsc_stc_rrl == "1") { echo "checked";} ?> required> Yes &#160; &#160;&#160;
              <input type="radio" name="frsmsc_stc_rrl" value="0" <?php if ($frsmsc_stc_rrl == "0") { echo "checked";} ?> required> No


                <br><br>
                <div class="text-right">
                    <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                </div>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>

    </div>
    </div>
</section>






<?php require_once('frd1_footer.php'); ?>   