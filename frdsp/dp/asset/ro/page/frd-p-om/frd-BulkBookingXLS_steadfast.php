<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Steadfast Bulk Booking XLS File";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Steadfast Bulk Booking XLS File </h2>


<!-- 1 SCRIPT S-->
<section> 
<?php 
  if(isset($_POST['f_chacked_orders_id'])){
        $FRc_InvoiceIdsArr = $_POST['f_chacked_orders_id']; 
  }else{
      FR_AL("$UsrName First Select The Order");
      FR_GO("om-OPS2?=FRH=HSJEUYBNH","1");
      exit;
  }
//   PR($FRc_InvoiceIdsArr);

?>
</section>
<!-- 1 SCRIPT E-->



<!DOCTYPE html>
<html>
<head>
        <meta charset='utf-8'/>
		<title><?php echo "$FR_ptitle";?></title>
        <link href="<?php echo "$FRD_HURL/frd-public/theme/asset/fonts/SolaimanLipiNormal/styles.css"?>" rel="stylesheet">
    <style>

    </style>
</head>

<body>



    <section>
        <?php

        ?>
    </section>




    <section>
        <?php

        $FRc_TABLE_HTML = "
        <div class='table-responsive'>
        <table id='FR_TABLE_DATA' class='table table-bordered'>
            <tr>
                <td>Invoice</td>
                <td>Name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>Amount</td>
                <td>Note</td>
                <td>Contact Name</td>
                <td>Contact Phone</td>
            </tr>
        ";
        foreach ($FRc_InvoiceIdsArr as $FR_ITEM) {
            $FRc_InvoIdx = $FR_ITEM;

            //FRD ORDER INVOICE T DATA READ:-
            $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = '$FRc_InvoIdx' AND fr_stat != 0", "");
            if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);

              $FRc_Instruction = "";
              if($fr_payment == 0){
                $FRc_Instruction = "If customer returns the product, then collect delivery charge 150 tk";
              }

              $FRQ = $FR_CONN->query("SELECT SUM(fr_qty) FROM frd_order_items WHERE fr_invo_id = $id");
              $FRSD = $FRQ->fetch();
              $FRc_ItemQuantity = $FRSD['SUM(fr_qty)'];

                if($fr_stat == 2 || $fr_stat == 3 || $fr_stat == 4 || $fr_stat == 11 || $fr_stat == 12 || $fr_stat == 13 || $fr_stat == 14){
                        $FRc_TABLE_HTML .= "
                        <tr>

                        <td>$id</td>
                        <td>$fr_cust_name</td>
                        <td>$fr_cust_addres</td>
                        <td>$fr_cust_mob1</td>
                        <td>$fr_invo_due</td>
                        <td></td>
                        <td>$fr_cname</td>
                        <td>$fr_cmobile_1</td>
                        </tr>
                        ";
                }else{
                    $FRc_TABLE_HTML .= "
                        <tr>
                            <td colspan='14'>#$id Not Valid</td>
                        </tr>
                    ";
                }

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

       <div class="row">
       <div class="col-md-6">
            <div class="text-left">
                <button class='btn btn-primary' id="FrTrig_DownlodeCSVFile"><span class='glyphicon glyphicon-download-alt'></span> Downlode CSV File</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <button class='btn btn-success' id="FrTrig_DownlodeXLSFile"><span class='glyphicon glyphicon-download-alt'></span> Downlode XLS File</button>
            </div>
        </div>
       </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <?php echo "$FRc_TABLE_HTML";?>
            </div>
        </div>

    </div>
    </div>




    <script src="<?php echo "$FRD_HURL/frd-src/inc/js/xlsx.full.min.js"?>"  type="text/javascript"></script>
    <script>
        let DownlodeFileName = '<?php echo "$FR_NOW_DATE-$fr_cname-SteadfastBulkBookingXLSFile";?>';
        let DownlodeSheetName = '<?php echo "SteadfastBulkBookingXLSFile";?>';

        function html_table_to_excel(type){
            var data = document.getElementById('FR_TABLE_DATA');

            var file = XLSX.utils.table_to_book(data, {sheet: DownlodeSheetName});

            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

            XLSX.writeFile(file, DownlodeFileName + '.' + type);
        }


        const export_button = document.getElementById('FrTrig_DownlodeXLSFile');
        export_button.addEventListener('click', () =>  {
            html_table_to_excel('xlsx');
        });

        const export_button_cvs = document.getElementById('FrTrig_DownlodeCSVFile');
        export_button_cvs.addEventListener('click', () =>  {
            html_table_to_excel('csv');
        });
    </script>


</body>

</html>





 
 <?php require_once('frd1_footer.php'); ?>