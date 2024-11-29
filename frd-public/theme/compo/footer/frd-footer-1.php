<style>
  /******************************************************************/
/* FRD FOOTER_1 STYLE */
/******************************************************************/
section.frfoot1{
    background: #D5D0CD;
    border: none !important;
    margin-top: -1px !important;
}
footer#fr_foot1{
   background: #D5D0CD;
   padding-bottom: 10px;
   padding-top: 20px !important;
}

footer#fr_foot1 .frFooterMobile {
    margin-left: 10px;
    padding: 5px;
}
footer#fr_foot1 .frFooterMobile h4 a{
    text-decoration: none;
    color: #222;
    font-size: 2em;
    font-weight: 900;
}


footer#fr_foot1 .frFooterEmail {
    margin-right: 10px;
    padding: 5px;
}
footer#fr_foot1 .frFooterEmail h4 a{
    text-decoration: none;
    color: #222;
    font-size: 2em;
    font-weight: 900;
}
@media (max-width: 767px) {
    footer#fr_foot1 .frFooterEmail h4 a{
        font-size: 1.3em;
    }
}


footer#fr_foot1 .frs_faddress{
   background: #D5D0CD;
    color: #222;
    font-weight: bold;
    padding: 10px;
    margin-top: -11px;
    font-weight: 900;
}

footer#fr_foot1 hr {
    border-top: 1px solid #333;
}

footer#fr_foot1 .appdownlodebtn {
   border: none !important;
}


/*COPYWRITE:-*/
footer#fr_foot1 .frs_copyw{
    text-align: center;
}
footer#fr_foot1 .frs_copyw a{
   color: #222;
}
footer#fr_foot1 .frs_copyw:hover{
    
}


