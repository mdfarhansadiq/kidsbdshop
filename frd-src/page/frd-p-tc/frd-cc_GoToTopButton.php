<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Go To Top Button Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Go To Top Button Color Customize </h2> -->


<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD THEME LEFT SIDE NAVE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_55'])){
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
        if(isset($fr_ow_55)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_55 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_55 = '$fr_ow_55',
            fr_ow_56 = '$fr_ow_56',
            fr_ow_57 = '$fr_ow_57',
            fr_ow_58 = '$fr_ow_58',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/*******************************************************/
/*FRD SCROLL TO TOP BUTTON OW*/
/*******************************************************/
#myScrollTopBtn{
    background: $fr_ow_55 !important;
    color: $fr_ow_56 !important;
}
#myScrollTopBtn:hover {
    background: $fr_ow_57 !important;
    color: $fr_ow_58 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_gototopbtn = '$FRc_CC_CSS_CODE', 
                    fr_cc_gototopbtn_id = 1  
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


<!--  -->
<div class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-primary">Go To Top Button Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">

                <tr>
                    <td>Background</td>
                    <td><input type="color" name="fr_ow_55" value="<?php echo "$fr_ow_55"?>"></td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td><input type="color" name="fr_ow_56" value="<?php echo "$fr_ow_56"?>"></td>
                </tr>
                <tr>
                    <td>Background (Hover)</td>
                    <td><input type="color" name="fr_ow_57" value="<?php echo "$fr_ow_57"?>"></td>
                </tr>
                <tr>
                    <td>Color (Hover)</td>
                    <td><input type="color" name="fr_ow_58" value="<?php echo "$fr_ow_58"?>"></td>
                </tr>

            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Update Color</button>
		    </div>
         </form>
    </div>
</div>


</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>    