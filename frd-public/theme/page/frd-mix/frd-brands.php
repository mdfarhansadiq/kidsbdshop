<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "ALl Brands - $fr_cmetatitle";
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
//Total found brand count s:-    
$FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_brandss");
$row_totfoundb_c = $FRQ->fetch();
$TotalFoundBrandCount = $row_totfoundb_c['COUNT(id)'];
$Total_FoundBrand_notiecho = " <b class='boldd'> $TotalFoundBrandCount</b> $frlc_t_brand_found_txt  ";
//END>>

?>
<!--<h2 class="PT ">  ALL BRAND </h2>-->



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="animated zoomIn"><span class='glyphicon glyphicon-flash alertt'></span> <?php echo "$Total_FoundBrand_notiecho"; ?></h3>
        </div>
        <!-- <div class="col-md-6">
            <form action="" method="post">
                  <table width="100%">
                      <tr>
                          <td>
                              <input class="form-control" type="text" id="frf_keyup_txt" placeholder="ব্র্যান্ড সার্চ করুন এখানে">
                          </td>
                      </tr>
                  </table>
             </form>
        </div> -->
    </div>
</div>





<!-- brand box list section  -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="load_data_keyup"></div>
                <div id="load_data"></div>
            </div>
        </div>

    </div>
</section>

<?php require_once("frd-public/theme/frd-footer.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {

        var start = 0;
        var limit = 100;
        var action = 'inactive';

        function load_data(limit, start) {
            $.ajax({
                url: "<?php echo "$FR_HURL_AT/inc/jq_ajax/fetch/f_brands.php"; ?>",
                method: "POST",
                data: {
                    limit: limit,
                    start: start
                },
                cache: false,
                success: function(data) {
                    $('#load_data').append(data);
                    if (data == '') {
                        $('#load_data_keyup').html("");
                        action = 'active';
                    } else {
                        $('#load_data_message').html("");
                        action = "inactive";
                    }
                }
            });
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }
        $(window).scroll(function() {
            var FRposition = $(window).scrollTop() + 300;
            var FRbottom = $(document).height() - $(window).height();
            if (FRposition >= FRbottom && action == 'inactive') {
                //toastr.error('FRD DATA LODING Initializing...  ');
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 200);

                document.documentElement.scrollTop = FRposition - 500;
            }
        });



        ///////////////////////////////////////////////////////////////////////
        ///////////////// FRD AUTO SEARCH  FETCHING //////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $('#frf_keyup_txt').keyup(function() {
            alert("This Feature Is Under Construction");
        });



    });
</script>