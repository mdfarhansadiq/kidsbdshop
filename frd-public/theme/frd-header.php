<?php
ob_start();
//FRD CONVERTION TRACK DATA CUSTOMIZE START:-
$FRc_CT_PAGE_TITEL = preg_replace("/'/","",$FRc_PAGE_TITEL);
//FRD CONVERTION TRACK DATA CUSTOMIZE END>>
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--iamfromthemeheader-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; -->
    <?php echo "$FRc_META_TAG_HTML";?>
    <title><?php echo "$FRc_PAGE_TITEL";?></title>
	<!-- icon  -->
	<link rel="icon" href="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_cicon"?>">
    <!-- End Canonical Code -->
    <link rel="canonical" href="<?php echo "$FRD_HURL".$_SERVER['REQUEST_URI'];?>"/>
    <!-- Bootstrap -->
    <link href="<?php echo "$FR_HURL_AT/asset"?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo "$FR_HURL_AT/asset/css/style_frd_v9.css?v=$FR_SOFT_VERSION"?>" rel="stylesheet">
    <link href="<?php echo "$FR_HURL_AT/asset"?>/css/animatee.css" rel="stylesheet">
    <link href="<?php echo "$FR_HURL_AT/asset"?>/css/chosen.css" rel="stylesheet">
    <link href="<?php echo "$FR_HURL_AT/asset"?>/fonts/SolaimanLipiNormal/styles.css" rel="stylesheet">
    <!-- OWL CAROSOL CSS-->
    <link href="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/css/owl.carousel.min.css"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/css/owl.theme.green.min.css"?>" rel="stylesheet">
    <!-- FONT AWESOM ICON CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- THEME CSS -->
    <link href="<?php echo "$FR_HURL_AT/asset/css/style.css?v=$FR_SOFT_VERSION"?>" rel="stylesheet">
    <link href="<?php echo "$FR_HURL_AT/asset/css/style-home-page.css?v=$FR_SOFT_VERSION"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frd-src/inc/toastr/toastr.min.css"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frd-data/theme/frd-color-customize.css?v=$frtc_s_ow_v";?>" rel="stylesheet">

    <!-- ---------------------------------------------------------------- -->
    <!-- JQURY/JS -->
    <script src="<?php echo "$FRD_HURL/frd-src/inc/js/jquery-3.4.1.min.js"?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/toastr/toastr.min.js"?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/js/owl.carousel.min.js"?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/js/sweetalert.min.js"?>"></script>
    <script>
        const FRD_HURLL = "<?php echo "$FRD_HURL";?>";
        const FR_HURL_APII = "<?php echo "$FR_HURL_API";?>";
        const FR_NOW_TIMEE = '<?php echo "$FR_NOW_TIME";?>';
        const FR_NOW_DAY_FF = '<?php echo "$FR_NOW_DAY_F";?>';
        const FR_NOW_MONTH_FF = '<?php echo "$FR_NOW_MONTH_F";?>';
        const FR_PG_RR = "<?php echo "$FR_PG_R";?>";
        const FR_SERVERR = '<?php echo "$frd_server";?>';
        const FRD_AKEY_2 = '<?php echo "$FR_AKEY_2";?>';
        const fr_fot_developed_by_txtt = '<?php echo "$fr_fot_developed_by_txt";?>';
        const frtcplug_GTMdataLayerr = '<?php echo "$frtcplug_GTMdataLayer";?>';
        const frtex_PixelTrackk = '<?php echo "$frtex_PixelTrack";?>';
        const FR_FLASH_SALES_END_TIME = '<?php echo "$FR_FLASH_SELLS_TIME";?>';
        const frplug_capii = '<?php echo "$frplug_capi";?>';
        const FRc_USER_AGENTT = '<?php echo "$FRc_USER_AGENT";?>';
        const FRc_USER_IPP = '<?php echo "$FRc_USER_IP";?>';
        const FRc_USER_UIDD = '<?php echo "$FRc_USER_UID";?>';
        const FRc_EVENT_IDD = '<?php echo "$FRc_EVENT_ID";?>';
        const FRc_EXTERNAL_IDD = '<?php echo "$FRc_EXTERNAL_ID";?>';
        const FRc_fbcc = '<?php echo "$FRc_fbc";?>';
        const FRc_fbpp = '<?php echo "$FRc_fbp";?>';
        const FRc_THIS_PAGE_URLL = '<?php echo "$FRc_THIS_PAGE_URL";?>';
        const FRc_CT_PAGE_TITELL = '<?php echo "$FRc_CT_PAGE_TITEL";?>';
        const FRc_Cnamee = '<?php echo "$fr_cname";?>';
        const FRc_Whatsappp = '<?php echo "$fr_whatsapp";?>';
    </script>
    <!-- FRD INSERT HEADER -->
    <?php require_once($FR_HDPATH."frd-data/mixd/frd-insert-header.php");?>
    
    <?php if($frtex_PixelTrack == 1){ ?>
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo "$frtex_PixelId";?>');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?php echo "$frtex_PixelId";?>&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
    <?php } ?>

    <?php if($frtex_PixelTrack == 2){ ?>
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '<?php echo "$frtex_PixelId";?>', {
            external_id: FRc_EXTERNAL_IDD,
            fbc: '<?php echo "$FRc_fbc";?>',
            fbp: '<?php echo "$FRc_fbp";?>'
        });

        fbq(
          "track",
          "PageView",
          {
            user_role: "guest",
            domain: FRD_HURLL,
            page_title: FRc_CT_PAGE_TITELL,
            event_url: FRc_THIS_PAGE_URLL,
            event_source_url: FRc_THIS_PAGE_URLL,
            event_day: FR_NOW_DAY_FF,
            event_month: FR_NOW_MONTH_FF,
            event_time: FR_NOW_TIMEE,
            fbc: FRc_fbcc,
            fbp: FRc_fbpp,
            plugin: "PixelYourSiteBySpider",
          },
          {
            event_id: "pv" + FRc_EVENT_IDD,
          }
        );
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?php echo "$frtex_PixelId";?>&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
    <?php } ?>

  </head>
    <body id="main" class="bodyy">
    <!-- FRD INSERT BODY -->
    <?php require_once($FR_HDPATH."frd-data/mixd/frd-insert-body.php");?>

    <?php
        echo "<div class='text-center' id='FR_PageLodeTime'> </div>";
        require_once("compo/header/frd-header-$frtc_header_n.php");
        require_once('compo/cart-right-side-nav.php');
        require_once("compo/frd-left-side-nav.php");
    ?>
    <div class="container">
        <div class="row">
            <div id="FR_DATA_SEARCH_PRODUCT" class=""></div>
        </div>
    </div>


    <?php if($fr_headline_dplay == 1){ ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="xs frs_headline">
                    <table>
                        <tr>
                            <td class="td1">
                                <span><span class="glyphicon glyphicon-volume-up"></span> <?php echo "$fr_headline_txt";?> </span>
                            </td>
                            <td class="td2">
                                <span class="">
                                    <marquee><?php echo "$fr_headline_data";?></marquee>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>