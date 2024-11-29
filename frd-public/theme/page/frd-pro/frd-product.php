<?php
require_once("frd-public/theme/frd-header-s.php");
// ob_start();
if (isset($_GET['urll'])){
  $l_url = explode('/', $_GET['urll']);
  $FRc_ProductIdx = $l_url[1]; //product id
  if (!isset($l_url[2])) {
    echo "<script>window.location.replace('$FRD_HURL?alert_frd=This Is Not Valid Product Url');</script>";
  }
}


  $FRQ = $FR_CONN->prepare("SELECT * FROM frd_products WHERE id = :id AND statuss IN (1,2)");
  $FRQ->bindParam(':id', $FRc_ProductIdx, PDO::PARAM_INT);
  $FRQ->execute();
  $Rows = $FRQ->rowCount();
  extract($FRQ->fetch());
  //FRD VALIDATION CHACKING:-
  if ($Rows == 0) {
    header("location:$FRD_HURL?alert_frd=ThisProductPresentStatusShow [fc=1537]");
    exit;
  }


  $FRc_ThisProductLink = "$FRD_HURL/product/$FRc_ProductIdx/$fr_slug";
  if($pro_typ == 1){ 
    $FRc_MP_IDx = $FRc_ProductIdx;
  } else{ 
    $FRc_MP_IDx = $v_mp_id; 
  }
  $FRc_SizeNamex = $siz_name;
  $FRc_SalesPricex = $sells_pri;

  extract(FRF_BRAND_NAME($r_brand));
  extract(FRF_COLOR_NAME($r_color));
  $FRc_LongDescription = preg_replace("/#/", '<span class="glyphicon glyphicon-apple" ></span>', $detailess); 


  $FRc_Pic_1 = "$pic_1";
  $FRc_Pic_2 = "$pic_2";
  $FRc_Pic_3 = "$pic_3";
  $FRc_Pic_4 = "$pic_4";

  $FRc_Cat1_Name = "NA";
  $FRc_Cat2_Name = "NA";
  $FRc_Cat3_Name = "NA";
  $FRc_Cat4_Name = "NA";
  $FRc_RelatedProCatId = 0;
  $FRc_CatPathHtml = "";



  $FRc_StockStatusText = "$frlc_out_stock_tx";
  $FRc_OG_availability = "out of stock";
  if($qtyy > 0){ $FRc_StockStatusText = "$frlc_in_stock_tx";   $FRc_OG_availability = "in stock"; }

  

  $market_pri_exp = explode('.', $market_pri);
  $FRc_MarketPricePoisa = $market_pri_exp[1];
  //++
  $sells_pri_exp = explode('.', $sells_pri);
  $FRc_SalesPricePoisa = $sells_pri_exp[1];
  //++
  $FRc_SalesPrice = number_format($sells_pri);
  if($FRc_SalesPricePoisa > 0){
    $FRc_SalesPrice = number_format($sells_pri,2);
  }
  //+
  $FRc_MarketPrice = number_format($market_pri);
  if($FRc_MarketPricePoisa > 0){
    $FRc_MarketPrice = number_format($market_pri,2);
  }



  //FRD CONVERTION TRACK DATA CUSTOMIZE START:-
  // $FRc_CT_PAGE_TITEL = "HAVE IN HEADER";
  $FRc_CT_ItemSealPrice = $sells_pri;
  $FRc_CT_ItemId = $FRc_ProductIdx;
  $FRc_CT_ItemName = preg_replace("/'/","",$bn_name);
  $FRc_CT_ItemCatName = preg_replace("/'/","",$FRc_Cat1_Name);
  //FRD CONVERTION TRACK DATA CUSTOMIZE END>>



  $FR_R = $FR_CONN->exec("UPDATE frd_products SET vieww = vieww+1 WHERE id = $FRc_ProductIdx");



  //FRD CATEGORY PATH MAKING:-
    if ($r_cat_1 > 0) {
          $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $r_cat_1");
          $row_cat1_name = $FRQ->fetch();
          $FRc_Cat1_Name = $row_cat1_name['bn_name'];
          $pro_catt1_slug = $row_cat1_name['slugg'];
          $FRc_CatPathHtml .= "<span class='rcsp_1'> <a href='$FRD_HURL'> $fr_tn_home_btn_txt </a> / <a href='$FRD_HURL/category/$pro_catt1_slug'> $FRc_Cat1_Name</a> </span>";
            $FRc_RelatedProCatId = $r_cat_1;//temp

          if ($r_cat_2 > 0) {
            $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $r_cat_2");
            $row_cat2_name = $FRQ->fetch();
            $FRc_Cat2_Name = $row_cat2_name['bn_name'];
            $pro_catt2_slug = $row_cat2_name['slugg'];
            $FRc_CatPathHtml .= "<span class='rcsp_2'> <a href='$FRD_HURL/category/$pro_catt2_slug'>/ $FRc_Cat2_Name</a> </span>";
              $FRc_RelatedProCatId = $r_cat_2;//temp
          }
          if ($r_cat_3 > 0) {
            $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $r_cat_3");
            $row_cat3_name = $FRQ->fetch();
            $FRc_Cat3_Name = $row_cat3_name['bn_name'];
            $pro_catt3_slug = $row_cat3_name['slugg'];
            $FRc_CatPathHtml .= "<span class='rcsp_3'> <a href='$FRD_HURL/category/$pro_catt3_slug'>/ $FRc_Cat3_Name</a> </span>";
              $FRc_RelatedProCatId = $r_cat_3;//temp
          }
          if ($r_cat_4 > 0) {
            $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $r_cat_4");
            $row_cat4_name = $FRQ->fetch();
            $FRc_Cat4_Name = $row_cat4_name['bn_name'];
            $pro_catt4_slug = $row_cat4_name['slugg'];
            $FRc_CatPathHtml .= "<span class='rcsp_4'> <a href='$FRD_HURL/category/$pro_catt4_slug'>/ $FRc_Cat4_Name</a> </span>";
              $FRc_RelatedProCatId = $r_cat_4;//temp
          }
    }
  //END>>       


