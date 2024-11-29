<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";

//FRD VC________
    if(isset($_POST['FrPdfFileLink'])){
         $FRc_PdfFileLink = $_POST['FrPdfFileLink'];
         $FR_VC_POST = 1; 
    } else{
        $FR_OP_HTML .= "<h6>Access Denied 1 </h6>";
    }


//FRD OPARATION START:-
     if($FR_VC_POST == 1){
         $FR_OP_HTML .="
         <div class='col-md-12 text-center'>
            <iframe width='100%' height='500px' src='$FRc_PdfFileLink'  frameborder='0'></iframe>
         </div>
         ";
     }
//END>>


THIS_LAST:
echo $FR_OP_HTML;