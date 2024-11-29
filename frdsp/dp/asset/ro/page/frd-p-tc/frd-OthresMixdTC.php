<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Headline Text";//PAGE TITLE
$p="EditHeadlineText";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Theme Customizer </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frtc_lang'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                FR_MaxOrdQty = :FR_MaxOrdQty,
                frtc_lang = :frtc_lang,
                Frtc_category_t_cs = :Frtc_category_t_cs,
                frtc_cat_baner_dp = :frtc_cat_baner_dp,
                frd_gom = :frd_gom,
                frtc_app_d_btn = :frtc_app_d_btn
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':FR_MaxOrdQty', $FR_MaxOrdQty, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_lang', $frtc_lang, PDO::PARAM_STR);
                $FRQ->bindParam(':Frtc_category_t_cs', $Frtc_category_t_cs, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_cat_baner_dp', $frtc_cat_baner_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frd_gom', $frd_gom, PDO::PARAM_STR);
                $FRQ->bindParam(':frtc_app_d_btn', $frtc_app_d_btn, PDO::PARAM_INT);
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



if(isset($_POST['frtcplug_GTMdataLayer'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtcplug_GTMdataLayer = :frtcplug_GTMdataLayer
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtcplug_GTMdataLayer', $frtcplug_GTMdataLayer, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}





//FRD OVERWRITE DADA:-
if($frtc_lang == "EN"){$frtc_langM = "English";}
elseif($frtc_lang == "BN"){$frtc_langM = "বাংলা";}
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

                        <span>Website Language  </span><br>
                        <select class='form-control' name='frtc_lang' required>
                            <option value='<?php echo "$frtc_lang";?>'><?php echo "$frtc_langM";?></option>
                            <option value='EN'>English</option>
                            <option value='BN'>বাংলা</option>
                        </select>


                        <br><br>
                        <span>Popular category slider of category landing page  </span><br>
                        <input type="radio" name="Frtc_category_t_cs" value="1" <?php if ($Frtc_category_t_cs == "1") { echo "checked";} ?> required> Need &#160; &#160;&#160;
                        <input type="radio" name="Frtc_category_t_cs" value="0" <?php if ($Frtc_category_t_cs == "0") { echo "checked";} ?> required> Not Need

                        <br><br>
                        <span>Category Baner of category base product landing page  </span><br>
                        <input type="radio" name="frtc_cat_baner_dp" value="1" <?php if ($frtc_cat_baner_dp == "1") { echo "checked";} ?> required> Need &#160; &#160;&#160;
                        <input type="radio" name="frtc_cat_baner_dp" value="0" <?php if ($frtc_cat_baner_dp == "0") { echo "checked";} ?> required> Not Need


                        <br><br>
                        <span>Guest Order Mode  </span><br>
                        <input type="radio" name="frd_gom" value="frd_on" <?php if ($frd_gom == "frd_on") { echo "checked";} ?> required> On &#160; &#160;&#160;
                        <input type="radio" name="frd_gom" value="frd_off" <?php if ($frd_gom == "frd_off") { echo "checked";} ?> required> Off


                        <br><br><br>
                        <span>Max Order Qty </span>
                        <select class='form-control' name='FR_MaxOrdQty' required>
                                <option value='<?php echo "$FR_MaxOrdQty";?>'><?php echo "$FR_MaxOrdQty";?></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='10'>10</option>
                                <option value='30'>30</option>
                                <option value='90'>90</option>
                        </select>


                        <br><br>
                        <span>App Download Button </span><br>
                        <input type="radio" name="frtc_app_d_btn" value="1" <?php if ($frtc_app_d_btn == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_app_d_btn" value="0" <?php if ($frtc_app_d_btn == "0") { echo "checked";} ?> required> Hied


 
                    
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



<?php if($frtex_GTM4DL == 1){ ?>
    <section>
    <div class="container">
        <div class="row mt-10">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h3 class="text-center text-success boldd">GTM4 Data Layer</h3>
            
                <form class="" id="" action="" method="post">

                    <span>GTM Data Layer Plugin </span><br>
                    <input type="radio" name="frtcplug_GTMdataLayer" value="1" <?php if ($frtcplug_GTMdataLayer == "1") { echo "checked";} ?> required> Activated &#160; &#160;&#160;
                    <input type="radio" name="frtcplug_GTMdataLayer" value="0" <?php if ($frtcplug_GTMdataLayer == "0") { echo "checked";} ?> required> Deactivated


                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>







<?php require_once('frd1_footer.php'); ?>