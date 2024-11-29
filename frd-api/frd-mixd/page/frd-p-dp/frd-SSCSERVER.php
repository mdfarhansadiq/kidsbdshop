<?php 
require_once('frd1_whoami.php');
$FR_ptitle="#";//PAGE TITLE
$p="#";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> PAGE TITLE [ FRD FRAME WORK ROW ] </h2>



<!-- 1 SCRIPT S -->
<section>
<?php
if(isset($_POST['CHANGE'])){
    FRF_SSC_SERVER_RESET();
}

if(isset($_POST['SET_LOCAL_SSC_SERVER'])){
    $_SESSION['FRs_SSC_SERVER'] = $FRSSCSERVER[0];
}
?>
</section>
<!-- 1 SCRIPT E -->

<h2 class="PT"> SSC SERVER </h2>

   

   





<section>
    <div class="container">
     <div class="col-md-11">

        <div class="row">
            <div class="col-md-12 jumbotron">
                <h4>CURRENT SSC SERVER: <br> <?php echo $_SESSION['FRs_SSC_SERVER']; ?></h4>

            <form action='' method='POST'>
                    <div class="text-right">
                        <button type="submit" class='btn btn-success btn-xs' name="CHANGE"> <span class='glyphicon glyphicon-flash'></span> CHANGE</button>
                    </div>
            </form>

            <?php if($FR_SERVER == 2){ ?>
            <br>
            <form action='' method='POST'>
                    <div class="text-right">
                        <button type="submit" class='btn btn-success btn-xs' name="SET_LOCAL_SSC_SERVER"> <span class='glyphicon glyphicon-flash'></span> SET LOCAL SSC SERVER </button>
                    </div>
            </form>
            <?php } ?>

            </div>
        </div>

     </div>
    </div>
</section>

   







<?php require_once('frd1_footer.php'); ?>