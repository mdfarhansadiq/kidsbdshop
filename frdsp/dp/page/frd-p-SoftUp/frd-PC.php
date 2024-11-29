<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Plugin Config";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Plugin Config </h2>


<!-- 1 SCRIPT START -->   
<section>
<?php 

if(isset($_POST['frtex_PixelTrack'])){
     extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_soft_config SET 
                frtex_PixelTrack = :frtex_PixelTrack,
                frtex_PixelId = :frtex_PixelId
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frtex_PixelTrack', $frtex_PixelTrack, PDO::PARAM_INT);
                $FRQ->bindParam(':frtex_PixelId', $frtex_PixelId, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","Pixel Tracking Actived","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}





if(isset($_POST['frplug_capi'])){
     extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_soft_config SET 
                frplug_capi = :frplug_capi
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frplug_capi', $frplug_capi, PDO::PARAM_INT);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!","CAPI Plugin Activated Completed","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
if(isset($_POST['fr_capi_ds_id'])){
     extract($_POST);
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_capi SET 
                fr_capi_ds_id = :fr_capi_ds_id,
                fr_capi_accesstoken = :fr_capi_accesstoken,
                fr_capi_test_event_code = :fr_capi_test_event_code
                WHERE fr_capi_id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_capi_ds_id', $fr_capi_ds_id, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_capi_accesstoken', $fr_capi_accesstoken, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_capi_test_event_code', $fr_capi_test_event_code, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Completed","success");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}
?>   
</section>
<!-- 1 SCRIPT END -->    

   

<section>
    <div class="container">
        <div class="col-md-11">
    


        <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">
                       <h2 class="text-center text-danger boldd"> Pixel Tracking</h2>
                        <span>Pixel Tracking </span> <br>
                        <input type="radio" name="frtex_PixelTrack" value="0" <?php if ($frtex_PixelTrack== "0") { echo "checked";} ?> required> Deactivated <br>
                        <input type="radio" name="frtex_PixelTrack" value="1" <?php if ($frtex_PixelTrack== "1") { echo "checked";} ?> required> Activated Without Daynamic Value &#160; &#160;&#160; <br>
                        <input type="radio" name="frtex_PixelTrack" value="2" <?php if ($frtex_PixelTrack== "2") { echo "checked";} ?> required> Activated With Daynamic Value &#160; &#160;&#160;
                        <br><br>


                        <span>Dataset ID</span><br>
                        <input class="form-control" type="text" value="<?php echo "$frtex_PixelId";?>" name="frtex_PixelId" required>

                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
                 <hr>

            </div>
           </div>



           <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">
                       <h2 class="text-center text-danger boldd"> Server Site Tracking</h2>
                        <span>Server Site Tracking </span> <br>
                        <input type="radio" name="frplug_capi" value="1" <?php if ($frplug_capi == "1") { echo "checked";} ?> required> Active &#160; &#160;&#160;
                        <input type="radio" name="frplug_capi" value="0" <?php if ($frplug_capi == "0") { echo "checked";} ?> required> Deactivated
                        <br><br>
                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
                 <hr>

                 <?php if($frplug_capi == 1){
                    //FRD SOFTWARE CONFIG TABLE DATA:-
                    $FRR = FR_QSEL("SELECT * FROM frd_capi WHERE fr_capi_id = 1","");
                    if($FRR['FRA']==1){ 
                    extract($FRR['FRD']);
                    } else{ ECHO_4($FRR['FRM']); }
                    //END>>
                    ?>
                <div class="row">
                    <div class="col-md-12 jumbotron">
                        <form action="" method="POST">
                            <h4 class="text-center text-danger boldd"> Server Site Tracking Configer </h4>

                                <span>Dataset ID</span><br>
                                <input class="form-control" type="text" value="<?php echo "$fr_capi_ds_id";?>" name="fr_capi_ds_id" required>

                                <br>
                                <span>Access Token</span><br>
                                <textarea class="form-control" name="fr_capi_accesstoken" id="" cols="30" rows="3" required><?php echo "$fr_capi_accesstoken";?></textarea>

                                <br>
                                <span>Test Event Code </span><br>
                                <input class="form-control" type="text" value="<?php echo "$fr_capi_test_event_code";?>" name="fr_capi_test_event_code">


                            <div class='text-right mt-10'>
                                <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                            </div>  
                        </form>
                    </div>
                </div>
                <?php } ?>

            </div>
           </div>


        </div>
    </div>
</section>


<?php require_once('frd1_footer.php'); ?>