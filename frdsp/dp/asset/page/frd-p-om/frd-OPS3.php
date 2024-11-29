<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Order Closing";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> OPS1</h2> -->

<style>

</style>

<!-- 1 SCRIPT S-->
<section>
    <?php
    //FRD VALIDATION CHACKING|| ONLY ADMIN CAN ACCESS THIS PAGE:-
    if($UsrType != "ad" AND $UsrType != "M" AND $UsrType != "x"){
        FR_SWAL("ACCESS DENIED", "$UsrName", "error");
        FR_GO("$FR_SP_HURL_DP/om-OPS1",3);
        exit;
    }

    $FRc_SDATE = date("Y-01-01");
    $FRc_EDATE = $FR_NOW_DATE;

    $FRc_url_search_text = "";
    if (isset($_GET['search_text'])) {
        $FRc_url_search_text = $_GET['search_text'];
    }

    $FRc_Filt_OA_Usr = "";
    if($UsrType == "OCA"){ $FRc_Filt_OA_Usr = $UsrId; }
    ?>
</section>
<!-- 1 SCRIPT E-->




<section id="fr_filter_sec_2">
    <div class="container">
        <div class="col-md-11">
  

            <!-- sgdgdgdgh -->
            <div class="row">
                <div class="owl-carousel owl-theme fr_oc_orders frd-card-1">
                    <?php

                    $FRc_ARR = [4,7,15,5];
                    $FRc_STAT = FRF_INVOICE_STAT();
                    foreach ($FRc_ARR as $FR_ITEM) {
         
                        $s_code = $FRc_STAT[$FR_ITEM]["s_code"];
                        $s_title = $FRc_STAT[$FR_ITEM]["s_title"];

                            $FRc_Q = "SELECT COUNT(id) FROM frd_order_invo WHERE fr_stat = $s_code";
                            if($FRc_Filt_OA_Usr != ""){  $FRc_Q .=" AND fr_o_a_usrid = $FRc_Filt_OA_Usr"; }
                            $FRQ = $FR_CONN->query("$FRc_Q");
                            $FRSD = $FRQ->fetch();
                            $FR_T_INVOICE_C = $FRSD['COUNT(id)'];
                            
                            echo "
                                <div class='item frtrig_search_stat' frval='$s_code' role='button' >
                                    <div class='text-center btn btn-default btn-block'>
                                        <small> <i class='fa-solid fa-cart-shopping'> </i> $s_title  </small>
                                        <h3>$FR_T_INVOICE_C</h3>
                                    </div>
                                </div>
                            ";
                    }
                
                    ?>
                </div>
            </div>
            <!-- sgdgdgdgh -->



            <div class="row">
                <div class="col-md-12">
                    <form id="FormOrderFilt" class="" action="">
                        <div class='table-responsive'>
                            <table class="table">
                                <tr>
                                    <td>
                                        <small>OrderId</small>
                                        <input class="form-control f_search_order_id_past" type="text" id="f_search_order_id" placeholder="Enter Text">
                                    </td>
                                    <td>
                                        <small>Mobile, Name, Address</small>
                                        <input class="form-control f_search_text_past" type="text" id="f_search_text" placeholder="Enter Text">
                                    </td>
                                    <td>
                                        <small>Filter Delivery Partner</small>
                                        <select class='form-control' id="f_search_DeliveryPart" name='f_search_DeliveryPart'>
                                            <option value=''>ALL</option>
                                            <?php
                                            $FRR = FR_QSEL("SELECT * FROM frd_shippart ORDER BY id ASC", "ALL");
                                            if ($FRR['FRA'] == 1) {
                                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                                    extract($FR_ITEM);
                                                    echo "<option value='$id'>$frd_namee</option>";
                                                }
                                            } else {
                                                PR($FRR);
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <small>From Date</small>
                                        <input type="date" class="form-control" name="f_filt_SDATE" id="f_filt_SDATE" value="<?php echo "$FRc_SDATE"; ?>" required>
                                    </td>
                                    <td>
                                        <small>To Date</small>
                                        <input type="date" class="form-control" name="f_filt_EDATE" id="f_filt_EDATE" value="<?php echo "$FRc_EDATE"; ?>" required>
                                    </td>
                                    <td>
                                        <small>Filter New/Old</small>
                                        <select class='form-control' id="f_filt_asc_desc" name='f_filt_asc_desc'>
                                            <option value='DESC'>Old => New</option>
                                            <option value='ASC'>New => Old</option>
                                        </select>
                                    </td>
                                </tr>

    
                            </table>

                        </div>
                        <input type="hidden" id="f_search_stat" value="4">
                        <input type="hidden" id="f_filt_limit" value="60">
                        <input type="hidden" id="f_Filt_OA_Usr" value="<?php echo "$FRc_Filt_OA_Usr";?>">
                    </form>

                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div id="FRD_LIST"></div>
                </div>
            </div>




        </div>
    </div>
</section>





<script>
    const url_search_text = '<?php echo "$FRc_url_search_text"; ?>';

    $(document).ready(function() {



            let f_search_stat = $('#f_search_stat').val();
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();

            $.ajax({
                url: FR_HURL_APII + "/InvoiceList",
                method: "POST",
                data: {
                    f_search_stat: f_search_stat,
                    f_Filt_OA_Usr: f_Filt_OA_Usr,
                    f_search_DeliveryPart: f_search_DeliveryPart,
                    f_filt_SDATE: f_filt_SDATE,
                    f_filt_EDATE: f_filt_EDATE,
                    f_filt_asc_desc: f_filt_asc_desc,
                    f_filt_limit: f_filt_limit
                },
                success: function(data) {
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });



        $( ".frtrig_search_stat" ).on( "click", function() {
            let frval = $(this).attr("frval"); 
            $('#f_search_stat').val(frval);

                let f_search_stat = $('#f_search_stat').val();
                let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
                let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
                let f_filt_SDATE = $('#f_filt_SDATE').val();
                let f_filt_EDATE = $('#f_filt_EDATE').val();
                let f_filt_asc_desc = $('#f_filt_asc_desc').val();
                let f_filt_limit = $('#f_filt_limit').val();

                $.ajax({
                    url: FR_HURL_APII + "/InvoiceList",
                    method: "POST",
                    data: {
                        f_search_stat: f_search_stat,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_filt_SDATE: f_filt_SDATE,
                        f_filt_EDATE: f_filt_EDATE,
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit
                    },
                    success: function(data) {
                        $('#FRD_LIST').html(data);
                        $("#FRD_LIST").hide();
                        $("#FRD_LIST").show(300);
                    }
                });
        });



        $('#f_search_DeliveryPart,#f_filt_SDATE,#f_filt_EDATE,#f_filt_asc_desc,#f_filt_limit').on('change', function() {
            let f_search_stat = $('#f_search_stat').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();

            $.ajax({
                url: FR_HURL_APII + "/InvoiceList",
                method: "POST",
                data: {
                    f_search_stat: f_search_stat,
                    f_Filt_OA_Usr: f_Filt_OA_Usr,
                    f_search_DeliveryPart: f_search_DeliveryPart,
                    f_filt_SDATE: f_filt_SDATE,
                    f_filt_EDATE: f_filt_EDATE,
                    f_filt_asc_desc: f_filt_asc_desc,
                    f_filt_limit: f_filt_limit
                },
                success: function(data) {
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });
        });




        $('#f_search_text').keyup(function() {
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            var f_search_text = $(this).val();
            if (f_search_text != "") {
                $.ajax({
                    url: FR_HURL_APII + "/InvoiceList",
                    method: "POST",
                    data: {
                        f_search_stat: f_search_stat,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_filt_SDATE: f_filt_SDATE,
                        f_filt_EDATE: f_filt_EDATE,
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit,
                        f_search_text: f_search_text
                    },
                    success: function(data) {
                        // alert(data);
                        $('#FRD_LIST').html(data);
                    }
                });
            }

            if (f_search_text == "") {
                $('#FRD_LIST').html("");
            }
        });
        //++
        //++
        $(".f_search_text_past").bind("paste", function(e) {
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            var f_search_text = e.originalEvent.clipboardData.getData('text');
            // alert(f_search_text);

            if (f_search_text != "") {
                $.ajax({
                    url: FR_HURL_APII + "/InvoiceList",
                    method: "POST",
                    data: {
                        f_search_stat: f_search_stat,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_filt_SDATE: f_filt_SDATE,
                        f_filt_EDATE: f_filt_EDATE,
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit,
                        f_search_text: f_search_text
                    },
                    success: function(data) {
                        // alert(data);
                        $('#FRD_LIST').html(data);
                    }
                });
            }
        });
        //++
        //++
        if (url_search_text != "") {
            $.ajax({
                url: FR_HURL_APII + "/InvoiceList",
                method: "POST",
                data: {
                    f_search_text: url_search_text
                },
                success: function(data) {
                    // alert(data);
                    $('#FRD_LIST').html(data);
                }
            });
        }



        $('#f_search_order_id').keyup(function() {
            let f_search_stat = $('#f_search_stat').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            var f_search_order_id = $(this).val();
            if (f_search_order_id != "") {
                $.ajax({
                    url: FR_HURL_APII + "/InvoiceList",
                    method: "POST",
                    data: {
                        f_search_stat: f_search_stat,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_filt_SDATE: f_filt_SDATE,
                        f_filt_EDATE: f_filt_EDATE,
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit,
                        f_search_order_id: f_search_order_id
                    },
                    success: function(data) {
                        $('#FRD_LIST').html(data);
                    }
                });
            }
        });
        //++
        //++
        $(".f_search_order_id_past").bind("paste", function(e) {
            let f_search_stat = $('#f_search_stat').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            var f_search_order_id = e.originalEvent.clipboardData.getData('text');
            if (f_search_order_id != "") {
                $.ajax({
                    url: FR_HURL_APII + "/InvoiceList",
                    method: "POST",
                    data: {
                        f_search_stat: f_search_stat,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_filt_SDATE: f_filt_SDATE,
                        f_filt_EDATE: f_filt_EDATE,
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit,
                        f_search_order_id: f_search_order_id
                    },
                    success: function(data) {
                        $('#FRD_LIST').html(data);
                    }
                });
            }
        });



            /////////////////////////////////////////// 
            //FRD OWL CAROSOL:-
            ///////////////////////////////////////////  
            $('.fr_oc_orders').owlCarousel({
                loop: false,
                margin: 20,
                nav: false,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                dots: false,
                responsive: {
                    0: {
                        items: 4
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 4
                    }
                }
            });
            //END>>

    });
</script>


<?php require_once('frd1_footer.php'); ?>