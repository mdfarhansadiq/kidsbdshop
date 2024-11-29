<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Product Barcode Print"; //PAGE TITLE
$p = "$FR_RP"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
// require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> PRODUCT BARCODE PRINT </h2> -->


<!-- SCRIPT 1 -->
 <section>
    <?php
     if(isset($_POST['f_barcode_need'])){
        extract($_POST);
     }
    ?>
 </section>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Barcode Print</title>
        <style>
            /******************************************************************/
            /*pro-barcode-1*/
            /******************************************************************/
            body{
                margin: 0;
                padding: 0;
            }
            .pro-barcode-1 .box {
                width: 142px;
                height: 94px;
                display: inline-block;
                border: 1px #111111 solid;
                margin: 1px;
                padding: 5px;
                overflow: hidden;
                float: left;
                font-family: 'SolaimanLipi';
            }
            .pro-barcode-1 .box .barcode{
                text-align: center;
            }
            .pro-barcode-1 .box .barcode small{
                font-size: 10px;
            }
        </style>
</head>
<body>
    
     <?php 
        for($i=1; $i<=$f_barcode_need; $i++){//FOR_LOOP_START 

            $barcode_frd = $f_product_id;
            require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
            echo "
            <div class='pro-barcode-1'>
            <div class='box'>
                <div class='barcode'>   
                        $Barcode_FRD <br>
                        <small>$f_product_titel <br> $f_product_writer </small>         
                    </div>
            </div>
            </div>
            ";

        }//FOR_LOOP_END  
     ?>

    <script>
        window.print();
    </script>
</body>
</html>