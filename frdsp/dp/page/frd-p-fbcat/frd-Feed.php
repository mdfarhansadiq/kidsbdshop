<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Facebook Feed";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Facebook Feed </h2>




<!-- 1 SCRIPT START -->   
<section>
<?php 
   if(isset($_POST['f_UpdateFBProductFeedXML'])){
       if($frsc_fb_feed_xml == 1){ FRF_FBProFeedXmlData($FR_PATH_HD); }
   } 
?>   
</section>
<!-- 1 SCRIPT END -->    

   

<?php if($frsc_fb_feed_xml == 1){ ?>
<section>
    <div class="container">
    <div class="col-md-11">

      <div class="row jumbotron">
        <div class="col-md-6">
            <button class="btn btn-success btn-block"><a class="frd_tdn fr-color-white" href="<?php echo "$FRD_HURL/frd-data/mixd/FbShopProductFeed.xml";?>" target="_blank">Open FB Product Feed XML</a></button>
        </div>
        <div class="col-md-6">
            <form action='' method='POST'>
                <button type='submit' class='btn btn-danger btn-block' name="f_UpdateFBProductFeedXML"> <span class='glyphicon glyphicon-flash'></span> Update FB Product Feed XML</button>
            </form>
        </div>
      </div> 



    </div>
    </div>
</section>
<?php } ?>


<?php if($frsc_fb_feed_xml == 0){ FR_COMMING_SOON(); }?>




<?php require_once('frd1_footer.php'); ?>   