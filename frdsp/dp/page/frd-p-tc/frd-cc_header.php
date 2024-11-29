<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Header Color Customize";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Header Color Customize </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD HEADER 4 (PC) DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['fr_ow_1'])){
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
        if(isset($fr_ow_1)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($fr_ow_1 != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }


        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themestyle_ow SET 
            fr_ow_16 = '$fr_ow_16',
            fr_ow_1 = '$fr_ow_1',
            fr_ow_2 = '$fr_ow_2',
            fr_ow_3 = '$fr_ow_3',
            fr_ow_4 = '$fr_ow_4',
            fr_ow_5 = '$fr_ow_5',
            fr_ow_6 = '$fr_ow_6',
            fr_ow_7 = '$fr_ow_7',
            fr_ow_8 = '$fr_ow_8',
            fr_ow_9 = '$fr_ow_9',

            fr_ow_10 = '$fr_ow_10',
            fr_ow_11 = '$fr_ow_11',
            fr_ow_12 = '$fr_ow_12',
            fr_ow_13 = '$fr_ow_13',
            fr_ow_14 = '$fr_ow_14',
            fr_ow_15 = '$fr_ow_15',
            fr_ow_17 = '$fr_ow_17',
            fr_ow_18 = '$fr_ow_18',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
               
$FRc_CC_CSS_CODE = "
/*******************************************************/
/* FRD HEADER 4 STYLE  OW  FOR PC DEVICE*/
/*******************************************************/
.FrHeader4_PC{
    background: $fr_ow_16 !important;
}
.FrHeader4_PC .searchTerm {
    border: 2px solid $fr_ow_1 !important;
    color: black;
}
.FrHeader4_PC .searchTerm:focus {
    color: $fr_ow_2;
}
.FrHeader4_PC .searchButton {
    border: 2px solid $fr_ow_3 !important;
    background: $fr_ow_4 !important;
    color: $fr_ow_5 !important;
}

.FrHeader4_PC .fricon_cart{
    color: $fr_ow_6 !important;
}

.FrHeader4_PC .fricon_user{
    color: $fr_ow_7 !important;
}

.FrHeader4_PC .fricon_home{
    color: $fr_ow_8 !important;
}

.FrHeader4_PC .fricon_sn1_showAhied span{
    color: $fr_ow_9 !important;
}

/*******************************************************/
/* FRD HEADER 4 STYLE  OW  FOR MOBILE DEVICE*/
/*******************************************************/
.FrHeader4_Mob{
    background: $fr_ow_10 !important;
}
.FrHeader4_Mob .frbtn_sidenaveopen{
    color: $fr_ow_11 !important;
}

.FrHeader4_Mob .fricon_user{
    color: $fr_ow_12 !important;
}


.FrHeader4_Mob input {
    border: 2px solid $fr_ow_13 !important;
}
.FrHeader4_Mob input:focus {
    border: 2px solid $fr_ow_14 !important;
}
.FrHeader4_Mob .input-group-addon {
    border: 1px solid $fr_ow_15 !important;
    background: $fr_ow_17 !important;
    color: $fr_ow_18 !important;
}
";

                try{
                    $FR_CONN->exec("UPDATE frd_themecolor SET 
                    fr_cc_header = '$FRc_CC_CSS_CODE', 
                    fr_cc_header_id = 4  
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

<?php if($frtc_header_n == 4){ ?>
<!-- HEADER 4 PC -->
<div id="ow_header" class="row mt-10">
    <div class="col-md-12 jumbotron">
         <h4 class="text-center boldd text-success" title="<?php echo "Header #$frtc_header_n";?>">Header Color Customization (PC)</h4>
         <form action="" method="POST">
            <table class="table" width="100%">
                <tr>
                    <td>Background Color</td>
                    <td>
                        <input type="color" name="fr_ow_16" value="<?php echo "$fr_ow_16"?>">
                    </td>
                </tr>
                <tr>
                    <td>Side Nave Open/Close Icon Color</td>
                    <td><input type="color" name="fr_ow_9" value="<?php echo "$fr_ow_9";?>"></td>
                </tr>
                <tr>
                    <td>Home Icon Color</td>
                    <td><input type="color" name="fr_ow_8" value="<?php echo "$fr_ow_8";?>"></td>
                </tr>
                <tr>
                    <td>Search Box Border</td>
                    <td>
                        <input type="color" name="fr_ow_1" value="<?php echo "$fr_ow_1";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Box Focus</td>
                    <td>
                        <input type="color" name="fr_ow_2" value="<?php echo "$fr_ow_2";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Border</td>
                    <td>
                        <input type="color" name="fr_ow_3" value="<?php echo "$fr_ow_3";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_4" value="<?php echo "$fr_ow_4";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_5" value="<?php echo "$fr_ow_5";?>">
                    </td>
                </tr>
                <tr>
                    <td>Cart Icon Color</td>
                    <td><input type="color" name="fr_ow_6" value="<?php echo "$fr_ow_6";?>"></td>
                </tr>
                <tr>
                    <td>User Icon Color</td>
                    <td><input type="color" name="fr_ow_7" value="<?php echo "$fr_ow_7";?>"></td>
                </tr>





                <tr>
                    <td colspan="2"> 
                        <h4 class="text-center boldd text-primary" title="<?php echo "Header #$frtc_header_n";?>">Header Color Customization (Mobile)</h4>
                    </td>
                </tr>
                <tr>
                    <td>Background Color</td>
                    <td>
                        <input type="color" name="fr_ow_10" value="<?php echo "$fr_ow_10"?>">
                    </td>
                </tr>
                <tr>
                    <td>Side Nave Open Icon Color</td>
                    <td><input type="color" name="fr_ow_11" value="<?php echo "$fr_ow_11";?>"></td>
                </tr>
                <tr>
                    <td>User Icon Color</td>
                    <td><input type="color" name="fr_ow_12" value="<?php echo "$fr_ow_12";?>"></td>
                </tr>
                <tr>
                    <td>Search Box Border</td>
                    <td>
                        <input type="color" name="fr_ow_13" value="<?php echo "$fr_ow_13";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Box Focus</td>
                    <td>
                        <input type="color" name="fr_ow_14" value="<?php echo "$fr_ow_14";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Border</td>
                    <td>
                        <input type="color" name="fr_ow_15" value="<?php echo "$fr_ow_15";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Background</td>
                    <td>
                        <input type="color" name="fr_ow_17" value="<?php echo "$fr_ow_17";?>">
                    </td>
                </tr>
                <tr>
                    <td>Search Button Text Color</td>
                    <td>
                        <input type="color" name="fr_ow_18" value="<?php echo "$fr_ow_18";?>">
                    </td>
                </tr>
                
            </table>
            
            <br>
            <div class='text-center'>
			    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Update Header Color</button>
		    </div>
         </form>
    </div>
</div>
<?php } ?> 


    </div>
    </div>
</section>





<?php require_once('frd1_footer.php'); ?>  