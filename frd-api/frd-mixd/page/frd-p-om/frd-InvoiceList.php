<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Invoice Lis";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Invoice List </h2>

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

    ?>
</section>
<!-- 1 SCRIPT E-->






<section id="fr_filter_sec_2">
    <div class="container">
        <div class="col-md-11">

            <div class="row">
                <div class="col-md-12">
                    <form id="FormOrderFilt" class="" action="">
                        <div class='table-responsive'>
                            <table class="table">
                                <tr>
                                    <td>
                                        <small>Search By Order Id</small>
                                        <input class="form-control f_search_order_id_past" type="text" id="f_search_order_id" placeholder="Enter Text">
                                    </td>
                                    <td>
                                        <small>Mobile, Name, Address</small>
                                        <input class="form-control f_search_text_past" type="text" id="f_search_text" placeholder="Enter Text">
                                    </td>
                                    <td>
                                        <small>Filter Order Status</small>
                                        <select class='form-control' id="f_search_stat" name='f_search_stat'>
                                            <?php 
                                            if($frsc_om_deforderlist == "new"){
                                                $FRQ = $FR_CONN->query("SELECT COUNT(id) AS FRc_T_INVOICE_C FROM frd_order_invo WHERE fr_stat = 1");
                                                extract($FRQ->fetch());
                                               echo "<option value='1'>New [$FRc_T_INVOICE_C]</option>";
                                            }
                                            ?>
                                             
                                            <option value=''>ALL</option>
                                            <?php
                                            $FRR_INVOICE_STAT = FRF_INVOICE_STAT();
                                            foreach ($FRR_INVOICE_STAT AS $FR_ITEM) {
                                                extract($FR_ITEM);
                                                $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_order_invo WHERE fr_stat = $s_code");
                                                $FRSD = $FRQ->fetch();
                                                $FR_T_INVOICE_C = $FRSD['COUNT(id)'];
                                                echo "<option value='$s_code'>$s_title [ $FR_T_INVOICE_C ]</option>";
                                            }
                                            ?>
                                        </select>
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
                                        <small title="Order Place User">Filter OPU</small>
                                        <select class='form-control' id="f_search_op_user" name='f_search_op_user'>
                                            <option value=''>ALL</option>
                                            <?php
                                            $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE typee IN('ad','x','OCA') AND statuss = 1 ORDER BY id ASC", "ALL");
                                            if ($FRR['FRA'] == 1) {
                                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                                    extract($FR_ITEM);
                                                    echo "<option value='$id'>$namee</option>";
                                                }
                                            } else {
                                                PR($FRR);
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <small title="Order Assinee Based">Filter OAB</small>
                                        <select class='form-control' id="f_Filt_OA_Usr" name='f_Filt_OA_Usr'>
                                            <option value=''>ALL</option>
                                            <?php
                                            $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE typee IN('ad','x','OCA') AND statuss = 1 ORDER BY id ASC", "ALL");
                                            if ($FRR['FRA'] == 1) {
                                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                                    extract($FR_ITEM);
                                                    echo "<option value='$id'>$namee</option>";
                                                }
                                            } else {
                                                PR($FRR);
                                            }
                                            ?>
                                            <option value='0'>Unassigned</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
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
                                    <td>
                                        <small>Limit</small>
                                        <select class='form-control' id="f_filt_limit" name='f_filt_limit'>
                                            <option value='100'>100</option>
                                            <option value='300'>300</option>
                                            <option value='600'>600</option>
                                            <option value='900'>900</option>
                                            <option value='1500'>1500</option>
                                            <option value='2000'>2000</option>
                                            <option value='3000'>3000</option>
                                            <option value='6000'>6000</option>
                                        </select>
                                    </td>
                                    <td>
                                        <small>Complain</small>
                                        <select class='form-control' id="f_filt_complain" name='f_filt_complain'>
                                            <option value=''>NA</option>
                                            <option value='1'>Complain Processing</option>
                                            <option value='2'>Complain Solved</option>
                                        </select>
                                    </td>
                                    <td>
                                        <small>Schedule Delivery Date</small>
                                        <input type="date" class="form-control" name="f_filt_schedule_d_date" id="f_filt_schedule_d_date" required>
                                    </td>
                                </tr>
                            </table>


                        </div>
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
            let f_search_op_user = $('#f_search_op_user').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();

            $.ajax({
                url: FR_HURL_APII + "/InvoiceList",
                method: "POST",
                data: {
                    f_search_stat: f_search_stat,
                    f_bulk_action_form: 1,
                    f_search_DeliveryPart: f_search_DeliveryPart,
                    f_search_op_user: f_search_op_user,
                    f_Filt_OA_Usr: f_Filt_OA_Usr,
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



        $('#f_search_stat,#f_search_DeliveryPart,#f_search_op_user,#f_Filt_OA_Usr,#f_filt_SDATE,#f_filt_EDATE,#f_filt_schedule_d_date,#f_filt_asc_desc,#f_filt_limit,#f_filt_complain').on('change', function() {
            let f_search_stat = $('#f_search_stat').val();
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_search_op_user = $('#f_search_op_user').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
            let f_filt_SDATE = $('#f_filt_SDATE').val();
            let f_filt_EDATE = $('#f_filt_EDATE').val();
            let f_filt_schedule_d_date = $('#f_filt_schedule_d_date').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            let f_filt_complain = $('#f_filt_complain').val();

            $.ajax({
                url: FR_HURL_APII + "/InvoiceList",
                method: "POST",
                data: {
                    f_search_stat: f_search_stat,
                    f_bulk_action_form: 1,
                    f_search_DeliveryPart: f_search_DeliveryPart,
                    f_search_op_user: f_search_op_user,
                    f_Filt_OA_Usr: f_Filt_OA_Usr,
                    f_filt_SDATE: f_filt_SDATE,
                    f_filt_EDATE: f_filt_EDATE,
                    f_filt_schedule_d_date: f_filt_schedule_d_date,
                    f_filt_complain: f_filt_complain,
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
            let f_search_op_user = $('#f_search_op_user').val();    
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
                        f_bulk_action_form: 1,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_search_op_user: f_search_op_user,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
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
            let f_search_op_user = $('#f_search_op_user').val();
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
                        f_bulk_action_form: 1,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_search_op_user: f_search_op_user,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
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
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_search_op_user = $('#f_search_op_user').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
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
                        f_bulk_action_form: 1,
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_search_op_user: f_search_op_user,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
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
            let f_search_DeliveryPart = $('#f_search_DeliveryPart').val();
            let f_search_op_user = $('#f_search_op_user').val();
            let f_Filt_OA_Usr = $('#f_Filt_OA_Usr').val();
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
                        f_search_DeliveryPart: f_search_DeliveryPart,
                        f_bulk_action_form: 1,
                        f_search_op_user: f_search_op_user,
                        f_Filt_OA_Usr: f_Filt_OA_Usr,
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

    });
</script>


<?php require_once('frd1_footer.php'); ?>