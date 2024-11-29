<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Writers - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
    <meta property='og:title' content='$FRc_PAGE_TITEL'>
    <meta property='og:description' content='$fr_cmetades'>
    <meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
    <meta property='og:url' content='$FR_THISPAGE'>
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
<!-- 1 scripts s-->
<section>
    <?php
    //FRD TOTAL WRITERS COUNT:-
    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_writers WHERE fr_writer_stat = 1 AND fr_writer_visi = 1");
    $FRSD = $FRQ->fetch();
    $FRc_T_Writers = $FRSD['COUNT(id)'];
    
    ?>
</section>
<!-- 1 scripts e-->

<h2 class="PT"> মোট <?php echo "$FRc_T_Writers";?> জন লেখক পাওয়া গিয়েছে </h2>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="load_data"></div>
                <div id="load_data_message"></div>
            </div> 
        </div>
    </div>
</section>







<script type="text/javascript">
    $(document).ready(function() {


        /////////////////////////////////////////////
        //FRD WRITERS LIST  CALL
        /////////////////////////////////////////////    
        var limit = 90;
        var start = 0;
        var action = 'inactive';
        function load_data(limit, start) {
            $.ajax({
                url:FR_HURL_APII + "/writers_list",
                method: "POST",
                data: {
                    limit: limit,
                    start: start
                },
                cache: false,
                success: function(data) {
                    $('#load_data').append(data);
                    if (data == '') {
                        $('#load_data_message').html("");
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
            if (action == 'inactive') {
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 200);
            }
        });
        //END>>



    });
</script>




<?php require_once("frd-public/theme/frd-footer.php"); ?>