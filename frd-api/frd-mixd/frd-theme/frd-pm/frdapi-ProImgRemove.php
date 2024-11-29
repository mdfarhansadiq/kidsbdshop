<?php
header("Access-Control-Allow-Origin: $FRD_HURL");
$FRR = [];
$FR_VC_SESSION = "";
$FR_VC_POST = "";


//FRD VC_________________________SESSION:-
if(isset($_SESSION['sUsrId'])){ 
    $FR_VC_SESSION = 1;
}else{ 
    $FRR['FRA'] = 2;
    $FRR['FRM'] = "Access Denied 1";
    goto THIS_LAST;
}

//FRD VC_________________________POST:-
if(isset($_POST['f_imgNum'])){ 
    $FR_VC_POST = 1;
}else{ 
    $FRR['FRA'] = 2;
    $FRR['FRM'] = "Access Denied 2";
    goto THIS_LAST;
}


if($FR_VC_SESSION == 1 AND $FR_VC_POST == 1){

	$FRc_pro_id =  $_POST['f_proId'];
	$FRc_pic_num =  $_POST['f_imgNum'];

        if ($FRc_pic_num == 1 || $FRc_pic_num == 2 || $FRc_pic_num == 3 || $FRc_pic_num == 4) {
            $FRQ = "UPDATE frd_products SET pic_$FRc_pic_num = '1.jpg' WHERE id = $FRc_pro_id";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {
                $FRR['FRA'] = 1;
                $FRR['FRM'] = "Image Removed Done";
                $FRR['FRD_IMGID'] = "frdimg-$FRc_pro_id-$FRc_pic_num";
                $FRR['FRD_IMGLINK'] = "$FRD_HURL/frd-data/img/product/1.jpg";
            } else {
                $FRR['FRA'] = 2;
                $FRR['FRM'] = "Image Removed Failed";
            }
        } else {
            $FRR['FRA'] = 2;
            $FRR['FRM'] = "Unvalid Work";
        }

}

THIS_LAST:
echo json_encode($FRR);