$FRc_PAGE_TITEL = "$FRc_CT_ItemName | $fr_cname";
$FRc_META_TAG_HTML = "
    <meta property='og:title' content='$FRc_PAGE_TITEL'>
    <meta property='og:description' content='$fr_meta_desc. $FRc_Cat1_Name'>
    <meta property='og:url' content='$FRD_HURL/product/$FRc_ProductIdx/$fr_slug'>
    <meta property='og:image' content='$FRD_HURL/frd-data/img/product/$pic_1'>
    <meta property='product:brand' content='$FRc_BRAND_NAME'>
    <meta property='product:availability' content='$FRc_OG_availability'>
    <meta property='product:condition' content='new'>
    <meta property='product:price:amount' content='$sells_pri'>
    <meta property='product:price:currency' content='BDT'>
    <meta property='product:retailer_item_id' content='$FRc_ProductIdx'>
    <meta property='product:item_group_id' content='$skuu'>
    <meta property='og:image:type' content='image/jpeg'/>
    <meta property='og:image:width' content='auto'/>
    <meta property='og:image:height' content='1080'/>

    
    <meta name='keywords' content='$tagg,$FRc_Cat1_Name,spiderecommerce.com,spider eCommerce'>
    <meta name='description' content='$fr_meta_desc'>
    <meta name='page-topic' content='$FRc_Cat1_Name'>
    <meta name='author' content='$fr_cname'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_cname'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";

require_once("frd-public/theme/frd-header.php");
?>

<script>
  const fr_p_lpss = '<?php echo "$fr_p_lps";?>';

  const FRc_CT_ItemSealPricee = '<?php echo "$FRc_CT_ItemSealPrice";?>';
  const FRc_CT_ItemIdd = '<?php echo "$FRc_CT_ItemId";?>';
  const FRc_CT_ItemNamee = '<?php echo "$FRc_CT_ItemName";?>';
  const FRc_CT_ItemCatNamee = '<?php echo "$FRc_CT_ItemCatName";?>';

  const FRc_ProductIdxx = '<?php echo "$FRc_ProductIdx";?>';
  const FRc_ProductVideoo = '<?php echo "$videoo";?>';
  const FRc_ProductSlug = '<?php echo "$fr_slug";?>';
  const fr_messenger_linkk = '<?php echo "$fr_messenger_link";?>';
</script>




<?php require_once("frd-comp-plp-$fr_p_lps.php"); ?>









<?php if($frtex_PixelTrack == 1){ ?>
<script>
    $(document).ready(function() {
    if (typeof fbq === "function") {
        fbq('track', 'ViewContent', {
            plugin: 'SpiderEcommerceFBPixel'
        });
    }
    });
</script>
<?php } ?>




