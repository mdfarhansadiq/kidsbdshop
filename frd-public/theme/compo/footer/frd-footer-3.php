<style>
.footer3-container{
	 background: #002F4A;
}
.footer-3{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    font-family: "Roboto", sans-serif;
    font-style: normal;
    padding: 40px 50px 10px 50px;
}
.footer-3 .pickaboo{
    width: 20%;
}
.footer-3 .col{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.footer-3 h2{
    font-size: 18px;
    line-height: 18px;
    text-transform: uppercase;
    color: rgb(255, 255, 255);
    margin-bottom: 15px;
    font-weight: 900;
}
.footer-3 p {
	color: rgb(255, 255, 255);
	font-size: 14px;
	font-weight: 300;
	margin-bottom: 10px;
    display: flex;
}
.footer-3 li {
	color: rgb(255, 255, 255);
	font-size: 14px;
	font-weight: 300;
	margin-bottom: 10px;
	display: flex;
}
.footer-3 span{
    padding: 0 8px 0 0;
}
.footer-3 span i{
    color: #FD5521;
}
.footer-3 span.glyphicon{
    color: #FD5521;
}
.footer-3 a{
    text-decoration: none;
    color: rgb(255, 255, 255);
	font-size: 14px;
	font-weight: 300;
	margin-bottom: 10px;
	display: flex;
}
.footer-3 a:hover{
    transition: 0.1s;
    transform: scale(1.1);
}
.footer-3 .paymentmethod h2{
    font-size: 18px;
    line-height: 18px;
    text-transform: uppercase;
    color: rgb(255, 255, 255);
    margin-bottom: 15px;
}
.footer-3 .paymentmethod img{
    margin-left: 20px;
    max-height: 200px;
    width: auto;
    text-align: center;
}

.footer3-container .copyright p{
    color: rgb(255, 255, 255);
	font-size: 14px;
    font-family: "Roboto", sans-serif;
	font-weight: 300;
	line-height: 14px;
    text-align: center;
	padding:20px 25px;
}
.footer3-container .copyright a{
    color: rgb(255, 255, 255);
}



@media (max-width:820px) {
    .footer-3 .pickaboo{
        width: 100%;
        margin-bottom: 20px;
    }
}

@media (max-width:550px) {
    .footer-3 .pickaboo{
        width: 100%;
        margin-bottom: 20px;
    }
    .footer-3 {
        padding: 40px 15px 10px 15px;
    }
}

@media (max-width:477px) {
    .footer-3 {
        padding: 40px 15px 10px 15px;
    }
    .footer-3 .col {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 35px;
    }
    .footer3-container .copyright p{
        margin-left: 0px;
    }
    .footer-3 .help{
        width: 40%;
        margin-bottom: 20px;
    }

}
@media (max-width:415px) {
    .footer-3 {
        padding: 40px 30px 10px 30px;
    }
}
@media (max-width:299px) {
    .footer-3 {
        padding: 40px 10px 10px 10px;
    }
}


/*FRD CUSTOM */
.footer3-container div.frdcredits{
    text-align: center !important;
    margin-top: -20px;
    padding-bottom: 20px;
}
.footer3-container div.frdcredits span, .footer3-container div.frdcredits a{
    color: rgb(255, 255, 255);
}
</style>



<div class="footer3-container">
    <footer>
    <div class="footer-3">
            <div class="col pickaboo">
                <h2><?php echo "$fr_cname";?></h2>
                <p><?php echo "$fr_ctagline";?></p>
                <li>
                    <span><i class="glyphicon glyphicon-map-marker"></i></span>
                    <?php echo "$fr_caddress_1";?>
                </li>
                <li>
                    <span><i class="glyphicon glyphicon-earphone"></i></span>
                    <a href="tel:<?php echo "$fr_cmobile_1";?>"><?php echo "$fr_cmobile_1";?></a>
                </li>
                <li>
                    <span><i class="glyphicon glyphicon-envelope"></i></span>
                    <a href="mailto:<?php echo "$fr_cemail_1";?>"><?php echo "$fr_cemail_1";?></a>
                </li>
            </div>

            <div class="col help">
                <h2>About</h2>
                <?php
                  echo "
                  <a href='$pageview_frd/about'><span class='glyphicon glyphicon-file'></span> $fr_vp_about_txt </a>
                  <a href='$pageview_frd/privacy-policy'><span class='glyphicon glyphicon-file'></span> $fr_vp_privacypolicy_txt </a>
                  <a href='$pageview_frd/terms-and-conditions'><span class='glyphicon glyphicon-file'></span> $fr_vp_tramsandcondition_txt </a>
                  <a href='$pageview_frd/delivery-policy'><span class='glyphicon glyphicon-file'></span> $fr_vp_deliverypolicy_txt </a>
                  <a href='$pageview_frd/return-policy'><span class='glyphicon glyphicon-file'></span> $fr_vp_returnpolicy_txt </a>
                  <a href='$pageview_frd/refund-policy'><span class='glyphicon glyphicon-file'></span> $fr_vp_refund_txt </a>
                  <a href='$pageview_frd/contact'><span class='glyphicon glyphicon-file'></span> $fr_vp_contact_txt</a>
                  ";
                  ?>
            </div>
            <div class="col">
                <h2>Quick Links</h2>
                <?php
                  echo "
                  <a href='$FRD_HURL'><span class='glyphicon glyphicon-home'></span> $fr_tn_home_btn_txt </a>
                  ";
                  if ($FR_FLASH_SELLS_MODE == "FRON"){
                      echo "<a href='$FRD_HURL/flash-sales'><span class='glyphicon glyphicon-flash pip_pip_1s'></span> $fr_tn_flash_sales_txt </a>";
                  }
                echo "
                <a href='$FRD_HURL/products'><span class='glyphicon glyphicon-grain'></span>  $fr_tn_new_product_txt </a>
                <a href='$FRD_HURL/offers'><span class='glyphicon glyphicon-sunglasses'></span>  $fr_tn_offer_txt </a>
                <a href='$FRD_HURL/categories'><span class='glyphicon glyphicon-folder-open'></span> $fr_tn_cat_boxview_txt </a>
                <a href='$FRD_HURL/brands'><span class='glyphicon glyphicon-tasks'></span> $fr_tn_allbrand_txt </a>
                ";
                if($frtc_app_d_btn == 1){
                    echo "<a href='$FRD_HURL/frd-data/mixd/$fr_cname.apk'><span class='glyphicon glyphicon-save'></span> $frlc_app_d_btn_txt </a>";
                  }
                ?>
            </div>
            <div class="col">
                <h2>SOCIAL</h2>
                <?php
                  if($fr_cfb_pg != ""){echo " <a href='$fr_cfb_pg' target='_blank'><span><i class='fa-brands fa-square-facebook'></i></span> Facebook </a>"; }
                  if($fr_cyoutube != ""){echo " <a href='$fr_cyoutube' target='_blank'><span><i class='fa-brands fa-youtube'></i></span> Youtube </a>"; }
                  if($fr_cinstagram != ""){echo " <a href='$fr_cinstagram' target='_blank'><span><i class='fa-brands fa-square-instagram'></i></span> Instagram </a>"; }
                  if($fr_ctwitter != ""){echo " <a href='$fr_ctwitter' target='_blank'><span><i class='fa-brands fa-square-twitter'></i></span> Twitter </a>"; }
                  if($fr_whatsapp_link != ""){echo " <a href='$fr_whatsapp_link' target='_blank'><span><i class='fa-brands fa-square-whatsapp'></i></span> Whats App </a>"; }
                ?>
            </div>
            <div class="col">
                <h2>Payment Methods</h2>
                <div class="paymentmethod">
                    <div class="row">
                        <a href="#"><img src="<?php echo "$FR_HURL_AT/asset/img/footer3-paymentmet.png";?>" alt="#"></a> <br>
                    </div>
                </div>
            </div>
    </div>

    <hr/>
    <div class="copyright">
        <p style="text-align:center">© <?php echo "" . date('Y'); ?> <a href="<?php echo "$FRD_HURL"; ?>"> <?php echo "$fr_cname"; ?> </a> | All Rights Reserved.</p>
    </div>
    </footer>
</div>