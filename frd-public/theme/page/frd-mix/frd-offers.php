<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Offers $fr_cmetatitle";
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

//Total found offers count s:- 
$FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_products WHERE ofer_status = 1");
$row_totfoundoffer_c = $FRQ->fetch();
$TotalFoundOffersCount=$row_totfoundoffer_c['COUNT(id)'];
$Total_FoundOffers_notiecho="<b class='boldd'> $TotalFoundOffersCount</b> $frlc_t_offer_found_txt";      
//END>>
?>
<h2 class="PT animated fadeInLeft"> <small><?php echo "$Total_FoundOffers_notiecho";?></small> </h2>



<!-- Products -->
    <div class="container"> 
       <div class="row">
           <div class="col-md-12">
                <div id="load_data"></div>
                <div id="load_data_message"></div>
           </div>
       </div>
    </div>

<script>
///// Single catt bases product fetcher helper /////     
$(document).ready(function(){
 var limit = 100;
 var start = 0;
 var doffer = 'doffer';
 var action = 'inactive';
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start, doffer:doffer},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<h4  class='TAC'>NO MORE FOUND!</h4>");
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


<?php require_once("frd-public/theme/frd-footer.php"); ?> 