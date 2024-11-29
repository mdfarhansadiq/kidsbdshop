<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Order Track Page Custom Message";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="EditMess_OrderTrackPageCustom";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Edit Order Track Page Custom Message </h2>


<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['f_pagebody'])){
    $f_pagebody = $_POST['f_pagebody']; 
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_pages SET 
                page_body_en = :page_body_en 
                WHERE id = 20";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':page_body_en', $f_pagebody, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Message Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Message Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}




//---------------------------------------------------------
//FRD  DATA UPDATE
//---------------------------------------------------------
if(isset($_POST['frtc_track_pg_ctom_mess'])){
    $FR_VC_DATA_PROCESS = "";
    $FR_VC_ARF = "";//ALL REQUIRED FILD

    $frtc_track_pg_ctom_mess = $_POST["frtc_track_pg_ctom_mess"];

//FRD_VC___________DATA PROSESSED OR NOT:-
    if(isset($frtc_track_pg_ctom_mess)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}
//FRD_VC___________ALL REQUIRED FILED:-
    if($frtc_track_pg_ctom_mess != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }
    

    if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
        $FRQ = "UPDATE frd_themeconfig SET 
        frtc_track_pg_ctom_mess = '$frtc_track_pg_ctom_mess',
        fr_dumy_txt = '$FR_NOW_TIME'
        WHERE id = 1";
        $R = FR_DATA_UP("$FRQ");
        if($R['FRA']==1){
            $_SESSION['FRs_frtc_lang'] = "$frtc_lang";
            FR_SWAL("Dear Boss $UsrName!","Update Done!","success");
            FR_GO("$FR_THIS_PAGE","1");
            exit;
        }else{
            FR_SWAL("Dear Boss $UsrName!"," Update Failed","error");
            FR_GO("$FR_THIS_PAGE","1");
            exit;
        }
    }

}
//END>>




//FRD PAGE TABLE DATA READ:-
$FRR = FR_QSEL("SELECT * FROM frd_pages WHERE id = 20","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   




<section>
    <div class="container">
        <div class="col-md-11">

            <div class="row">
            <div class="col-md-12 jumbotron">
              <form id="" class="pageditform" action="" method="post" enctype="multipart/form-data" >
                
                        <input type="radio" name="frtc_track_pg_ctom_mess" value="1" <?php if ($frtc_track_pg_ctom_mess == "1") { echo "checked";} ?> required> Show &#160; &#160;&#160;
                        <input type="radio" name="frtc_track_pg_ctom_mess" value="0" <?php if ($frtc_track_pg_ctom_mess == "0") { echo "checked";} ?> required> Hide
                        
                    <br><br>
                    <textarea class="form-control mt-10" name="f_pagebody" id="summernote" style="height: 500px !important;"><?php echo "$page_body_en"?></textarea>

                    <div class='text-right'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  

              </form>
            </div> 
            </div>


        </div>
    </div>
</section>







<?php require_once('frd1_footer.php'); ?>   