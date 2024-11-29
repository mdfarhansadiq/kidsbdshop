<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product Landing Page Customize ";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="ProductLandingPageCustomize";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Product Landing Page Customize  </h2>


<!-- 1 SCRIPT START -->   
<section>
<?php 

if(isset($_POST['frtc_delifreeimg_s_dp'])){
    $frtc_catpath_dp = $_POST['frtc_catpath_dp']; 
    $frtc_pro_title_dp = $_POST['frtc_pro_title_dp']; 
    $frtc_pro_id_dp = $_POST['frtc_pro_id_dp']; 
    $frtc_pro_instock_dp = $_POST['frtc_pro_instock_dp']; 
    $frtc_delifreeimg_s_dp = $_POST['frtc_delifreeimg_s_dp']; 
    $frtc_atc_btn_dp = $_POST['frtc_atc_btn_dp']; 
    $frtc_on_btn_dp = $_POST['frtc_on_btn_dp']; 
    $frtc_co_btn_dp = $_POST['frtc_co_btn_dp']; 
    $frtc_wpo_btn_dp = $_POST['frtc_wpo_btn_dp']; 
    $frtc_callfororder_s_dp = $_POST['frtc_callfororder_s_dp'];
    $frtc_delicharg_s_dp = $_POST['frtc_delicharg_s_dp'];
    $frtc_notes_s_dp = $_POST['frtc_notes_s_dp'];
    $frtc_offerpro_s_dp = $_POST['frtc_offerpro_s_dp'];
    $frtc_relatedproshow_s_dp = $_POST['frtc_relatedproshow_s_dp'];
    $frtc_order_btng2_dp = $_POST['frtc_order_btng2_dp'];
    $frtc_pro_view_dp = $_POST['frtc_pro_view_dp'];
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_catpath_dp = :frtc_catpath_dp,
                frtc_pro_title_dp = :frtc_pro_title_dp,
                frtc_pro_id_dp = :frtc_pro_id_dp,
                frtc_pro_instock_dp = :frtc_pro_instock_dp,
                frtc_pro_view_dp = :frtc_pro_view_dp,
                frtc_delifreeimg_s_dp = :frtc_delifreeimg_s_dp,
                frtc_atc_btn_dp = :frtc_atc_btn_dp,
                frtc_on_btn_dp = :frtc_on_btn_dp,
                frtc_co_btn_dp = :frtc_co_btn_dp,
                frtc_wpo_btn_dp = :frtc_wpo_btn_dp,
                frtc_callfororder_s_dp = :frtc_callfororder_s_dp, 
                frtc_delicharg_s_dp = :frtc_delicharg_s_dp, 
                frtc_notes_s_dp = :frtc_notes_s_dp, 
                frtc_offerpro_s_dp = :frtc_offerpro_s_dp, 
                frtc_relatedproshow_s_dp = :frtc_relatedproshow_s_dp, 
                frtc_order_btng2_dp = :frtc_order_btng2_dp 
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_catpath_dp', $frtc_catpath_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_pro_title_dp', $frtc_pro_title_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_pro_id_dp', $frtc_pro_id_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_pro_instock_dp', $frtc_pro_instock_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_pro_view_dp', $frtc_pro_view_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_delifreeimg_s_dp', $frtc_delifreeimg_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_atc_btn_dp', $frtc_atc_btn_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_on_btn_dp', $frtc_on_btn_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_co_btn_dp', $frtc_co_btn_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_wpo_btn_dp', $frtc_wpo_btn_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_callfororder_s_dp', $frtc_callfororder_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_delicharg_s_dp', $frtc_delicharg_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_notes_s_dp', $frtc_notes_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_offerpro_s_dp', $frtc_offerpro_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_relatedproshow_s_dp', $frtc_relatedproshow_s_dp, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_order_btng2_dp', $frtc_order_btng2_dp, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}


