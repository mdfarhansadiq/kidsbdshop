<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Flash Sales - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FRD_HURL'>
<meta property='og:type' content='website'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>

<meta name='keywords' content='$fr_cmetatag'>
<meta name='author' content='$fr_cname'> 
<meta name='publisher' content='$fr_cname'>
<meta name='copyright' content='$fr_cname'>
<meta name='description' content='$fr_cmetades'>
<meta name='page-topic' content='Ecommerce Flash Seles'>
<meta name='page-type' content='Product'>
<meta name='audience' content='Everyone'>
<meta name='robots' content='index'>
";
require_once("frd-public/theme/frd-header.php");

?>
<!-- <h2 class="PT"> Page Title </h2> -->
<!-- 1 scripts s-->
<section>
<?php   

$q_frd = "SELECT * from frd_sliderr where id=1";
require("$rtd_path/1_frd.php");
require("$rtd_path/slider_t_frd.php");

?>
</section>
<!-- 1 scripts e-->

<style>
.flashseals_time_div #FRcountDownX{
    background: #FF6801 !important;
    margin-bottom: 10px;
}
.flashseals_time_div #FRcountDownX .frcountdownnum{
    color: #111111;
    float: center;
    margin-top: 15px !important;
}
.flashseals_time_div #FRcountDownX li{
    display: inline-block;
    list-style-type: none;
    padding: 5px;
    text-transform: uppercase;
    font-weight: bolder;
    text-align: center;
    background: #FFFFFF;
    color: #111111;
    width: 55px;
    border-radius: 5px;
    margin-right: 2px;
}
.flashseals_time_div #FRcountDownX li span {
    display: block;
    font-size: 15px;
    margin-bottom: -5px;
}
.flashseals_time_div #FRcountDownX li i {
    font-size: 10px;
}
</style>




<?php 
$FRc_FLASH_SELLS_TIME_SRT = strtotime("$FR_FLASH_SELLS_TIME");
if($FR_FLASH_SELLS_MODE == "FRON" AND $FRc_FLASH_SELLS_TIME_SRT > $FR_NOW_TIME){
?>
<div  class="container">

        <div class="row fr-mb-5">
            <div class="com-md-12">
                <img src="<?php echo "$sli_pic_1_url";?>" alt="#" class="img-responsive">
            </div>
        </div>

         <div class="row">
            <div>
                <div class="col-md-4">
                    <h2><span class="glyphicon glyphicon-flash pip_pip_1s"></span> <?php echo "$frtc_flash_sales_txt";?> </h2>
                </div>
                <div class="col-md-8 text-center">

                    <div class="flashseals_time_div">
                    <div id='FRcountDownX' class="col-xs-12 text-center">
                       <div class="frcountdownnum" id="countdown">
                            <ul>
                                <li><span id="FRdays"></span> <i><?php echo "$frtc_flash_sales_days_txt";?></i> </li>
                                <li><span id="FRhours"></span> <i><?php echo "$frtc_flash_sales_hours_txt";?></i> </li>
                                <li><span id="FRminutes"></span> <i><?php echo "$frtc_flash_sales_minutes_txt";?></i> </li>
                                <li><span id="FRseconds"></span> <i><?php echo "$frtc_flash_sales_second_txt";?></i> </li>
                            </ul>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>


                <div class="row">
                    <div class="col-md-12">
                        <div id="load_data"></div>
                        <div id="load_data_message"></div>
                    </div> 
                </div>

</div>
<script>
$(document).ready(function () {
    FrFun_FlashSalesCD(FR_FLASH_SALES_END_TIME);
});
</script>
<?php 
}else{
    echo "
    <br><br><br><br>
    <div class='alert alert-danger text-center h2'>$frlc_flash_sales_time_over_txt!</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    ";
}
?>


            




<?php require_once("frd-public/theme/frd-footer.php");?>



<script type="text/javascript">
$(document).ready(function(){
 var limit = 101;
 var start = 0;
 var action = 'inactive';
 function load_data(limit, start)
 {
  $.ajax({
   url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
   method:"POST",
   data:{limit:limit, start:start, f_flash_sales:'1', f_filt_rand:'1'},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<h4  class='TAC'>No More Found!</h4>");
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
    var FRposition = $(window).scrollTop() + 400;
    var FRbottom = $(document).height() - $(window).height();
        if( FRposition >= FRbottom && action == 'inactive'){
             //toastr.error('FRD DATA LODING Initializing...  ');
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