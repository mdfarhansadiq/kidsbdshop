<?php 
require_once('frd1_whoami.php');
$FR_ptitle="XML Sitemap Manager";//PAGE TITLE
$p="shipzone";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> XML Sitemap Manager </h2>


<!-- 1 SCRIPT S -->
<section>
<?php
if(isset($_POST['FRtrig_SitemapMakeXML'])){
    FRF_SitemapMakeXML($FR_PATH_HD);
} 


// <changefreq>: How frequently the page is likely to change (e.g., always, hourly, daily, weekly, monthly, yearly, never).


 function FRF_SitemapMakeXML($FR_PATH_HD){
    global $FR_CONN,$FRD_HURL,$FR_NOW_DATE;

    $FRc_OP_Html = "<?xml version='1.0' encoding='UTF-8'?>
    <urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>
    
      <!-- TOP -->
      <url>
        <loc>$FRD_HURL</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/products</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/categories</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/categories_list</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/brands</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/flash-sales</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/offers</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>
      <url>
        <loc>$FRD_HURL/login</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
      </url>";

      

      $FRc_OP_Html .=" 
      <!-- Product Categories -->";
      $FRQ = $FR_CONN->query("SELECT slugg FROM frd_categoriess WHERE statuss = 1");
      foreach($FRQ->fetchAll() as $FR_ITEM){
        extract($FR_ITEM);
        $FRc_OP_Html .="
          <url>
            <loc>$FRD_HURL/category/$slugg</loc>
            <lastmod>$FR_NOW_DATE</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
          </url>";
      }



      $FRc_OP_Html .="
      <!-- Product Pages -->";
      $FRQ = $FR_CONN->query("SELECT id,fr_slug FROM frd_products WHERE pro_typ = 1 AND statuss = 1");
      foreach($FRQ->fetchAll() as $FR_ITEM){
        extract($FR_ITEM);
        $FRc_OP_Html .="
          <url>
            <loc>$FRD_HURL/product/$id/$fr_slug</loc>
            <lastmod>$FR_NOW_DATE</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
          </url>";
      }


      $FRc_OP_Html .="
      <!-- Static Pages -->
      <url>
        <loc>$FRD_HURL/page/about</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/contact</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/terms-and-conditions</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/privacy-policy</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/delivery-policy</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/return-policy</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/refund-policy</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/mission</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
      <url>
        <loc>$FRD_HURL/page/vision</loc>
        <lastmod>$FR_NOW_DATE</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
      </url>
    ";

    $FRc_OP_Html .= "</urlset>";

    $FR_fh = fopen( $FR_PATH_HD."sitemap.xml", "w");
    $FR_fdata = "$FRc_OP_Html";
    if(fwrite( $FR_fh, $FR_fdata )){
        FR_TAL("XML Sitemap Update Done","success");
    }else{
        FR_TAL("XML Sitemap Update Failed","success");
    }
    fclose( $FR_fh );




$FR_fh_robotsTxt = fopen( $FR_PATH_HD."robots.txt", "w");
$FR_fdata_RobotsTxt = "# Block all crawlers from accessing
User-agent: *
Disallow: /admin/
Disallow: /ss-login/
Disallow: /Spider_eCommerce-login/
Disallow: /checkout/

# Allow all crawlers to access
User-agent: *
Allow: /products/
Allow: /categories/
Allow: /categories_list/
Allow: /offers/
Allow: /flash-sales/

# Specify the location of the sitemap
User-agent: *
Sitemap: $FRD_HURL/sitemap.xml
";
if(fwrite( $FR_fh_robotsTxt, $FR_fdata_RobotsTxt )){
  FR_TAL("Robots Txt Update Done","success");
}else{
  FR_TAL("Robots Txt Update Failed","success");
}
fclose( $FR_fh_robotsTxt );

    

}
//END>>
?>
</section>
<!-- 1 SCRIPT E -->




<section>
    <div class="container">
    <div class="col-md-11">


      <div class="row jumbotron">
        <div class="col-md-12">
            <form action='' method='POST'>
                <button type='submit' class='btn btn-success btn-block' name="FRtrig_SitemapMakeXML"> <span class='glyphicon glyphicon-flash'></span> Update XML Sitemap</button>
            </form>
        </div>
        <br><br><br>
        <div class="col-md-12">
            <button class="btn btn-info btn-block"><a class="frd_tdn fr-color-white" href="<?php echo "$FRD_HURL/sitemap.xml";?>" target="_blank">View XML Sitemap</a></button>
        </div>
      </div> 



    </div>
    </div>
</section> 

   




<?php require_once('frd1_footer.php'); ?>