<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Delivery Charge";//PAGE TITLE
$p="shipzone";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Delivery Charge Update</h2>


<!-- 1 SCRIPT S -->
<section>
<?php
//---------------------------------------------------------
//FRD # DATA UPDATE
//---------------------------------------------------------
if(isset($_POST['FRD_SHIP_ZONE_UP_SUB'])){
//    PR($_POST);
   $f_rowid = $_POST['f_rowid'];
   $f_ShipZoneName = $_POST['f_ShipZoneName'];
   $f_ShipCharge = $_POST['f_ShipCharge'];

            $FRQ = "UPDATE frd_ship_zone SET 
            fr_sz_name = '$f_ShipZoneName',
            fr_sz_shipcost = '$f_ShipCharge'
            WHERE id = $f_rowid";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("$UsrName  তথ্য আপডেট হয়েছে ","","success");
            }else{
                FR_SWAL("$UsrName  তথ্য আপডেট হয়নি ","","error");
            }
    // FR_GO("$FR_THIS_PAGE","2");
    // exit;
}
//END>>



if(isset($_POST['frtc_OrdrTimeIagree'])){
       extract($_POST); 
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_cf_divdistha = :frtc_cf_divdistha,
                FR_Dfild_Note = :FR_Dfild_Note,
                frtc_OrdrTimeIagree = :frtc_OrdrTimeIagree,
                frd_order_mintk = :frd_order_mintk,
                frtc_cf_fildadress_r = :frtc_cf_fildadress_r
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_cf_divdistha', $frtc_cf_divdistha, PDO::PARAM_STR);
                $FRQ->bindParam(':frtc_OrdrTimeIagree', $frtc_OrdrTimeIagree, PDO::PARAM_STR);
                $FRQ->bindParam(':FR_Dfild_Note', $FR_Dfild_Note, PDO::PARAM_STR);
                $FRQ->bindParam(':frd_order_mintk', $frd_order_mintk, PDO::PARAM_STR);
                $FRQ->bindParam(':frtc_cf_fildadress_r', $frtc_cf_fildadress_r, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
                FR_GO("$FR_THIS_PAGE","2");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}




//FRD ADD :-------------------------------------------------
if(isset($_POST['FRDO_AddNewDeliveryZone'])){
        $arr = array();
        $arr['fr_sz_shipcost'] = 0;
        $FRR = FR_DATA_IN("frd_ship_zone",$arr);
        if($FRR['FRA']==1){
            FR_SWAL("Dear Boss $UsrName","Add Done","success");
        }else{
            FR_SWAL("Dear Boss $UsrName",$R['FRM'],"error");
        }             
}
//END ADD>>
?>
</section>
<!-- 1 SCRIPT E -->




<section>
<div class="container">
<div class="col-md-11">

    
   <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8 jumbotron">
        <form action="" method="POST">

                <span> Division District Thana Select </span><br>
                <input type="radio" name="frtc_cf_divdistha" value="1" <?php if ($frtc_cf_divdistha == 1) { echo "checked";} ?> required> Need &#160; &#160;&#160;
                <input type="radio" name="frtc_cf_divdistha" value="0" <?php if ($frtc_cf_divdistha == 0) { echo "checked";} ?> required> Not Need


                <br><br>
                <span>Delivery Address Priority </span><br>
                <input type="radio" name="frtc_cf_fildadress_r" value="1" <?php if ($frtc_cf_fildadress_r == 1) { echo "checked";} ?> required> Required &#160; &#160;&#160;
                <input type="radio" name="frtc_cf_fildadress_r" value="0" <?php if ($frtc_cf_fildadress_r == 0) { echo "checked";} ?> required> Optional

            
                <br><br>
                <span>Delivery Note Box </span><br>
                <input type="radio" name="FR_Dfild_Note" value="YES" <?php if ($FR_Dfild_Note == "YES") { echo "checked";} ?> required> Need &#160; &#160;&#160;
                <input type="radio" name="FR_Dfild_Note" value="NO" <?php if ($FR_Dfild_Note == "NO") { echo "checked";} ?> required> No Need


                <br><br>
                <span>Checkout Form I Agrree Checkbox </span><br>
                <input type="radio" name="frtc_OrdrTimeIagree" value="YES" <?php if ($frtc_OrdrTimeIagree == "YES") { echo "checked";} ?> required> Need &#160; &#160;&#160;
                <input type="radio" name="frtc_OrdrTimeIagree" value="NO" <?php if ($frtc_OrdrTimeIagree == "NO") { echo "checked";} ?> required> No Need

                <br><br>
                <span>Minimum Order Amount</span>
                <select class='form-control' name='frd_order_mintk' required>
                    <option value='<?php echo "$frd_order_mintk";?>'><?php echo "$frd_order_mintk";?></option>
                    <option value='1.00'>1</option>
                    <option value='10.00'>10</option>
                    <option value='100.00'>100</option>
                    <option value='300.00'>300</option>
                    <option value='500.00'>500</option>
                    <option value='1000.00'>1000</option>
                    <option value='2000.00'>2000</option>
                </select>

            <br><br>    
            <div class='text-right'>
            <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
            </div>  
        </form>
                            
     </div>
     <div class="col-md-2"></div>
   </div>

   <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
        <?php
         $FRR = FR_QSEL("SELECT * FROM frd_ship_zone ORDER BY id ASC","ALL");
         if($FRR['FRA']==1){ 
                echo "<table class='table table-bordered table-striped'>";
                echo "
                    <tr class='h6 text-white bg-dark'>
                        <td>SL</td>
                        <td>Delivery Zone</td>
                        <td class='text-right'>Delivery Charge</td>
                        <td class='text-right'>Action</td>
                    </tr>
                ";
         
                        $FRc_SL = 1;
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);

                            echo "<form action='' method='POST'>";
                            
                                echo "
                                 <input type='hidden' name='f_rowid' value='$id' required>
                                    <tr>
                                        <td>$FRc_SL</td>
                                        <td class='text-right' style=''>
                                           <input type='text' class='form-control'  placeholder='লিখুন' name='f_ShipZoneName'  value='$fr_sz_name'>
                                           
                                        </td>
                                        <td class='text-right' style='width:110px;'>
                                           <input type='number' class='form-control' placeholder='লিখুন' name='f_ShipCharge' value='$fr_sz_shipcost' >
                                        </td>
                                        <td class='text-right' style='width:110px;'>
                                            <div class='text-right'>
                                                <button type='submit' class='btn btn-success' name='FRD_SHIP_ZONE_UP_SUB'> <span class='glyphicon glyphicon-flash'></span> Save </button>
                                            </div>
                                        </td>
                                    </tr> 
                                ";
                            echo "</form>";
                                
                            $FRc_SL = ($FRc_SL + 1);
                        }
                
                echo "</table>";
                
         } else{ 
           //   PR($FRR);
           echo "<div class='text-center alert alert-danger'> কোন তথ্য পাওয়া যায়নি।  সবগুলো অ্যাড করা হয়ে গেছে।  </div>";
         }
        ?>



    <form action="" method="POST">
        <div class='text-center'>
           <button type='submit' class='btn btn-danger' name="FRDO_AddNewDeliveryZone"> <span class='glyphicon glyphicon-plus'></span> Add New Delivery Zone </button>
        </div>  
    </form>

    </div>
    <div class="col-md-2"></div>
   </div>

</div>
</div>
</section>   

   




<?php require_once('frd1_footer.php'); ?>