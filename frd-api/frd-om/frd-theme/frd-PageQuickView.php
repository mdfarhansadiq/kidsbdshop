<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_POST = "";
//FRD VC________
    if( isset($_POST['frd_page_slug'])){
        $FRc_PageSlug = $_POST['frd_page_slug'];
         $FR_VC_POST = 1; 
    }

//FRD OPARATION START:-
     if($FR_VC_POST == 1){
     
                $FRQ = "SELECT * FROM frd_pages WHERE page_url = '$FRc_PageSlug'";
                $FRR = FR_QSEL("$FRQ","");
                if ($FRR['FRA'] == 1) {
                    extract($FRR['FRD']);
                    $FR_OP_HTML .= "
                       <div style='text-align: justify;'> $page_body_en </div>
                    ";
                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <div class='col-md-12'>
                      <div class='text-center boldd alert alert-danger'> No Page Data Found </div>
                    </div>
                    ";
                   exit;
                }

         
     }


THIS_LAST:
echo $FR_OP_HTML;