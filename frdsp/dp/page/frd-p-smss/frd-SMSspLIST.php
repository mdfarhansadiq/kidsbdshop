<?php 
require_once('frd1_whoami.php');
$FR_ptitle="SMS Services Customize";//PAGE TITLE
$p="SMSspLIST";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> SMS Services Customize </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    





<section>
    <div class="container">
    <div class="col-md-11">

      <div class="row">
        <div class="col-md-12 jumbotron">
            <?php 
             $FRR = FR_QSEL("SELECT * FROM frd_sms_sp ORDER BY id ASC","ALL");
             if($FRR['FRA']==1){ 
                    echo "<table class='table table-bordered'>";
                    echo "
                        <tr class='alert alert-success'>
                            <td>SL</td>
                            <td>SMS SP</td>
                            <td>Status</td>
                            <td class='text-right'>Action</td>
                        </tr>
                    ";
             
                            $FRc_SL = 1;
                            foreach($FRR['FRD'] as $FR_ITEM){
                                extract($FR_ITEM);

                                if($fr_sms_sp_stat == 0){$fr_sms_sp_stat_M = "<span class='label label-danger'>DEACTIVATED</span>";}
                                if($fr_sms_sp_stat == 1){$fr_sms_sp_stat_M = "<span class='label label-success'>ACTIVATED</span>";}
                                    echo "
                                        <tr>
                                            <td>$FRc_SL</td>
                                            <td>$fr_sms_sp_name</td>
                                            <td>$fr_sms_sp_stat_M</td>
                                            <td class='text-right'>
                                                <a class='btn btn-success' href='smss-SMSspEdit/$id'> <span class='glyphicon glyphicon-pencil'></span></a>
                                              </td>
                                        </tr> 
                                    ";
                                    
                                $FRc_SL = ($FRc_SL + 1);
                            }
                    
                    echo "</table>";
             } else{ 
               //   PR($FRR);
               echo "<div class='text-center alert alert-danger'>No Data Found</div>";
             }

            ?>
        </div>
      </div>

    </div>
    </div>
</section>







<?php require_once('frd1_footer.php'); ?>