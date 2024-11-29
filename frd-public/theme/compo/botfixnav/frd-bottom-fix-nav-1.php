<style>
nav.FrBotFixNav_1{
    background: #FFF;
    display: none;
    border: none !important;
}
nav.FrBotFixNav_1 .navbar-brand{
    color: #444;
}
nav.FrBotFixNav_1 .fr_home_icon{
    color: #111111;
}
nav.FrBotFixNav_1 .fr_cart_icon{
    color: #111111;
}
nav.FrBotFixNav_1 .fr_usr_icon{
    color: #111111;
}
@media (max-width: 991px) {
    nav.FrBotFixNav_1{
        display: block !important;
    }
    body{
        margin-bottom: 50px !important;
        padding-bottom: 50px !important;
    }
    #myScrollTopBtn {
      bottom: 60px !important;
    }
    .FrBtn_ChatOptionShow {
       bottom: 60px;
    }
}
</style>
<nav class="FrBotFixNav_1 navbar navbar-default navbar-fixed-bottom">
  <div class="container">
     <div class="row">
      <div class="col-xs-4">
         <a class="navbar-brand fr_home_icon" href="<?php echo "$FRD_HURL";?>"><span class="glyphicon glyphicon-home"></span></a>
      </div>
      <div class="col-xs-4 text-center">
          <span class="navbar-brand fr_cart_icon view_cart_trig"> <span class="glyphicon glyphicon-shopping-cart cart_itemss"></span></span>
      </div>
      <div class="col-xs-4">
      <?php
        if(isset($_SESSION['s_cust_id'])){
          echo "<span class='navbar-brand FrTrig_CustomerAllPages'><img class='img-circle' src='$FRD_HURL/frd-data/img/customer/".$_SESSION['s_cust_pic']."' alt='' height='30px' width='30px'></span>";
        }else{
            echo "<a class='navbar-brand fr_usr_icon' href='$FRD_HURL/login'><span class='glyphicon glyphicon-user'></span></a>";
        }
      ?>
      </div>
     </div>
  </div>
</nav>