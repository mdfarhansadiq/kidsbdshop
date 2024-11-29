<?php 
$rtd_path="rtd";

////////// Url value reciving ///////
if( isset($_GET['urll']) ){
    $l_url=explode('/',$_GET['urll']);  
    $catt_slug=$l_url[1];
}

//##FRD CATEGORY TABLE DATA FETCHING
$q_frd="SELECT * from frd_categoriess where slugg='$catt_slug'";
require_once("$rtd_path/1_frd.php");   
require("$rtd_path/catt_t_frd.php"); 
//echo "Cat id: $catt_id | Catt Type: $catt_type";
//FRD_VC____ SLIG EXIST OR NOT:-
if($rowsnum_frd==0){
    header("location:$FRD_HURL");
    exit;
}

$fr_cat_meta_dec = $fr_cat_meta_dec; 

require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cat_meta_title";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cat_meta_dec'>
<meta property='og:image' content='$catt_baner_picc_path'>
<meta property='og:url' content='$FRD_HURL/category/$catt_slugg'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:type' content='website'>
<meta property='og:type' content='website'>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cat_meta_tag'>
<meta name='author' content='$fr_cname'> 
<meta name='publisher' content='$fr_cname'>
<meta name='copyright' content='$fr_cname'>
<meta name='description' content='$fr_cat_meta_dec'>
<meta name='page-topic' content='$fr_cname'>
<meta name='page-type' content='Online Shopping'>
<meta name='audience' content='Everyone'>
<meta name='robots' content='index'>
";
require_once("frd-public/theme/frd-header.php");


//FRD TDR:-
$FRR = FR_QSEL("SELECT fr_hpc_popu_cats FROM frd_hpconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); exit; }
//END>>
?>


<style>
    /* ruf / prosasing css */
    .cvp_fathcatpath{
        font-size: 1.2em;
    }
    /**/
    img#cattbanerimg{
       margin: 0;
        padding: 0;
    }
</style>


<!--  FRD SUB CATEGORIES WITH HEADER PART OUTPUT MAKING S -->
<section>
<?php

    
////////////////////////////////////////////////////////////////////////
////////////////// FRD MAIN SCRIPT FOR TDR & OUTPUT MAKING
////////////////////////////////////////////////////////////////////////
            $FR_OUTPUT_HTML = "";
            $FRc_RowsNum = 1;
            ob_start(); //Start remembering everything that would normally be outputted, but don't quite do anything with it yet    
    
    
    
    
    
    /////////////////////////////////////////////////////////////////////////////
    ////////////////////////////// FRD ONE SCRIPTS S ////////////////////////////
    /////////////////////////////////////////////////////////////////////////////    
    if('1s'=='1s'){
        
    if($rowsnum_frd==1){    
        
    ////////////////////////////////////////////////    
    /////Categories All chield Catt Finder /////////    
    ////////////////////////////////////////////////
    $q_catt_accf="SELECT COUNT(id) FROM frd_categoriess WHERE cat_father = $catt_id AND statuss = 1";
    $FRQ = $FR_CONN->query("$q_catt_accf");
    $row_catt_accf = $FRQ->fetch();
    $ProsesCattTotalChield=$row_catt_accf['COUNT(id)'];      
    if($ProsesCattTotalChield>0){
        $ProsesCattTotalChield_notyecho=" <b class='r'> $ProsesCattTotalChield </b>  $frlc_t_sub_category_found_txt ";
    }
        
        
    //if($ProsesCattTotalChield==0){      
    //////////// Total matched  counting s
    //// condition appliying 
    if($catt_type==1){$mody_catt="r_cat_1";}    
    if($catt_type==2){$mody_catt="r_cat_2";}    
    if($catt_type==3){$mody_catt="r_cat_3";}    
    if($catt_type==4){$mody_catt="r_cat_4";}
    $q_totmatched_c="SELECT count(id) from frd_products where statuss=1 and $mody_catt=$catt_id or m_cat_1=$catt_id or m_cat_2=$catt_id or m_cat_3=$catt_id or m_cat_4=$catt_id";
    $FRQ = $FR_CONN->query("$q_totmatched_c");
    $row_totmatched_c = $FRQ->fetch();
    $TotalMatchedProductCount=$row_totmatched_c['count(id)'];
    $Total_matchedproduct_noty="<b class='boldd'> $TotalMatchedProductCount</b>  $frlc_t_product_found_txt ";      
    //////////// Total matched  counting e  
    //}else{
        //$Total_matchedproduct_noty="";
    //}
        
    }
        
    }    
    ?>  