<?php if($frtex_PixelTrack == 2){ ?>
<?php if($fr_p_lps == 2 || $fr_p_lps == 4){ ?>
<script>
    $(document).ready(function() {

    if (typeof fbq === "function") {
        fbq('track', 'InitiateCheckout', {
            currency: 'BDT',
            value: <?php echo "$FRc_CT_ItemSealPrice";?>,
            content_type: 'product',
            content_category: '<?php echo "$FRc_CT_ItemCatName";?>',
            num_items: 1,
            content_name: '<?php echo "$FRc_CT_ItemName";?>',
            content_ids: '<?php echo "$FRc_ProductIdx";?>',
            user_role: 'guest',
            domain: '<?php echo "$FRD_HURL";?>',
            page_title: '<?php echo "$FRc_PAGE_TITEL";?>',
            event_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
            event_source_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
            event_day: '<?php echo "$FR_NOW_DAY_F";?>',
            event_month: '<?php echo "$FR_NOW_MONTH_F";?>',
            event_time: '<?php echo "$FR_NOW_TIME";?>',
            fbc: '<?php echo "$FRc_fbc";?>',
            fbp: '<?php echo "$FRc_fbp";?>',
            plugin: 'PixelYourSiteBySpider'
        },
        {
             event_id: "ic"+FRc_EVENT_IDD
        }
        );
    }

    });

</script>
<?php } ?>
<?php } ?>




<?php if ($frtcplug_GTMdataLayer == 1) { ?>
    <!-- FRD GTM begin_checkout FIRE | FRD GTM EVERNT -->
    <script>
        $(document).ready(function() {

        //FRD VIEW ITEM EVENT:-
          dataLayer.push({
            ecommerce: null
          }); // Clear the previous ecommerce object.
          dataLayer.push({
            event: "view_item",
            client_id: "<?php echo "$FRc_USER_AGENT";?>",
            ip_override: "<?php echo "$FRc_USER_IP";?>",
            user_id: "<?php echo "$FRc_USER_UID";?>",
            plugin: "SpiderEcommerceGTM4DL",
            ecommerce: {
              currency: "BDT",
              value: <?php echo "$sells_pri";?>,
              affiliation: "<?php echo "$fr_cname"; ?>",
              items: [{
                item_id: "<?php echo "$FRc_ProductIdx"; ?>",
                item_name: "<?php echo "$FRc_CT_ItemName"; ?>",
                coupon: "NA",
                currency: "BDT",
                price: <?php echo "$sells_pri"; ?>,
                discount: <?php echo "$discount_pri"; ?>,
                index: 0,
                item_brand: "<?php echo "$FRc_BRAND_NAME"; ?>",
                item_category: "<?php echo "$FRc_Cat1_Name"; ?>",
                item_category2: "<?php echo "$FRc_Cat2_Name"; ?>",
                item_category3: "<?php echo "$FRc_Cat3_Name"; ?>",
                item_category4: "<?php echo "$FRc_Cat4_Name"; ?>",
                item_list_id: "NA",
                item_list_name: "NA",
                item_variant: "<?php echo "$FRc_COLOR_NAME"; ?>",
                location_id: "NA",
                quantity: 1
              }]
            }
          });
        //END>>

    });            
    </script>
<?php } ?>


<?php if($frtcplug_GTMdataLayer == 1){ ?>
<?php if($fr_p_lps == 2 || $fr_p_lps == 4){ ?>
<script>
    $(document).ready(function() {

        //FRD GTM BEGINING CHECKOUT EVENT:-
        dataLayer.push({
            ecommerce: null
          }); // Clear the previous ecommerce object.
          dataLayer.push({
            event: "begin_checkout",
            client_id: "<?php echo "$FRc_USER_AGENT";?>",
            ip_override: "<?php echo "$FRc_USER_IP";?>",
            user_id: "<?php echo "$FRc_USER_UID";?>",
            plugin: "SpiderEcommerceGTM4DL",
            ecommerce: {
              currency: "BDT",
              value: <?php echo "$sells_pri";?>,
              affiliation: "<?php echo "$fr_cname"; ?>",
              items: [{
                item_id: "<?php echo "$FRc_ProductIdx"; ?>",
                item_name: "<?php echo "$FRc_CT_ItemName"; ?>",
                coupon: "NA",
                currency: "BDT",
                price: <?php echo "$sells_pri"; ?>,
                discount: <?php echo "$discount_pri"; ?>,
                index: 0,
                item_brand: "<?php echo "$FRc_BRAND_NAME"; ?>",
                item_category: "<?php echo "$FRc_Cat1_Name"; ?>",
                item_category2: "<?php echo "$FRc_Cat2_Name"; ?>",
                item_category3: "<?php echo "$FRc_Cat3_Name"; ?>",
                item_category4: "<?php echo "$FRc_Cat4_Name"; ?>",
                item_list_id: "NA",
                item_list_name: "NA",
                item_variant: "<?php echo "$FRc_COLOR_NAME"; ?>",
                location_id: "NA",
                quantity: 1
              }]
            }
          });
        //END>>
      });
</script>
<?php } ?>
<?php } ?>


<?php require_once("frd-public/theme/frd-footer.php");?>
<script> FrFunAddToCartManger();</script>