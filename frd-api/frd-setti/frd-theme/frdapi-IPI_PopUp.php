<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_POST = "";
//FRD VC________
    if( isset($_POST['frproid'])){
        $FRc_proid = $_POST['frproid'];
         $FR_VC_POST = 1;
    }

//FRD OPARATION START:-
     if($FR_VC_POST == 1){
     

        $FRQ = "SELECT * FROM frd_products WHERE id = $FRc_proid";
        $FRR = FR_QSEL("$FRQ","");
        if ($FRR['FRA'] == 1) {
            extract($FRR['FRD']);
            $FR_OP_HTML .= "
            <div class='row'>
                <div class='col-md-6'>
                    <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$pic_1' alt='#'>
                </div>
                <div class='col-md-6'>
                    <h2 class='boldd'>$bn_name</h2>
                    <h3 class='boldd text-danger'>$sells_pri ৳</h3>
                    <div class=''>$detailess</div>
                </div>
            </div>
            ";
        } else {
            // PR($FRR);
            $FR_OP_HTML .="
            <div class='col-md-12'>
              <div class='text-center boldd alert alert-danger'> No Product Info Found </div>
            </div>
            ";
           exit;
        }
         
     }

THIS_LAST:
echo $FR_OP_HTML;