<?php if($Frtc_category_t_cs == 1){ ?>
<br>
<!-- POPULER CATEGORY SLIDER  -->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_hp_populcats pointer TAC catbasebuy">
          <?php
          $FRR = FR_QSEL("SELECT * FROM frd_categoriess WHERE id in($fr_hpc_popu_cats)", "ALL");
          if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);
              echo "
                            <div class='item'>
                            <a href='$fr_cat_bpro_url/$slugg'>
                                <img src='$FRD_HURL/frd-data/img/cat_thum/$thumb_picc' class='img-responsive'>
                            </a>
                            <span class='cat_name'> $bn_name </span>
                            </div>
                        ";
            }
          } else {
            // PR($FRR);
            echo "<div class='item alert alert-danger text-center'> No Popular Product Categories Found </div>";
          }
          ?>
        </div>
      </div>
    </div>
    </div>
    <?php } ?>

    
    
    <!-- PROSESS CATEGORY SLUG PATH MAKING S -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <?php 
                if($catt_type==1){
                    echo "<span><a href='$FRD_HURL'> $fr_tn_home_btn_txt </a> / <a href='$fr_cat_bpro_url/$catt_slugg'>$catt_name_bn</a></span>"; 
                }
                
                if($catt_type==2){
                    $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $catt_father");
                    $row_find_fathcinfo = $FRQ->fetch();
                    $cvp_fath_bn_name=$row_find_fathcinfo['bn_name'];
                    $cvp_fath_slug=$row_find_fathcinfo['slugg'];
                    echo "
                    <span class='cvp_fathcatpath'><a href='$FRD_HURL'> $fr_tn_home_btn_txt </a> / <a href='$fr_cat_bpro_url/$cvp_fath_slug'>$cvp_fath_bn_name</a></span> / 
                    <span><a href='$fr_cat_bpro_url/$catt_slugg'>$catt_name_bn</a></span>
                    "; 
                }
                
                if($catt_type==3){
                    $FRQ = $FR_CONN->query("SELECT bn_name,slugg FROM frd_categoriess WHERE id = $catt_father");
                    $row_find_fathcinfo = $FRQ->fetch();
                    $cvp_fath_bn_name=$row_find_fathcinfo['bn_name'];
                    $cvp_fath_slug=$row_find_fathcinfo['slugg'];     
                    echo "
                    <span><a href='$FRD_HURL'> $fr_tn_home_btn_txt </a> / <a href='$fr_cat_bpro_url/$cvp_fath_slug'>$cvp_fath_bn_name</a></span> / 
                    <span><a href='$fr_cat_bpro_url/$catt_slugg'>$catt_name_bn</a></span>
                    "; 
                }
                ?>
            </div>
        </div>
    </div>

    <!-- FRD CATEGORY NAME AND SHORT INFO SHOWING S-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo "$catt_name_bn";?> | <small><?php if(isset($ProsesCattTotalChield_notyecho)){echo "$ProsesCattTotalChield_notyecho";} ?> | <?php echo "$Total_matchedproduct_noty"; ?></small></h4>
                </div>
            </div>
        </div>



         <!-- FRD CATEGORY BANER SHOWING S -->
         <?php if($frtc_cat_baner_dp == 1){ ?>
         <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img id="cattbanerimg" src="<?php echo "$catt_baner_picc_path"?>" alt="<?php echo "$catt_name";?>" class="img-responsive" style='margin:auto;'>
                </div>
            </div>
        </div>
        <?php } ?>
    
    
    
    
        <!-- CATEGORIES CHIELD CATEGORIES SHOWING START -->
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                <?php 
                if($ProsesCattTotalChield > 0){

                    $q_allclildcatsshow="SELECT * FROM frd_categoriess WHERE cat_father = $catt_id AND statuss = 1";
                    $FRQ = $FR_CONN->query("$q_allclildcatsshow");
                    $rowsnum_allclildcatsshow = $FRQ->rowCount();
                    for($i = 1; $i<=$rowsnum_allclildcatsshow; $i++){//for loop start
                        $row = $FRQ->fetch();
                        $cildcatt_id = $row["id"];
                        $cildcatt_bn_name = $row["bn_name"];
                        $cildcatt_slugg = $row["slugg"];
                        $cildcatt_thumbpicc = $row["thumb_picc"];
                        $cildcatt_thumbpiccpath = "$FRD_HURL/frd-data/img/cat_thum/$cildcatt_thumbpicc";    
                        
                        // CATEGORY BASE PRODUCT COUNT ALSO    
                        $q_totmatched_c="SELECT COUNT(id) FROM frd_products WHERE statuss = 1 AND r_cat_1 = $cildcatt_id OR r_cat_2 = $cildcatt_id OR r_cat_3 = $cildcatt_id OR r_cat_4 = $cildcatt_id";
                        $FRQ2 = $FR_CONN->query("$q_totmatched_c");
                        $row_totmatched_c = $FRQ2->fetch();
                        $TotalProductCount=$row_totmatched_c['COUNT(id)'];  
                        
                    ?>
                    
                        
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="frs_catbox_1">
                        <a href="<?php echo "$fr_cat_bpro_url/$cildcatt_slugg"?>">
                        <img src="<?php echo "$cildcatt_thumbpiccpath";?>" alt="" class="img-responsive">
                            <h4 class="title"><?php echo "$cildcatt_bn_name <br> <b class='alert-danger'>[ $TotalProductCount ]</b>";?></h4>
                            </a>
                        </div>
                        </div>
                        
                    <?php 
                        }//for loop end  
                }
                ?>
                </div>
            </div>
        </div>
        
        
        
        
    <?php
    $FR_OUTPUT_HTML .= ob_get_contents(); //Gives whatever has been "saved"
    ob_end_clean(); //Stops saving things and discards whatever was saved
    ob_flush(); //Stops saving and outputs it all at once


    echo "$FR_OUTPUT_HTML";
 
   
