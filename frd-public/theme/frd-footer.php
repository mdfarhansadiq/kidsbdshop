
<?php require_once("compo/footer/frd-footer-$frtc_footer_n.php");?>
<?php require_once("compo/botfixnav/frd-bottom-fix-nav-1.php"); ?>



  <?php 
    if($frtc_popupoffer_dp == 1){
      if(!isset($_COOKIE['FRcook_PopUpOffer'])){
        $c_name = "FRcook_PopUpOffer";
        $c_value = "786";
        $c_expiry = time() + (60 * 30);
        $c_path = "/";
        setcookie($c_name, $c_value, $c_expiry, $c_path);
    ?>
      <div id="FR_DATA_POPUP_OFFER"> </div>
        <script>
          $(document).ready(function(){
            setTimeout(function(){ 
                $.ajax({
                  url: FRD_HURLL + "/frdsp/dp/page/frd-p-popoffer/frdapi-PopupOffer.php",
                  method:"POST",
                  data: {1:'1',f_spiderecommerce:'spiderecommerce.com'},
                  success:function(data){
                    console.log(data);
                    $('#FR_DATA_POPUP_OFFER').html(data);
                  }
                });
            }, 10000);
          });
        </script>
    <?php } } ?>


<!-- FRD OVERLAY SEARCH START -->
<div id="FRsearchOverlay" class="FRsSearchoverlay">
    <div class="overlay-content ">
        <br><br>
          <span class="btn btn-default" onclick="fr_closeSearch()"><span class="glyphicon glyphicon-remove"></span></span>
        <br>
        <br>
        <form id="frd_prosearchform" action="<?php echo " $FRD_HURL/search ";?>" method="GET">
            <input type="text" placeholder="পণ্য খুজুন এখানে.." id="f_pro_name" name="productname" autocomplete="off" autofocus required>
            <button type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </form>
        <div class="row">
            <div class="col-xs-12">
                 <div id="fr_pro_ss"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="FR_SPIDER_MODEL" role="dialog"> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
        </div>
        <div class="modal-body">
           <div id="FR_SPIDER_MODEL_DATA"></div>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>   


<button class="frdiv_print_time_hied" onclick="topFunction()" id="myScrollTopBtn" title="Go to top"> <span class="glyphicon glyphicon-arrow-up
"></span> </button>







<?php if($frtc_chatoption == 1){ ?>
  <button class="FrBtn_ChatOptionShow" id="FrTrig_ChatOptionShow" title="Chat With Us"> <i class="fa-brands fa-facebook-messenger"></i> </button>
  
<div class="modal fade" id="FrChatIptionModel" role="dialog"> 
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
        </div>
        <div class="modal-body text-center">

          <?php
             if($fr_whatsapp_link !=""){
                echo "
                <a href='$fr_whatsapp_link' target='_blank'>
                    <img src='$FRD_HURL/frd-public/theme/img/icon/frdicon-whatsapp-chat.jpg' alt='#' class='img-responsive'>
                </a>
                ";   
            }
            if($fr_messenger_link !=""){
             echo "
                <a href='$fr_messenger_link' target='_blank'>
                    <img src='$FRD_HURL/frd-public/theme/img/icon/frdicon-messenger-chat.jpg' alt='#' class='img-responsive'>
                </a>
                ";
            }
            
          ?>
          
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div> 
<?php } ?>




<script>
$(document).ready(function(){
    //////////////////////////////////////////////////////////////////////
    //FRD MINI CART ITEMS AND PRICE SHOW START:-
    //////////////////////////////////////////////////////////////////////
        <?php 
        if(isset($_SESSION['cart_items'])){
        ?>
            $('.cart_itemss').html(<?php echo $_SESSION['cart_items']?>);
            $('#cart_pricee').html(<?php echo $_SESSION['cart_price']?>);
        <?php    
        }else{
            echo "
            $('.cart_itemss').html('0');
            $('#cart_pricee').html('0');
            ";
        }
        ?>
    //END>>


    
}); 
</script>
<!-- Include all compiled plugins (below) -->
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/bootstrap.min.js"></script>
<!-- Chosen Js -->
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/chosen/chosen.jquery.js"></script>
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/chosen/chosen_2.js"></script>
<!-- counter script-->
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/counterup/waypoints.min.js"></script>
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/counterup/counterup.min.js"></script>
<!-- QJUERY UI -->
<script src="<?php echo "$FR_HURL_AT/asset"?>/js/jquery-ui_v1_11_2.min.js"></script>
<!-- Custom -->
<script src="<?php echo "$FR_HURL_AT/asset/js/scripts_v1.js?v=$FR_SOFT_VERSION"?>"></script>
<script src="<?php echo "$FRD_HURL/frd-public/theme/asset/js/frd-this-function.js?v=$FR_SOFT_VERSION"?>"></script>
<!-- FRD INSERT FOOTER -->
<?php require_once($FR_HDPATH."frd-data/mixd/frd-insert-footer.php");?>



<?php if($frtcplug_GTMdataLayer == 1){ ?>
<script>
  dataLayer.push({
    ecommerce: null
  });
  dataLayer.push({
    event: "view_page",
    client_id: "<?php echo "$FRc_USER_AGENT";?>",
    ip_override: "<?php echo "$FRc_USER_IP";?>",
    user_id: "<?php echo "$FRc_USER_UID";?>",
    plugin: "SpiderEcommerceGTM4DL"
  });
</script>
<?php } ?>



</body>
</html>
<?php
if(isset($_GET['CartOpen'])){ echo "<script>FrFunOpenCart();</script>"; }
$FR_CONN = NULL; ob_end_flush();