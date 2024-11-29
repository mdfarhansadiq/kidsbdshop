<?php
require_once('frd1_whoami.php');
$FR_ptitle="Partial Product Received Statment DB";//Page  Title
$p="PPRReceivedStatmentDB";//Page Name
$inn="#";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Partial Product Received Statment Daily Based</h2> -->


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
                url:FR_HURL_APII + "/PPRReceivedStatmentDB",
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
                url:FR_HURL_APII + "/PPRReceivedStatmentDB",
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