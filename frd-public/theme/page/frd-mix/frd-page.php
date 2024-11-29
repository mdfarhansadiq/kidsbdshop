<?php 
$rtd_path="rtd";
if(isset($_GET['urll'])){
    $l_url=explode('/',$_GET['urll']);
    $page_slug=$l_url[1];
}
//## PAGE TABLE DATA FETCHING:-
$q_frd="SELECT * from frd_pages where page_url='$page_slug'";
require("$rtd_path/1_frd.php");   
require("$rtd_path/pages_t_frd.php");
//FRD_VC____ PAGE SLUG EXIST OR NOT:--
if($rowsnum_frd==0){header("location:$FRD_HURL?alert_frd= 404 দুঃখিত এই পেইজটি পাওয়া যায়নি "); exit;}



require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$page_name_en - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FR_THISPAGE'>
<meta property='og:type' content='website'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cmetatag'>
<meta name='author' content='$fr_cname'> 
<meta name='publisher' content='$fr_cname'>
<meta name='copyright' content='$fr_cname'>
<meta name='description' content='$fr_cmetades'>
<meta name='page-topic' content='Ecommerce'>
<meta name='page-type' content='Product'>
<meta name='audience' content='Everyone'>
<meta name='robots' content='index'>
";

require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT animated fadeInLeft"> View Page </h2>-->

<style>
  .pagebody_con{
       text-align: justify;
    }
</style>
  


   
 <div class="container pagebody_con">
    
    <div class="row">
       <div class="col-md-1"></div>
        <div class="col-md-10">
          
           <img src="<?php echo "$page_baner_pic_path";?>" alt="" class="img-responsive">
           <h3 class="PT"> <?php echo "$page_name_en";?> </h3>
            <ul class="nav nav-tabs">

              <li role="presentation" class="<?php if($page_urlslug=='about'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/about";?>"> <?php echo "$fr_vp_about_txt";?></a></li>

              <li role="presentation" class="<?php if($page_urlslug=='contact'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/contact";?>"> <?php echo "$fr_vp_contact_txt";?></a></li>

               <li role="presentation" class="<?php if($page_urlslug=='terms-and-conditions'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/terms-and-conditions";?>"> <?php echo "$fr_vp_tramsandcondition_txt";?> </a></li>
               
               <li role="presentation" class="<?php if($page_urlslug=='delivery-policy'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/delivery-policy";?>"> <?php echo "$fr_vp_deliverypolicy_txt";?></a></li>
               
              <li role="presentation" class="<?php if($page_urlslug=='privacy-policy'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/privacy-policy";?>"><?php echo "$fr_vp_privacypolicy_txt";?></a></li>

              <li role="presentation" class="<?php if($page_urlslug=='return-policy'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/return-policy";?>"> <?php echo "$fr_vp_returnpolicy_txt";?></a></li>

              <li role="presentation" class="<?php if($page_urlslug=='refund-policy'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/refund-policy";?>"> <?php echo "$fr_vp_refund_txt";?></a></li>

              <li role="presentation" class="<?php if($page_urlslug=='mission'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/mission";?>"> <?php echo "$fr_vp_mission_txt";?></a></li>

              <li role="presentation" class="<?php if($page_urlslug=='vision'){echo 'active';}?>"><a href="<?php echo "$pageview_frd/vision";?>"> <?php echo "$fr_vp_vision_txt";?></a></li>
            </ul>
        </div>
        <div class="col-md-1"></div>
    </div>
    
     <div class="row">
       <br/>
        <div class="col-md-1"></div>
         <div class="col-md-10">
           <?php echo $page_body_en;?>
         </div>
         <div class="col-md-1"></div>
     </div>
 </div>  


<?php require_once("frd-public/theme/frd-footer.php");?>