<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Bottom Fix Nav Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Color Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD BOTTOM FIX NAV 1 STYLE UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_98'])){
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
        if(isset($fr_ow_98)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_98 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_98 = '$fr_ow_98',
            fr_ow_99 = '$fr_ow_99',
            fr_ow_100 = '$fr_ow_100',
            fr_ow_101 = '$fr_ow_101',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){

$FRc_CC_CSS_CODE = "
/*******************************************************/
/* BOOTOM FIX NAV 1*/
/*******************************************************/
nav.FrBotFixNav_1{
    background: $fr_ow_98 !important;
}
nav.FrBotFixNav_1 .fr_home_icon{
    color: $fr_ow_99 !important;
}
nav.FrBotFixNav_1 .fr_cart_icon{
    color: $fr_ow_100 !important;
}
nav.FrBotFixNav_1 .fr_usr_icon{
    color: $fr_ow_101 !important;
}
                ";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_botfixnav = '$FRc_CC_CSS_CODE', 
                    fr_cc_botfixnav_id = 1  
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




<!-- BOTTOM FIX NAV 1  -->
<div id="ow_botton_fix_nav" class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Bottom Fix Nav #";?>">Bottom Fix Nav Color Customization</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Background Color</td>
                    <td><input type="color" name="fr_ow_98" value="<?php echo "$fr_ow_98"?>"></td>
                </tr>
                <tr>
                    <td>Home Icon Color</td>
                    <td><input type="color" name="fr_ow_99" value="<?php echo "$fr_ow_99"?>"></td>
                </tr>
                <tr>
                    <td>Cart Icon Color</td>
                    <td><input type="color" name="fr_ow_100" value="<?php echo "$fr_ow_100"?>"></td>
                </tr>
                <tr>
                    <td>User Icon Color</td>
                    <td><input type="color" name="fr_ow_101" value="<?php echo "$fr_ow_101"?>"></td>
                </tr>
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Bottom Fix Nav Color</button>
		    </div>
         </form>
    </div>
</div>



</div>
</div>
</section>




<?php require_once('frd1_footer.php'); ?>   