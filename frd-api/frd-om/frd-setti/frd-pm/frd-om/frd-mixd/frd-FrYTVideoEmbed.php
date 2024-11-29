<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";

//FRD VC________
    if(isset($_SESSION['FRs_UsrId']) or isset($_SESSION['FRs_ABC'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }
//FRD VC________
    if(isset($_POST['FrVID'])){
         $FRc_VideoId = $_POST['FrVID'];
         $FRc_VAP = $_POST['FrVAP'];//VIDEO AUTOPLAY STATUS
         $FR_VC_POST = 1;
    } else{
        $FR_OP_HTML .= "<h6>Access Denied 2 </h6>";
    }


//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){
         $FR_OP_HTML .="
         <div class='col-md-12 text-center'>
            <iframe width='auto' height='238' src='https://www.youtube.com/embed/$FRc_VideoId?autoplay=$FRc_VAP' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
         </div>
         ";
     }


THIS_LAST:
echo $FR_OP_HTML;