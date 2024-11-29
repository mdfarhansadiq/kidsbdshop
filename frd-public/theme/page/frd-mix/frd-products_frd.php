<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Latest Products - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades, developed by spiderecommerce.com'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FR_THISPAGE'>
<meta property='og:type' content='website'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cmetatag,developed by spiderecommerce.com,spiderecommerce.com,spider ecommerce'>
<meta name='author' content='$fr_cname, developed by spiderecommerce.com'> 
<meta name='publisher' content='$fr_cname'>
<meta name='copyright' content='$fr_cname'>
<meta name='description' content='$fr_cmetades. developed by spiderecommerce.com'>
<meta name='page-topic' content='Ecommerce'>
<meta name='page-type' content='Product'>
<meta name='audience' content='Everyone'>
<meta name='robots' content='index'>
";


require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT animated fadeInLeft"> NEW PRODUCTS </h2>-->
<!-- 1 scripts s-->
<section>
<?php 
//Total found produt count s:-
$FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_products WHERE statuss = 1 AND qtyy >= 0");
$row_totfoundpro_c = $FRQ->fetch();
$TotalFoundProductCount=$row_totfoundpro_c['COUNT(id)'];
$Total_FoundProduct_notiecho=" <b class='boldd'> $TotalFoundProductCount</b> $frlc_t_product_found_txt";      
//END>>

            
?>    
</section>
<!-- 1 scripts e-->
   


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4><?php echo "$Total_FoundProduct_notiecho";?></h4>
        </div>
    </div>
</div>


<section>
 <div class="container">
     <div class="row">
        <div id="load_data"></div>
     </div>
     <div class="row">
         <div class="col-md-12 text-center">
             <div id="load_data_message" class="d-block"></div>
         </div> 
     </div>
 </div>  
</section>



<?php  require_once("frd-public/theme/frd-footer.php"); ?> 



<script type="text/javascript">

const loading_gif = '<?php echo "$FRD_HURL/frd-src/img/gif/frd-loading-1.gif";?>';

$(document).ready(function(){
 var limit = 101;
 var start = 0;
 var action = 'inactive';
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     alert(data);
     action = 'active';
    }
    else
    {
    $('#load_data_message').html("No More Product Found");
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
    var FRposition = $(window).scrollTop() + 400;
    var FRbottom = $(document).height() - $(window).height();

        if( FRposition >= FRbottom && action == 'inactive'){
            //    toastr.error('FRD DATA LODING Initializing...  ');
              $('#load_data_message').html('<img src="' + FRD_HURLL + '/frd-src/img/gif/frd-loading-1.gif" style="width:200px;height:auto;margin:auto;">');
               action = 'active';
               start = start + limit;
               setTimeout(function(){
                load_data(limit, start);
               }, 300);
             //document.documentElement.scrollTop = FRposition-500;
        }
});
   
    
});   
</script>