//FRD UPDATRE - LP DELIVERY CHARGE HINKS INSIDE DHAKA:-
if(isset($_POST['f_pagebody_12'])){
    $f_pagebody = $_POST['f_pagebody_12']; 
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 12";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Message Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}

//FRD UPDATRE - LP DELIVERY CHARGE HINKS OUTSIDE DHAKA:-
if(isset($_POST['f_pagebody_13'])){
    $f_pagebody = $_POST['f_pagebody_13']; 
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 13";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Message Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}

//FRD UPDATRE - LP NOTES SECTION DATA :-
if(isset($_POST['f_pagebody_14'])){
    $f_pagebody = $_POST['f_pagebody_14']; 
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 14";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Message Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
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
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">

                        <span>Product Category Path </span><br>
                        <input type="radio" name="frtc_catpath_dp" value="1" <?php if ($frtc_catpath_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_catpath_dp" value="0" <?php if ($frtc_catpath_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Product Title </span><br>
                        <input type="radio" name="frtc_pro_title_dp" value="1" <?php if ($frtc_pro_title_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_pro_title_dp" value="0" <?php if ($frtc_pro_title_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Product Id </span><br>
                        <input type="radio" name="frtc_pro_id_dp" value="1" <?php if ($frtc_pro_id_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_pro_id_dp" value="0" <?php if ($frtc_pro_id_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Product View Counter </span><br>
                        <input type="radio" name="frtc_pro_view_dp" value="1" <?php if ($frtc_pro_view_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_pro_view_dp" value="0" <?php if ($frtc_pro_view_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Product InStock </span><br>
                        <input type="radio" name="frtc_pro_instock_dp" value="1" <?php if ($frtc_pro_instock_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_pro_instock_dp" value="0" <?php if ($frtc_pro_instock_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Delivery Charge Free Alert </span><br>
                        <input type="radio" name="frtc_delifreeimg_s_dp" value="1" <?php if ($frtc_delifreeimg_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_delifreeimg_s_dp" value="0" <?php if ($frtc_delifreeimg_s_dp == "0") { echo "checked";} ?> required> Hide


                        <br><br>
                        <span>Add To Cart Button  </span><br>
                        <input type="radio" name="frtc_atc_btn_dp" value="1" <?php if ($frtc_atc_btn_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_atc_btn_dp" value="0" <?php if ($frtc_atc_btn_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Order Now / Buy Now Button </span><br>
                        <input type="radio" name="frtc_on_btn_dp" value="1" <?php if ($frtc_on_btn_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_on_btn_dp" value="0" <?php if ($frtc_on_btn_dp == "0") { echo "checked";} ?> required> Hied

                        <br><br>
                        <span>Call Order Button </span><br>
                        <input type="radio" name="frtc_co_btn_dp" value="1" <?php if ($frtc_co_btn_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_co_btn_dp" value="0" <?php if ($frtc_co_btn_dp == "0") { echo "checked";} ?> required> Hied


                        <br><br>
                        <span>Whatsapp Order Button </span><br>
                        <input type="radio" name="frtc_wpo_btn_dp" value="1" <?php if ($frtc_wpo_btn_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_wpo_btn_dp" value="0" <?php if ($frtc_wpo_btn_dp == "0") { echo "checked";} ?> required> Hied




                        <br><br>
                        <span>Orders Button Group 2 Section</span><br>
                        <input type="radio" name="frtc_order_btng2_dp" value="1" <?php if ($frtc_order_btng2_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_order_btng2_dp" value="0" <?php if ($frtc_order_btng2_dp == "0") { echo "checked";} ?> required> Hide



                        <br><br>
                        <span>Call For Order Section</span><br>
                        <input type="radio" name="frtc_callfororder_s_dp" value="1" <?php if ($frtc_callfororder_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_callfororder_s_dp" value="0" <?php if ($frtc_callfororder_s_dp == "0") { echo "checked";} ?> required> Hide


                        <br><br>
                        <span>Delivery Charge Hinks Section</span><br>
                        <input type="radio" name="frtc_delicharg_s_dp" value="1" <?php if ($frtc_delicharg_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_delicharg_s_dp" value="0" <?php if ($frtc_delicharg_s_dp == "0") { echo "checked";} ?> required> Hide


                        <br><br>
                        <span>Note Section</span><br>
                        <input type="radio" name="frtc_notes_s_dp" value="1" <?php if ($frtc_notes_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_notes_s_dp" value="0" <?php if ($frtc_notes_s_dp == "0") { echo "checked";} ?> required> Hide


                        <br><br>
                        <span>Offer Product Show Section</span><br>
                        <input type="radio" name="frtc_offerpro_s_dp" value="1" <?php if ($frtc_offerpro_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_offerpro_s_dp" value="0" <?php if ($frtc_offerpro_s_dp == "0") { echo "checked";} ?> required> Hide



                        <br><br>
                        <span>Related Product Show Section</span><br>
                        <input type="radio" name="frtc_relatedproshow_s_dp" value="1" <?php if ($frtc_relatedproshow_s_dp == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_relatedproshow_s_dp" value="0" <?php if ($frtc_relatedproshow_s_dp == "0") { echo "checked";} ?> required> Hide


                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
            </div>
           </div>
          

            <div class="row">
                <?php 
                 //FRD PAGE TABLE DATA READ:-
                    $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 12","");
                    if($FRR['FRA']==1){ 
                    extract($FRR['FRD']);
                    } else{ ECHO_4($FRR['FRM']); }
                    //END>>
                ?>
                <div class="col-md-12 jumbotron">
                <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                    <span>Inside Dhaka Delivery Charge Message</span><br>
                    <textarea class="form-control" name="f_pagebody_12" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>
                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
                </div> 
            </div>


            <div class="row">
                <?php 
                 //FRD PAGE TABLE DATA READ:-
                    $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 13","");
                    if($FRR['FRA']==1){ 
                    extract($FRR['FRD']);
                    } else{ ECHO_4($FRR['FRM']); }
                    //END>>
                ?>
                <div class="col-md-12 jumbotron">
                <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                    <span>Outside Dhaka Delivery Charge Message</span><br>
                    <textarea class="form-control" name="f_pagebody_13" id="summernote2" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>
                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
                </div> 
            </div>



            <div class="row">
                <?php 
                 //FRD PAGE TABLE DATA READ:-
                    $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 14","");
                    if($FRR['FRA']==1){ 
                    extract($FRR['FRD']);
                    } else{ ECHO_4($FRR['FRM']); }
                    //END>>
                ?>
                <div class="col-md-12 jumbotron">
                <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                    <span>Product Landing Page Note Message</span><br>
                    <textarea class="form-control" name="f_pagebody_14" id="summernote3"><?php echo "$page_body_en"?></textarea>
                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
                </div> 
            </div>


        </div>
    </div>
</section>






<?php require_once('frd1_footer.php'); ?>   

<script type="text/javascript">
  $('#summernote2').summernote();
  $('#summernote3').summernote();
</script>