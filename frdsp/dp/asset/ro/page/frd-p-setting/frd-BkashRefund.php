<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Bkash Refund"; //PAGE TITLE
$p = "$FR_RP"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Bkash Refund </h2>

<!-- 1 SCRIPT START --> 
<section>
    <?php

    if ((isset($_POST['paymentID'])) && (isset($_POST['trxID'])) && (isset($_POST['amount']))) {

        function refund()
        {
            getToken();

            global  $FR_CONN;
            $FRQ = $FR_CONN->query("SELECT * FROM frd_paygw_bkash WHERE id = 1");
            extract($FRQ->fetch());

            $post_token = array(
                'paymentID' => $_POST['paymentID'],
                'amount' => $_POST['amount'],
                'trxID' => $_POST['trxID'],
                'sku' => 'sku',
                'reason' => 'test '
            );

            $url = curl_init("$fr_bka_base_url/checkout/payment/refund");
            $post_token = json_encode($post_token);
            $header = array(
                'Content-Type:application/json',
                'Authorization:' . $_SESSION["token"],
                'X-APP-Key:' . $fr_bka_app_key
            );

            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            $result_data = curl_exec($url);
            curl_close($url);

            $response = json_decode($result_data, true);

            return $response;
        }

        PR(refund());
    }
    ?>
</section>
<!-- 1 SCRIPT END -->





<section>
    <div class="container">
    <div class="col-md-11">

        <div class="row">
            <div class="col-md-12 jumbotron">
                <div>
                    <form action="" method="POST">
                        <label for="paymentID">Payment ID:</label>
                        <input class="form-control" type="text" id="paymentID" name="paymentID" required><br>

                        <label for="trxID">Trx ID:</label>
                        <input class="form-control" type="text" id="trxID" name="trxID" required><br>

                        <label for="amount">Amount:</label>
                        <input class="form-control" type="text" id="amount" name="amount" required><br>

                        <div class="text-right">
                            <input class="btn btn-success" type="submit" value="Click For Refund">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    </div>
</section>







<?php require_once('frd1_footer.php'); ?>