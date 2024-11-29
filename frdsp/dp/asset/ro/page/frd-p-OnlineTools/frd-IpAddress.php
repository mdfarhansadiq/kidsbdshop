<?php 
require_once('frd1_whoami.php');
$FR_ptitle="IP Address";//PAGE TITLE
$p="pi_c";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> IP Address  </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
$FR_ClientIP = FRF_USER_IP();
$FR_ClientIP2 =  $_SERVER['REMOTE_ADDR'];

?>   
</section>
<!-- 1 SCRIPT END -->    

   

<section>
    <div class="container">
       <div class="col-md-11">
       
        <div class="row">
           <div class="col-md-12 text-center">
               <h4><?php echo "Hi $UsrName Your IP Address Is: <b class='r'> $FR_ClientIP </b>";?></h4>
               <h4><?php echo "Hi $UsrName Your IP Address2 Is: <b class='g'> $FR_ClientIP2 </b>";?></h4>
           </div> 
        </div>
        
        </div>
    </div>
</section>


<section>
    <div class="container">
    <div class="col-md-11">


      <div class="row">
        <div class="col-md-12">
            <?php //PR($_SERVER); ?>
        </div>
      </div>

    </div>
    </div>
</section>





<?php require_once('frd1_footer.php'); ?>   