<?php
require_once('frd1_whoami.php');
$FR_ptitle="Product Comming Back";//Page  Title
$p="PPRCommingBack";//Page Name
$inn="#";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Product Comming Back </h2> -->
<!-- 1 SCRIPT S-->
<section> 
<?php
//---------------------------------------------------------
//FRD PARCIAL RETURN PRODUCT RECEIVED DATA UPDATE
//---------------------------------------------------------
if(isset($_POST['f_invo_item_id'])){

        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
        $FR_VC_ONLYADMIN = "";//ONLY ADMIN CAN DO THIS

        extract($_POST);

    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($f_invo_item_id)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}
    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_invo_item_id != ""){ $FR_VC_ARF = 1; }else{ FR_SWAL("Please Fill All Required Field","","error"); }
    //FRD_VC___________ THIS USER ADMIN OR NOT:-
        if($UsrType == "ad"){ $FR_VC_ONLYADMIN = 1; }else{ FR_SWAL("Hi $UsrName!","Only Admin Can Do This!","error"); }


        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_ONLYADMIN == 1){
            $FRQ = "UPDATE frd_order_items SET 
            fr_pprr_stat = 1,
            fr_pprr_date = '$FR_NOW_DATE'
            WHERE id = $f_invo_item_id AND fr_invo_id = '$f_invoice_id'";
            $R = FR_DATA_UP("$FRQ");
            if($R['FRA']==1){
                FR_SWAL("$UsrName Product Received Done","","success");
            }else{
                FR_SWAL("$UsrName Product Received Failed","","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }
        }
}
//END>>   
?>
</section>
<!-- 1 SCRIPT E-->


<!-- 1 SCRIPT START -->
<section>
 <?php
    $FRc_SDATE = date("Y-01-01");
    $FRc_EDATE = $FR_NOW_DATE;
 ?>
</section>
<!-- 1 SCRIPT END -->





<section>
    <div class="container">
    <div class="col-md-11">

       <div class="row">
            <form id="" class="" action="">
             <div class='table-responsive'>
                 <table class="table">
                    <tr>
                        <td>
                            <small>From Date</small>
                            <input type="date" class="form-control" name="f_filt_SDATE" id="f_filt_SDATE" value="<?php echo "$FRc_SDATE";?>" required>
                        </td>
                        <td>
                            <small>To Date</small>
                            <input type="date" class="form-control" name="f_filt_EDATE" id="f_filt_EDATE" value="<?php echo "$FRc_EDATE";?>" required>
                        </td>
                        <td>
                            <small>Filter New/Old</small>
                            <select class='form-control' id="f_filt_asc_desc" name='f_filt_asc_desc'>
                                <option value='ASC'>New => Old</option>
                                <option value='DESC'>Old => New</option>
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
                    </tr>
                </table>
            </div>
            </form>
                
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
$(document).ready(function(){

           let f_filt_SDATE = $('#f_filt_SDATE').val();
           let f_filt_EDATE = $('#f_filt_EDATE').val();
           let f_filt_asc_desc = $('#f_filt_asc_desc').val();
           let f_filt_limit = $('#f_filt_limit').val();
            $.ajax({
                url:FR_HURL_APII + "/PPRCommingBack",
                method:"POST",
                data: {f_filt_SDATE:f_filt_SDATE, f_filt_EDATE:f_filt_EDATE, f_filt_asc_desc:f_filt_asc_desc, f_filt_limit:f_filt_limit},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });


        $('#f_filt_SDATE,#f_filt_EDATE,#f_filt_type,#f_filt_asc_desc,#f_filt_limit').on('change', function() {
           let f_filt_SDATE = $('#f_filt_SDATE').val();
           let f_filt_EDATE = $('#f_filt_EDATE').val();
           let f_filt_asc_desc = $('#f_filt_asc_desc').val();
           let f_filt_limit = $('#f_filt_limit').val();

            $.ajax({
                url:FR_HURL_APII + "/PPRCommingBack",
                method:"POST",
                data: {f_filt_SDATE:f_filt_SDATE, f_filt_EDATE:f_filt_EDATE, f_filt_asc_desc:f_filt_asc_desc, f_filt_limit:f_filt_limit},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });
        });
  
});
</script>


 
 <?php require_once('frd1_footer.php'); ?>