<?php
require_once('frd1_whoami.php');
$FR_ptitle = "Theme Language Config"; //PAGE TITLE
$p = "ThemeLanguageConfig"; //PAGE NAME
$inn = "";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Theme Language Config </h2> -->

<!-- 1 SCRIPT START -->
<section>
<?php
//---------------------------------------------------------
//FRD THEME CONFIG TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['frtc_flash_sales_txt'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
    //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $keys = array_keys($_POST);
        foreach($keys as $key){
            $$key = $_POST["$key"];
            //echo "$key <br>";
        }
        
        
        


        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themeconfig SET 
            FRatd_PayNow_btnT = '$f_FRatd_PayNow_btnT',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP_2("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("$UsrName Update Done","","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("$UsrName Update Failed","","error");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    

}
//END>>




//FRD  DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themelan WHERE id = 1","");
if($FRR['FRA']==1){ 
  PR($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

//FRD  DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themelan WHERE id = 2","");
if($FRR['FRA']==1){ 
  PR($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

?>
</section>
<!-- 1 SCRIPT END -->










<?php require_once('frd1_footer.php'); ?>