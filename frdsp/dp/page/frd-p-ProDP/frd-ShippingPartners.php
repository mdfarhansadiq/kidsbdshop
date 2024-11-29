<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Delivery Partners";//PAGE TITLE
$p="a_shippart";//PAGE NAME
$inn="";
$FRc_THIS_P_ID = 21;//THIS PANEL ID [21=DELIVERY PARTNERS]
require_once('frd1_header.php');
?>
<h2 class="PT"> Delivery Partners </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
$rtd_path="../../rtd";    


//####################################################################
// NEW SHIPPING PARTNET ADD DONE 
//####################################################################
if(isset($_POST['f_frd_shippartname'])){
    $f_frd_shippartname=$_POST['f_frd_shippartname'];
    $f_frd_shipparaddress=$_POST['f_frd_shipparaddress'];

                    $ARR = [];
                    $ARR['frd_namee'] = "$f_frd_shippartname";
                    $ARR['frd_address'] = "$f_frd_shipparaddress";
                    $ARR['byy'] = "$UsrId";
                    $ARR['datee'] = "$FR_NOW_DATE";
                    $ARR['timee'] = "$FR_NOW_TIME";
                    $FRR = FR_DATA_IN_2("frd_shippart",$ARR);
                    if($FRR['FRA']==1){
                        FR_SWAL("NEW DELIVERY PARTNER ADD DONE","","success");
                    }else{
                        FR_SWAL("NEW DELIVERY PARTNER ADD FALED","","error");
                    }
}   
?>   
</section>
<!-- 1 SCRIPT END -->    

   






<!-- ## -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
                <form class="f2" action="" method="post">
                    <table>
                        <tr>
                            <td>Delivery Partners Name*</td>
                            <td>
                                <input class="form-control" type="text" name="f_frd_shippartname" required> 
                            </td>
                        </tr>
                        <tr>
                            <td>Delivery Partners Address </td>
                            <td>
                                <textarea class="form-control" name="f_frd_shipparaddress" id="" cols="30" rows="3"></textarea> 
                            </td>
                        </tr>
                         <tr>
                            <td></td>
                            <td>
                               <button type="submit" class="btn btn-danger pull-right">Confirn & Add</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>     
</section>




<!-- ## -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <?php
                 echo "
                <table class='t1 table table-bordered'>
                <tr class='TH'>
                       <td>SL</td>
                       <td>ID</td>
                       <td>Delivery Partner Name</td>
                       <td>Delivery Partner Address</td>
                       <td>Add Time</td>
                </tr>
                ";
                $q_frd="select * from frd_shippart ORDER BY id DESC";
                require("$rtd_path/1_frd.php");   
                $SL=1;
                for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
                require("$rtd_path/shpipart_t_gsra_frd.php");
                echo "
                     <tr>
                       <td>$SL</td>
                       <td>$sipprt_id</td>
                       <td>$sipprt_name</td>
                       <td>$sipprt_address</td>
                       <td>$sipprt_date</td>
                     </tr>

                    ";
                 $SL=($SL+1);    
                }//For Loop E
                echo "</table>";  
                ?>
            </div>
        </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>    