<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Gain Customer Trust";//PAGE TITLE
$p="GainCustomerTrust";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Gain Customer Trust </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

 //---------------------------------------------------------
//FRD  DATA UPDATE
//---------------------------------------------------------
if(isset($_POST['fr_gct_title'])){

    //    PR($_POST);

       //FRD POST DATA FILTERING AND MAKING VARIVAL:-
       $keys = array_keys($_POST);
       foreach($keys as $key){
           $$key = $_POST["$key"];
           //echo "$key <br>";
       }
   //FRD_VC___________DATA PROSESSED OR NOT:-
       if(isset($fr_gct_title)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

   //FRD_VC___________ALL REQUIRED FILED:-
       if($fr_gct_title != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }


                $FRQ = "UPDATE frd_gain_cust_trust SET 
                fr_gct_title = '$fr_gct_title',
                fr_gct_dec = '$fr_gct_dec',
                dumytext = '$FR_NOW_TIME'
                WHERE id = $f_id";
                $R = FR_DATA_UP("$FRQ");
                //PR($R);
                if($R['FRA']==1){
                        FR_SWAL("$UsrName Update Done","","success");
                }else{
                    FR_SWAL("$UsrName  Update Failed ","","error");
                    FR_GO("$FR_THIS_PAGE","3");
                    exit;
                }

}
//END>>




//---------------------------------------------------------
//FRD HOME PAGE GTC SECTION DATA UPDATE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['f_fr_hpc_def_deli_items'])){
   //FRD VC NEED:-
       $FR_VC_DATA_PROCESS = "";
       $FR_VC_ARF = "";//ALL REQUIRED FILD
   //FRD POST DATA FILTERING AND MAKING VARIVAL:-
       $keys = array_keys($_POST);
       foreach($keys as $key){
           $$key = $_POST["$key"];
           //echo "$key <br>";
       }
   //FRD_VC___________DATA PROSESSED OR NOT:-
       if(isset($f_fr_hpc_def_deli_items)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

   //FRD_VC___________ALL REQUIRED FILED:-
       if($f_fr_hpc_def_deli_items != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

       if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
           $FRQ = "UPDATE frd_hpconfig SET 
           fr_hpc_def_deli_items = '$f_fr_hpc_def_deli_items',
           fr_hpc_def_customers = '$f_fr_hpc_def_customers',
           dumytxt = '$FR_NOW_TIME'
           WHERE id = 1";
           $R = FR_DATA_UP("$FRQ");
           //PR($R);
           if($R['FRA']==1){
               FR_SWAL("Dear Boss $UsrName","Update Done","success");
               FR_GO("$FR_THIS_PAGE","1");
               exit;
           }else{
               FR_SWAL("Dear Boss $UsrName","Update Failed","error");
               FR_GO("$FR_THIS_PAGE","1");
               exit;
           }
       }
}
//END>>



//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_hpconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   



<br>
<section>
<div class="container">

   <div class="row">
    <div class="col-md-11 jumbotron">
        <?php
         $FRR = FR_QSEL("SELECT * FROM frd_gain_cust_trust ORDER BY id ASC","ALL");
         if($FRR['FRA']==1){ 
                
                        $FRc_SL = 1;
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
                            echo "<div class='table-responsive'>";
                             echo "<form action='' method='POST'>";
                             echo "<table class='table table-bordered table-striped'>";
                                echo "
                                    <tr>
                                        <td>$FRc_SL</td>
                                        <td><img src='$FRD_HURL/frd-data/img/hp/gain_cust_trust/$fr_gct_icon' alt='' width='100px' height='100px'></td>
                                        <td>
                                          <input type='text' name='fr_gct_title' id='' class='form-control' value='$fr_gct_title' required>
                                        </td>
                                        <td>
                                           <textarea class='form-control' name='fr_gct_dec' id='' cols='30' rows='3'>$fr_gct_dec</textarea>
                                        </td>
                                        <td>
                                           <input type='hidden' name='f_id' id='' value='$id' required>
                                           <button type='submit' class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                        </td>
                                    </tr> 
                                ";
                                
                            $FRc_SL = ($FRc_SL + 1);

                            echo "</table>";
                            echo "</form>";
                            echo "</div>";
                        }
                
                
         } else{ 
           //   PR($FRR);
           echo "<div class='text-center alert alert-danger'>  NO DATA FOUND  </div>";
         }
        ?>
    </div>
   </div>




   <!-- <br><br><br>
   <div class="row">
     <h5 class="text-center">Typo</h5>
    <div class="col-md-6">
         <table class="table table-bordered">
             <tr>
                <td>সাশ্রয়ী মূল্য</td>
                <td>আমরা আমাদের ক্রেতাদেরকে সর্বদা প্রতিযোগিতামূলক সাশ্রয়ী মূল্য অফার করি।</td>
             </tr>
             <tr>
                <td>দেশব্যাপী ডেলিভারি</td>
                <td>আমরা আমাদের অর্ডারকৃত পণ্য সারাদেশে দ্রুততার সাথে ডেলিভারি দিয়ে থাকি।</td>
             </tr>
             <tr>
                <td>নিরাপদ মূল্যপরিশোধ</td>
                <td>আমাদের আপনি পেমেন্ট করুন বিশ্বের জনপ্রিয় ও নিরাপদ পেমেন্ট পদ্ধতিতে।</td>
             </tr>
             <tr>
                <td>আস্থার সাথে কিনুন</td>
                <td>নিরাপদ কেনাকাটা করুন পণ্য বাছাই করা থেকে ঘরে ডেলিভারি পর্যন্ত</td>
             </tr>
             <tr>
                <td>সার্বক্ষণিক কাস্টমার সেবা</td>
                <td>ঝামেলাহীন কেনাকাটার অভিজ্ঞতার জন্য আছে সার্বক্ষণিক কাস্টমার সেবা</td>
             </tr>
         </table>
    </div>
    <div class="col-md-5">
         <table class="table table-bordered">
             <tr>
                <td>Affordable Price</td>
                <td>We always offer competitive affordable prices to our customers.</td>
             </tr>
             <tr>
                <td>Nationwide Delivery</td>
                <td>We provide fast delivery of our ordered products across the country.</td>
             </tr>
             <tr>
                <td>Secure Payment</td>
                <td>Pay us through the world's most popular and secure payment methods.</td>
             </tr>
             <tr>
                <td>Buy With Confidence</td>
                <td>Shop safely from product selection to home delivery</td>
             </tr>
             <tr>
                <td>24/7 Customer Support</td>
                <td>24/7 customer service for a hassle-free shopping experience</td>
             </tr>
         </table>
    </div>
   </div> -->


</div>
</section>





<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h3 class="text-center text-success boldd">Home Page GTC Section</h3>
        
                <form class="" id="" action="" method="post">

                    <br>
                    <span>Default Delivery Successed Items  *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="f_fr_hpc_def_deli_items" value="<?php echo "$fr_hpc_def_deli_items"; ?>" required>
                    
                    <br>
                    <span>Default Customers  *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="f_fr_hpc_def_customers" value="<?php echo "$fr_hpc_def_customers"; ?>" required>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>

                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>






<?php require_once('frd1_footer.php'); ?>