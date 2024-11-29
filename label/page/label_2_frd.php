<?php 
$p_title="Label #$FRc_Invoice_Id_x For $fr_cust_name";//Page  Title
$p="#";//Page Name
$inn="";
require_once("1frd_header.php");
?>

<!-- 1 scripts s-->
<section>
<?php

?>
</section>


 <div style="width:270px;height:310px;display:block;border: 1px red solid; margin: 0px;padding: 5px; overflow: hidden;">
              <div class="TAC">
              <img id="invoice_bandlogu" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo";?>" alt="" style="width:100px;height:50px;margin:auto;display:block;">
              <b><?php echo "$fr_cname";?></b>
              <hr>

                     <h4 class="TAC r">কন্ডিশনঃ <?php echo "$fr_invo_due";?> ৳</h4>
                </div>   
               
                <table class="table1">
                    <tr>
                        <td>
                            <?php 
                               echo "
                               <b> পণ্য ডেলিভারি ঠিকানাঃ-</b> <br>
                                <b>নামঃ</b> $fr_cust_name <br>
                                <b>মোবাইল নাম্বারঃ</b> $fr_cust_mob1 $fr_cust_mob2 <br>
                                <b>ঠিকানাঃ</b> $fr_cust_addres <br>
                                <b>নোটঃ</b> $fr_cust_o_note 
                               ";
                             ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="frs_label">
                             <?php
                             $barcode_frd = $FRc_Invoice_Id_x;
                             require_once($FR_PATH_HD."frd-src/inc/php/barcode_configar_frd.php");
                             echo "$Barcode_FRD";  
                           ?>
                           </div>
                        </td>
                    </tr>
                </table>
                             
                     
 </div>        
  
  

<?php require_once("1frd_footer.php");?>


<script type="text/javascript">
 print();
</script>