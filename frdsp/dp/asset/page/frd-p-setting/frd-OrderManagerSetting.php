<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Order Manager Setting";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Order Manager Setting </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
if(isset($_POST['frsc_om_deforderlist'])){
     extract($_POST);

     if(!isset($frsc_om_bulk_invo_num)){$frsc_om_bulk_invo_num = 1;}else{
        $frsc_om_bulk_invo_num =  base64_decode(base64_decode($frsc_om_bulk_invo_num));
     }
    
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_soft_config SET 
                frsc_om_deforderlist = :frsc_om_deforderlist,
                frsc_om_bulk_invo_num = :frsc_om_bulk_invo_num
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':frsc_om_deforderlist', $frsc_om_deforderlist, PDO::PARAM_STR);
                $FRQ->bindParam(':frsc_om_bulk_invo_num', $frsc_om_bulk_invo_num, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
  
}



if(isset($_POST['fr_sf_api_key'])){
     extract($_POST);

        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_qapi_steadfast SET 
                fr_sf_clientid = :fr_sf_clientid,
                fr_sf_api_key = :fr_sf_api_key,
                fr_sf_secret_key = :fr_sf_secret_key
                WHERE id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_sf_clientid', $fr_sf_clientid, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_sf_api_key', $fr_sf_api_key, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_sf_secret_key', $fr_sf_secret_key, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Update Failed","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
}




if(isset($_POST['fr_pat_client_id'])){
     extract($_POST);
     
     
     
     
        //FRD DATA UPDATE S:-
            try{
                $FRQ = "UPDATE frd_qapi_pathao SET 
                fr_pat_client_id = :fr_pat_client_id,
                fr_pat_client_secret = :fr_pat_client_secret,
                fr_pat_client_email = :fr_pat_client_email,
                fr_pat_client_password = :fr_pat_client_password,
                fr_pat_store_id = :fr_pat_store_id,
                fr_pat_base_url = :fr_pat_base_url
                WHERE fr_pat_id = 1";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_pat_client_id', $fr_pat_client_id, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_pat_client_secret', $fr_pat_client_secret, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_pat_client_email', $fr_pat_client_email, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_pat_client_password', $fr_pat_client_password, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_pat_store_id', $fr_pat_store_id, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_pat_base_url', $fr_pat_base_url, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!"," Pathao Update Done","success");
            }catch(PDOException $e){
                FR_SWAL("$UsrName Pathao Update Failed","","error");
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
                        <span>Default Order List </span><br>
                        <input type="radio" name="frsc_om_deforderlist" value="all" <?php if ($frsc_om_deforderlist == "all") { echo "checked";} ?> required> ALL &#160; &#160;&#160;
                        <input type="radio" name="frsc_om_deforderlist" value="new" <?php if ($frsc_om_deforderlist == "new") { echo "checked";} ?> required> Only New



                        <br><br><br>
                        <span>Bulk Print Invoice Style</span>
                         <select class='form-control' name='frsc_om_bulk_invo_num' required>
                            <option value='<?php echo "$frsc_om_bulk_invo_num";?>'><?php echo "Bulk Print Invoice Style $frsc_om_bulk_invo_num";?></option>
                            <?php 
                              $FRc_ARR = explode(",","$frsc_om_invoices");
                              foreach($FRc_ARR AS $ITEM){
                                echo "<option value='".base64_encode(base64_encode($ITEM))."'>Bulk Print Invoice Style $ITEM</option>";
                              }
                            ?>
                        </select>



                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
            </div>
           </div>




           <?php if($frplug_api_steadfast == 1){
            //FRD SOFTWARE CONFIG TABLE DATA:-
            $FRR = FR_QSEL("SELECT * FROM frd_qapi_steadfast WHERE id = 1","");
            if($FRR['FRA']==1){ 
            extract($FRR['FRD']);
            } else{ ECHO_4($FRR['FRM']); }
            //END>>
            ?>
           <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">
                       <h2 class="text-center text-danger boldd">SteadFast Courier Automatic Parcel Booking Services Activation</h2>
                       <h4 class='text-center'>Connect Your Website To SteadFast Courier</h4>
                        <span>Client ID</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_sf_clientid";?>" name="fr_sf_clientid" required>

                        <br>
                        <span>API Key</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_sf_api_key";?>" name="fr_sf_api_key" required>

                        <br>
                        <span>Secret Key </span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_sf_secret_key";?>" name="fr_sf_secret_key" required>


                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
            </div>
           </div>
           <?php } ?>





           <?php if($frplug_api_pathao == 1){
            //FRD TDR:-
            $FRR = FR_QSEL("SELECT * FROM frd_qapi_pathao WHERE fr_pat_id = 1","");
            if($FRR['FRA']==1){ 
            extract($FRR['FRD']);
            } else{ ECHO_4($FRR['FRM']); }
            //END>>
            ?>
           <div class="row">
            <div class="col-md-12 jumbotron">
                <form action="" method="POST">
                       <h2 class="text-center text-danger boldd">Pathao Booking API Configer</h2>
                        <span>Client ID</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_client_id";?>" name="fr_pat_client_id" required>

                        <br>
                        <span>Client Secret</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_client_secret";?>" name="fr_pat_client_secret" required>

                        <br>
                        <span>Client Email</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_client_email";?>" name="fr_pat_client_email" required>

                        <br>
                        <span>Client Password </span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_client_password";?>" name="fr_pat_client_password" required>

                        <br>
                        <span>Store ID </span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_store_id";?>" name="fr_pat_store_id" required>

                        <br>
                        <span>Hit URL</span><br>
                        <input class="form-control" type="text" value="<?php echo "$fr_pat_base_url";?>" name="fr_pat_base_url" required>


                    <div class='text-right mt-10'>
                        <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save</button>
                    </div>  
                </form>
            </div>
           </div>
           <?php } ?>
          





        </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   