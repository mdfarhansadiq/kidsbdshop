<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Bulk Order Assigne";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Bulk Order Assigne </h2>


<!-- 1 SCRIPT S-->
<section> 
<?php 
  if(isset($_POST['f_chacked_orders_id'])){
        $FRc_InvoiceIdsArr = $_POST['f_chacked_orders_id']; 
  }else{
      FR_AL("$UsrName First Select The Order");
      FR_GO("om-OPS2?=FRH=BDBDHDGDHBDUX","1");
      exit;
  }
//   PR($FRc_InvoiceIdsArr);




    //-------------------------------------------------------
    //FRD ORDER ASSINGEING TO USER:-
    //-------------------------------------------------------
    if (isset($_POST['f_OrderAssignUserId'])){
        //FRD VC NEED:-
        $FR_VC_ADMIN = "";

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_OrderAssignUserId = $_POST['f_OrderAssignUserId'];

        //FRD_VC___________:-
        if ($UsrType == "ad" || $UsrType == "M"){
            $FR_VC_ADMIN = 1;
        } else {
            FR_SWAL("Only Admin & Manger Can Do This!", "", "error");
            FR_GO("$FR_THISHURL/om-OPS1",2);
            exit;
        }

        if ($FR_VC_ADMIN == 1) {
            foreach ($FRc_InvoiceIdsArr as $FR_ITEM) {
                $FRc_InvoIdx = $FR_ITEM;
    
                    $FRQ = "UPDATE frd_order_invo SET 
                    fr_o_a_usrid = $f_OrderAssignUserId
                    WHERE id = $FRc_InvoIdx";
                    $R = FR_DATA_UP("$FRQ");
                    if ($R['FRA'] == 1) {
                        // FR_TAL("Dear Boss $UsrName Assigned Complete #$FRc_InvoIdx","success");
                    } else {
                        FR_SWAL("Dear Boss $UsrName Assigned Failed #$FRc_InvoIdx", "", "error");
                        FR_GO("$FR_THISHURL/om-OPS1", "6");
                        exit;
                    }
        
            }
        }
    }
    //END>>
?>
</section>
<!-- 1 SCRIPT E-->



<!DOCTYPE html>
<html>
<head>
        <meta charset='utf-8'/>
		<title><?php echo "Bulk Order Assigne";?></title>
</head>

<body>



    <section>
        <?php

        $FRc_TABLE_HTML = "
        <div class='table-responsive'>
        <table id='FR_TABLE_DATA' class='table table-bordered'>
            <tr class='boldd alert alert-success'>
                <td>SL</td>
                <td>CB</td>
                <td>Invoice</td>
                <td>Customer Name</td>
                <td>Contact No.</td>
                <td class='text-right'>Price</td>
                <td>Assigned</td>
            </tr>
        ";
        $FRc_SL = 1;
        foreach ($FRc_InvoiceIdsArr as $FR_ITEM) {
            $FRc_InvoIdx = $FR_ITEM;

            //FRD ORDER INVOICE T DATA READ:-
            $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = '$FRc_InvoIdx' AND fr_stat != 0", "");
            if ($FRR['FRA'] == 1) {
                 extract($FRR['FRD']);

                    $fr_o_a_usrid_NAME = "NA";
                    if($fr_o_a_usrid > 0){
                        extract(FR_USR_NAME($fr_o_a_usrid));
                        $fr_o_a_usrid_NAME = $FRc_USR_NAME;
                    }


                        $FRc_TABLE_HTML .= "
                        <tr>
                                <td>$FRc_SL</td>
                                <td><input type='checkbox' name='f_chacked_orders_id[]' class='f_chacked_orders_id' value='$id' checked></td>
                                <td>$id</td>
                                <td>$fr_cust_name</td>
                                <td>$fr_cust_mob1</td>
                                <td class='text-right'>$fr_invo_due/-</td>
                                <td>$fr_o_a_usrid_NAME</td>
                            </tr>
                        ";

                $FRc_SL = ($FRc_SL + 1);

            } else {
                // ECHO_4($FRR['FRM']);
                $FRc_TABLE_HTML .= "
                    <tr>
                        <td colspan='3'>No Data Found For Order Id #$FR_ITEM</td>
                    </tr>
                ";
            }
            //END>>

        }
        $FRc_TABLE_HTML .= "</table> </div>";

        ?>
    </section>






    <div class="container">
    <div class="col-md-11">

    <form id='' action='' method='POST' target='_self'>

        <select class='form-control' name='f_OrderAssignUserId' role="button" onchange="this.form.submit()" required>
            <?php
            echo "<option value=''>Change Assigne User</option>";
            $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE typee IN('ad','x','OCA') ORDER BY id ASC", "ALL");
            if ($FRR['FRA'] == 1){
                foreach ($FRR['FRD'] as $FR_ITEM){
                    extract($FR_ITEM);
                    echo "<option value='$id'>$namee</option>";
                }
            } else {
                PR($FRR);
            }
            ?>
        </select>

       <br>
        <div class="row">
            <div class="col-md-12">
                <?php echo "$FRc_TABLE_HTML";?>
            </div>
        </div>

    </form>

    </div>
    </div>


</body>

</html>





 
 <?php require_once('frd1_footer.php'); ?>