footer#fr_foot1 div.frdcredits{
    text-align: center;
    padding:5px;
}
footer#fr_foot1 div.frdcredits span{
    color: #222;
    font-size: 12px;
}
footer#fr_foot1 div.frdcredits a{
    color: #222;
    font-weight: 900;
}
/*++*/
/*++*/
/*++*/
/******************************************************************/
/* FRD SOCIAL ICON FOOTER STYLE */
/******************************************************************/
.SolialIconRow a {
    color: #4d4d4d;
    text-decoration: none;
  }

  .SolialIconRow .fb a,
  .SolialIconRow .fb:before,
  .SolialIconRow .fb {
    background: #3b5999;
    color: #3b5999;
  }

  .SolialIconRow .tw a,
  .SolialIconRow .tw:before,
  .SolialIconRow .tw {
    background: #55acee;
    color: #55acee;
  }

  .SolialIconRow .in a,
  .SolialIconRow .in:before,
  .SolialIconRow .in {
    background: #e4405f;
    color: #e4405f;
  }

  .SolialIconRow .yt a,
  .SolialIconRow .yt:before,
  .SolialIconRow .yt {
    background: #FF0000;
    color: #FF0000;
  }

  .SolialIconRow .wa a,
  .SolialIconRow .wa:before,
  .SolialIconRow .wa {
    background: #4ADE54;
    color: #4ADE54;
  }


  .SolialIconRow{
    margin-top: 30px;
    margin-bottom: 60px;
  }

  ul#FrScialBtnUl {
    padding: 0;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    list-style: none;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-gap: 10px;
    /* margin-top: 30px; */
  }

  ul#FrScialBtnUl:before {
    font-size: 2em;
    font-family: Arial;
    font-weight: 300;
    color: #4d4d4d;
    position: absolute;
    width: 100%;
    text-align: center;
    margin-top: -60px;
  }

  ul#FrScialBtnUl li {
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    box-sizing: border-box;
    background: transparent;
    border-radius: 12px;
    position: relative;
    overflow: hidden;
    transition: 0.5s;
    box-shadow: 0px 8px 16px -6px, 0px 0px 16px -6px;
  }

  ul#FrScialBtnUl li a {
    display: block;
    widows: 100%;
    height: 100%;
    font-size: 1.25em;
    background: transparent;
    transition: 0.5s;
    animation: icon-out 0.5s forwards;
    animation-timing-function: cubic-bezier(0.5, -0.6, 1, 1);
  }

  ul#FrScialBtnUl li:before {
    content: "";
    width: 90px;
    height: 90px;
    display: block;
    position: absolute;
    transform: rotate(-45deg) translate(-110%, -23px);
    z-index: -2;
    animation: back-out 0.5s forwards;
    animation-timing-function: cubic-bezier(0.5, -0.6, 1, 1);
  }

  ul#FrScialBtnUl li:hover a {
    animation: icon-in 0.5s forwards;
    animation-timing-function: cubic-bezier(0, 0, 0.4, 1.6);
  }

  ul#FrScialBtnUl li:hover:before {
    animation: back-in 0.5s forwards;
    animation-timing-function: cubic-bezier(0, 0, 0.4, 1.6);
  }

  @keyframes back-in {
    0% {
      transform: rotate(-45deg) translate(-110%, -23px);
    }

    80% {
      transform: rotate(-45deg) translate(5%, -23px);
    }

    100% {
      transform: rotate(-45deg) translate(0%, -23px);
    }
  }

  @keyframes back-out {
    0% {
      transform: rotate(-45deg) translate(0%, -23px);
    }

    20% {
      transform: rotate(-45deg) translate(5%, -23px);
    }

    100% {
      transform: rotate(-45deg) translate(-110%, -23px);
    }
  }

  @keyframes icon-in {
    0% {
      font-size: 1.25em;
    }

    80% {
      color: #fff;
      font-size: 1.5em;
    }

    100% {
      color: #fff;
      font-size: 1.35em;
    }
  }

  @keyframes icon-out {
    0% {
      color: #fff;
      font-size: 1.35em;
    }

    20% {
      color: #fff;
      font-size: 1.5em;
    }

    100% {
      font-size: 1.25em;
    }
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <?php if ($FRcf_ParcelBooki == "1") { ?>
        <h3 class="parcel_deli_link_2"><a href="<?php echo "$FRD_HURL/parcels_delivery"; ?>" class="btn btn-default btn-block"> আপনার পার্সেল ডেলিভারি করুন দ্রুত এবং কম খরচে >> </a></h3>
      <?php } ?>
    </div>
  </div>
</div>


<section class="frfoot1 frdiv_print_time_hied">
  <div class="container">
    <footer id="fr_foot1">

      <!-- MOBILE AND EMAIL  style="display:none"  -->
      <div class="row">
        <div class="col-md-6">
          <div class="frFooterMobile">
            <h4 class="TAC">
              <a href="tel:<?php echo "$fr_cmobile_1"; ?>">
                <span class="glyphicon glyphicon-phone-alt"></span> <?php echo "$fr_cmobile_1"; ?>
              </a>
            </h4>
          </div>
        </div>
        <div class="col-md-6">
          <div class="frFooterEmail">
            <h4 class="TAC">
              <a href="mailto:<?php echo "$fr_cemail_1"; ?>">
                <span class="glyphicon glyphicon-envelope"></span> <?php echo "$fr_cemail_1"; ?>
              </a>
            </h4>
          </div>
        </div>
      </div>


      <!-- ADDRESS -->
      <div class="row">
        <div class="col-md-12">
          <div class="frs_faddress">
            <h4 class='TAC'><span class='glyphicon glyphicon-home'></span> <?php echo "$fr_caddress_1"; ?></h4>
            <?php if ($fr_caddress_2 != "") {
              echo "<h4 class='TAC'><span class='glyphicon glyphicon-home'></span> $fr_caddress_2 </h4>";
            } ?>
          </div>
        </div>
      </div>


      <?php
      //FRD FOOTER SOCIAL ICON START:-
      if($fr_cfb_pg != ""){

          $FRc_GridCount = 1;

         echo "
          <div class='row SolialIconRow'>
          <div class='col-md-12 text-center'>
            <ul id='FrScialBtnUl'>
                <li class='fb'>
                  <a href='$fr_cfb_pg' title='Facebook' target='_blank'>
                    <i class='fa-brands fa-facebook'></i>
                  </a>
                </li>
          ";  
     

          if($fr_cyoutube != ""){
            $FRc_GridCount = ($FRc_GridCount+1);
               echo "
               <li class='yt'>
                  <a href='$fr_cyoutube' title='Youube' target='_blank'>
                    <i class='fa-brands fa-youtube'></i>
                  </a>
                </li>
               ";
          }

          if($fr_cinstagram != ""){
            $FRc_GridCount = ($FRc_GridCount+1);
              echo "
              <li class='in'>
                <a href='$fr_cinstagram' title='Instagram' target='_blank'>
                  <i class='fa-brands fa-instagram'></i>
                </a>
              </li>
              ";
          }

          if($fr_ctwitter != ""){
            $FRc_GridCount = ($FRc_GridCount+1);
              echo "
              <li class='tw'>
                <a href='$fr_ctwitter'title='Twitter' target='_blank'>
                  <i class='fa-brands fa-twitter'></i>
                </a>
              </li>
              ";
          }

          if($fr_whatsapp_link != ""){
            $FRc_GridCount = ($FRc_GridCount+1);
               echo "
               <li class='wa'>
                  <a href='$fr_whatsapp_link' title='WhatsApp' target='_blank'>
                    <i class='fa-brands fa-whatsapp'></i>
                  </a>
                </li>
               ";
          }
          
            echo "
            </ul>
          </div>
        </div>



        <style>
            ul#FrScialBtnUl {
            grid-template-columns: repeat($FRc_GridCount, 1fr);
          }
        </style>
         ";

      }
      //END>>
      ?>
      
  
      <?php if($frtc_app_d_btn == 1){ ?>
      <div class="text-center">
        <a href="<?php echo $FR_PATH_HD."frd-data/mixd/$fr_cname.apk";?>" download> <button class="btn btn-success appdownlodebtn"> <span class="glyphicon glyphicon-save"></span> <?php echo "$frlc_app_d_btn_txt";?></button></a>
      </div>
      <?php } ?>
    
      <hr>
      <div class="frs_copyw">
        <h5> <?php echo "$fr_fot_content_cw_txt"; ?> © <?php echo "" . date('Y'); ?> <a href="<?php echo "$FRD_HURL"; ?>"> <?php echo "$fr_cname"; ?> </a>
        </h5>
      </div>

    </footer>
  </div>
</section>