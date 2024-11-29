<?php 
require_once('frd1_whoami.php');
$FR_ptitle="NA";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
// require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Multi Invoice Print</h2> -->



<!-- 1 SCRIPT S-->
<section> 
<?php 
    $FRQ = $FR_CONN->query("SELECT * FROM frd_soft_config WHERE id = 1");
    extract($FRQ->fetch());

   require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");



 if(isset($FRurl[1])){
      try {
        $FRQ = $FR_CONN->prepare("SELECT id FROM frd_order_invo WHERE fr_enc_id = :fr_enc_id");
        $FRQ->bindParam(':fr_enc_id', $FRurl[1], PDO::PARAM_STR);
        $FRQ->execute();
        extract($FRQ->fetch());
        $FRc_InvoiceIdsArr = [$id];
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
 }else{
    if(isset($_POST['f_chacked_orders_id'])){
        // PR($_POST['f_chacked_orders_id']);
        $FRc_InvoiceIdsArr = $_POST['f_chacked_orders_id']; 
    }else{
        FR_AL("$UsrName First Select The Order");
        FR_GO("om-OPS2?FRH=NDYEYDNNBHDX","1");
        exit;
    }
 }

  
//   PR($FRc_InvoiceIdsArr); exit;


//FRD COMPANY DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>



if($frplug_api_steadfast == 1){
    $FRR = FR_QSEL("SELECT * FROM frd_qapi_steadfast WHERE id = 1","");
    if($FRR['FRA']==1){ 
       extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
    //END>>
}

?>
</section>
<!-- 1 SCRIPT E-->





<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'/>
    <title><?php echo "Multi Invoice Print";?></title>
    <link href="<?php echo "$FRD_HURL/frd-public/theme/asset/fonts/SolaimanLipiNormal/styles.css"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frdsp/dp/asset/css/frd-bulk-invoice-print.css?v=$FR_SOFT_VERSION-LV3"?>" rel="stylesheet">
</head>

<body>

        <?php
        foreach ($FRc_InvoiceIdsArr as $FR_ITEM) {
            $FRc_InvoIdx = $FR_ITEM;
            //FRD ORDER INVOICE T DATA READ Stext-rightT:-
            $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = '$FRc_InvoIdx' AND fr_stat != 0", "");
            if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
            $FRc_Invoice_Id_x = $id;
            $FRc_Invo_Stat_x = $fr_stat;
            $FRc_Invo_Cust_Id = $fr_cust_id;



            $FRR = FR_QSEL("SELECT COUNT(id) AS FRc_ItemsTotalC, SUM(fr_qty) AS FRc_ItemsTotalQtyC, SUM(fr_t_price) AS FRc_ItemsTotalPriceS FROM frd_order_items WHERE fr_invo_id = $FRc_InvoIdx AND fr_stat != 0", "");
            if ($FRR['FRA'] == 1) {
                extract($FRR['FRD']);
            } else {
                ECHO_4($FRR['FRM']);
            }



            if ($fr_stat == 1) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> নতুন </span>";
            }
            if ($fr_stat == 2) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি প্রক্রিয়া শুরু হয়েছে </span>";
            }
            if ($fr_stat == 3) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> প্যাকেজিং সম্পন্ন হয়েছে </span> ";
            }
            if ($fr_stat == 4) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> কুরিয়ারে আছে </span> ";
            }
            if ($fr_stat == 5) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি সম্পন্ন হয়েছে </span> ";
            }
            if ($fr_stat == 6) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> হোল্ডে আছে </span> ";
            }
            if ($fr_stat == 7) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি ব্যর্থ হয়েছে </span>";
            }
            if ($fr_stat == 8) {
                $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> অর্ডারটি বাতিল করা হয়েছে </span>";
            }
            //++
            //++
            //++
            //++
            if ($fr_invo_due > 0) {
                $FRc_PaymentStatus_HTML = " <span class='label label-danger'> UNPAID </span><br>";
            } elseif ($fr_invo_due == 0) {
                $FRc_PaymentStatus_HTML = " <span class='label label-success'> PAID </span><br>";
            } elseif ($fr_invo_due < 0) {
                $FRc_PaymentStatus_HTML = " <span class='label label-danger pip_pip_1s'> Will Get </span><br>";
            }
            //++
            //++
            if ($fr_cust_id == 1) {
                $FRc_OrderType_HTML = " <span class='label label-danger'> অথিতি অর্ডার </span><br>";
            } else {
                $FRc_OrderType_HTML = "";
            }

            } else {
                ECHO_4($FRR['FRM']);
                exit;
            }
            //END>>

            $FRc_SteadfastClientID_HTML = "";
            if(isset($fr_sf_clientid)){
                $FRc_SteadfastClientID_HTML = "SteadFast ID: <b>$fr_sf_clientid</b>";
            }

            $fr_ship_track_code_HTML = "";
            if($fr_ship_track_code != "" AND $fr_ship_track_code != "NA"){
                $fr_ship_track_code_HTML = "ট্র্যাকিং কোড: <b>$fr_ship_track_code</b>";
            }
            $fr_ship_consignment_id_HTML = "";
            if($fr_ship_consignment_id != ""){
                $fr_ship_consignment_id_HTML = "কনসাইনমেন্ট আইডি: <b>$fr_ship_consignment_id</b>";
            }


            require("compo/frd-compo-bulk-invoice-$frsc_om_bulk_invo_num.php");
        

           echo " <script>document.title = 'Invoice#$FRc_InvoIdx - $fr_cust_name - $fr_cust_mob1 - $fr_cname';</script>";
        } 
        ?>  



    <script>
        window.print();
    </script>
</body>

</html>