<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Search Products - $fr_cmetatitle";
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

//$submitt="autofocus";
require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> Home </h2>-->
<!-- 1 scripts s-->
<section>
<?php
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
if(isset($_GET['productname'])){
    $frd_productname = $_GET['productname'];
    $frd_productname = preg_replace('/</', '', $frd_productname);
    $frd_productname = preg_replace('/>/', '', $frd_productname);
    $frd_productname = preg_replace('/{/', '', $frd_productname);
    $frd_productname = preg_replace('/}/', '', $frd_productname);
    $frd_productname = preg_replace('/:/', '', $frd_productname);
    $frd_productname = preg_replace('/,/', '', $frd_productname);
    $frd_productname = preg_replace('/\'/', '', $frd_productname);
    $frd_productname = preg_replace('/=/', '', $frd_productname);
    $frd_productname = preg_replace('/!/', '', $frd_productname);
    $frd_productname = preg_replace('/@/', '', $frd_productname);
    $frd_productname = preg_replace('/#/', '', $frd_productname);
    $frd_productname = preg_replace('/%/', '', $frd_productname);
    
    // $frd_productname = preg_replace('/^/', '', $frd_productname);
    // $frd_productname = preg_replace('/*/', '', $frd_productname);
    // $frd_productname = preg_replace('/$/', '', $frd_productname);
    // $frd_productname = preg_replace('/+/', '', $frd_productname);
    // $frd_productname = preg_replace('(', '', $frd_productname);
    // $frd_productname = preg_replace(')', '', $frd_productname);

    // echo  $frd_productname;

        try{
          $ARR = ["fr_se_text","fr_se_user_uid","fr_se_user_ip","fr_se_user_browser","fr_se_date","fr_se_time"];
          $FRc_Columns = implode(", ", array_values($ARR));
          $FRc_ValuesBind = implode(", :", array_values($ARR));
          $FRQ = "INSERT INTO frd_search_h ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
          $FRQ = $FR_CONN->prepare("$FRQ");
          $FRQ->bindParam(':fr_se_text', $frd_productname, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_se_user_uid', $FRc_USER_UID, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_se_user_ip', $FRc_USER_IP, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_se_user_browser', $FRc_USER_AGENT, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_se_date', $FR_NOW_DATE, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_se_time', $FR_NOW_TIME, PDO::PARAM_STR);
          $FRQ->execute();
      }catch(PDOException $e){
          FR_SWAL("Dear Boss","ERROR: Data Insert Failed","error");
          echo "<h2> DATA INSERT DONE ERROR MESSAGE:" . $e->getMessage() . "</h2>";
      }
}
    
 
    
?>
</section>
<!-- 1 scripts e-->



<section>
 <div class="container">
     <div class="row">
         <div class="col-md-12">
              <div id="load_data"></div>
              <!-- <div id="load_data_message"></div> -->
         </div> 
     </div>
 </div>  
</section>

 


<?php require_once("frd-public/theme/frd-footer.php"); ?>   


<script type="text/javascript">
$(document).ready(function(){

 var limit = 100;
 var start = 0;
 var fr_search_text = '<?php echo "$frd_productname"?>';
 var action = 'inactive';
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start, fr_search_text:fr_search_text},
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



  //FRD GTM EVENT FIRE PRODUCT SEARCH:-
  dataLayer.push({
    ecommerce: null
  });
  dataLayer.push({
    event: "item_search",
    ecommerce: {
      search_text: "<?php echo "$frd_productname"?>"
    }
  });
  //END>>
});     
</script>