<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Rating Review Config";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Rating Review Config </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
//---------------------------------------------------------
//FRD THEME CONFIG TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['frtc_rating'])){

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
        if(isset($frtc_rating)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($frtc_rating != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_themeconfig SET 
            frtc_rating = '$frtc_rating',
            fr_dumy_txt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                $_SESSION['FRs_frtc_lang'] = "$frtc_lang";
                
                FR_SWAL("Dear Boss $UsrName!","Update Done","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }else{
                FR_SWAL("Dear Boss $UsrName!","Update Failed","error");
                FR_GO("$FR_THIS_PAGE","1");
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
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <form class="" id="" action="" method="post">

                    <div class="jumbotron">
                        <span>Products Rating Review  </span><br>
                        <input type="radio" name="frtc_rating" value="1" <?php if ($frtc_rating == "1") { echo "checked";} ?> required> Activated &#160; &#160;&#160;
                        <input type="radio" name="frtc_rating" value="0" <?php if ($frtc_rating == "0") { echo "checked";} ?> required> Deactivated
                    </div>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</section>





<?php require_once('frd1_footer.php'); ?>   