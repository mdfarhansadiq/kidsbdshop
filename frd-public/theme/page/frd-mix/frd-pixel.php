<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cname - $fr_ctagline";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");

?>
<h2 class="PT"> Pixel </h2>
<!-- 1 scripts s-->
<section>
<?php   

if(isset($_POST['f_pixel_setup_mode'])){
    extract($_POST);
 
    if($f_pixel_setup_mode == 1){
        $_SESSION['FRs_PixelSetupMode'] = "1";
        FR_SWAL("Dear Boss!","Pixel Setup Mode On Now","success");
    }
 
    if($f_pixel_setup_mode == 0){
        if(isset($_SESSION['FRs_PixelSetupMode'])){
            unset($_SESSION['FRs_PixelSetupMode']);
            FR_SWAL("Dear Boss $UsrName!","Pixel Setup Mode Off Now","success");
        }
    }
 
 }

?>
</section>
<!-- 1 scripts e-->





<section>
    <div class="container">
        <div class="col-md-11">


           <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">
                         <h3 class="text-center text-info boldd">Pixel Setup Mode</h3>
                         <select class='form-control' name='f_pixel_setup_mode' required>
                            <?php if(isset($_SESSION['FRs_PixelSetupMode'])){ echo "<option value='1'>On</option>"; }?>
                            <option value='0'>Off</option>
                            <option value='1'>On</option>
                         </select>
                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm </button>
                    </div>  
                </form>
            </div>
           </div>


        </div>
    </div>
</section>







<?php require_once("frd-public/theme/frd-footer.php");?>