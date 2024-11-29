<?php
//FRD_VC____________________________________:-
if (!isset($url[1]) or $url[1] == "") {
    header("location:$FRD_HURL/?FRH=bgtjsoavx");
}
//++
$FRc_WriterSlug = $url[1]; //WRITER ID
$FR_THIS_PAGE = "$FRD_HURL/writer/$FRc_WriterSlug";



//FRD WRITER TABLE DATA READ:-
$FRR = FR_QSEL("SELECT * FROM frd_writers WHERE fr_writer_slug = '$FRc_WriterSlug'", "");
if ($FRR['FRA'] == 1) {
    extract($FRR['FRD']);
    $FRc_WriterIdX = $id;
} else {
    // ECHO_4($FRR['FRM']);
    FR_GO("$FRD_HURL/?FRH=ddhyujxghx");
}
//END>>



//FRD TOTAL PRODUCT COUNT:-
$FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_products WHERE statuss = 1 AND r_writer = $FRc_WriterIdX");
$FRSD = $FRQ->fetch();
$FRc_T_Products = $FRSD['COUNT(id)'];





require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Writer - $fr_writer_name | $fr_cmetatitle";
$FRc_META_TAG_HTML = "
    <meta property='og:title' content='$FRc_PAGE_TITEL'>
    <meta property='og:description' content='$fr_writer_details'>
    <meta property='og:image' content='$FRD_HURL/frd-data/img/writers/$fr_writer_pic'>
    <meta property='og:url' content='$FR_THIS_PAGE'>
    <meta property='og:image:type' content='image/jpeg'/>
    <meta property='og:image:width' content='400'/>
    <meta property='og:image:height' content='400'/>

    <meta name='keywords' content='$fr_writer_name,$fr_cmetatag'>
    <meta name='author' content='$fr_writer_name'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_writer_name'>
    <meta name='description' content='$fr_writer_details'>
    <meta name='page-topic' content='Ecommerce'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";

require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT animated fadeInLeft">  Title</h2>-->

<!-- 1 scripts s-->
<section>
</section>
<!-- 1 scripts e-->



<!-- BANER IMAGES -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img id="" src="<?php echo "$FRD_HURL/frd-data/img/writers/$fr_writer_pic" ?>" alt="" class="img-responsive" width="200px" height="200px" style="margin:auto;" >
                <h3 class="TAC"><?php echo "$fr_writer_name"; ?></h3>
                <small><?php echo "মোট বই $FRc_T_Products টি"?></small>
                <br>
                <hr>
            </div>
        </div>
    </div>
</section>




<!--  -->
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



<script>
    $(document).ready(function() {
        var limit = 100;
        var start = 0;
        var action = 'inactive';
        var frd_prd = 'pd'; //PRODUCT RESUEST DEVICE
        var writer_id = '<?php echo "$FRc_WriterIdX" ?>';

        function load_data(limit, start) {
            $.ajax({
                url: "<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php"; ?>",
                method: "POST",
                data: {
                    limit: limit,
                    start: start,
                    writer_id: writer_id,
                    frd_prd: frd_prd
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
            var FRposition = $(window).scrollTop() + 300;
            var FRbottom = $(document).height() - $(window).height();
            if (FRposition >= FRbottom && action == 'inactive') {
                //toastr.error('FRD DATA LODING Initializing...  ');
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 200);

                //document.documentElement.scrollTop = FRposition-500;
            }
        });

    });
</script>



<?php require_once("frd-public/theme/frd-footer.php"); ?>