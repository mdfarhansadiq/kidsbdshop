<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Payment Message";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT">Payment Message </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php   

//FRD PARCIAL PAYMENT MESSAGE DATA UPDATE:-
if(isset($_POST['f_pagebody'])){
    $f_pagebody = $_POST['f_pagebody'];
    $frtc_parti_pay = $_POST['frtc_parti_pay'];
    $frtc_parti_pay_tk = $_POST['frtc_parti_pay_tk'];
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_parti_pay = :frtc_parti_pay, 
                frtc_parti_pay_tk = :frtc_parti_pay_tk 
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_parti_pay', $frtc_parti_pay, PDO::PARAM_INT);
                $FRQ->bindParam(':frtc_parti_pay_tk', $frtc_parti_pay_tk, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Update Done","success");

                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 19";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");

                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
//END>>




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



if(isset($_POST['frtc_any_pay'])){
    extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_themeconfig SET 
                frtc_any_pay = :frtc_any_pay
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtc_any_pay', $frtc_any_pay, PDO::PARAM_INT);
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
        <?php
        //FRD PAGE TABLE DATA READ:-
        $FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 19","");
        if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
        } else{ ECHO_4($FRR['FRM']); }
        //END>>
        ?>
        <div class="container">
            <div class="col-md-11">

                <div class="row">
                <div class="col-md-12 jumbotron">

                <h3 class="text-center text-success boldd">Partial Payment Message</h3>

                <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >

                    <span>Partial Payment Message </span><br>
                    <input type="radio" name="frtc_parti_pay" value="1" <?php if ($frtc_parti_pay == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                    <input type="radio" name="frtc_parti_pay" value="0" <?php if ($frtc_parti_pay == "0") { echo "checked";} ?> required> Hide

                    
                    <br><br>
                    <span>Partial Payment Amount *</span>
                    <input class="form-control" type="number" placeholder="লিখুন *" name="frtc_parti_pay_tk" value="<?php echo "$frtc_parti_pay_tk"; ?>" required>

                    <br>
                    <span>Partial Payment Message *</span>
                    <textarea class="form-control" name="f_pagebody" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>

                    <div class='text-right'>
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