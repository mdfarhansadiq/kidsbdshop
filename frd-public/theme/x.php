<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cname - $fr_ctagline";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='xx$fr_cname - $fr_ctagline - $fr_cmetades'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FRD_HURL'>
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
<h2 class="PT"> Page Title </h2>
<!-- 1 scripts s-->
<section>
<?php   



?>
</section>
<!-- 1 scripts e-->









<?php require_once("frd-public/theme/frd-footer.php");?>