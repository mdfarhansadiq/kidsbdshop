<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Footer Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Footer Color Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD FOOTER 1 STYLE  UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_74'])){
    // PR($_POST);

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $keys = array_keys($_POST);
        foreach($keys as $key){
            $$key = $_POST["$key"];
            //echo "$key <br>";
        }
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($fr_ow_74)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_74 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_74 = '$fr_ow_74',
            fr_ow_75 = '$fr_ow_75',
            fr_ow_76 = '$fr_ow_76',
            fr_ow_77 = '$fr_ow_77',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/************************************************************/
/* FRD FOOTER 1 CC */
/***********************************************************/
section.frfoot1, footer#fr_foot1, footer#fr_foot1 .frs_faddress {
    background: $fr_ow_74 !important;
}
footer#fr_foot1 .frFooterMobile h4 a, footer#fr_foot1 .frFooterEmail h4 a, footer#fr_foot1 .frs_faddress{
    color: $fr_ow_75 !important;
}
footer#fr_foot1 hr {
    border-top: 1px solid $fr_ow_76 !important;
}
footer#fr_foot1 .frs_copyw, footer#fr_foot1 .frs_copyw a, div.frdcredits span, div.frdcredits a {
    color: $fr_ow_77 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_footer = '$FRc_CC_CSS_CODE', 
                    fr_cc_footer_id = 1  
                    WHERE fr_cc_id = 1");
                    FRF_COLOR_CUSTOMIZE_FILE_UPDATE($FR_PATH_HD);
                }catch(PDOException $e){
                    FR_SWAL("$UsrName Theme Color Table Data Update Failed","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                }

            }else{
                FR_SWAL("$UsrName Update Failed","","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }
        }
    

}
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   


<section>
<div class="container">
<div class="col-md-11">


<?php if($frtc_footer_n == 1){ ?>
<!--FRD FOOTER 1 -->
<div id="ow_footer" class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Footer #$frtc_footer_n";?>">Footer Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Background Color</td>
                    <td>
                        <input type="color" name="fr_ow_74" value="<?php echo "$fr_ow_74"?>">
                    </td>
                </tr>
                <tr>
                    <td>Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_75" value="<?php echo "$fr_ow_75"?>">
                    </td>
                </tr>
                <tr>
                    <td>HR Color</td>
                    <td>
                        <input type="color" name="fr_ow_76" value="<?php echo "$fr_ow_76"?>">
                    </td>
                </tr>
                <tr>
                    <td>Copywrite Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_77" value="<?php echo "$fr_ow_77"?>">
                    </td>
                </tr>
            </table>
            
            <br>
            <div class='text-right'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Footer Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?>




</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>  