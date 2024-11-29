<?php
require_once('frd1_whoami.php');
$FR_ptitle = "SMS Marketing OSB"; //PAGE TITLE
$p = "$FR_RP"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> SMS Marketing OSB </h2>

<!-- 1 SCRIPT START -->
<section>
    <?php
    //---------------------------------------------------------
    //FRD  - 
    //---------------------------------------------------------
    if (isset($_POST['f_order_status'])) {
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        $FRc_BulkMobNumbers = "";
        
        extract($_POST);

        $FRc_Message = $f_message;

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_order_status)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
            goto THIS_LAST;
        }

        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_order_status != "") {
            $FR_VC_ARF = 1;
        } else {
            FR_SWAL("Please Fill All Required Field", "", "error");
            goto THIS_LAST;
        }


        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){

                $FRQ = "SELECT DISTINCT fr_cust_mob1 FROM frd_order_invo WHERE id > 0";
                if($f_order_status != "ALL"){
                    $FRQ .= " AND fr_stat = $f_order_status";
                }
                $FRQ .= " ORDER BY id ASC LIMIT $f_limit_start,$f_limit_end";

                //FRD QUICK DATA READ 2:-
                    $FRR = FR_QSEL("$FRQ","ALL");
                    $FR_ROWS = $FRR['FR_ROWS'];
                    if($FRR['FRA']==1){  
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
                            $FRc_BulkMobNumbers .="$fr_cust_mob1,";
                        }
                        $FRc_BulkMobNumbers = substr($FRc_BulkMobNumbers, 0, -1);

                            $FRR_SMS = FR_SEND_SMS("$FRc_BulkMobNumbers", "$FRc_Message");
                            if($FRR_SMS['FRA']==1){
                                FR_SWAL("Dear Boss $UsrName! Total $FR_ROWS SMS Send Request Completed", "", "success");
                                FR_GO("$FR_THIS_PAGE",6);
                                exit;
                            }else{
                                FR_TAL("SMS SEND FAILED","error");
                            }

                    } else{ PR($FRR); }
                //END>>

        }


    }


    THIS_LAST:
    ?>
</section>
<!-- 1 SCRIPT END -->








<?php if(!isset($_POST['f_order_status'])){ ?>
<section>
    <div class="container">
        <div class="col-md-11">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 jumbotron">
                    <form id='' action='' method='post'>

                        <span>Select Order Status *</span><br>
                        <select class='form-control' name='f_order_status' required>
                            <?php 
                            if($frsc_om_deforderlist == "new"){
                                $FRQ = $FR_CONN->query("SELECT COUNT(id) AS FRc_T_INVOICE_C FROM frd_order_invo WHERE fr_stat = 1");
                                extract($FRQ->fetch());
                                echo "<option value='1'>New [$FRc_T_INVOICE_C]</option>";
                            }
                            ?>

                            <option value=''>Select Order Status</option>
                            <option value='ALL'>ALL</option>
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

                        <br>
                        <table class="table">
                             <tr>
                                <td>
                                    <span>Limit Start *</span><br>
                                    <input class='form-control' type='number' name='f_limit_start' required>
                                </td>
                                <td>
                                   <span>Limit End *</span><br>
                                   <input class='form-control' type='number' name='f_limit_end' required>
                                </td>
                             </tr>
                        </table>


                      
                        <span>Write Your Message *</span><br>
                        <textarea class='form-control' name='f_message' id='' cols='30' rows='5' placeholder='Enter Text' required></textarea>


                        <br>
                        <div class='text-right'>
                            <button class='btn btn-success' type='submit'> <span class='glyphicon glyphicon-send'></span> Confirm & Send SMS</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5"></div>
            </div>


        </div>
    </div>
</section>
<?php } ?>





<?php require_once('frd1_footer.php'); ?>