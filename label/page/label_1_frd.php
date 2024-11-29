<?php 
$p_title="Label #$FRc_Invoice_Id_x For $fr_cust_name";//Page  Title
$p="#";//Page Name
$inn="";
require_once("1frd_header.php");
?>
 



    <!-- 1 scripts e -->
    <div class="containerx"> 
        <div class="rowx">
            <div class="col-md-12x">
                <div class="text-center">
                   <img id="invoice_bandlogu" src="<?php echo " $FRD_HURL/frd-data/img/brandlogu/$fr_clogo";?>" alt="" class="img-responsive">
                   <b><?php echo "$fr_cname";?></b>
                   <p> <?php echo " মোবাইল নাম্বারঃ $fr_cmobile_1 | ইমেইল: $fr_cemail_1 | ওয়েবসাইট: $FRD_HURL | ঠিকানাঃ  $fr_caddress_1";?> </p>
                </div>
               
               <hr>
                <table class="table1">
                    <tr>
                        <td>
                            <?php 
                               echo "
                               <b> পণ্য ডেলিভারি ঠিকানা:-</b> <br>
                                <b>নাম:</b> $fr_cust_name <br>
                                <b>মোবাইল নাম্বার:</b> $fr_cust_mob1 $fr_cust_mob2 <br>
                                <b>ঠিকানা:</b> $fr_cust_addres <br>
                                <b>নোট:</b> $fr_cust_o_note 
                               ";
                             ?>
                        </td>
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
                         <h4 class="TAC r">কন্ডিশন: <?php echo "$fr_invo_due";?> ৳</h4>
            </div>
        </div>


    <div class='row '>
        <div class="col-md-12 TAR">
            <button onclick='page_print()' class='btn btn-success'><span class='glyphicon glyphicon-print'></span></button>
        </div>
    </div>
    
  </div>    

<?php require_once("1frd_footer.php");?>