?>
</section>








<!-- FRD PROSESS CATEGORY BASE BRODUCT SHOWING S  -->
<section>
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div id="load_data"></div>
               <div id="load_data_message"></div>
           </div>
       </div>
    </div>
</section>




<?php if($fr_cat_details != ""){ ?>
<section>
     <div class="container">
        <div class="row">
            <div class="col-md-12 jumbotron">
                 <article>
                    <h2 class="text-center"><?php echo "$catt_name_bn";?></h2>
                    <?php echo "$fr_cat_details";?>
                </article>

            </div>
        </div>
     </div>
</section>
<?php } ?>




<?php if($Frtc_category_t_cs == 1){ ?>
<br>
<!-- POPULER CATEGORY SLIDER  -->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_hp_populcats pointer TAC catbasebuy">
          <?php
          $FRR = FR_QSEL("SELECT * FROM frd_categoriess WHERE id in($fr_hpc_popu_cats)", "ALL");
          if ($FRR['FRA'] == 1) {
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);
              echo "
                            <div class='item'>
                            <a href='$fr_cat_bpro_url/$slugg'>
                                <img src='$FRD_HURL/frd-data/img/cat_thum/$thumb_picc' class='img-responsive'>
                            </a>
                            <span class='cat_name'> $bn_name </span>
                            </div>
                        ";
            }
          } else {
            // PR($FRR);
            echo "<div class='item alert alert-danger text-center'> No Popular Product Categories Found </div>";
          }
          ?>
        </div>
      </div>
    </div>
    </div>
    <br>
    <?php } ?>




<script type="text/javascript">
//FRD PROSESS CATEGORY BASE PRODUCT SHOWING S :---  
$(document).ready(function(){
        
 var limit = 60;
 var start = 0;
 var action = 'inactive';
 var catt_id= '<?php echo "$catt_id"?>';
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start, catt_id:catt_id},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("NO MORE FOUND");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_data(limit, start);
 }
$(window).scroll(function() {    
    var FRposition = $(window).scrollTop() + 300;
    var FRbottom = $(document).height() - $(window).height();
        if( FRposition >= FRbottom && action == 'inactive'){
             //toastr.error('FRD DATA LODING Initializing...  ');
               action = 'active';
               start = start + limit;
               setTimeout(function(){
                load_data(limit, start);
               }, 200);
            
            //document.documentElement.scrollTop = FRposition-500;
        }
});



        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_hp_populcats').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:4000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:false,    
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:6
                    },
                    1000:{
                        items:8
                    }
                }
        });
         //END>>

    
}); 

</script>


<?php require_once("frd-public/theme/frd-footer.php"); ?>