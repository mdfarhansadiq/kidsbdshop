<?php 
$rtd_path="rtd";
////////// Url value reciving ///////
if( isset($_GET['urll']) ){
    $l_url=explode('/',$_GET['urll']); 
    $bsbrand_slug=$l_url[1];
}
/////////////////Brand Table Data Fatching 
$q_frd="SELECT * FROM frd_brandss WHERE slugg = '$bsbrand_slug'";
require("$rtd_path/1_frd.php"); 
require("$rtd_path/brands_t_frd.php");
//echo "Brand id: $brand_id";
////////// Validationing |slug Validation Chacking  
if($rowsnum_frd==0){
    header("location:$FRD_HURL");
}
//////////// Total matched  counting s
if($rowsnum_frd==1){
$FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_products WHERE r_brand = $brand_id");
$row_totmatched_c = $FRQ->fetch();
$TotalMatchedProductCount=$row_totmatched_c['COUNT(id)'];
$Tell_That="Total $TotalMatchedProductCount Product Matched";
}
//////////// Total matched  counting e


require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$brand_bn_name Brand - $fr_cmetatitle";
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
<!--<h2 class="PT animated fadeInLeft">  Title</h2>-->
<style>
    /* ruf / prosasing css */
    .cvp_fathcatpath{
        font-size: 1.2em;
    }
</style>
<!-- 1 scripts s-->
<section>   
</section>
<!-- 1 scripts e-->
   


<!-- Baner picture -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img id="cattbanerimg" src="<?php echo "$brand_banar_pic_path"?>" alt="" class="img-responsive">
                <br>
                <h3><?php echo "$brand_bn_name ";?></h3>
                <small><?php echo "মোট $TotalMatchedProductCount টি পণ্য পাওয়া গিয়েছে"?></small>
                 <br><br>
            </div>
        </div>
    </div>
</section>




<!-- Products -->
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




<?php require_once("frd-public/theme/frd-footer.php"); ?>  

<?php 
//////////////// Product Fatching s /////////////////
if($TotalMatchedProductCount>0){ ?>
<script>
///// Single catt bases product fetcher helper /////     
$(document).ready(function(){
 var limit = 100;
 var start = 0;
 var action = 'inactive';
 var frd_prd = 'pd';//PRODUCT RESUEST DEVICE
 var brand_id= '<?php echo "$brand_id"?>';      
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start,brand_id:brand_id, frd_prd:frd_prd},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("");
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
    
});      
</script>
<?php }?>