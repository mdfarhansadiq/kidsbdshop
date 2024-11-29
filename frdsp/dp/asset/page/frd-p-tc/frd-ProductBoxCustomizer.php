<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product Box Customizer";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Product Box Customizer </h2>


<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['FRcf_ProBoxNum'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                FRcf_ProBoxNum = :FRcf_ProBoxNum,
                frtc_on_btn_trig = :f_frtc_on_btn_trig
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':FRcf_ProBoxNum', $FRcf_ProBoxNum, PDO::PARAM_INT);
                $FRQ->bindParam(':f_frtc_on_btn_trig', $f_frtc_on_btn_trig, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}
?>   
</section>
<!-- 1 SCRIPT END -->    

   


<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
             <div class="col-md-6 jumbotron">
                <form id="" action="" method="post">
                        <span>Product Box Number </span>
                        <select class='form-control' name='FRcf_ProBoxNum' required>
                                <option value='<?php echo "$FRcf_ProBoxNum";?>'><?php echo "ProductBox $FRcf_ProBoxNum";?></option>
                                <option value='1'>ProductBox 1</option>
                                <option value='2'>ProductBox 2</option>
                                <option value='3'>ProductBox 3</option>
                                <option value='4'>ProductBox 4</option>
                                <option value='5'>ProductBox 5</option>
                                <option value='6'>ProductBox 6</option>
                                <option value='7'>ProductBox 7</option>
                                <option value='8'>ProductBox 8</option>
                        </select>

                        <br>
                        <span>After Click Order Now Button</span>
                        <select class='form-control' name='f_frtc_on_btn_trig' required>
                            <?php 
                            if($frtc_on_btn_trig == "frdtrig_atc"){
                                echo "<option value='frdtrig_atc'>Redirect  To Checkout Page</option>";
                            }
                            if($frtc_on_btn_trig == "frdtrig_showpopupcheckoutf"){
                                echo "<option value='frdtrig_showpopupcheckoutf'> Popup Checkout </option>";
                            }
                            ?>
                          <option value='frdtrig_atc'> Redirect  To Checkout Page  </option>
                          <option value='frdtrig_showpopupcheckoutf'> Popup Checkout </option>

                        </select>

                    
                    <div class="text-right">
                        <br>
                        <input class="btn btn-success" type="submit" value="Confirm & Update" name="do_topnaveofferdata_update">
                    </div>
                </form>
             </div>
            <div class="col-md-3"></div>
        </div>
        
    
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   